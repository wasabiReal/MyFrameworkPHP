<?php

namespace app\controllers\admin;

use wsb\Controller;

class MainController extends Controller
{
    public function indexAction(){
        echo '<h1>Admin page</h1>';
    }
}