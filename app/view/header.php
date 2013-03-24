<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="Content-Script-Type" content="text/javascript" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<meta http-equiv="Content-Language" content="de-DE" />
		
		<title>XML-Projekt von Florian Rusch (IT10B) - Gästebuch</title>

		<?php echo $this->getCssInclude('screen') ?>
		<?php echo $this->getCssInclude('styles') ?>
		<?php echo $this->getJsInclude('jQuery-1.9.1.min') ?>
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
							<a href="/" title="Gästebuch Einträge" class="current">
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
							<a href="/webDia.php" title="Gästebuch - Statistik">
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
				
				
				<div class="abbinder"></div>
			</header>

		
			<section id="content">
