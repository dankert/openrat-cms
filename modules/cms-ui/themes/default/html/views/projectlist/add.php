<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="add" data-action="projectlist" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form projectlist">
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
				</span>
			</div>
			<div class="input">
				<input name="name" type="text" maxlength="128" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="focus">
				</input>
			</div>
		</div>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<input type="radio" name="type" disabled="" value="empty" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
					</input>
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('empty'))) ?>
						</span>
					</label>
					<br>
					</br>
					<input type="radio" name="type" disabled="" value="copy" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
					</input>
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('copy'))) ?>
						</span>
					</label>
					<input name="projectid" value="" size="1" class="">
					</input>
				</div>
			</div>
		</div></fieldset>
	</form>