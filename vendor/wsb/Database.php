<?php

namespace wsb;

use Exception;
use RedBeanPHP\R;

class Database
{
    use TSingleton;

    private function __construct()
    {
        $db = require_once CONFIG . '/database.php';
        R::setup($db['dns'], $db['user'], $db['password']);
        if (!R::testConnection()) {
            throw new Exception('No connection to Database!', 500);
        }
        R::freeze(true);
        if (DEBUG) {
            R::debug(true, 3);
        }
        R::ext('xdispense', function ($type){
            return R::getRedBean()->dispense($type);
        });
    }
}