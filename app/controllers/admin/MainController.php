<?php

namespace app\controllers\admin;

use wsb\Controller;

class MainController extends AppController
{
    public function indexAction()
    {
        $title = 'Головна сторінка';
        $this->setMeta('adminka');
        $this->set(compact('title'));
    }
}