<?php

namespace app\controllers;

use app\models\Main;
use RedBeanPHP\R;
use wsb\App;
use wsb\Cache;
use wsb\Language;

/** @property Main $model */
class MainController extends AppController
{
    public function indexAction(){

        $language = App::$app->getProperty('language');

        $slides = R::findAll('slider');


        $products = $this->model->getHits($language, 6);

        $this->set(compact('slides', 'products'));
        $this->setMeta(___('main_index_meta_title'), ___('main_index_meta_description'), ___('main_index_meta_keywords'));
    }
}