<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
								<li<?php if($this->isActiveSite('/index')) { echo ' class="active"'; } ?>>
									<a href="/index" title="Gästebuch Einträge">
										Web-Ansicht
									</a>
								</li>
								<li<?php if($this->isActiveSite('/export/xml/')) { echo ' class="active"'; } ?>>
									<a href="/export/xml/" title="Gästebuch Einträge - XML Export">
										XML-Export
									</a>
								</li>
								<li<?php if($this->isActiveSite('/export/pdf/')) { echo ' class="active"'; } ?>>
									<a href="/export/pdf/" title="Gästebuch Einträge - PDF Export"  target="_blank">
										PDF-Export
									</a>
								</li>
								<li class="dropdown<?php if($this->isActiveSite('/export/img')) { echo ' active'; } ?>">
									<a class="dropdown-toggle" href="/export/img/" title="Gästebuch - Statistik  - JPG Export" data-toggle="dropdown" target="_blank">
										JPG-Export<b class="caret"></b>
									</a>
									<ul class="dropdown-menu">
										<?php foreach($this->subMenuImgYears as $y) { ?>
											<li<?php if($this->isActiveSite('/export/img/' . $y->Date)) { echo ' class="active"'; } ?>>
												<a href="/export/img/<?php echo $y->Date ?>" title="Gästebuch Einträge - Statistik - Jahr <?php echo $y->Date ?>" target="_blank">
													<?php echo $y->Date ?>
												</a>
											</li>
										<?php } ?>
									</ul>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</header>
			
			<div clas="row">
				<br /><br />
			</div>
