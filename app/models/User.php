<?php

namespace app\models;

class User extends AppModel
{

    public array $attributes = [
        'email' => '',
        'password' => '',
        'name' => '',
        'address' => ''
    ];
    public array $rules = [
        'required' => ['email', 'password', 'name', 'address'],
        'email' => ['email'],
        'lengthMin' => [
            ['password', 6],
        ]
    ];

    public array $labels = [
        'email' => 'tpl_signup_email_input',
        'password' => 'tpl_signup_password_input',
        'name' => 'tpl_signup_name_input',
        'address' => 'tpl_signup_address_input'
    ];

    public static function checkAuth(): bool
    {
        return isset($_SESSION['user']);
    }

    public function checkUnique($text_error = ''): bool
    {
        $user = R::findOne('user', 'email = ?', [$this->attributes['email']]);
        if($user){
            $this->errors['unique'][] = $text_error ?: ___('user_signup_error_email_unique');
            return false;
        }
    }

}