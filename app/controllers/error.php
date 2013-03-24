<?php

class Error extends Library_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function init() {
		$this->view->renderView('error/index');
	}
	
	public function index() {
		$this->init();
	}
}

?>