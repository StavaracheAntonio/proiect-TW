<?php

class Controller
{
    public function model($model)
    {
        require_once ROOT . '/app/models/' . $model . '_model.php';
        return new $model;
    }

    public function view($path, $data = [])
    {
        if (is_array($data))
            extract($data);

        require(ROOT . '/app/views/' . $path . '.php');
    }
}
