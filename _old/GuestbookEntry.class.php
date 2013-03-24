<?php

class GuestbookEntry {
	private $id, $status, $date, $name, $email, $url, $valuation, $comment;

	
	
	public function __construct($ele, $isXml = false) {
		$this->id = (int) $ele['id'];
		$this->status = (int) $ele['status'];
		
		
		if($isXml) {
			$this->date = (string) $ele->date;
			$this->name = (string) $ele->name;
			$this->email = (string) $ele->email;
			$this->url = (string) $ele->url;
			$this->valuation = (int) $ele->valuation;
			$this->comment = (string) $ele->comment;
		}else{
			$this->date = (string) $ele['date'];
			$this->name = (string) $ele['name'];
			$this->email = (string) $ele['email'];
			$this->url = (string) $ele['url'];
			$this->valuation = (int) $ele['valuation'];
			$this->comment = (string) $ele['comment'];
		}
	}


	
	public function getXML() {
		$xml = new SimpleXMLElement('<entry/>');
		$xml->addAttribute('id', $this->getId());
		$xml->addAttribute('status', $this->getStatus());
		$xml->addChild('date', $this->getDate());
		$xml->addChild('name', $this->getName());
		$xml->addChild('email', $this->getEmail());
		$xml->addChild('url', $this->getUrl());
		$xml->addChild('valuation', $this->getValuation());
		$xml->addChild('comment', $this->getComment());
		return $xml->asXML();
	}

	
	
	public function getId() { return $this->id; }
	public function getStatus() { return $this->status; }
	public function getDate() { return $this->date; }
	public function getName() { return $this->name; }
	public function getEmail() { return $this->email; }
	public function getUrl() { return $this->url; }
	public function getValuation() { return $this->valuation; }
	public function getComment() { return $this->comment; }
}
?>