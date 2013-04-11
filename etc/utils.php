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
		if ($arrayStr[0] == 'TCPDF' && is_readable('library/extern/' . strtolower($str) . '.php')) {
			require_once 'library/extern/' . strtolower($str) . '.php';
		} else if(is_readable(strtolower($str) . '.php')) {
			require_once strtolower($str) . '.php';
		} else {
			redirect('/index');
		}
	} else if(is_readable('library/extern/' . $str . '.php')) {
		require_once 'library/extern/' . $str . '.php';
	} else {
		redirect('/index');
	}
}




/**
 * Liefert das aktuell verwendetet Protkoll zurück.
 * 
 * @return string http, https
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
