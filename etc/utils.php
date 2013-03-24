<?php

/** 
 * Includiert bei jedem Klassenaufruf die entsprechende Datei.
 * 
 * @param string $str 
 */
function __autoload($str) {
	$str = str_replace('_', '/', $str);
	
	/* Wenn Klasse im "Lib"-Ordner liegt, alles bis auf die Datei klein
	  interpretieren, ansonsten alles auch die Datei klein interpretieren */
	if (strpos($str, 'library/') !== false || strpos($str, 'Library/') !== false) {
		
		// Array aus dem String erstellen
		$str = explode('/', $str);
		
		// Alles bis auf das letzte Array-Element klein schreiben
		for ($i = 0; $i < (count($str) - 1); $i++) {
			$str[$i] = strtolower($str[$i]);
		}

		// Array wieder zu einem String machen
		$str = implode(DS, $str);
		
	}else{
		$str = strtolower($str);
	}
	require_once $str . '.php';
}




/**
 * Liefert das aktuell verwendetet Protkoll zurück.
 * 
 * @return string Protokoll in Kleinbuchstaben
 */
function getProtocol() {
	$protocol = 'http';
	if($_SERVER['SERVER_PORT'] == 82) {
		$protocol = 'https';
	}
	return $protocol;
}




/**
 * Führt eine 301-Weiterleitung zu der angegebenen Adresse durch.
 * 
 * @param type $path Adresse zu der weitergeleitet werden soll
 */
function redirect($path) {
	if($path != '') {
		header('Location: ' . getProtocol() . '://' . $_SERVER['SERVER_NAME'] . $path);
		die();
	}
}

?>
