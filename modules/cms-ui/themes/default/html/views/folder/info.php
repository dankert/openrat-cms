<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<form name="" target="_self" data-target="view" action="./" data-method="info" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form folder" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="folder" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="info" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('GLOBAL_PROP') ?></legend><div class="closable">
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_name" class="label"><?php echo lang('global_name') ?>
						</label>
					</div>
					<div class="input">
						<span class="name,focus"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_filename" class="label"><?php echo lang('global_filename') ?>
						</label>
					</div>
					<div class="input">
						<span><?php echo nl2br(encodeHtml(htmlentities($filename))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_description" class="label"><?php echo lang('global_description') ?>
						</label>
					</div>
					<div class="input">
						<span class="description"><?php echo nl2br(encodeHtml(htmlentities($description))); ?></span>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('additional_info') ?></legend><div class="closable">
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_full_filename" class="label"><?php echo lang('FULL_FILENAME') ?>
						</label>
					</div>
					<div class="input">
						<span><?php echo nl2br(encodeHtml(htmlentities($full_filename))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_objectid" class="label"><?php echo lang('id') ?>
						</label>
					</div>
					<div class="input">
						<span><?php echo nl2br(encodeHtml(htmlentities($objectid))); ?></span>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('PROP_USERINFO') ?></legend><div class="closable">
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_create_user" class="label"><?php echo lang('global_created') ?>
						</label>
					</div>
					<div class="input">
						<i class="image-icon image-icon--action-el_date"></i>
						
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($create_date) ?>
						
						<br/>
						
						<i class="image-icon image-icon--action-user"></i>
						
						<?php include_once( 'modules/template-engine/components/html/user/component-user.php') ?><?php component_user($create_user) ?>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_lastchange_user" class="label"><?php echo lang('global_lastchange') ?>
						</label>
					</div>
					<div class="input">
						<i class="image-icon image-icon--action-el_date"></i>
						
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($lastchange_date) ?>
						
						<br/>
						
						<i class="image-icon image-icon--action-user"></i>
						
						<?php include_once( 'modules/template-engine/components/html/user/component-user.php') ?><?php component_user($lastchange_user) ?>
						
					</div>
				</div>
			</div></fieldset>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>
	