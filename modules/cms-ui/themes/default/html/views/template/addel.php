<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="addel" data-action="template" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form template">
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('global_name'))) ?>
				</span>
			</div>
			<div class="input">
				<input name="name" required="required" autofocus="autofocus" type="text" maxlength="50" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="">
				</input>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('element_type'))) ?>
				</span>
			</div>
			<div class="input">
				<?php  { $text= 'text'; ?>
				 <?php } ?>
				<input name="typeid" value="<?php echo encodeHtml(htmlentities(@$typeid)) ?>" size="1" class="">
				</input>
			</div>
		</div>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
		</div></fieldset>
		<div class="line">
			<div class="label">
			</div>
			<div class="input">
				<label class="label">
					<input type="checkbox" name="addtotemplate" value="1" checked="1" class="">
					</input>
					<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_template_srcelement'))) ?>
					</span>
				</label>
			</div>
		</div>
	</form>