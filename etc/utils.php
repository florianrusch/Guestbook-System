<?php

/** 
 * Includiert bei jedem Klassenaufruf die entsprechende Datei.
 * 
 * @param string $str 
 */
function __autoload($str) {
	$arrayStr = explode('_', $str);
	$str = str_replace('_', '/', $str);
	
	if (count($arrayStr) >= 2) {
		if ($arrayStr[0] == 'TCPDF') {
			require_once 'library/extern/' . strtolower($str) . '.php';
		} else {
			require_once strtolower($str) . '.php';
		}
	} else {
		require_once 'library/extern/' . $str . '.php';
	}
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
