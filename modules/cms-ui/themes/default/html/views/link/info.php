<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="info" data-action="link" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form link" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="link" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="info" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
		<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('global_prop') ?></legend><div class="closable">
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_name')))); ?></span>
				</div>
				<div class="input">
					<span class="name,focus"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_description')))); ?></span>
				</div>
				<div class="input">
					<span class="description"><?php echo nl2br(encodeHtml(htmlentities($description))); ?></span>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('additional_info') ?></legend><div class="closable">
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_objectid" class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'id'.'')))); ?></span>
					</label>
				</div>
				<div class="input">
					<span><?php echo nl2br(encodeHtml(htmlentities($objectid))); ?></span>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('prop_userinfo') ?></legend><div class="closable">
			<div class="line">
				<div class="label">
					<label class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('global_created')))); ?></span>
					</label>
				</div>
				<div class="input">
					<img src="./modules/cms-ui/themes/default/images/icon/el_date.png" />
					<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($create_date) ?>
					<br/>
					<img src="./modules/cms-ui/themes/default/images/icon/user.png" />
					<?php include_once( 'modules/template-engine/components/html/user/component-user.php') ?><?php component_user($create_user) ?>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('global_lastchange')))); ?></span>
					</label>
				</div>
				<div class="input">
					<img src="./modules/cms-ui/themes/default/images/icon/el_date.png" />
					<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($lastchange_date) ?>
					<br/>
					<img src="./modules/cms-ui/themes/default/images/icon/user.png" />
					<?php include_once( 'modules/template-engine/components/html/user/component-user.php') ?><?php component_user($lastchange_user) ?>
				</div>
			</div>
		</div></fieldset>
	<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary or-form-btn--save" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>