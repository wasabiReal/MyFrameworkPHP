<?php

namespace app\controllers\admin;

use app\models\admin\User;
use RedBeanPHP\R;
use wsb\Pagination;

/** @property User $model */
class UserController extends AppController
{

    public function loginAdminAction()
    {

        if($this->model::isAdmin()){
            redirect(ADMIN);
        }

        $this->layout = 'login';

        if(!empty($_POST)){
            if($this->model->login(true)){
                $_SESSION['success'] = 'Успішна авторизація';
            }else{
                $_SESSION['errors'] = 'Логін/пароль не правильні';
            }
            if($this->model::isAdmin()){
                redirect(ADMIN);
            }else{
                redirect();
            }
        }
    }

    public function logoutAction()
    {
        if($this->model::isAdmin()){
            unset($_SESSION['user']);
        }
        redirect(ADMIN . '/user/login-admin');
    }

    public function indexAction()
    {
        $page = get('page');
        $perpage = 10;
        $total = R::count('user');
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $users = $this->model->get_users($start, $perpage);

        $title = 'Користувачі';
        $this->setMeta("{$title} :: Панель адміністратора");
        $this->set(compact('title', 'pagination', 'total', 'users'));
    }

    public function viewAction()
    {
        $id = get('id');

        $user = $this->model->get_user($id);
        if(!$user){
            throw new \Exception("Not found user by ID: {$id}", 404);
        }

        $page = get('page');
        $perpage = 5;
        $total = $this->model->getCountOrders($id);
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $orders = $this->model->getUserOrders($start, $perpage, $id);

        $title = 'Користувачі';
        $this->setMeta("{$title} :: Панель адміністратора");
        $this->set(compact('title', 'pagination', 'total', 'user', 'orders'));
    }

}