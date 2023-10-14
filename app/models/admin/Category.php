<?php


namespace app\models\admin;


use app\models\AppModel;
use RedBeanPHP\R;

class Category extends AppModel
{

    public function category_validate(): bool
    {
        $errors = '';
        foreach ($_POST['category_desc'] as $lang_id => $item) {
            $item['title'] = trim($item['title']);
            if (empty($item['title'])) {
                $errors .= "Не заповнено поле Заголовок у вкладці {$lang_id}<br>";
            }
        }
        if ($errors) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            return false;
        }
        return true;
    }



}