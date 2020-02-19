<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<?php $if2=(config('security','nopublish')); if($if2) {  ?>
		<div class="message warn">
			<span class="help"><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOPUBLISH_DESC'))) ?>
			</span>
		</div>
	 <?php } ?>
	<form name="" target="_self" data-target="view" action="./" data-method="pub" data-action="pageelement" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="1" data-autosave="" class="or-form pageelement">
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<input type="checkbox" name="files" value="1" <?php if(''.@$files.''){ ?>checked="1"<?php } ?> class="">
					</input>
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('global_files'))) ?>
						</span>
					</label>
				</div>
			</div>
		</div></fieldset>
	</form>