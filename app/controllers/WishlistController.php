<?php

namespace app\controllers;

use app\models\Wishlist;

/** @property Wishlist $model */
class WishlistController extends AppController
{

    public function addAction()
    {
        $id = get('id');
        if(!$id){
            $answer = ['result' => 'error', 'text' => ___('wishlist_index_not_found')];
            exit(json_encode($answer));
        }

        $product = $this->model->get_product($id);
        if($product){
            $this->model->add_to_wishlist($id);
            $answer = ['result' => 'success', 'text' => ___('wishlist_index_add_success')];
        }else{
            $answer = ['result' => 'error', 'text' => ___('wishlist_index_not_found')];
        }

    }

}