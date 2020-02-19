<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="template" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form template">
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('TEMPLATE_NAME'))) ?>
				</span>
			</div>
			<div class="input">
				<input name="name" type="text" maxlength="50" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="">
				</input>
			</div>
		</div>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
		</div></fieldset>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('file_extension'))) ?>
				</span>
			</div>
			<div class="input">
				<a target="_self" data-type="view" data-action="" data-method="extension" data-id="" data-extra="[]" href="/#//" class="">
					<div class="inputholder">
						<span class=""><?php echo encodeHtml(htmlentities(@$extension)) ?>
						</span>
					</div>
				</a>
				<div class="clickable">
					<a target="_self" data-type="view" data-action="" data-method="extension" data-id="" data-extra="[]" href="/#//" class="action">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('edit'))) ?>
						</span>
					</a>
				</div>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('file_mimetype'))) ?>
				</span>
			</div>
			<div class="input">
				<a target="_self" data-action="template" data-method="extension" data-id="" data-extra="[]" href="/#/template/" class="">
					<div class="inputholder">
						<span class=""><?php echo encodeHtml(htmlentities(@$mime_type)) ?>
						</span>
					</div>
				</a>
			</div>
		</div>
	</form>