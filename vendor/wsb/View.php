<?php

namespace wsb;

use Exception;
use RedBeanPHP\R;

class View
{

    public string $content = '';

    public function __construct(
        public $route,
        public $layout = '',
        public $view = '',
        public $meta = [],
    )
    {
        if (false !== $this->layout) {
            $this->layout = $this->layout ?: LAYOUT;
        }
    }

    public function render($data)
    {
        if (is_array($data)) {
            extract($data);
        }
        $prefix = str_replace('\\', '/', $this->route['admin_prefix']);
        $viewfile = APP . "/views/{$prefix}{$this->route['controller']}/{$this->view}.php";
        if (is_file($viewfile)) {
            ob_start();
            require_once $viewfile;
            $this->content = ob_get_clean();
        } else {
            throw new Exception("View was didn't found {$viewfile}", 500);
        }

        if (false !== $this->layout) {
            $layoutfile = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($layoutfile)) {
                require_once $layoutfile;
            } else {
                throw new Exception("Layout was didn't found {$layoutfile}", 500);
            }
        }
    }

    public function getDatabaseLogs()
    {
        if (DEBUG) {
            $logs = R::getDatabaseAdapter()->getDatabase()->getLogger();
            $logs = array_merge($logs->grep('SELECT'), $logs->grep('select'), $logs->grep('UPDATE'), $logs->grep('DELETE'));
            debug($logs);
        }
    }

    public function getMeta()
    {
        if (!empty($this->meta['title'])) {
            $out = '<title>' .h($this->meta['title']) . ' - ' . App::$app->getProperty('site_name') . '</title>' . PHP_EOL;
        } else {
            $out = '<title>' . App::$app->getProperty('site_name') . '</title>' . PHP_EOL;
        }
        $out .= '<meta name="description" content="' . h($this->meta['description']) . '">' . PHP_EOL;
        $out .= '<meta name="keywords" content="' . h($this->meta['keywords']) . '">' . PHP_EOL;
        return $out;
    }

    public function getPart($file, $data = null)
    {
        if (is_array($data)) {
            extract($data);
        }
        $file = APP . "/views/parts/{$file}.php";
        if (is_file($file)) {
            require $file;
        } else {
            echo "File {$file} not found!";
        }
    }

}