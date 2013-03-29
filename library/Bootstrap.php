<?php

class Library_Bootstrap {

	public function __construct($url) {
		$url = rtrim($url, '/');
		$url = explode('/', $url);
		
		/*
		 * $url[0]		= Controller
		 * $url[1]		= Method
		 * $url[2 - x]	= Parameter
		 */
		
		
		// Default-Site
		if (empty($url[0])) {
			redirect('/index');
			die();
		}

		$controller = 'App_Controllers_' . $url[0];
		
		// Initialization of the controller
		$controller = new $controller;

		// Calling a method when it has been set
		if (isset($url[1])) {
			
			// Call the method, if it exists
			if (method_exists($controller, $url[1])) {
				
				if (isset($url[2])) {
					$countPara = count($url);
					$para = array();
					
					
					for ($i = 2; $i < $countPara; $i++) {
						if (!empty($url[$i])) {
							$para[] = $url[$i];
						}
					}
					
					// Calling the method with a parameter when it is set
					if (isset($url[2])) {
						$controller->{$url[1]}($url[2]);
						exit();
					} else {
						$controller->{$url[1]}();
						exit();
					}
				} else {
					$controller->{$url[1]}();
					exit();
				}
			}
		}
		$controller->index();
	}
}

?>
