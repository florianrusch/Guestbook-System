<?php

require_once 'etc/utils.php';
require_once 'config/config.inc.php';

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__).DS);

$url = isset($_GET['url']) ? $_GET['url'] : '';


// Init Bootstrap
$app = new Library_Bootstrap($url);

?>