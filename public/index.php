<?php

if(PHP_MAJOR_VERSION < 8){
    die("Php version lower 8. Install 8+ version");
}

require_once dirname(__DIR__) . '/config/init.php';
require_once HELPERS . '/functions.php';
require_once CONFIG . '/routes.php';

new \wsb\App();


