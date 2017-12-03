
	
		
		
		<form name="" target="_self" action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="<?php echo OR_METHOD ?>" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave="" onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<?php $if3=(!empty(@$conf['login']['logo']['file'])); if($if3){?>
				<?php $if4=(!empty(@$conf['login']['logo']['url'])); if($if4){?>
					<a target="_self" data-url="<?php echo @$conf['login']['logo']['url'] ?>" data-action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
						<img class="" title="" src="<?php echo @$conf['login']['logo']['file'] ?>" />
						
					</a>

				<?php } ?>
				<?php $if4=(empty(@$conf['login']['logo']['url'])); if($if4){?>
					<img class="" title="" src="<?php echo @$conf['login']['logo']['file'] ?>" />
					
				<?php } ?>
			<?php } ?>
			<?php $if3=(empty(@$conf['login']['motd'])); if($if3){?>
				<div class="message info">
					<span class="text"><?php echo nl2br('config:login/motd'); ?></span>
					
				</div>
			<?php } ?>
			<?php $if3=(@$conf['login']['nologin']); if($if3){?>
				<div class="message error">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'LOGIN_NOLOGIN_DESC'.'')))); ?></span>
					
				</div>
			<?php } ?>
			<?php $if3=(@$conf['security']['readonly']); if($if3){?>
				<div class="message warn">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_READONLY_DESC'.'')))); ?></span>
					
				</div>
			<?php } ?>
			<?php $if3=(!@$conf['login']['nologin']); if($if3){?>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_login_name" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_USERNAME'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<?php $if6=!(!empty($$force_username)); if($if6){?>
							<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> data-hint="<?php echo lang('USER_USERNAME') ?>" id="<?php echo REQUEST_ID ?>_login_name" name="login_name<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="name" value="<?php echo Text::encodeHtml($login_name) ?>" /><?php if ('') { ?><input type="hidden" name="login_name" value="<?php $login_name ?>"/><?php } ?></div>
							
						<?php } ?>
						<?php if(!$if6){?>
							<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_login_name" name="login_name<?php if ('') echo '_disabled' ?>" type="hidden" maxlength="256" class="text" value="<?php echo Text::encodeHtml($login_name) ?>" /><?php if ('') { ?><input type="hidden" name="login_name" value="<?php $login_name ?>"/><?php } ?></div>
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($force_username))); ?></span>
							
						<?php } ?>
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_login_password" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_PASSWORD'.'')))); ?></span>
							
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
						<?php { $tmpname     = 'remember';$default  = false;$readonly = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
						
						<label for="<?php echo REQUEST_ID ?>_remember" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'REMEMBER_ME'.'')))); ?></span>
							
						</label>
					</div>
				</div>
			<?php } ?>
			<fieldset class="<?php echo false?" open":"" ?><?php echo false?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('USER_NEW_PASSWORD') ?></legend><div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_password1" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_NEW_PASSWORD'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input type="password" name="password1" id="<?php echo REQUEST_ID ?>_password1" size="25" maxlength="256" class="" value="" /></div>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_password2" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_NEW_PASSWORD_REPEAT'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input type="password" name="password2" id="<?php echo REQUEST_ID ?>_password2" size="25" maxlength="256" class="" value="" /></div>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="<?php echo false?" open":"" ?><?php echo false?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('USER_TOKEN') ?></legend><div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_user_token" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_TOKEN'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_user_token" name="user_token<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="text" value="<?php echo Text::encodeHtml('') ?>" /><?php if ('') { ?><input type="hidden" name="user_token" value="<?php '' ?>"/><?php } ?></div>
						
					</div>
				</div>
			</div></fieldset>
			<?php $if3=(intval('1')<intval(@count($dbids))); if($if3){?>
				<fieldset class="<?php echo true?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><img src="/themes/default/images/icon/method/database.svg" /><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('DATABASE') ?></legend><div>
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_dbid" class="label">
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'DATABASE'.'')))); ?></span>
								
							</label>
						</div>
						<div class="input"><!-- Compiling selectbox/selectbox-begin --><?php $a7_list='dbids';$a7_name='dbid';$a7_default=$actdbid;$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
$a7_readonly=false;
$a7_tmp_list = $$a7_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a7_name)?'- '.lang('EMPTY').' -':$a7_tmp_list[$$a7_name];
}
else
{
if ( $a7_addempty!==FALSE  )
{
	if ($a7_addempty===TRUE)
		$a7_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a7_tmp_list;
	else
		$a7_tmp_list = array(''=>'- '.lang($a7_addempty).' -')+$a7_tmp_list;
}
?><div class="inputholder"><select<?php if ($a7_readonly) echo ' disabled="disabled"' ?> id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?>"  name="<?php echo $a7_name; if ($a7_multiple) echo '[]'; ?>" onchange="<?php echo $a7_onchange ?>" title="<?php echo $a7_title ?>" class="<?php echo $a7_class ?>"<?php
if (count($$a7_list)<=1) echo ' disabled="disabled"';
if	($a7_multiple) echo ' multiple="multiple"';
echo ' size="'.intval($a7_size).'"';
?>><?php
		if	( isset($$a7_name) && isset($a7_tmp_list[$$a7_name]) )
			$a7_tmp_default = $$a7_name;
		elseif ( isset($a7_default) )
			$a7_tmp_default = $a7_default;
		else
			$a7_tmp_default = '';
		foreach( $a7_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a7_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a7_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a7_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select></div><?php
if (count($$a7_list)==0) echo '<input type="hidden" name="'.$a7_name.'" value="" />';
if (count($$a7_list)==1) echo '<input type="hidden" name="'.$a7_name.'" value="'.$box_key.'" />';
}
?><?php unset($a7_list,$a7_name,$a7_default,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?>
						</div>
					</div>
				</div></fieldset>
			<?php } ?>
			<?php if(!$if3){?>
				<input type="hidden" name="dbid" value="<?php echo $actdbid ?>"/>
				
			<?php } ?>
			<input type="hidden" name="objectid" value="<?php echo $objectid ?>"/>
			
			<input type="hidden" name="modelid" value="<?php echo $modelid ?>"/>
			
			<input type="hidden" name="projectid" value="<?php echo $projectid ?>"/>
			
			<input type="hidden" name="languageid" value="<?php echo $languageid ?>"/>
			
		
<div class="bottom">
	<div class="command true">
	
		<input type="button" class="submit ok" value="<?php echo lang('menu_login') ?>" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. --><input type="button" class="submit cancel" value="<?php echo lang("CANCEL") ?>" onclick="$(div#dialog').hide(); $('div#filler').fadeOut(500); $(this).closest('div.panel').find('ul.views > li.active').click();" />	</div>
</div>

</form>

	