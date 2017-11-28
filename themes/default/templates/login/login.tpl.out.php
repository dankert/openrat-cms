<!-- Compiling output/output-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><!-- Compiling header/header-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a2_name='';$a2_views='password,register,license';$a2_back=false; ?><?php if(!empty($a2_views)) { ?>
  <div class="headermenu">
    <?php foreach( explode(',',$a2_views) as $a2_tmp_view ) { ?>
  	<div class="toolbar-icon clickable">
    <a href="javascript:void(0);" data-type="dialog" data-name="<?php echo lang('MENU_'.$a2_tmp_view) ?>" data-method="<?php echo $a2_tmp_view ?>">
		  <img src="<?php  echo $image_dir ?>icon/<?php echo $a2_tmp_view ?>.png" title="<?php echo lang('MENU_'.$a2_tmp_view.'_DESC') ?>" /> <?php echo lang('MENU_'.$a2_tmp_view) ?>
		</a>
  </div>
		<?php } ?>
  </div>
<?php } ?>
<?php unset($a2_name,$a2_views,$a2_back) ?>
		<form name=""
      target="_self"
      action="<?php echo OR_ACTION ?>"
      data-method="<?php echo OR_METHOD ?>"
      data-action="<?php echo OR_ACTION ?>"
      data-id="<?php echo OR_ID ?>"
      method="<?php echo OR_METHOD ?>"
      enctype="application/x-www-form-urlencoded"
      class="<?php echo OR_ACTION ?>"
      data-async=""
      data-autosave=""
      onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" />
      
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
<?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?>

			<?php $if3=(!empty(@$conf['login']['logo']['file'])); if($if3){?>
				<?php $if4=(!empty(@$conf['login']['logo']['url'])); if($if4){?><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a5_title='';$a5_type='';$a5_target='_top';$a5_url=@$conf['login']['logo']['url'];$a5_class='';$a5_frame='_self';$a5_modal=false; ?><?php
	$params = array();
	$tmp_url = '';
	$params[REQ_PARAM_TARGET] = $a5_target;
	$tmp_href = 'javascript:void(0);';		                          
	switch( $a5_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a5_action)?$a5_action:$this->actionName,'subaction'=>!empty($a5_subaction)?$a5_subaction:$this->subActionName,'id'=>!empty($a5_id)?$a5_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_data = str_replace("\n",'',str_replace('"','&quot;',$tmp_data));
			break;
		case 'html';
			$tmp_href = $a5_url;
		default:
			$tmp_data = '';
	}
?><a data-url="<?php echo $a5_url ?>" target="<?php echo $a5_frame ?>"<?php if (isset($a5_name)) { ?> data-name="<?php echo $a5_name ?>" name="<?php echo $a5_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a5_class ?>" data-id="<?php echo @$a5_id ?>" data-type="<?php echo $a5_type ?>" data-action="<?php echo @$a5_action ?>" data-method="<?php echo @$a5_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a5_accesskey)) echo ' accesskey="'.$a5_accesskey.'"' ?>  title="<?php echo encodeHtml($a5_title) ?>"><?php unset($a5_title,$a5_type,$a5_target,$a5_url,$a5_class,$a5_frame,$a5_modal) ?>
						<img class="" title="" src="<?php echo @$conf['login']['logo']['file'] ?>" />
						<!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></a>
				<?php } ?>
				<?php $if4=(empty(@$conf['login']['logo']['url'])); if($if4){?>
					<img class="" title="" src="<?php echo @$conf['login']['logo']['file'] ?>" />
					
				<?php } ?>
			<?php } ?>
			<?php $if3=(empty(@$conf['login']['motd'])); if($if3){?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a4_class='message info'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a5_class='text';$a5_raw=@$conf['login']['motd'];$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a5_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_raw,$a5_escape,$a5_cut) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div>
			<?php } ?>
			<?php $if3=(@$conf['login']['nologin']); if($if3){?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a4_class='message error'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a5_class='text';$a5_key='LOGIN_NOLOGIN_DESC';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div>
			<?php } ?>
			<?php $if3=(@$conf['security']['readonly']); if($if3){?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a4_class='message warn'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a5_class='text';$a5_key='GLOBAL_READONLY_DESC';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div>
			<?php } ?>
			<?php $if3=(!@$conf['login']['nologin']); if($if3){?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a6_for='login_name'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a7_class='text';$a7_key='USER_USERNAME';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></label><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?>
						<?php $if6=!(!empty($force_username)); if($if6){?><!-- Compiling input/input-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a7_class='name';$a7_default='';$a7_type='text';$a7_name='login_name';$a7_value='';$a7_size='20';$a7_maxlength='256';$a7_onchange='';$a7_readonly=false;$a7_hint=lang('USER_USERNAME');$a7_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
	  if ($a7_readonly && empty($$a7_name)) $$a7_name = '- '.lang('EMPTY').' -';
      if(!isset($a7_default)) $a7_default='';
      $tmp_value = Text::encodeHtml(isset($$a7_name)?$$a7_name:$a7_default);
?><?php if (!$a7_readonly || $a7_type=='hidden') {
?><div class="<?php echo $a7_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a7_readonly) echo ' disabled="true"' ?><?php if ($a7_hint) echo ' data-hint="'.$a7_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" name="<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" type="<?php echo $a7_type ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo str_replace(',',' ',$a7_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a7_icon) echo '<img src="'.$image_dir.'icon_'.$a7_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a7_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?>" name="<?php echo $a7_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a7_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a7_class,$a7_default,$a7_type,$a7_name,$a7_value,$a7_size,$a7_maxlength,$a7_onchange,$a7_readonly,$a7_hint,$a7_icon) ?>
						<?php } ?>
						<?php if(!$if6){?><!-- Compiling input/input-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a7_class='text';$a7_default='';$a7_type='hidden';$a7_name='login_name';$a7_value=$force_username;$a7_size='';$a7_maxlength='256';$a7_onchange='';$a7_readonly=false;$a7_hint='';$a7_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
	  if ($a7_readonly && empty($$a7_name)) $$a7_name = '- '.lang('EMPTY').' -';
      if(!isset($a7_default)) $a7_default='';
      $tmp_value = Text::encodeHtml(isset($$a7_name)?$$a7_name:$a7_default);
?><?php if (!$a7_readonly || $a7_type=='hidden') {
?><div class="<?php echo $a7_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a7_readonly) echo ' disabled="true"' ?><?php if ($a7_hint) echo ' data-hint="'.$a7_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" name="<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" type="<?php echo $a7_type ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo str_replace(',',' ',$a7_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a7_icon) echo '<img src="'.$image_dir.'icon_'.$a7_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a7_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?>" name="<?php echo $a7_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a7_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a7_class,$a7_default,$a7_type,$a7_name,$a7_value,$a7_size,$a7_maxlength,$a7_onchange,$a7_readonly,$a7_hint,$a7_icon) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a7_class='text';$a7_value=$force_username;$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $a7_escape?htmlentities($a7_value):$a7_value;
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_value,$a7_escape,$a7_cut) ?>
						<?php } ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a6_for='login_password'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a7_class='text';$a7_key='USER_PASSWORD';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></label><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling password/password-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a6_name='login_password';$a6_default='';$a6_class='name';$a6_size='20';$a6_maxlength='256'; ?><div class="inputholder"><input type="password" name="<?php echo $a6_name ?>"  id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?>" size="<?php echo $a6_size ?>" maxlength="<?php echo $a6_maxlength ?>" class="<?php echo $a6_class ?>" value="<?php echo isset($$a6_name)?$$a6_name:$a6_default ?>" /></div><?php unset($a6_name,$a6_default,$a6_class,$a6_size,$a6_maxlength) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?>
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
						<!-- Compiling label/label-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a6_for='remember'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a7_class='text';$a7_key='REMEMBER_ME';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></label><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div>
			<?php } ?>
			<fieldset class="<?php echo false?" open":"" ?><?php echo false?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('USER_NEW_PASSWORD') ?></legend><div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a6_for='password1'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a7_class='text';$a7_key='USER_NEW_PASSWORD';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></label><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling password/password-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a6_name='password1';$a6_default='';$a6_class='';$a6_size='25';$a6_maxlength='256'; ?><div class="inputholder"><input type="password" name="<?php echo $a6_name ?>"  id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?>" size="<?php echo $a6_size ?>" maxlength="<?php echo $a6_maxlength ?>" class="<?php echo $a6_class ?>" value="<?php echo isset($$a6_name)?$$a6_name:$a6_default ?>" /></div><?php unset($a6_name,$a6_default,$a6_class,$a6_size,$a6_maxlength) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a6_for='password2'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a7_class='text';$a7_key='USER_NEW_PASSWORD_REPEAT';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></label><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling password/password-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a6_name='password2';$a6_default='';$a6_class='';$a6_size='25';$a6_maxlength='256'; ?><div class="inputholder"><input type="password" name="<?php echo $a6_name ?>"  id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?>" size="<?php echo $a6_size ?>" maxlength="<?php echo $a6_maxlength ?>" class="<?php echo $a6_class ?>" value="<?php echo isset($$a6_name)?$$a6_name:$a6_default ?>" /></div><?php unset($a6_name,$a6_default,$a6_class,$a6_size,$a6_maxlength) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div>
			</div></fieldset>
			<fieldset class="<?php echo false?" open":"" ?><?php echo false?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('USER_TOKEN') ?></legend><div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a6_for='user_token'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a7_class='text';$a7_key='USER_TOKEN';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></label><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling input/input-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a6_class='text';$a6_default='';$a6_type='text';$a6_name='user_token';$a6_size='25';$a6_maxlength='256';$a6_onchange='';$a6_readonly=false;$a6_hint='';$a6_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
	  if ($a6_readonly && empty($$a6_name)) $$a6_name = '- '.lang('EMPTY').' -';
      if(!isset($a6_default)) $a6_default='';
      $tmp_value = Text::encodeHtml(isset($$a6_name)?$$a6_name:$a6_default);
?><?php if (!$a6_readonly || $a6_type=='hidden') {
?><div class="<?php echo $a6_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a6_readonly) echo ' disabled="true"' ?><?php if ($a6_hint) echo ' data-hint="'.$a6_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" name="<?php echo $a6_name ?><?php if ($a6_readonly) echo '_disabled' ?>" type="<?php echo $a6_type ?>" maxlength="<?php echo $a6_maxlength ?>" class="<?php echo str_replace(',',' ',$a6_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a6_icon) echo '<img src="'.$image_dir.'icon_'.$a6_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a6_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a6_name ?>" name="<?php echo $a6_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a6_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a6_class,$a6_default,$a6_type,$a6_name,$a6_size,$a6_maxlength,$a6_onchange,$a6_readonly,$a6_hint,$a6_icon) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div>
			</div></fieldset>
			<?php $if3=(intval('1')<intval(@count($dbids))); if($if3){?>
				<fieldset class="<?php echo true?" open":"" ?><?php echo 1?" show":"" ?>"><legend><img src="/themes/default/images/icon/method/database.svg" /><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('DATABASE') ?></legend><div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a5_class='line'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a6_class='label'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><!-- Compiling label/label-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a7_for='dbid'; ?><label<?php if (isset($a7_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" <?php if(hasLang(@$a7_key.'_desc')) { ?> title="<?php echo lang(@$a7_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); ?><?php if (isset($a7_text)) { echo $a7_text; } ?><?php } ?><?php unset($a7_for) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a8_class='text';$a8_key='DATABASE';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?><!-- Compiling label/label-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></label><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a6_class='input'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><!-- Compiling selectbox/selectbox-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a7_list='dbids';$a7_name='dbid';$a7_default=$actdbid;$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_default,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:29 +0100 --></div>
				</div></fieldset>
			<?php } ?>
			<?php if(!$if3){?><!-- Compiling hidden/hidden-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a4_name='dbid';$a4_default=$actdbid; ?><?php
if (isset($$a4_name))
	$a4_tmp_value = $$a4_name;
elseif ( isset($a4_default) )
	$a4_tmp_value = $a4_default;
else
	$a4_tmp_value = "";
?><input type="hidden" name="<?php echo $a4_name ?>" value="<?php echo $a4_tmp_value ?>" /><?php unset($a4_name,$a4_default) ?>
			<?php } ?><!-- Compiling hidden/hidden-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a3_name='objectid'; ?><?php
if (isset($$a3_name))
	$a3_tmp_value = $$a3_name;
elseif ( isset($a3_default) )
	$a3_tmp_value = $a3_default;
else
	$a3_tmp_value = "";
?><input type="hidden" name="<?php echo $a3_name ?>" value="<?php echo $a3_tmp_value ?>" /><?php unset($a3_name) ?><!-- Compiling hidden/hidden-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a3_name='modelid'; ?><?php
if (isset($$a3_name))
	$a3_tmp_value = $$a3_name;
elseif ( isset($a3_default) )
	$a3_tmp_value = $a3_default;
else
	$a3_tmp_value = "";
?><input type="hidden" name="<?php echo $a3_name ?>" value="<?php echo $a3_tmp_value ?>" /><?php unset($a3_name) ?><!-- Compiling hidden/hidden-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a3_name='projectid'; ?><?php
if (isset($$a3_name))
	$a3_tmp_value = $$a3_name;
elseif ( isset($a3_default) )
	$a3_tmp_value = $a3_default;
else
	$a3_tmp_value = "";
?><input type="hidden" name="<?php echo $a3_name ?>" value="<?php echo $a3_tmp_value ?>" /><?php unset($a3_name) ?><!-- Compiling hidden/hidden-begin @ Wed, 29 Nov 2017 00:26:29 +0100 --><?php $a3_name='languageid'; ?><?php
if (isset($$a3_name))
	$a3_tmp_value = $$a3_name;
elseif ( isset($a3_default) )
	$a3_tmp_value = $a3_default;
else
	$a3_tmp_value = "";
?><input type="hidden" name="<?php echo $a3_name ?>" value="<?php echo $a3_tmp_value ?>" /><?php unset($a3_name) ?>
		
<div class="bottom">
	<div class="command true">
	
		<input type="button" class="submit ok" value="message:menu_login" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->		<input type="button" class="submit cancel" value="{lang('CANCEL')}" onclick="$('div#dialog').hide(); $('div#filler').fadeOut(500); $(this).closest('div.panel').find('ul.views > li.active').click();" />	</div>
</div>

</form>
