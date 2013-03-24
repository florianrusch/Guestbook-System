<?php

class Library_Model {
	public $db;
	
	public function __construct() {
		$this->db = new Library_Database();
	}
	
}

?>