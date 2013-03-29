<?php

class App_Model_Entries extends Library_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function getAllEntries($sortBy = 'Date', $sortWay = 'DESC') {
		$gb = array();
		$stmt = $this->db->query('SELECT * FROM `guestbook-entries` ORDER BY `guestbook-entries`.`Date` DESC');
		return $this->db->fetchObj($stmt);
	}
}

?>