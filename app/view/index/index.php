
<section class="row-fluid">
	<form action="" method="POST" class="well span10 offset1">
		<fieldset>
			<legend class="text-center">Neuer Gästebucheintrag</legend>
			<div class="row-fluid">
				<div class="span5">
					<label for="fName">Name:*</label>
					<div class="controls">
						<div class="input-prepend span11">
							<span class="add-on"><i class="icon-user"></i></span>
							<input id="fName" type="text" name="name" class="span11" placeholder="Max Mustermann" />
						</div>
					</div>
					<div class="clearfix"></div>

					<label for="fValuation">Bewertung der Seite:*</label>
					<div class="controls">
						<div class="input-prepend span11">
							<span class="add-on"><i class="icon-star"></i></span>
							<select id="fValuation" class="span11" name="valuation">
								<option value="3">Die Seite ist echt super</option>
								<option value="2">Die Seite ist ganz okay</option>
								<option value="1">Die Seite ist verbesserungswürdig</option>
								<option value="0">Die Seite ist einfach nur schlecht</option>
							</select>
						</div>
					</div>
					<div class="clearfix"></div>


					<label for="fLiame">E-Mail:</label>
					<div class="controls">
						<div class="input-prepend span11">
							<span class="add-on"><i class="icon-envelope"></i></span>
							<input id="fLiame" type="email" name="liame" class="span11" placeholder="max@mustermann.de" />
						</div>
					</div>
					<div class="clearfix"></div>


					<label for="fUrl">Website:</label>
					<div class="controls">
						<div class="input-prepend span11">
							<span class="add-on"><i class="icon-globe"></i></span>
							<input id="fUrl" type="text" name="url" class="span11" placeholder="www.mustermann.de" />
						</div>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="span7">
					<label for="fComment">Ihr Eintrag:*</label>
					<textarea id="fComment" name="comment" class="span12" rows="11"></textarea>
				</div>

				<div class="clearfix"></div>
				<br /><br />

				<div class="text-center">
					<button type="submit" class="submit btn btn-primary">Abschicken</button>
					<button type="button" class="cancel btn">Abbrechen</button>
					<br />
					*: Pflichtfelder
				</div>
			</div>
		</fieldset>
	</form>
</section>


<div class="row">
	<br /><br />
</div>

<div class="row-fluid">
	<div class="row-fluid">
		<h2 class="span12 text-center">Einträge</h2>
	</div>
	<?php
		foreach ($this->gb as $entry) {
			if ($entry->Status == 1) {

				if (!empty($entry->Website)) {
					$html = '<a href="http://' . $entry->Website . '" title="Zur Website - ' . $entry->Website . '" rel="nofollow" target="_blank">';
						$html .= $entry->Name;
					$html .= '</a>';
				} else {
					$html = $entry->Name;
				}
	?>
				<section class="row-fluid">
					<div class="span8 offset2 well">
						<div class="row-fluid">
							<div class="span5"><b><i class="icon-user"></i></b> <?php echo $html ?></div>
							
							<div class="span3" style="min-height: 10px !important">
								<b><i class="icon-calendar"></i></b> <?php echo $entry->Date ?>
							</div>
							
							<div class="span4 text-right">
								<?php for ($i = 0; $i < $entry->Valuation; $i++) { ?>
									<i class="icon-star"></i>
								<?php } ?>
							</div>
						</div>
						
						<div class="row-fluid">
							<hr />
						</div>

						<div class="row-fluid">
							<b>Beitrag:</b><br />
							<?php echo $entry->Message ?>
						</div>
					</div>
					
				</section>
	<?php
			}
		}
	?>
</div>



<script>
	jQuery('form button.cancel').click(function() {
		form = jQuery(this).parents('form')
		form.find('input').each(function() {
			jQuery(this).val('');
		});
		form.find('textarea').each(function() {
			jQuery(this).val('');
		});
	});
</script>