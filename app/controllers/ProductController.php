<?php

namespace app\controllers;

use app\models\Product;
use wsb\App;

/* @property Product $model */
class ProductController extends AppController
{
    public function viewAction()
    {
        $lang = App::$app->getProperty('language');
        $product = $this->model->get_product($this->route['slug'], $lang);

        if(!$product){
            throw new \Exception("Can't find {$this->route['slug']} product");
        }

        $gallery = $this->model->get_gallery($product['id']);
        

//        $this->setMeta($product['title'], $product['description'], $product['keywords']);
        $this->set(compact('product', 'gallery'));
    }
}