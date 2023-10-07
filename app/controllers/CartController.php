<?php

namespace app\controllers;

use wsb\App;
use app\models\Cart;

/** @property Cart $model */
class CartController extends AppController
{

    public function addAction()
    {
        $lang = App::$app->getProperty('language');
        $id = get('id');
        $qty = get('qty');

        if (!$id) {
            return false;
        }

        $pd = $this->model->getProduct($id, $lang);

        if (!$pd) {
            return false;
        }

        $this->model->addtoCart($pd, $qty);

        if ($this->isAjax()) {
            $this->loadView('cart_modal');
        }
        redirect();
        return true;
    }

    public function deleteAction()
    {
        $id = get('id');
        if (isset($_SESSION['cart'][$id])) {
            $this->model->deleteItem($id);
        }
        if ($this->isAjax()) {
            $this->loadView('cart_modal');
        }
        redirect();
    }

    public function showAction()
    {
        $this->loadView('cart_modal');
    }

    public function clearAction()
    {
        if (empty($_SESSION['cart'])) {
            return false;
        }
        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.sum']);
        $this->loadView('cart_modal');
        return true;
    }

}