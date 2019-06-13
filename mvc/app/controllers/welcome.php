<?php

class Welcome extends Controller
{
    public function index()
    {
        $this->view('templates/header');
        $this->view('containers/welcome');
        $this->view('components/index');
        $this->view('containers/end');
        $this->view('templates/footer');
    }
}
