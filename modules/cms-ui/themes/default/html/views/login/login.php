<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<form name="" target="_self" data-target="view" action="./" data-method="login" data-action="login" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form login" data-async="false" data-autosave="false" data-after-success="reloadAll"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="login" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="login" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<?php $if3=(config('login','logo','enabled')); if($if3){?>
				<?php $if4=!((config('login','logo','url'))==FALSE); if($if4){?>
					<a target="_self" data-url="<?php echo config('login','logo','url') ?>" data-action="" data-method="login" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#//">
						<img src="<?php echo config('login','logo','image') ?>" />
						
					</a>
				<?php } ?>
				<?php if(!$if4){?>
					<img src="<?php echo config('login','logo','image') ?>" />
					
				<?php } ?>
			<?php } ?>
			<?php $if3=!((config('login','motd'))==FALSE); if($if3){?>
				<div class="message info">
					<span><?php echo nl2br(encodeHtml(htmlentities(config('login','motd')))); ?></span>
					
				</div>
			<?php } ?>
			<?php $if3=(config('login','nologin')); if($if3){?>
				<div class="message error">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'LOGIN_NOLOGIN_DESC'.'')))); ?></span>
					
				</div>
			<?php } ?>
			<?php $if3=(config('security','readonly')); if($if3){?>
				<div class="message warn">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_READONLY_DESC'.'')))); ?></span>
					
				</div>
			<?php } ?>
			<?php $if3=(!config('login','nologin')); if($if3){?>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_login_name" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_USERNAME'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<?php $if6=!(isset($$force_username)); if($if6){?>
							<div class="inputholder"><input placeholder="<?php echo lang('USER_USERNAME') ?>" id="<?php echo REQUEST_ID ?>_login_name" name="<?php if ('') echo ''.'_' ?>login_name<?php if (false) echo '_disabled' ?>" required="required" autofocus="autofocus" type="text" maxlength="128" class="name" value="<?php echo Text::encodeHtml(@$login_name) ?>" /><?php if (false) { ?><input type="hidden" name="login_name" value="<?php $login_name ?>"/><?php } ?></div>
							
						<?php } ?>
						<?php if(!$if6){?>
							<input type="hidden" name="login_name" value="<?php echo $login_name ?>"/>
							
							<span><?php echo nl2br(encodeHtml(htmlentities($force_username))); ?></span>
							
						<?php } ?>
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_login_password" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_PASSWORD'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input type="password" name="login_password" id="<?php echo REQUEST_ID ?>_login_password" size="20" maxlength="256" class="name" value="" /></div>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php { $tmpname     = 'remember';$default  = false;$readonly = false;$required = false;		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1"<?php if( $checked ) echo ' checked="checked"' ?><?php if( $required ) echo ' required="required"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
						
						<label for="<?php echo REQUEST_ID ?>_remember" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'REMEMBER_ME'.'')))); ?></span>
							
						</label>
					</div>
				</div>
			<?php } ?>
			<fieldset class="toggle-open-close<?php echo false?" open":" closed" ?><?php echo false?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('USER_NEW_PASSWORD') ?></legend><div class="closable">
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_password1" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_NEW_PASSWORD'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input type="password" name="password1" id="<?php echo REQUEST_ID ?>_password1" size="25" maxlength="256" class="" value="" /></div>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_password2" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_NEW_PASSWORD_REPEAT'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input type="password" name="password2" id="<?php echo REQUEST_ID ?>_password2" size="25" maxlength="256" class="" value="" /></div>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo false?" open":" closed" ?><?php echo false?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('USER_TOKEN') ?></legend><div class="closable">
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_user_token" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_TOKEN'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_user_token" name="<?php if ('') echo ''.'_' ?>user_token<?php if (false) echo '_disabled' ?>" type="text" maxlength="30" class="" value="<?php echo Text::encodeHtml('') ?>" /><?php if (false) { ?><input type="hidden" name="user_token" value="<?php '' ?>"/><?php } ?></div>
						
					</div>
				</div>
			</div></fieldset>
			<?php $if3=(intval('1')<intval(@count($dbids))); if($if3){?>
				<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><img src="/themes/default/images/icon/method/database.svg" /><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('DATABASE') ?></legend><div class="closable">
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_dbid" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'DATABASE'.'')))); ?></span>
								
							</label>
						</div>
						<div class="input">
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_dbid" name="dbid" title="" class=""<?php if (count($dbids)<=1) echo ' disabled="disabled"'; ?> size="1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($dbids,$dbid,0,0) ?><?php if (count($dbids)==0) { ?><input type="hidden" name="dbid" value="" /><?php } ?><?php if (count($dbids)==1) { ?><input type="hidden" name="dbid" value="<?php echo array_keys($dbids)[0] ?>" /><?php } ?>
							</select></div>
						</div>
					</div>
				</div></fieldset>
			<?php } ?>
			<?php if(!$if3){?>
				<input type="hidden" name="dbid" value="<?php echo $dbid ?>"/>
				
			<?php } ?>
			<input type="hidden" name="objectid" value="<?php echo $objectid ?>"/>
			
			<input type="hidden" name="modelid" value="<?php echo $modelid ?>"/>
			
			<input type="hidden" name="projectid" value="<?php echo $projectid ?>"/>
			
			<input type="hidden" name="languageid" value="<?php echo $languageid ?>"/>
			
		<div class="or-form-actionbar"><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('menu_login') ?>" /></div></form>
	