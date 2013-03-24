<?php

class Library_Bootstrap {

	public function __construct($url) {
		$url = rtrim($url, '/');
		$url = explode('/', $url);

		//var_dump($url);
		//var_dump($_SERVER);

		// Standard-Seite
		if (empty($url[0])) {
			require_once ROOT . 'app' . DS . 'controllers' . DS . 'index.php';
			$controller = new App_Controllers_Index();
			$controller->index();
			return false;
		}

		// Controller initialisieren
		$controller = new $url[0];

		// Model initialisieren
		$controller->loadModel($url[0]);

		// Methode aufrufen
		if(isset($url[1])) {
			if(method_exists($controller, $url[1])) {
				// Funktion im Controller ausführen
				if(isset($url[2])) {
					var_dump($controller);
					$controller->{$url[1]}($url[2]);
				}else{
					$controller->{$url[1]}();
				}
			}else{
				$controller = $this->getErrorPage();
			}
			return false;
		}
		$controller->index();
	}
	
	
	
	
	/**
	 * Läd den Controller der Error-Page
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
