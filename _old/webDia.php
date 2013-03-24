<?php
	define('DROOT', $_SERVER['DOCUMENT_ROOT']);
	$error = array();
	
	require_once DROOT . '/classes/Guestbook.class.php';
	require_once DROOT . '/lib/pChart.class.php';
	require_once DROOT . '/lib/pData.class.php';
	
	$gb = new Guestbook('guestbookEntrys.xml');
	if($gb == false) { $error[] = 'readXML'; }

	
	foreach($gb->getEntries() as $entry) {
		if($entry->getStatus() == 1) {
			
		}
	}
	
	
	
	// Fehlerbehandlung
	if(count($error) > 0) {
		$errorMessage = '';
		foreach($error as $err) {
			switch ($err) {
				case 'readXML':
					$errorMessage .= 'Leider können momentan keine Datensätze aus unserer Datenhaltung ausgelesen werden.<br />';
					break;
			}
		}
	}
	
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="Content-Script-Type" content="text/javascript" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<meta http-equiv="Content-Language" content="de-DE" />
		
		<title>XML-Projekt von Florian Rusch (IT10B) - Gästebuch</title>
		<link rel="stylesheet" type="text/css" href="/css/style.css" />
		<script src="/js/jQuery-1.9.1.min.js"></script>
	</head>

	<body>
		<div id="wrapper">
			<header>
				<h1>
					Gästebuch
				</h1>
				<h2>
					XML-Projekt von Florian Rusch (IT10B)
				</h2>
				
				<nav>
					<ul>
						<li>
							<a href="/" title="Gästebuch Einträge">
								Gästebuch Einträge<br />
								Web-Ansicht
							</a>
						</li>
						<li>
							<a href="/exportPDF.php" title="Gästebuch Einträge - PDF Export" target="_blank">
								Gästebuch Einträge<br />
								PDF-Export
							</a>
						</li>
						<li>
							<a href="/webDia.php" title="Gästebuch - Statistik" class="current">
								Gästebuch Statistik<br />
								Web-Ansicht
							</a>
						</li>
						<li>
							<a href="/exportDia.php" title="Gästebuch - Statistik  - JPG Export" target="_blank">
								Gästebuch Statistik<br />
								JPG-Export
							</a>
						</li>
					</ul>
				</nav>
			</header>

		
			<section id="content">
				<?php
					if(count($error) != 0) {
						echo '<div class="error">';
							echo '<div>';
								echo '<div class="headline">Fehler:</div>';
								echo $errorMessage;
							echo '</div>';
						echo '</div>';
					}
				?>
				
				
				<h2>Einträge</h2>

				

				
			</section>
		</div>
		<script>
			jQuery(window).load(function() {
				jQuery('div#wrapper').fadeIn(3000);
			});
		</script>
	</body>
</html>