<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="registercode" data-action="login" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form login" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="login" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="registercode" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
		<div class="line logo">
	<div class="label">
	<img src="themes/default/images/logo_register.png ?>"
	border="0" />
	</div>
	<div class="input">
	<h2>
			<?php echo langHtml('logo_register') ?>
		</h2>
		<p>
			<?php echo langHtml('logo_register_text') ?>
		</p>

	</div>
</div>
		</div>
		<div class="line">
			<div class="label">
				<span><?php echo nl2br(encodeHtml(htmlentities(lang('USER_REGISTER_CODE')))); ?></span>
			</div>
			<div class="input">
				<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_code" name="<?php if ('') echo ''.'_' ?>code<?php if (false) echo '_disabled' ?>" type="text" maxlength="256" class="focus" value="<?php echo Text::encodeHtml('') ?>" /><?php if (false) { ?><input type="hidden" name="code" value="<?php '' ?>"/><?php } ?></div>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<span><?php echo nl2br(encodeHtml(htmlentities(lang('USER_USERNAME')))); ?></span>
			</div>
			<div class="input">
				<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_username" name="<?php if ('') echo ''.'_' ?>username<?php if (false) echo '_disabled' ?>" type="text" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$username) ?>" /><?php if (false) { ?><input type="hidden" name="username" value="<?php $username ?>"/><?php } ?></div>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<span><?php echo nl2br(encodeHtml(htmlentities(lang('USER_PASSWORD')))); ?></span>
			</div>
			<div class="input">
				<div class="inputholder"><input type="password" name="password" id="<?php echo REQUEST_ID ?>_password" size="25" maxlength="256" class="" value="" /></div>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_DATABASE')))); ?></span>
			</div>
			<div class="input">
				<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_dbid" name="dbid" title="" class=""<?php if (count($dbids)<=1) echo ' disabled="disabled"'; ?> size="1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($dbids,'actdbid',0,0) ?><?php if (count($dbids)==0) { ?><input type="hidden" name="dbid" value="" /><?php } ?><?php if (count($dbids)==1) { ?><input type="hidden" name="dbid" value="<?php echo array_keys($dbids)[0] ?>" /><?php } ?>
				</select></div>
			</div>
		</div>
	<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary or-form-btn--save" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>