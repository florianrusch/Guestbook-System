<?php

class App_Controllers_Export extends Library_Controller {

	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		redirect('/');
	}
	
	public function xml() {
		$entries = parent::loadModel('Entries')->getAllEntries();
		
		$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><guestbookEntries></guestbookEntries>');
		foreach ($entries as $entry) {
			$txml = $xml->addChild('entry');
			$txml->addAttribute('id', $entry->ID);
			$txml->addAttribute('status', $entry->Status);
			$txml->addChild('date', $entry->Date);
			$txml->addChild('name', $entry->Name);
			$txml->addChild('email', $entry->EMail);
			$txml->addChild('url', $entry->Website);
			$txml->addChild('valudation', $entry->Valuation);
			$txml->addChild('comment', $entry->Message);
		}
		$this->view->xml = $xml->asXML();
		
		$this->view->renderView('export' . DS . 'xml', false);
	}
}

?>