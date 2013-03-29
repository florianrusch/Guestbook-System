<?php

class App_Controllers_Export extends Library_Controller {

	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		redirect('/');
	}
	
	public function xml() {
		$this->view->gb = parent::loadModel('Entries')->getAllEntries();
		$this->view->renderView('export' . DS . 'xml', false);
	}
}

?>