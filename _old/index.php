<?php
	define('DROOT', $_SERVER['DOCUMENT_ROOT']);
	$error = array();
	
	require_once DROOT . '/classes/Guestbook.class.php';
	
	$gb = new Guestbook('guestbookEntrys.xml');
	if($gb == false) { $error[] = 'readXML'; }


	if(!empty($_POST['submitCheck'])){
		
		// Pflicht
		if(!empty($_POST['comment'])) { $comment = $_POST['comment']; }else{ $error[] = 'comment'; }
		if(!empty($_POST['name'])) { $name = $_POST['name']; }else{ $error[] = 'name'; }
		if(!empty($_POST['valuation'])) { $valuation = $_POST['valuation']; }else{ $error[] = 'valuation'; }
		
		// Optional
		if(!empty($_POST['liame'])) { $email = $_POST['liame']; }else{ $email = ''; }
		if(!empty($_POST['url'])) { $url = $_POST['url']; }else{ $url = ''; }
		

		//Abfrage, ob alle Pflichfelder ausgefüllt wurden
		if(count($error) == 0) {
			$entryID = $gb->newEntry($name, $email, $url, $valuation, $comment);
			$gb->entryAdd2XML((int) $entryID);
			$gb->saveXML();
			if($gb->saveXML()) {
				header('Location: http://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'] . '?success=true');
			}else{
				$error[] = 'saveXML';
			}
		}
	}
	
	
	// Fehlerbehandlung
	if(count($error) > 0) {
		$errorMessage = '';
		foreach($error as $err) {
			switch ($err) {
				case 'name':
					$errorMessage .= "Bitte geben Sie Ihren Namen an.<br />";
					break;

				case 'valuation':
					$errorMessage .= "Bitte geben Sie eine Bewertung zu dieser Seite ab.<br />";
					break;

				case 'comment':
					$errorMessage .= "Bitte schreiben Sie 2-3 Sätze dazu, wie Ihnen diese Website gefällt.<br />";
					break;

				case 'saveXML':
					$errorMessage .= 'Ihr Beitrag konnte nicht gespeichert werden. Bitte nehmen Sie Kontakt zu uns auf.<br />';
					break;

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

				<?php
					if(count($error) != 0) {
						echo '<div class="error">';
							echo '<div>';
								echo '<div class="headline">Fehler:</div>';
								echo $errorMessage;
							echo '</div>';
						echo '</div>';
					}else if(!empty($_GET['success'])) {
						echo '<div class="success">';
							echo '<div>';
								echo 'Gästebuch-Eintrag erfolgreich gespeichert.';
							echo '</div>';
						echo '</div>';
					}
				?>



				<form id="gaestebuchForm" action="" method="POST">
					<input type="hidden" name="submitCheck" value="send" />

					<div class="fl">
						<label for="fName"<?php if(!empty($error) && in_array('name', $error)) { echo ' class="error"'; } ?>>Name:*</label><br />
						<input id="fName" type="text" name="name" size="35"<?php if(!empty($error) && in_array('name', $error)) { echo ' class="error"'; } ?><?php if(!empty($_POST['name'])) echo ' value="' . $_POST['name'] . '"' ?> /><br />
						<br />

						<div>
							<div class="fl"><label for="fValuation">Bewertung der Seite:*</label><br />
								<span class="fs12">(4 = gut, 1 = schlecht)</span>
							</div>
							<div class="fr pt10">
								<select id="fValuation" name="valuation">
									<option<?php if(!empty($_POST['valuation']) && $_POST['valuation'] == 4) echo ' selected' ?>>4</option>
									<option<?php if(!empty($_POST['valuation']) && $_POST['valuation'] == 3) echo ' selected' ?>>3</option>
									<option<?php if(!empty($_POST['valuation']) && $_POST['valuation'] == 2) echo ' selected' ?>>2</option>
									<option<?php if(!empty($_POST['valuation']) && $_POST['valuation'] == 1) echo ' selected' ?>>1</option>
								</select>
							</div>
							<div class="cb"></div>
						</div>
						<br />


						<label for="fLiame">E-Mail:</label><br />
						<input id="fLiame" type="text" name="liame" size="35"<?php if(!empty($_POST['liame'])) echo ' value="' . $_POST['liame'] . '"' ?> /><br />
						<br />


						<label for="fUrl">Website:</label><br />
						<input id="fUrl" type="text" name="url" size="35"<?php if(!empty($_POST['url'])) echo ' value="' . $_POST['url'] . '"' ?> /><br />
					</div>
					
					<div class="fr">
						<label for="fComment"<?php if(!empty($error) && in_array('comment', $error)) { echo ' class="error"'; } ?>>Ihr Eintrag:*</label><br />
						<textarea id="fComment" name="comment" cols="62" rows="12"<?php if(!empty($error) && in_array('comment', $error)) { echo ' class="error"'; } ?>><?php if(!empty($_POST['comment'])) echo $_POST['comment'] ?></textarea>
					</div>
					<div class="cb"></div>
					
					<div class="m0a tac">
						<input type="submit" name="submit" value="Abschicken" /><br />
						<span class="fs11">* Diese Felder müssen ausgefüllt werden!!</span>
					</div>
					<div class="cb"></div>
				</form>


				<br />
				<br />
				
				
				<h2>Einträge</h2>

				<?php foreach($gb->getEntries() as $entry) { ?>
					<?php if($entry->getStatus() == 1) { ?>
						<section class="gaestebuchEintrag" id="eintrag<?php echo $entry->getId() ?>">
							<div class="bewertung star<?php echo $entry->getValuation() ?>"></div>
							<strong>Datum: </strong><?php echo $entry->getDate() ?><br />
							<strong>Name: </strong>
							<?php $url = $entry->getUrl() ?>
							<?php if(!empty($url)) { ?>
								<a href="http://<?php echo $url ?>" title="Zur Website - <?php echo $url ?>" rel="nofollow" target="_blank">
							<?php } ?>
									<?php echo htmlspecialchars($entry->getName()) ?>
							<?php if(!empty($url)) { ?>
								</a>
							<?php } ?>	
						<hr />
							<div class="beitrag">
								<span class="db pb5 fwb">Beitrag:</span>
								<?php echo nl2br(htmlspecialchars($entry->getComment())) ?>
							</div>
						</section>
					<?php } ?>
				<?php } ?>

				
			</section>
		</div>
		<script>
			jQuery(window).load(function() {
				jQuery('div#wrapper').fadeIn(3000);
			});
		</script>
	</body>
</html>