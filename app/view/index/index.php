<?php if (count($this->formMessage) > 0) { ?>
	<section class="row-fluid">
		<span class="alert alert-<?php echo $this->formMessage['status'] ?> span10 offset1">
			<?php
				unset($this->formMessage['status']);
				foreach ($this->formMessage as $k => $v) {
					echo $v . '<br />';
				}
			?>
		</span>
	</section>
	<div class="row">
		<br />
	</div>
<?php } ?>


<section class="row-fluid">
	<form action="/index/newEntry/" method="POST" class="well span10 offset1">
		<fieldset>
			<legend class="text-center">Neuer Gästebucheintrag</legend>
			<div class="row-fluid">
				<div class="row-fluid">
					<div class="span5">
						<label for="fName">Name:*</label>
						<div class="controls">
							<div class="input-prepend span11">
								<span class="add-on"><i class="icon-user"></i></span>
								<input id="fName" type="text" name="newEntry[name]" class="span11" placeholder="Max Mustermann" value="<?php echo $this->errorFieldsVal['name']; ?>" />
							</div>
						</div>
						<div class="clearfix"></div>

						<label for="fValuation">Bewertung der Seite:*</label>
						<div class="controls">
							<div class="input-prepend span11">
								<span class="add-on"><i class="icon-star"></i></span>
								<select id="fValuation" class="span11" name="newEntry[valuation]">
									<option value="3"<?php if ($this->errorFieldsVal['valuation'] == 3) echo 'selected'; ?>>Die Seite ist echt super</option>
									<option value="2"<?php if ($this->errorFieldsVal['valuation'] == 2) echo 'selected'; ?>>Die Seite ist ganz okay</option>
									<option value="1"<?php if ($this->errorFieldsVal['valuation'] == 1) echo 'selected'; ?>>Die Seite ist verbesserungswürdig</option>
									<option value="0"<?php if ($this->errorFieldsVal['valuation'] == 0) echo 'selected'; ?>>Die Seite ist einfach nur schlecht</option>
								</select>
							</div>
						</div>
						<div class="clearfix"></div>


						<label for="fLiame">E-Mail:</label>
						<div class="controls">
							<div class="input-prepend span11">
								<span class="add-on"><i class="icon-envelope"></i></span>
								<input id="fLiame" type="email" name="newEntry[liame]" class="span11" placeholder="max@mustermann.de" value="<?php echo $this->errorFieldsVal['liame']; ?>" />
							</div>
						</div>
						<div class="clearfix"></div>


						<label for="fUrl">Website:</label>
						<div class="controls">
							<div class="input-prepend span11">
								<span class="add-on"><i class="icon-globe"></i></span>
								<input id="fUrl" type="text" name="newEntry[url]" class="span11" placeholder="www.mustermann.de" value="<?php echo $this->errorFieldsVal['url']; ?>" />
							</div>
						</div>
						<div class="clearfix"></div>
					</div>

					<div class="span7">
						<label for="fComment">Ihr Eintrag:*</label>
						<textarea id="fComment" name="newEntry[message]" class="span12" rows="11"><?php echo $this->errorFieldsVal['message']; ?></textarea>
					</div>
				</div>

				<div class="row">
					<br /><br />
				</div>

				
				<div class="row-fluid text-center">
					<div class="span2 offset4">
						<button type="submit" class="btn-success btn span12">Abschicken</button>
					</div>
					<div class="span2">
						<button type="button" class="btn-danger btn span12">Abbrechen</button>
					</div>
					<div class="span2 offset2 text-right">
						<span class="help-block">* Pflichtfelder</span>
					</div>
				</div>
			</div>
		</fieldset>
	</form>
</section>


<div class="row">
	<br /><br />
</div>


<?php if (count($this->guestbookEntries) > 0) { ?>
	<div class="row-fluid">
		<div class="row-fluid">
			<h2 class="span12 text-center">Einträge</h2>
		</div>
		<?php
			foreach ($this->guestbookEntries as $entry) {
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
								<div class="span5"><b><i class="icon-user"></i></b> <?php echo utf8_decode($html) ?></div>

								<div class="span3" style="min-height: 10px !important">
									<b><i class="icon-calendar"></i></b> <?php echo $entry->Date ?>
								</div>

								<div class="span4 text-right">
									<?php for ($i = 0; $i <= $entry->Valuation; $i++) { ?>
										<i class="icon-star"></i>
									<?php } ?>
								</div>
							</div>

							<div class="row-fluid">
								<hr />
							</div>

							<div class="row-fluid">
								<b>Beitrag:</b><br />
								<?php echo nl2br(htmlentities(utf8_decode($entry->Message))) ?>
							</div>
						</div>

					</section>
		<?php
				}
			}
		?>
	</div>
<?php } ?>


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