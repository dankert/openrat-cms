<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="remove" data-action="element" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form element">
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('ELEMENT_NAME'))) ?>
					</span>
				</div>
				<div class="input">
					<span class="name"><?php echo encodeHtml(htmlentities(@$name)) ?>
					</span>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<input type="checkbox" name="confirm" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$confirm)) ?>" required="required" class="">
					</input>
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('CONFIRM_DELETE'))) ?>
						</span>
					</label>
				</div>
			</div>
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<span class="">     
					</span>
					<input type="radio" name="type" disabled="" value="value" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
					</input>
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('ELEMENT_DELETE_VALUES'))) ?>
						</span>
					</label>
					<br>
					</br>
					<span class="">     
					</span>
					<input type="radio" name="type" disabled="" value="all" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
					</input>
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('DELETE'))) ?>
						</span>
					</label>
				</div>
			</div>
		</div></fieldset>
	</form>