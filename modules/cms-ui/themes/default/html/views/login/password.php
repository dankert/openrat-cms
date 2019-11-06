<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<?php $if2=(config('login','send_password')); if($if2){?>
		<form name="" target="_self" data-target="view" action="./" data-method="password" data-action="login" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form login" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="login" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="password" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line logo">
	<div class="label">
	<img src="themes/default/images/logo_password.png ?>"
	border="0" />
	</div>
	<div class="input">
	<h2>
			<?php echo langHtml('logo_password') ?>
		</h2>
		<p>
			<?php echo langHtml('logo_password_text') ?>
		</p>

	</div>
</div>
			</div>
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('USER_USERNAME')))); ?></span>
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_username" name="<?php if ('') echo ''.'_' ?>username<?php if (false) echo '_disabled' ?>" autofocus="autofocus" type="text" maxlength="128" class="" value="<?php echo Text::encodeHtml(@$username) ?>" /><?php if (false) { ?><input type="hidden" name="username" value="<?php $username ?>"/><?php } ?></div>
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
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>
	<?php } ?>
	<?php if(!$if2){?>
		<div class="message error">
			<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'PASSWORD_NOT_ENABLED'.'')))); ?></span>
		</div>
	<?php } ?>