<?php

class App_Model_Entries extends Library_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function getAllEntries() {
		$stmt = $this->db->query('SELECT * FROM `guestbook-entries` ORDER BY `Date` DESC, `ID` DESC;');
		return $this->db->fetchObj($stmt);
	}
	
	
	public function getAllEntriesFomeTheYear($year = 0, $sortBy = 'Date', $sortWay = 'DESC') {
		$year = ($year === 0) ? date('Y') : $year;
		$stmt = $this->db->query('SELECT * FROM `guestbook-entries` WHERE YEAR(`Date`) = ' . $year . ' ORDER BY `guestbook-entries`.`' . $sortBy . '` ' . $sortWay);
		return $this->db->fetchObj($stmt);
	}
	
	
	public function getAllYears() {
		$stmt = $this->db->query('SELECT YEAR(`Date`) as `Date` FROM `guestbook-entries` GROUP BY YEAR(`Date`) ORDER BY `Date` DESC');
		return $this->db->fetchObj($stmt);
	}
	
	
	public function saveEntry($para) {
		$keys = array();
		$values = array();
		foreach ($para as $k => $v) {
			$keys[] = $k;
			$values[] = '?';
		}
		return $this->db->insertQuery($para);
	}
}

?>