<?php

class Trip extends Controller
{
	public function index($input)
	{
		$data = array("city" => $input);

		$this->view('templates/header');
		$this->view('components/topbar');
		$this->view('containers/trip');
		$this->view('components/tripinfo', $data);
		$this->view('components/flightbar');
		$this->view('containers/end');
		$this->view('components/aboutus');
		$this->view('templates/footer');
	}
}
