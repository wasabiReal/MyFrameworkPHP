<?php

namespace app\controllers\admin;

use wsb\App;
use wsb\Cache;

class CacheController extends AppController
{

    public function indexAction()
    {
        $title = 'Керування кешем';
        $this->setMeta("{$title} :: Панель адміністратора");
        $this->set(compact('title'));
    }

    public function deleteAction()
    {
        $langs = App::$app->getProperty('languages');
        $cache_key = get('cache', 's');
        $cache = Cache::getInstance();
        if($cache_key == 'category'){
            foreach ($langs as $lang => $item){
                $cache->delete("ishop_menu_{$lang}");
            }
        }
        if($cache_key == 'page'){
            foreach ($langs as $lang => $item){
                $cache->delete("ishop_page_menu_{$lang}");
            }
        }
        $_SESSION['success'] = 'Кеш було успішно видалено!';
        redirect();
    }


}