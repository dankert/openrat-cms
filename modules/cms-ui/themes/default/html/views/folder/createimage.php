<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="upload" action="./" data-method="createimage" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="multipart/form-data" data-async="" data-autosave="" class="or-form folder">
		<input type="hidden" name="type" value="file" class="">
		</input>
		<div class="line">
			<div class="label">
				<label class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('global_FILE'))) ?>
					</span>
				</label>
			</div>
			<div class="input">
				<input multiple="multiple" id="req0_file" name="file" size="40" maxlength="<?php echo encodeHtml(htmlentities(@$maxlength)) ?>" class="upload">
				</input>
			</div>
		</div>
		<div class="line or-dropzone-upload">
			<div class="label">
			</div>
			<div class="input">
			</div>
		</div>
		<div class="line">
			<div class="label">
				<span class="help"><?php echo encodeHtml(htmlentities(@lang('file_max_size'))) ?>
				</span>
			</div>
			<div class="input">
				<span class=""><?php echo encodeHtml(htmlentities(@$max_size)) ?>
				</span>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('HTTP_URL'))) ?>
				</span>
			</div>
			<div class="input">
				<input name="url" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$url)) ?>" class="">
				</input>
			</div>
		</div>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
		</div></fieldset>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('global_NAME'))) ?>
				</span>
			</div>
			<div class="input">
				<input name="name" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="">
				</input>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('global_DESCRIPTION'))) ?>
				</span>
			</div>
			<div class="input">
				<textarea name="description" disabled="" maxlength="0" class="inputarea">
				</textarea>
			</div>
		</div>
	</form>