<?php

namespace app\controllers\admin;

use app\models\admin\Page;
use RedBeanPHP\R;
use wsb\App;
use wsb\Pagination;

/** @property Page $model */
class PageController extends AppController
{

    public function indexAction()
    {
        $lang = App::$app->getProperty('language');
        $page = get('page');
        $perpage = 3;
        $total = R::count('page');
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $pages = $this->model->get_pages($lang, $start, $perpage);

        $title = 'Список сторінок';
        $this->setMeta("{$title} :: Панель адміністратора");
        $this->set(compact('title', 'pages', 'pagination', 'total'));
    }

    public function deleteAction()
    {
        $id = get('id');
        if($this->model->deletePage($id)){
            $_SESSION['success'] = 'Сторінку було видалено!';
        }else{
            $_SESSION['errors'] = 'Помилка видалення сторінки!';
        }
        redirect();
    }

    public function addAction()
    {
        if(!empty($_POST)){
            if($this->model->page_validate()){
                if($this->model->save_page()){
                    $_SESSION['success'] = 'Сторінка створена!';
                }else{
                    $_SESSION['errors'] = 'Помилка створення сторінки!';
                }
            }
            redirect();
        }
        $title = 'Створення сторінки';
        $this->setMeta("{$title} :: Панель адміністратора");
        $this->set(compact('title'));
    }

    public function editAction()
    {
        $id = get('id');

        if(!empty($_POST)){
            if($this->model->page_validate()){
                if($this->model->update_page($id)){
                    $_SESSION['success'] = 'Сторінка успішно оновлена!';
                }else{
                    $_SESSION['errors'] = 'Не вдалось оновити сторінку!';
                }
            }
            redirect();
        }
        $page = $this->model->get_page($id);
        if(!$page){
            throw new \Exception("Not found page", 404);
        }

        $title = 'Редагування сторінки';
        $this->setMeta("{$title} :: Панель адміністратора");
        $this->set(compact('title', 'page'));
    }



}


