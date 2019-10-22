<?php

// base controller for all other controllers
class Controller
{
	// the name of the model to load
	public function model($model) {
		require_once '../app/models/' . $model . '.php';
		return new $model();
	}

	// $view = the name of view to include
	// array $data = any data that needs to be available into the view
	public function view($view, $data = []) {
		require_once '../app/views/'. $view . '.php';
	}
}