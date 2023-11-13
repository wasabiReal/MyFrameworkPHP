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


}