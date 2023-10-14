<?php

namespace app\controllers\admin;

use RedBeanPHP\R;

class CategoryController extends AppController
{

    public function indexAction()
    {
        $title = 'Категорії';
        $this->setMeta("Панель адміністратора :: {$title}");
        $this->set(compact('title'));
    }

    public function deleteAction()
    {
        $id = get('id');
        $errors = '';
        $children = R::count('category', 'parent_id = ?', [$id]);
        $products = R::count('product', 'category_id = ?', [$id]);
        if($children){
            $errors .= 'Помилка, в категорії є вкладеність<br>';
        }
        if($products){
            $errors .= 'Помилка, в категорії є товари<br>';
        }
        if($errors){
            $_SESSION['errors'] = $errors;
        }else{
            R::exec("DELETE FROM category WHERE id = ?", [$id]);
            R::exec("DELETE FROM category_desc WHERE category_id = ?", [$id]);
            $_SESSION['success'] = 'Категорія була видалена';
        }
        redirect();
    }

}