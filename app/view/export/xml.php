<?php

header('Expires: Thu, 19 Nov 1981 08:52:00 GMT'); 
header('Cache-Control: must-revalidate, post-check=0, pre-check=0'); 
header('Pragma: no-cache'); 
header('Content-Type:text/xml');
header("Content-Disposition: attachment; filename=guestbook-entries.xml"); 

echo $this->xml

?>
