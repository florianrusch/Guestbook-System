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
		parent::setAttribute(parent::ATTR_ERRMODE, parent::ERRMODE_WARNING );  
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
	
	
	public function insertQuery($para) {
		if (!is_array($para) || !count($para)) return false;
		
		$data = array();
		foreach ($para as $k => $v) {
			$data[':' . $k] = $v;
		}
		
		
		$bind = implode(', ', array_keys($data));
		$sql  = 'INSERT INTO `guestbook-entries` (`' . implode('`, `', array_keys($para)) . '`) VALUES (' . $bind . ')';
		try {
			$stmt = parent::prepare($sql);
		} catch (PDOException $exc) {
			echo $exc->getMessage();
		}
		try {
			$stmt = $stmt->execute($data);
		} catch (PDOException $exc) {
			echo $exc->getMessage();
		}
		return $stmt;
	}
}
?>