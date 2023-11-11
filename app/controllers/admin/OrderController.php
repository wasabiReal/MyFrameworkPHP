<?php

namespace app\controllers\admin;

use RedBeanPHP\R;
use wsb\Pagination;

/** @property Order $model */
class OrderController extends AppController
{

    public function indexAction()
    {
        $status = get('status', 's');
        $status = ($status == 'new') ? 'status = 0' : '';

        $page = get('page');
        $perpage = 5;
        $total = R::count('orders', $status);
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $orders = $this->model->get_orders($start, $perpage, $status);

        $title = "Усі замовлення";
        $this->setMeta("Панель адміністратора :: {$title}");
        $this->set(compact('title', 'orders', 'pagination', 'total'));
    }

    public function editAction()
    {
        $id = get('id');
        if(isset($_GET['status'])){
            $status = get('status');
            if ($this->model->change_status($id, $status)){
                $_SESSION['success'] = "Статус замовлення було змінено.";
            }else{
                $_SESSION['errors'] = "Помилка! Не можливо змінити статус замовлення.";
            }
        }

        $order = $this->model->get_order($id);

        if(!$order){
            throw new \Exception('Not found order', 404);
        }


        $title = "Замовлення № {$id}";
        $this->setMeta("{$title} :: Панель адміністратора");
        $this->set(compact('title', 'order'));

    }



}


