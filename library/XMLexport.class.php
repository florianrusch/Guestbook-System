<?php

class Library_dataSource_Guestbook {
	private $xml, $filePath, $entriesArray;

	
	function __construct($fileName) {
		$this->filePath = DROOT . '/xml/' . $fileName;
		$this->xml = simplexml_load_file($this->filePath);
		if($this->xml != false) {
			return true;
		}
		return false;
	}

	
	
	public function newEntry($name, $email, $url, $valuation, $comment) {
		$id = $this->getLastID() + 1;

		$newEntry = new GuestbookEntry(array(
			'id' => $id,
			'status' => 1,
			'date' => date('d.m.Y'),
			'name' => $name,
			'email' => $email,
			'url' => $url,
			'valuation' => $valuation,
			'comment' => $comment
		));
		
		$this->entriesArray[$id] = $newEntry;
		return $this->getLastID();
	}
	
	
	
	/**
	 * Speichert die Dateinsätze aus der lokalen Instance in die 
	 * 
	 * @return boolean
	 */
	public function save() {
		$handle = fopen($this->filePath, 'wb');
		if($handle != false) {
			$write = fwrite($handle, $this->xml->asXML());
			fclose($handle);
			if($write != false) {
				return true;
			}
		}
		return false;
	}
}

?>
