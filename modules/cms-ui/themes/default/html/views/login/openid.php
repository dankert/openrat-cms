<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="_top" action="./" data-method="login" data-action="login" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form login" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="login" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="login" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
		<?php $if3=(config('security','openid','enable')); if($if3){?>
			<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('OPENID') ?></legend><div class="closable">
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'openid_user'.'')))); ?></span>
						<?php $if7=!((config('security','openid','logo_url'))==FALSE); if($if7){?>
							<img src="<?php echo config('security','openid','logo_url') ?>" />
						<?php } ?>
					</div>
					<div class="input">
						<?php include_once( 'modules/template-engine/components/html/radiobox/component-radio-box.php') ?><?php component_radio_box('openid_provider',$openid_providers,$openid_provider) ?>
						<?php $if7=($openid_user_identity); if($if7){?>
							<input  class="" type="radio" id="<?php echo REQUEST_ID ?>_openid_provider_identity" name="<?php if ('') echo ''.'_' ?>openid_provider<?php if (false) echo '_disabled' ?>" value="identity"<?php if('identity'==@$openid_provider)echo ' checked="checked"' ?> />
							<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_openid_url" name="<?php if ('') echo ''.'_' ?>openid_url<?php if (false) echo '_disabled' ?>" type="text" maxlength="256" class="name" value="<?php echo Text::encodeHtml(@$openid_url) ?>" /><?php if (false) { ?><input type="hidden" name="openid_url" value="<?php $openid_url ?>"/><?php } ?></div>
						<?php } ?>
					</div>
				</div>
			</div></fieldset>
			<?php $if4=(intval('1')<intval(@count($dbids))); if($if4){?>
				<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><img src="/themes/default/images/icon/method/database.svg" /><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('DATABASE') ?></legend><div class="closable">
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_dbid" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'DATABASE'.'')))); ?></span>
							</label>
						</div>
						<div class="input">
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_dbid" name="dbid" title="" class=""<?php if (count($dbids)<=1) echo ' disabled="disabled"'; ?> size="1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($dbids,$actdbid,0,0) ?><?php if (count($dbids)==0) { ?><input type="hidden" name="dbid" value="" /><?php } ?><?php if (count($dbids)==1) { ?><input type="hidden" name="dbid" value="<?php echo array_keys($dbids)[0] ?>" /><?php } ?>
							</select></div>
							<input type="hidden" name="screenwidth" value="9999"/>
						</div>
					</div>
				</div></fieldset>
			<?php } ?>
			<?php if(!$if4){?>
				<input type="hidden" name="dbid" value="<?php echo $actdbid ?>"/>
			<?php } ?>
			<input type="hidden" name="objectid" value="<?php echo $objectid ?>"/>
			<input type="hidden" name="modelid" value="<?php echo $modelid ?>"/>
			<input type="hidden" name="projectid" value="<?php echo $projectid ?>"/>
			<input type="hidden" name="languageid" value="<?php echo $languageid ?>"/>
		<?php } ?>
		<?php if(!$if3){?>
			<div class="message error">
				<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'OPENID_NOT_ENABLED'.'')))); ?></span>
			</div>
		<?php } ?>
	<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary or-form-btn--save" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>