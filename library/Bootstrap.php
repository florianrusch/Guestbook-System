<?php

class Library_Bootstrap {

	public function __construct($url) {
		$url = rtrim($url, '/');
		$url = explode('/', $url);

		// Default-Site
		if (empty($url[0])) {
			require_once ROOT . 'app' . DS . 'controllers' . DS . 'index.php';
			$controller = new App_Controllers_Index();
			$controller->index();
			return false;
		}

		// Initialization of the controller
		$controller = new $url[0];
		
		// Initialization of the modell
		$controller->loadModel($url[0]);

		// Calling a method when it has been set
		if (isset($url[1])) {
			
			// Call the method, if it exists
			if (method_exists($controller, $url[1])) {
				
				// Calling the method with a parameter when it is set
				if (isset($url[2])) {
					$controller->{$url[1]}($url[2]);
				} else {
					$controller->{$url[1]}();
				}
			} else {
				$controller = $this->getErrorPage();
			}
			return false;
		}
		$controller->index();
	}
	
	
	
	
	/**
	 * Initialization of the controller of the error page
	 * 
	 * @return Error $con
	 */
	private function getErrorPage() {
		require_once ROOT . 'app' . DS . 'controllers' . DS . 'error.php';
		$con = new Error();
		$con->index();
		return $con;
	}
}

?>
