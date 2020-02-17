<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="element" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form element">
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('LABEL'))) ?>
					</span>
				</div>
				<div class="input">
					<input name="label" disabled="" required="required" autofocus="autofocus" type="text" maxlength="100" value="<?php echo encodeHtml(htmlentities(@$label)) ?>" class="">
					</input>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('NAME'))) ?>
					</span>
				</div>
				<div class="input">
					<input name="name" disabled="" required="required" type="text" maxlength="50" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="">
					</input>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_DESCRIPTION'))) ?>
					</span>
				</div>
				<div class="input">
					<textarea name="description" disabled="" maxlength="255" class="inputarea"><?php echo encodeHtml(htmlentities(@$description)) ?>
					</textarea>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('ELEMENT_TYPE'))) ?>
					</span>
				</div>
				<div class="input">
					<input name="typeid" value="<?php echo encodeHtml(htmlentities(@$typeid)) ?>" size="1" class="">
					</input>
				</div>
			</div>
		</div></fieldset>
	</form>