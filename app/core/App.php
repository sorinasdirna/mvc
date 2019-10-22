<?php

class App
{

	// default controller and default method
	protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

	public function __construct() {
		
	}

	// explode url and giv us controller, method, params
	public function parseUrl() {

		// check if url is set
		if(isset($_GET['url'])) {
			/* 
			  sanitize url and explode it 
			  url[0] -> controller
			  url[1] -> method
			  rest -> params 
			  return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
			*/
			 $url = explode('/', $_GET['url']);
		
			// check if controller exists
			if(file_exists('../app/controllers/' . $url[0] .'.php')) {
				// set controller and replace default 'home'
				$this->controller = $url[0];
				// remove controller from url array
				unset($url[0]);  
			}

			// if controller doesnt exists will require 'home' every time controller thats why is out of if statement
			require_once '../app/controllers/' . $this->controller . '.php';

			// create new instance for controller controller class, if controller is not set we create instance for default 'home' controller
			$this->controller = new $this->controller; 

			
			// check second param (method) if exists in url
			if(isset($url[1])) {
				// check if exist method in the object
				if(method_exists($this->controller, $url[1])) {
					// set the method
					$this->method = $url[1];
					// 
					unset($url[1]);
				}
			}


			// set params and reset array indexes for whats left
			$this->params = array_values($url);


			// calling the controller, methods and params
			// call_user_func is used when you dont know the function that yo are calling
			// call the method $this->method using the parameters $this->params in the instantiated class $this->controller
			call_user_func_array([$this->controller, $this->method], $this->params);
		}

	}
}