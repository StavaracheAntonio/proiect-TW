<?php

class Dashboard extends Controller
{
    public function index()
    {
        $this->view('templates/header');
        $this->view('components/topbar');
        $this->view('containers/dashboard');
        $this->view('containers/user');
        $this->view('components/userinfo');
        $this->view('components/userupdate');
        $this->view('components/usertrip');
        $this->view('containers/end');
        $this->view('containers/end');
        $this->view('components/aboutus');
        $this->view('templates/footer');
    }
}
