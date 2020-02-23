<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="srcelement" data-action="template" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form template">
		<?php $if3=(isset($elements)); if($if3) {  ?>
			<div class="line">
				<div class="label">
					<input type="radio" name="type" disabled="" value="addelement" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
					</input>
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('value'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<input name="elementid" value="<?php echo encodeHtml(htmlentities(@$elementid)) ?>" size="1" class="">
					</input>
				</div>
			</div>
		 <?php } ?>
		<?php $if3=(isset($writable_elements)); if($if3) {  ?>
			<fieldset class="or-group toggle-open-close open show"><div class="closable">
			</div></fieldset>
			<div class="line">
				<div class="label">
					<input type="radio" name="type" disabled="" value="addicon" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
					</input>
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_ICON'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<input name="writable_elementid" value="<?php echo encodeHtml(htmlentities(@$writable_elementid)) ?>" size="1" class="">
					</input>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<input type="radio" name="type" disabled="" value="addifempty" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
					</input>
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('TEMPLATE_SRC_IFEMPTY'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
				</div>
			</div>
			<div class="line">
				<div class="label">
					<input type="radio" name="type" disabled="" value="addifnotempty" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
					</input>
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('TEMPLATE_SRC_IFNOTEMPTY'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
				</div>
			</div>
		 <?php } ?>
	</form>