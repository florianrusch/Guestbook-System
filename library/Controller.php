<?php

class Library_Controller {
	
	
	public function __construct() {
		$this->view = new Library_View();
	}
	
	
	/**
	 * Läd das entsprechende Model.
	 * 
	 * @param string $name Controller-Name, für welchen das entsprechende Model geladen werden soll.
	 */
	public function loadModel($name) {
		$name = 'App_Model_' . $name;
		return new $name();
	}
}

?>