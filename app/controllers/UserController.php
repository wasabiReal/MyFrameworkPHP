<?php

namespace app\controllers;

use app\models\User;

/** @property User $model */
class UserController extends AppController
{

    public function signupAction()
    {
        if (User::checkAuth()) {
            redirect(base_url());
        }

        if (!empty($_POST)) {
            $data = $_POST;
            $this->model->load($data);
            if(!$this->model->validate($data)){
                $this->model->getErrors();
            }else{
                $_SESSION['success'] = ___('user_signup_success_register');
            }
            redirect();
        }

        $this->setMeta(___('tpl_signup'));
    }


}