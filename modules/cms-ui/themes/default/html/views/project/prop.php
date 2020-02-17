<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="project" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form project">
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_NAME'))) ?>
					</label>
				</div>
				<div class="input">
					<input name="name" disabled="" type="text" maxlength="128" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="name">
					</input>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_HOSTNAME'))) ?>
					</label>
				</div>
				<div class="input">
					<input name="url" disabled="" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$url)) ?>" class="">
					</input>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_TARGET_DIR'))) ?>
					</label>
				</div>
				<div class="input">
					<input name="target_dir" disabled="" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$target_dir)) ?>" class="filename">
					</input>
				</div>
			</div>
			<?php $if4=(config('publish','project','override_system_command')); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_CMD_AFTER_PUBLISH'))) ?>
						</label>
					</div>
					<div class="input">
						<input name="cmd_after_publish" disabled="" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$cmd_after_publish)) ?>" class="filename">
						</input>
					</div>
				</div>
			 <?php } ?>
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<input type="checkbox" name="publishFileExtension" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$publishFileExtension)) ?>" class="">
					</input>
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_publish_File_Extension'))) ?>
					</label>
				</div>
			</div>
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<input type="checkbox" name="publishPageExtension" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$publishPageExtension)) ?>" class="">
					</input>
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_publish_page_Extension'))) ?>
					</label>
				</div>
			</div>
			<label class="or-form-row or-form-radio"><input type="radio" name="linksAbsolute" disabled="" value="0" checked="<?php echo encodeHtml(htmlentities(@$linksAbsolute)) ?>" class="">
			</input></label>
			<label class="or-form-row or-form-radio"><input type="radio" name="linksAbsolute" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$linksAbsolute)) ?>" class="">
			</input></label>
		</div></fieldset>
		<?php $if3=('config:publish/ftp/enable'); if($if3) {  ?>
			<fieldset class="or-group toggle-open-close open show"><div class="closable">
				<div class="line">
					<div class="label">
						<label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_FTP_URL'))) ?>
						</label>
					</div>
					<div class="input">
						<input name="ftp_url" disabled="" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$ftp_url)) ?>" class="filename">
						</input>
						<br>
						</br>
						<input type="checkbox" name="ftp_passive" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$ftp_passive)) ?>" class="">
						</input>
						<label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_FTP_PASSIVE'))) ?>
						</label>
					</div>
				</div>
			</div></fieldset>
		 <?php } ?>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<input type="checkbox" name="content_negotiation" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$content_negotiation)) ?>" class="">
					</input>
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_CONTENT_NEGOTIATION'))) ?>
					</label>
				</div>
			</div>
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<input type="checkbox" name="cut_index" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$cut_index)) ?>" class="">
					</input>
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('PROJECT_CUT_INDEX'))) ?>
					</label>
				</div>
			</div>
		</div></fieldset>
	</form>