<?php

namespace app\controllers\admin;

use RedBeanPHP\R;
use wsb\Controller;

class MainController extends AppController
{
    public function indexAction()
    {
        $orders = R::count('orders');
        $neworders = R::count('orders', 'status = 0');
        $users = R::count('user');
        $products = R::count('product');
        $title = 'Головна сторінка';
        $this->setMeta('Панель адміністратора');
        $this->set(compact('title', 'orders', 'neworders', 'users', 'products'));
    }
}