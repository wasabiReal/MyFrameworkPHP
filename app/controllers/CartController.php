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

        if(!$id){
            return false;
        }

        $pd = $this->model->getProduct($id, $lang);

        if(!$pd){
            return false;
        }

        $this->model->addtoCart($pd, $qty);

        if($this->isAjax()){
            $this->loadView('cart_modal');
        }
        redirect();
        return true;
    }

}