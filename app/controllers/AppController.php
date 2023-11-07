<?php

namespace app\controllers;

use app\models\AppModel;
use app\models\Wishlist;
use app\widgets\language\Language;
use RedBeanPHP\R;
use wsb\App;
use wsb\Controller;

class AppController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();

        App::$app->setProperty('languages', Language::getLanguages());
        App::$app->setProperty('language', Language::getLanguage(App::$app->getProperty('languages')));


        $lang = App::$app->getProperty('language');
        \wsb\Language::load($lang['code'], $this->route);


        $categories = R::getAssoc("SELECT c.*, cd.* FROM category c
                        JOIN category_desc cd
                        ON c.id = cd.category_id
                        WHERE cd.language_id = ?", [$lang['id']]);

        App::$app->setProperty("categories_{$lang['code']}", $categories);

        App::$app->setProperty('wishlist', Wishlist::get_wishlist_ids());

    }
}