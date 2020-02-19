<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="extension" data-action="template" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form template">
		<?php foreach($extension as $list_key=>$list_value) { extract($list_value); ?>
			<fieldset class="or-group toggle-open-close open show"><div class="closable">
				<?php  { $$name= $extension; ?>
				 <?php } ?>
				<label class="or-form-row or-form-input"><input name="<?php echo encodeHtml(htmlentities(@$name)) ?>" required="required" type="text" maxlength="10" value="<?php echo encodeHtml(htmlentities(@$${name)) ?>}" class="">
				</input></label>
			</div></fieldset>
		 <?php } ?>
	</form>