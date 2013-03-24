<?php

class App_Controllers_Index extends Library_Controller {

	function __construct() {
		parent::__construct();
	}
	
	private function init() {
		$this->view->renderView('index/index');
	}
	
	public function index() {
		$this->view->gb = parent::loadModel('guestbookentrys')->getAllEntrys();
		$this->view->renderView('index/index');
	}
	
	public function createEntry() {
		//$this->validateForm('');
	}
}

?>