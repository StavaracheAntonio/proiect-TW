<?php

class Home extends Controller
{
    public function index()
    {
        $this->view('templates/header');
        $this->view('components/topbar');
        $this->view('containers/home');
        $this->view('components/searchbar');
        $this->view('components/triplist');
        $this->view('containers/end');
        $this->view('components/aboutus');
        $this->view('templates/footer');
    }
}
