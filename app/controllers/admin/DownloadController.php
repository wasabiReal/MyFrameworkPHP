<?php


namespace app\controllers\admin;


use app\models\admin\Download;
use RedBeanPHP\R;
use wsb\App;
use wsb\Pagination;

/** @property Download $model */
class DownloadController extends AppController
{

    public function indexAction()
    {
        $lang = App::$app->getProperty('language');
        $page = get('page');
        $perpage = 20;
        $total = R::count('download');
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $downloads = $this->model->get_downloads($lang, $start, $perpage);
        $title = 'Файли';
        $this->setMeta("Панель адміністратора :: {$title}");
        $this->set(compact('title', 'downloads', 'pagination', 'total'));
    }


    public function addAction()
    {
        if(!empty($_POST)){
            if($this->model->download_validate()){
                if($data = $this->model->upload_file()){
                    if($this->model->save_download($data)){
                        $_SESSION['success'] = 'Файл було додано успішно';
                    }else {
                        $_SESSION['errors'] = 'Помилка завантаження файла';
                    }
                }else {
                    $_SESSION['errors'] = 'Помилка переміщення файла';
                }
            }
            redirect();
        }

        $title = 'Додавання файлу';
        $this->setMeta("Панель адміністратора :: {$title}");
        $this->set(compact('title'));
    }


    public function deleteAction()
    {

    }
}