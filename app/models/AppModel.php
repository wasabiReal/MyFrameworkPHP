<?php


namespace app\models;

use RedBeanPHP\R;
use wsb\Model;

class AppModel extends Model
{

    public static function create_slug($table, $field, $str, $id): string
    {
        $str = self::str2url($str);
        $res = R::findOne($table, "$field = ?", [$str]);
        if ($res) {
            $str = "{$str}-{$id}";
            $res = R::count($table, "$field = ?", [$str]);
            if ($res) {
                $str = self::create_slug($table, $field, $str, $id);
            }
        }
        return $str;
    }

    public static function str2url($str): string
    {
        $str = self::ua2translit($str);
        $str = strtolower($str);
        $str = preg_replace('~[^-a-z0-9]+~u', '-', $str);
        $str = trim($str, "-");
        return $str;
    }

    public static function ua2translit($string): string
    {

        $converter = array(

            'а' => 'a',     'б' => 'b',     'в' => 'v',     'г' => 'h',
            'ґ' => 'g',     'д' => 'd',     'е' => 'e',     'є' => 'ye',
            'ж' => 'zh',    'з' => 'z',     'и' => 'y',     'і' => 'i',
            'ї' => 'yi',    'й' => 'y',     'к' => 'k',     'л' => 'l',
            'м' => 'm',     'н' => 'n',     'о' => 'o',     'п' => 'p',
            'р' => 'r',     'с' => 's',     'т' => 't',     'у' => 'u',
            'ф' => 'f',     'х' => 'kh',    'ц' => 'ts',    'ч' => 'ch',
            'ш' => 'sh',    'щ' => 'shch',  'ь' => '\'',    'ю' => 'yu',    'я' => 'ya',

            'А' => 'A',     'Б' => 'B',     'В' => 'V',     'Г' => 'H',
            'Ґ' => 'G',     'Д' => 'D',     'Е' => 'E',     'Є' => 'Ye',
            'Ж' => 'Zh',    'З' => 'Z',     'И' => 'Y',     'І' => 'I',
            'Ї' => 'Yi',    'Й' => 'Y',     'К' => 'K',     'Л' => 'L',
            'М' => 'M',     'Н' => 'N',     'О' => 'O',     'П' => 'P',
            'Р' => 'R',     'С' => 'S',     'Т' => 'T',     'У' => 'U',
            'Ф' => 'F',     'Х' => 'Kh',    'Ц' => 'Ts',    'Ч' => 'Ch',
            'Ш' => 'Sh',    'Щ' => 'Shch',  'Ь' => '\'',    'Ю' => 'Yu',    'Я' => 'Ya',

        );

        return strtr($string, $converter);

    }

}