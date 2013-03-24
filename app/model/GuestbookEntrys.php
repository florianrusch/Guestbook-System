<?php

class App_Model_GuestbookEntrys extends Library_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function getAllEntrys() {
		$gb = array();
		$stmt = $this->db->query('SELECT * FROM `gaestebuchEintraege` ORDER BY `gaestebuchEintraege`.`Datum` DESC');
		return $this->db->fetchObj($stmt);
	}
}

?>