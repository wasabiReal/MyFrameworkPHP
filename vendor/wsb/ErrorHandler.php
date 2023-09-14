<?php

namespace wsb;

class ErrorHandler
{

    public function __construct()
    {
        if(DEBUG){
            error_reporting(-1);
        }else{
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']);

        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
    }

    public function errorHandler($errornum, $errorstr, $errorfile, $errorline)
    {
        $this->logErrors($errorstr, $errorfile, $errorline);
        $this->displayError($errornum, $errorstr, $errorfile, $errorline);
    }

    public function fatalErrorHandler()
    {
        $error = error_get_last();
        if(!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)){
            $this->logErrors($error['message'], $error['file'], $error['line']);
            ob_end_clean();
            $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
        }else{
            ob_end_flush();
        }
    }

    public function exceptionHandler(\Throwable $e)
    {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Exception', $e->getMessage() ,$e->getFile(), $e->getLine(), $e->getCode());
    }

    protected function logErrors($message = '', $file = '', $line = '')
    {
        file_put_contents(
            LOGS . '/errors.log',
            "[" . date('Y-m-d H:i:s') . "] Error text: {$message} | File: {$file} | Line: {$line}\n======================\n",
            FILE_APPEND);
    }

    protected function displayError($errornum, $errorstr, $errorfile, $errorline, $responce = 500)
    {
        if($responce == 0){
            $responce = 404;
        }
        http_response_code($responce);
        if($responce == 404 && !DEBUG){
            require WWW . '/errors/404.php';
            die;
        }
        if(DEBUG){
            require WWW . '/errors/development.php';
        }else{
            require WWW . '/errors/production.php';
        }
    }

}