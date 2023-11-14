<?php

namespace app\models\admin;

use app\models\AppModel;
use RedBeanPHP\R;
use wsb\App;

class Page extends AppModel
{

    public function get_pages($lang, $start, $perpage): array
    {
        return R::getAll("SELECT p.*, pd.title FROM page p JOIN page_description pd ON p.id = pd.page_id WHERE pd.language_id = ? LIMIT 
                              $start, $perpage", [$lang['id']]);
    }

    public function deletePage($id): bool
    {
        R::begin();
        try {
            $page = R::load('page', $id);
            if(!$page){
                return false;
            }
            R::trash($page);
            R::exec("DELETE FROM page_description WHERE page_id = ?", [$id]);
            R::commit();
            return true;
        }catch (\Exception $e){
            R::rollback();
            return false;
        }
    }

    public function page_validate(): bool
    {
        $errors = '';
        foreach ($_POST['page_description'] as $lang_id => $item){
            $item['title'] = trim($item['title']);
            $item['content'] = trim($item['content']);
            if(empty($item['title'])){
                $errors .= "Не заповнено поле Позначення у вкладці {$lang_id}<br>";
            }
            if(empty($item['content'])){
                $errors .= "Не заповнено Контент у вкладці {$lang_id}<br>";
            }
        }

        if(!empty($errors)){
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            return false;
        }

        return true;
    }

    public function save_page(): bool
    {
        $lang = App::$app->getProperty('language')['id'];
        R::begin();
        try {
            $page = R::dispense('page');
            $page_id = R::store($page);
            $page->slug = AppModel::create_slug('page', 'slug', $_POST['page_description'][$lang]['title'], $page_id);
            R::store($page);

            foreach ($_POST['page_description'] as $lang_id => $item){
                R::exec("INSERT INTO page_description (page_id, language_id, title, content, keywords, description) VALUES (?,?,?,?,?,?)",
                    [
                        $page_id,
                        $lang_id,
                        $item['title'],
                        $item['content'],
                        $item['keywords'],
                        $item['description'],
                    ]);
            }

            R::commit();
            return true;
        }catch (\Exception $e){
            R::rollback();
            $_SESSION['form_data'] = $_POST;
            return false;
        }
    }

    public function get_page($id): array
    {
        return R::getAssoc("SELECT pd.language_id, pd.*, p.* FROM page_description pd JOIN page p on pd.page_id = p.id WHERE pd.page_id = ?", [$id]);
    }

    public function update_page($id): bool
    {
        R::begin();
        try {
            $page = R::load('page', $id);
            if(!$page){
                return false;
            }
            // page_description
            foreach ($_POST['page_description'] as $lang_id => $item){
                R::exec("UPDATE page_description SET title = ?, content = ?, keywords = ?, description = ? WHERE page_id = ? AND language_id = ?",
                    [
                        $item['title'],
                        $item['content'],
                        $item['keywords'],
                        $item['description'],
                        $id,
                        $lang_id,
                    ]);
            }

            // product_gallery if exist

            if(!isset($_POST['gallery'])){
                R::exec("DELETE FROM product_gallery WHERE product_id = ?", [$id]);
            }

            if(isset($_POST['gallery']) && is_array($_POST['gallery'])){
                $gallery = self::get_gallery($id);

                if((count($gallery) != count($_POST['gallery'])) || array_diff($gallery, $_POST['gallery']) || array_diff($_POST['gallery'], $gallery)){
                    R::exec("DELETE FROM product_gallery WHERE product_id = ?", [$id]);
                    $sql = "INSERT INTO product_gallery (product_id, img) VALUES ";
                    foreach ($_POST['gallery'] as $item){
                        $sql .= "({$id}, ?),";
                    }
                    $sql = rtrim($sql, ',');
                    R::exec($sql, $_POST['gallery']);
                }
            }

            // product_download if is_download
            R::exec("DELETE FROM product_download WHERE product_id = ?", [$id]);
            if($product->is_download){
                $download_id = post('is_download', 'i');
                R::exec("INSERT INTO product_download (product_id, download_id) VALUES (?,?)", [$product_id, $download_id]);
            }

            R::commit();
            return true;
        }catch (\Exception $e){
            R::rollback();
            return false;
        }
    }

}