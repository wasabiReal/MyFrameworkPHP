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

}