<?php

class Library_Database extends PDO {
	
	
	public function __construct() {
		try {
			// Die Konstanten kommen aus der /config/config.inc.php
			parent::__construct('mysql:host=' . DB_HOST . ";dbname=" . DB_NAME . ';charset=UTF-8', DB_USER, DB_PASSWORD);
		} catch (PDOException $e) {
			echo $e->getMessage();
			die();
		}
	}
	
	public function query($stmt) {
		return parent::query($stmt);
	}
	
	public function fetchObj($stmt) {
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$result = array();
		while ($row = $stmt->fetch()) {
			$result[] = $row;
		}
		return $result;
	}
	
	
}

?>