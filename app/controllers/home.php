<?php

class Home extends Controller 
{
	public function index($name="", $email="") {
		//echo 'home/index' . $name;

		$user = $this->model('User');
		$user->name = $name;
		$user->email = $email;

		// returning a view
		return $this->view('home/index', ['name' => $user->name, 'email' => $user->email]);
	} 
}