<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="Content-Script-Type" content="text/javascript" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<meta http-equiv="Content-Language" content="de-DE" />
		
		<title>XML-Projekt von Florian Rusch (IT10B) - Gästebuch</title>

		<?php echo $this->getCssInclude('bootstrap.min') ?>
		<?php echo $this->getCssInclude('screen') ?>
		<?php echo $this->getCssInclude('styles') ?>
		
		<?php echo $this->getJsInclude('jQuery-1.9.1.min') ?>
		<?php echo $this->getJsInclude('bootstrap.min') ?>
	</head>

	<body>
		<div class="container">
			<header class="row-fluid">
				<div class="row-fluid">
					<div class="page-header span12 text-center">
						<h1>
							Gästebuch System<br />
							<small>Ein XML-Projekt von Florian Rusch (IT10B)</small>
						</h1>
					</div>
				</div>
				<div class="row-fluid"></div>
				
				<div class="row-fluid">
					<nav class="navbar">
						<div class="navbar-inner text-center">
							<ul class="nav">
								<li class="active">
									<a href="/" title="Gästebuch Einträge">
										Web-Ansicht
									</a>
								</li>
								<li>
									<a href="/export/xml/" title="Gästebuch Einträge - PDF Export" >
										XML-Export
									</a>
								</li>
								<li>
									<a href="/export/pdf/" title="Gästebuch Einträge - PDF Export" target="_blank">
										PDF-Export
									</a>
								</li>
								<li>
									<a href="/export/img/" title="Gästebuch - Statistik  - JPG Export" target="_blank">
										JPG-Export
									</a>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</header>
			
			<div clas="row">
				<br /><br />
			</div>
