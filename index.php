<?php

define('DS', '/');
define('ROOT', dirname(__FILE__).DS);

$utilsPath = ROOT . 'etc' . DS . 'utils.php';
$configPath = ROOT . 'config' . DS . 'config.inc.php';

if (is_readable($configPath)) {
	require_once $configPath;
} else {
	echo 'ERROR!! Die Config-Datei fehlt oder ist nicht lesbar!';
	die();
}
require_once $utilsPath;


$url = isset($_GET['url']) ? $_GET['url'] : '';


// Init Bootstrap
$app = new Library_Bootstrap($url);

?>