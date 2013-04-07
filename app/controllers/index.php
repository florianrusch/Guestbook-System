<?php

class App_Controllers_Index extends Library_Controller {

	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->view->guestbookEntries = parent::loadModel('Entries')->getAllEntries();
		$this->view->subMenuImgYears = parent::loadModel('Entries')->getAllYears();
		$this->view->renderView('index' . DS . 'index');
	}
	
	public function newEntry() {
		if (!empty($_REQUEST['newEntry'])) {
			
			$formData = $_REQUEST['newEntry'];
			
			$error = array();
			$errorMsg = array();
			
			// Name
			if (empty($formData['name'])) {
				$error[] = 'name';
				$errorMsg[] = 'Es wurde kein Name angegeben.';
			} else {
				$name = $formData['name'];
			}
			
			
			// Valuation
			if (empty($formData['valuation'])) {
				$error[] = 'valuation';
				$errorMsg[] = 'Es wurde keine Bewertung abgegeben';
			} else {
				$valuation = $formData['valuation'];
			}
			
			
			// Message
			if (empty($formData['message'])) {
				$error[] = 'message';
				$errorMsg[] = 'Es wurde keine Nachricht eingetragen.';
			} else {
				$message = $formData['message'];
			}
			
			
			// E-Mail
			$liame = (!empty($formData['liame'])) ? $formData['liame'] : '';
			// Website
			$website = (!empty($formData['website'])) ? $formData['website'] : '';

			
			if (count($error) == 0) {
				
				$para = array(
					'Name' => $name,
					'EMail' => $liame,
					'Website' => $website,
					'Valuation' => $valuation,
					'Date' => date('Y-m-d'),
					'Message' => $message,
					'Status' => 1
				);
				if (parent::loadModel('entries')->saveEntry($para) === true) {
					$this->view->formMessage['status'] = 'sucess';
					$this->view->formMessage[] = 'Der Gästebuch-Eintrag wurde erfolgreich veröffentlicht.';
				} else {
					$this->view->formMessage['status'] = 'error';
					$this->view->formMessage[] = 'Der Gästebuch-Eintrag wurde nicht veröffentlicht.';
				}
				
			} else {
				
				$this->view->formMessage['status'] = 'error';
				foreach ($errorMsg as $v) {
					$this->view->formMessage[] = $v;
				}
				$this->view->formMessage[] = 'Der Gästebuch-Eintrag wurde somit nicht veröffentlicht.';
				$this->view->errorFields = $error;
				$this->view->errorFieldsVal = $formData;
			}
			
			
			$this->view->renderView('index' . DS . 'index');
		}
		redirect('/');
	}
}

?>