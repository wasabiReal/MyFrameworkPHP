<?php

namespace app\models\admin;

use RedBeanPHP\R;

class User extends \app\models\User
{

    public array $attributes = [
        'email' => '',
        'password' => '',
        'name' => '',
        'address' => '',
        'role' => ''
    ];

    public array $rules = [
        'required' => ['email', 'password', 'name', 'address', 'role'],
        'email' => ['email'],
        'lengthMin' => [
            ['password', 6],
        ],
        'optional' => ['password'],
    ];

    public array $labels = [
        'email' => 'E-mail',
        'password' => 'Пароль',
        'name' => "Ім'я",
        'address' => 'Адреса',
        'role' => 'Роль'
    ];

    public static function isAdmin(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin';
    }

    public function get_users($start, $perpage): array
    {
        return R::findAll("user", "LIMIT $start, $perpage");
    }

    public function get_user($id): array
    {
        return R::getRow("SELECT * FROM user WHERE id = ?", [$id]);
    }

    public function checkEmail($user_data): bool
    {
        if($user_data['email'] == $this->attributes['email']){
            return true;
        }
        $user = R::findOne("user", "email = ?", [$this->attributes['email']]);
        if($user){
            $this->errors['unique'][] = 'Ця електронна почта використовується іншим користувачем';
            return false;
        }
        return true;
    }





}



