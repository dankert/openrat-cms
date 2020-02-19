<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<?php $if2=(config('security','nopublish')); if($if2) {  ?>
		<div class="message warn">
			<span class="help"><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOPUBLISH_DESC'))) ?>
			</span>
		</div>
	 <?php } ?>
	<form name="" target="_self" data-target="view" action="./" data-method="pub" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="1" data-autosave="" class="or-form folder">
		<?php $if3=($pages); if($if3) {  ?>
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<input type="checkbox" name="pages" value="1" <?php if(''.@$pages.''){ ?>checked="1"<?php } ?> class="">
					</input>
					<label class="label">
						<span class=""> 
						</span>
						<span class=""><?php echo encodeHtml(htmlentities(@lang('global_pages'))) ?>
						</span>
					</label>
				</div>
			</div>
		 <?php } ?>
		<?php $if3=($files); if($if3) {  ?>
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<input type="checkbox" name="files" value="1" <?php if(''.@$files.''){ ?>checked="1"<?php } ?> class="">
					</input>
					<label class="label">
						<span class=""> 
						</span>
						<span class=""><?php echo encodeHtml(htmlentities(@lang('global_files'))) ?>
						</span>
					</label>
				</div>
			</div>
		 <?php } ?>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<?php $if4=(isset($subdirs)); if($if4) {  ?>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<input type="checkbox" name="subdirs" disabled="disabled" value="1" <?php if(''.@$subdirs.''){ ?>checked="1"<?php } ?> class="">
						</input>
						<label class="label">
							<span class=""> 
							</span>
							<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_PUBLISH_WITH_SUBDIRS'))) ?>
							</span>
						</label>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=(isset($clean)); if($if4) {  ?>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<input type="checkbox" name="clean" value="1" <?php if(''.@$clean.''){ ?>checked="1"<?php } ?> class="">
						</input>
						<label class="label">
							<span class=""> 
							</span>
							<span class=""><?php echo encodeHtml(htmlentities(@lang('global_CLEAN_AFTER_PUBLISH'))) ?>
							</span>
						</label>
					</div>
				</div>
			 <?php } ?>
		</div></fieldset>
	</form>