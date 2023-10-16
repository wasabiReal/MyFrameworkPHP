<?php

namespace app\controllers\admin;

use app\models\admin\Category;
use RedBeanPHP\R;
use wsb\App;

/** @property Category $model */
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

    public function addAction()
    {
        if (!empty($_POST)) {
            if ($this->model->category_validate()) {
                if($this->model->save_category()){
                    $_SESSION['success'] = 'Категорію збережено';
                }
                else{
                    $_SESSION['errors'] = 'Помилка збереження категорії';
                }
            }
            redirect();
        }
        $title = 'Створення категорії';
        $this->setMeta("Панель адміністратора :: {$title}");
        $this->set(compact('title'));
    }

    public function editAction()
    {
        $id = get('id');
        if(!empty($_POST)){
            if($this->model->category_validate()){
                if($this->model->update_category($id)){
                    $_SESSION['success'] = 'Категорію оновлено';
                }else{
                    $_SESSION['errors'] = 'Виникла помилка!';
                }
            }
            redirect();
        }
        $category = $this->model->get_category($id);
        if(!$category){
            throw new \Exception('No categories found', 404);
        }
        $lang = App::$app->getProperty('language')['id'];
        App::$app->setProperty('parent_id', $category[$lang]['parent_id']);
        $title = 'Редагування категорії';
        $this->setMeta("Панель адміністратора :: {$title}");
        $this->set(compact('title', 'category'));
    }

}