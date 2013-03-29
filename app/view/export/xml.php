<?php
header ("Content-Type:text/xml");

$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><guestbookEntries></guestbookEntries>');

foreach ($this->gb as $entry) {
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

echo $xml->asXML();

?>
