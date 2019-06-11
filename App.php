<?php

class App
{

    private $controller = 'Welcome';
    private $method = 'index';
    private $params = [];

    public function __construct()
    {
        // obitinem parametrii din url
        $url = $this->parseUrl();

        // verificam daca exista controllerul
        if (file_exists('../app/controllers/' .  $url[0]  . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        // creeem Controlarul respectiv
        require_once '../app/controllers/'  . $this->controller  .  '.php';
        $this->controller = new $this->controller;

        // verificam daca exista metoda
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // apelem in controllerul respectiv functia cu parametrii dati
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl()
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            $url = explode('/', filter_var(rtrim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL));
            if (count($url) > 3) {
                array_splice($url, 0, 3);
                $url = explode('?', $url[0]);
                return $url;
            }
        }
    }
}
