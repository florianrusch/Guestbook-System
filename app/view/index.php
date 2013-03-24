<?php

	if (!empty($error) && count($error) != 0) {
		echo '<div class="error">';
			echo '<div>';
				echo '<div class="headline">Fehler:</div>';
				echo $errorMessage;
			echo '</div>';
		echo '</div>';
	} else if(!empty($_GET['success'])) {
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
<?php foreach ($this->gb as $entry) { ?>
	<?php if ($entry->Status == 1) { ?>
		<section class="gaestebuchEintrag" id="eintrag<?php echo $entry->ID ?>">
			<div class="bewertung star<?php echo $entry->Bewertung ?>"></div>
			<strong>Datum: </strong><?php echo $entry->Datum ?><br />
			<strong>Name: </strong>
			<?php $url = $entry->Website ?>
			<?php if (!empty($url)) { ?>
				<a href="http://<?php echo $url ?>" title="Zur Website - <?php echo $url ?>" rel="nofollow" target="_blank">
			<?php } ?>
					<?php echo htmlspecialchars($entry->Name) ?>
			<?php if (!empty($url)) { ?>
				</a>
			<?php } ?>	
		<hr />
			<div class="beitrag">
				<span class="db pb5 fwb">Beitrag:</span>
				<?php echo nl2br(htmlspecialchars($entry->Text)) ?>
			</div>
		</section>
	<?php } ?>
<?php } ?>
<script>
	jQuery(window).load(function() {
		jQuery('div#wrapper').fadeIn(3000);
	});
</script>