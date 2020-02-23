<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="add" data-action="templatelist" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form templatelist">
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
				</span>
			</div>
			<div class="input">
				<input name="name" type="text" maxlength="50" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="">
				</input>
			</div>
		</div>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<input type="radio" name="type" disabled="" value="empty" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
					</input>
				</div>
				<div class="input">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('empty'))) ?>
						</span>
					</label>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('copy'))) ?>
						</span>
					</label>
					<input type="radio" name="type" disabled="" value="copy" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
					</input>
				</div>
				<div class="input">
					<input name="templateid" value="<?php echo encodeHtml(htmlentities(@$templateid)) ?>" size="1" class="">
					</input>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('example'))) ?>
						</span>
					</label>
					<input type="radio" name="type" disabled="" value="example" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
					</input>
				</div>
				<div class="input">
					<input name="example" value="<?php echo encodeHtml(htmlentities(@$example)) ?>" size="1" class="">
					</input>
				</div>
			</div>
		</div></fieldset>
	</form>