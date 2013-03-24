<?php
require_once DROOT . '/classes/GuestbookEntry.class.php';

class Guestbook {
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
	
	
	
	public function entryAdd2XML($id) {
		$xmlObject = $this->xml->addChild('entry');
		$xmlObject->addAttribute('id', $this->entriesArray[$id]->getId());
		$xmlObject->addAttribute('status', $this->entriesArray[$id]->getStatus());

		$xmlObject->addChild('date', $this->entriesArray[$id]->getDate());
		$xmlObject->addChild('name', $this->entriesArray[$id]->getName());
		$xmlObject->addChild('email', $this->entriesArray[$id]->getEmail());
		$xmlObject->addChild('url', $this->entriesArray[$id]->getUrl());
		$xmlObject->addChild('valuation', $this->entriesArray[$id]->getValuation());
		$xmlObject->addChild('comment', $this->entriesArray[$id]->getComment());
		
		return true;
	}
	
	
	
	private function getLastID() {
		$id = 0;
		foreach($this->getEntries() as $entry) {
			if($entry->getId() > $id) {
				$id = $entry->getId();
			}
		}
		return $id;
	}
	
	
	
	private function readEntries() {
		$entries = array();
		foreach($this->xml->children() as $entry) {
			$entries[(int)$entry['id']] = new GuestbookEntry($entry, true);
		}
		rsort($entries);
		$this->entriesArray = $entries;
		if(count($this->entriesArray) > 0) {
			return true;
		}
		return false;
	}
	
	
	
	function getEntries() {
		$entriesWereReaded = false;
		if(count($this->entriesArray) == 0){
			$entriesWereReaded = $this->readEntries();
		}else{
			$entriesWereReaded = true;
		}
		
		if($entriesWereReaded) {
			return $this->entriesArray;
		}
		return array();
	}
	
	
	
	public function saveXML() {
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
