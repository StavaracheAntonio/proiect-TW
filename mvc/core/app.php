<?php

class App
{
    private $controller = 'Welcome';
    private $method = 'index';
    private $params = [];

    public function __construct()
    {
        define('URI', $_SERVER['REQUEST_URI']);
        define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/mvc');

        session_start();
    }

    public function run()
    {
        // obitinem parametrii din url
        $url = explode('/', URI);
        $url = array_slice($url, 2);

        // verificam daca exista controllerul
        if (file_exists(ROOT . '/app/controllers/' .  $url[0]  . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        // creeem Controlarul respectiv
        require_once ROOT . '/app/controllers/'  . $this->controller  .  '.php';
        $this->controller = new $this->controller;

        /*// verificam daca exista metoda
        if (isset($url[2])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }*/

        //var_dump($url);

        // apelem in controllerul respectiv functia cu parametrii dati
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
}
