<?php

namespace app\controllers\admin;

use app\models\admin\Product;
use wsb\App;
use wsb\Pagination;
use RedBeanPHP\R;

/** @property Product $model */
class ProductController extends AppController
{

    public function indexAction()
    {
        $lang = App::$app->getProperty('language');
        $page = get('page');
        $perpage = 10;
        $total = R::count('product');
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $products = $this->model->get_products($lang, $start, $perpage);
        $title = 'Список товарів';
        $this->setMeta("Панель адміністратора :: {$title}");
        $this->set(compact('title', 'products', 'pagination', 'pagination', 'total'));

    }

    public function addAction()
    {
        if(!empty($_POST)){
            if($this->model->product_validate()){
                if($this->model->save_product()){
                    $_SESSION['success'] = 'Товар було успішно додано.';
                }else{
                    $_SESSION['errors'] = 'Помилка! Товар не додано.';
                }
            }
            redirect();
        }

        $title = 'Новий товар';
        $this->setMeta("Панель адміністратора :: {$title}");
        $this->set(compact('title'));
    }

    public function getDownloadAction()
    {
        $q = get('q', 's');
        $downloads = $this->model->get_downloads($q);
        echo json_encode($downloads);
        die;

    }

    public function editAction()
    {
        $id = get('id');

        if(!empty($_POST)){
            if($this->model->product_validate()){
                if($this->model->update_product($id)){
                    $_SESSION['success'] = 'Товар збережено.';
                }else{
                    $_SESSION['errors'] = 'Помилка! Не вдалось оновити товар';
                }
            }
        }

        $product = $this->model->get_product($id);
        if(!$product){
            throw new \Exception('Not found product', 404);
        }

        $gallery = $this->model->get_gallery($id);

        $lang = App::$app->getProperty('language')['id'];
        App::$app->setProperty('parent_id', $product[$lang]['category_id']);
        $title = 'Редагування товару';
        $this->setMeta("Панель адміністратора :: {$title}");
        $this->set(compact('title', 'product', 'gallery'));
    }



}