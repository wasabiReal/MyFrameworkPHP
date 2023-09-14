<?php

namespace app\controllers;

use app\models\AppModel;
use app\widgets\language\Language;
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


    }
}