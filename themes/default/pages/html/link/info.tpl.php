<?php $a2_name='';$a2_target='_self';$a2_method='post';$a2_enctype='application/x-www-form-urlencoded';$a2_type=''; ?><?php
		$a2_action = $actionName;
		$a2_subaction = $targetSubActionName;
		$a2_id = $this->getRequestId();
	if ($this->isEditable())
	{
		if	($this->isEditMode())
		{
			$a2_method    = 'POST';
		}
		else
		{
			$a2_method    = 'GET';
			$a2_subaction = $subActionName;
		}
	}
	switch( $a2_type )
	{
		case 'upload':
			$a2_tmp_submitFunction = '';
			break;
		default:
			$a2_tmp_submitFunction = 'formSubmit( $(this) ); return false;';
	}
?><form name="<?php echo $a2_name ?>"
      target="<?php echo $a2_target ?>"
      action="<?php echo Html::url( $a2_action,$a2_subaction,$a2_id ) ?>"
      method="<?php echo $a2_method ?>"
      enctype="<?php echo $a2_enctype ?>" style="margin:0px;padding:0px;"
      class="<?php echo $a2_action ?>"
      onSubmit="<?php echo $a2_tmp_submitFunction ?>"><input type="submit" class="invisible" />
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $this->actionName ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $this->subActionName ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $this->getRequestId() ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($a2_name,$a2_target,$a2_method,$a2_enctype,$a2_type) ?><?php $a3_title=lang('global_prop'); ?><fieldset><?php if(isset($a3_title)) { ?><legend><?php if(isset($a3_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a3_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a3_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a3_title) ?><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='text';$a6_text='GLOBAL_name';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='name,focus';$a6_var='name';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?></div></div><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='text';$a6_text='GLOBAL_description';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='description';$a6_var='description';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?></div></div></fieldset><?php $a3_title=lang('additional_info'); ?><fieldset><?php if(isset($a3_title)) { ?><legend><?php if(isset($a3_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a3_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a3_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a3_title) ?><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_for='objectid'; ?><label<?php if (isset($a6_for)) { ?> for="id_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); if(hasLang($a6_key.'_desc')) { ?><div class="description"><?php echo lang($a6_key.'_desc')?></div> <?php } } ?><?php unset($a6_for) ?><?php $a7_class='text';$a7_key='id';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?></label></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='text';$a6_var='objectid';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?></div></div></fieldset><?php $a3_title=lang('prop_userinfo'); ?><fieldset><?php if(isset($a3_title)) { ?><legend><?php if(isset($a3_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a3_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a3_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a3_title) ?><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_for=''; ?><label<?php if (isset($a6_for)) { ?> for="id_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); if(hasLang($a6_key.'_desc')) { ?><div class="description"><?php echo lang($a6_key.'_desc')?></div> <?php } } ?><?php unset($a6_for) ?><?php $a7_class='text';$a7_text='global_created';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?></label></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_icon='el_date';$a6_align='left'; ?><?php
	$a6_tmp_image_file = $image_dir.'icon_'.$a6_icon.IMG_ICON_EXT;
	$a6_size = '16x16';
	$a6_tmp_title = basename($a6_tmp_image_file);
?><img alt="<?php echo $a6_tmp_title; if (isset($a6_size)) { echo ' ('; list($a6_tmp_width,$a6_tmp_height)=explode('x',$a6_size);echo $a6_tmp_width.'x'.$a6_tmp_height; echo')';} ?>" src="<?php echo $a6_tmp_image_file ?>" border="0"<?php if(isset($a6_align)) echo ' align="'.$a6_align.'"' ?><?php if (isset($a6_size)) { list($a6_tmp_width,$a6_tmp_height)=explode('x',$a6_size);echo ' width="'.$a6_tmp_width.'" height="'.$a6_tmp_height.'"';} ?> /><?php unset($a6_icon,$a6_align) ?><?php $a6_date=$create_date; ?><?php	
    global $conf;
	$time = $a6_date;
	if	( isset($_COOKIE['or_timezone_offset']) )
	{
		$time -= (int)date('Z');
		$time += ((int)$_COOKIE['or_timezone_offset']*60);
	}
	if	( $time==0)
		echo lang('GLOBAL_UNKNOWN');
	elseif ( !$conf['interface']['human_date_format'] )
	{
		echo '<span title="';
		$dl = date(lang('DATE_FORMAT_LONG'),$time);
		$dl = str_replace('{weekday}',lang('DATE_WEEKDAY'.strval(date('w',$time))),$dl);
		$dl = str_replace('{month}'  ,lang('DATE_MONTH'  .strval(date('n',$time))),$dl);
		echo $dl;
		unset($dl);
		echo '">';
		echo date(lang('DATE_FORMAT'),$time);
		echo '</span>';
	}
	else
	{
		$sekunden = time()-$time;
		$minuten = intval($sekunden/60);
		$stunden = intval($minuten /60);
		$tage    = intval($stunden /24);
		$monate  = intval($tage    /30);
		$jahre   = intval($monate  /12);
		echo '<span title="'.date(lang('DATE_FORMAT'),$time).'"">';
		if	( $time==0)
			echo lang('GLOBAL_UNKNOWN');
		elseif ( !$conf['interface']['human_date_format'] )
			echo date(lang('DATE_FORMAT'),$time);
		elseif	( $sekunden == 1 )
			echo $sekunden.' '.lang('GLOBAL_SECOND');
		elseif	( $sekunden < 60 )
			echo $sekunden.' '.lang('GLOBAL_SECONDS');
		elseif	( $minuten == 1 )
			echo $minuten.' '.lang('GLOBAL_MINUTE');
		elseif	( $minuten < 60 )
			echo $minuten.' '.lang('GLOBAL_MINUTES');
		elseif	( $stunden == 1 )
			echo $stunden.' '.lang('GLOBAL_HOUR');
		elseif	( $stunden < 60 )
			echo $stunden.' '.lang('GLOBAL_HOURS');
		elseif	( $tage == 1 )
			echo $tage.' '.lang('GLOBAL_DAY');
		elseif	( $tage < 60 )
			echo $tage.' '.lang('GLOBAL_DAYS');
		elseif	( $monate == 1 )
			echo $monate.' '.lang('GLOBAL_MONTH');
		elseif	( $monate < 12 )
			echo $monate.' '.lang('GLOBAL_MONTHS');
		elseif	( $jahre == 1 )
			echo $jahre.' '.lang('GLOBAL_YEAR');
		else
			echo $jahre.' '.lang('GLOBAL_YEARS');
		echo '</span>';
	}
?><?php unset($a6_date) ?><br/><?php $a6_icon='user';$a6_align='left'; ?><?php
	$a6_tmp_image_file = $image_dir.'icon_'.$a6_icon.IMG_ICON_EXT;
	$a6_size = '16x16';
	$a6_tmp_title = basename($a6_tmp_image_file);
?><img alt="<?php echo $a6_tmp_title; if (isset($a6_size)) { echo ' ('; list($a6_tmp_width,$a6_tmp_height)=explode('x',$a6_size);echo $a6_tmp_width.'x'.$a6_tmp_height; echo')';} ?>" src="<?php echo $a6_tmp_image_file ?>" border="0"<?php if(isset($a6_align)) echo ' align="'.$a6_align.'"' ?><?php if (isset($a6_size)) { list($a6_tmp_width,$a6_tmp_height)=explode('x',$a6_size);echo ' width="'.$a6_tmp_width.'" height="'.$a6_tmp_height.'"';} ?> /><?php unset($a6_icon,$a6_align) ?><?php $a6_user=$create_user; ?><?php
		if	( is_object($a6_user) )
			$user = $a6_user;
		else
			$user = $$a6_user;
		if	( empty($user->name) )
			$user->name = lang('GLOBAL_UNKNOWN');
		if	( empty($user->fullname) )
			$user->fullname = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
		if	( !empty($user->mail) && $conf['security']['user']['show_mail'] )
			echo '<a href="mailto:'.$user->mail.'" title="'.$user->fullname.'">'.$user->name.'</a>';
		else
			echo '<span title="'.$user->fullname.'">'.$user->name.'</span>';
?><?php unset($a6_user) ?></div></div><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_for=''; ?><label<?php if (isset($a6_for)) { ?> for="id_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); if(hasLang($a6_key.'_desc')) { ?><div class="description"><?php echo lang($a6_key.'_desc')?></div> <?php } } ?><?php unset($a6_for) ?><?php $a7_class='text';$a7_text='global_lastchange';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?></label></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_icon='el_date';$a6_align='left'; ?><?php
	$a6_tmp_image_file = $image_dir.'icon_'.$a6_icon.IMG_ICON_EXT;
	$a6_size = '16x16';
	$a6_tmp_title = basename($a6_tmp_image_file);
?><img alt="<?php echo $a6_tmp_title; if (isset($a6_size)) { echo ' ('; list($a6_tmp_width,$a6_tmp_height)=explode('x',$a6_size);echo $a6_tmp_width.'x'.$a6_tmp_height; echo')';} ?>" src="<?php echo $a6_tmp_image_file ?>" border="0"<?php if(isset($a6_align)) echo ' align="'.$a6_align.'"' ?><?php if (isset($a6_size)) { list($a6_tmp_width,$a6_tmp_height)=explode('x',$a6_size);echo ' width="'.$a6_tmp_width.'" height="'.$a6_tmp_height.'"';} ?> /><?php unset($a6_icon,$a6_align) ?><?php $a6_date=$lastchange_date; ?><?php	
    global $conf;
	$time = $a6_date;
	if	( isset($_COOKIE['or_timezone_offset']) )
	{
		$time -= (int)date('Z');
		$time += ((int)$_COOKIE['or_timezone_offset']*60);
	}
	if	( $time==0)
		echo lang('GLOBAL_UNKNOWN');
	elseif ( !$conf['interface']['human_date_format'] )
	{
		echo '<span title="';
		$dl = date(lang('DATE_FORMAT_LONG'),$time);
		$dl = str_replace('{weekday}',lang('DATE_WEEKDAY'.strval(date('w',$time))),$dl);
		$dl = str_replace('{month}'  ,lang('DATE_MONTH'  .strval(date('n',$time))),$dl);
		echo $dl;
		unset($dl);
		echo '">';
		echo date(lang('DATE_FORMAT'),$time);
		echo '</span>';
	}
	else
	{
		$sekunden = time()-$time;
		$minuten = intval($sekunden/60);
		$stunden = intval($minuten /60);
		$tage    = intval($stunden /24);
		$monate  = intval($tage    /30);
		$jahre   = intval($monate  /12);
		echo '<span title="'.date(lang('DATE_FORMAT'),$time).'"">';
		if	( $time==0)
			echo lang('GLOBAL_UNKNOWN');
		elseif ( !$conf['interface']['human_date_format'] )
			echo date(lang('DATE_FORMAT'),$time);
		elseif	( $sekunden == 1 )
			echo $sekunden.' '.lang('GLOBAL_SECOND');
		elseif	( $sekunden < 60 )
			echo $sekunden.' '.lang('GLOBAL_SECONDS');
		elseif	( $minuten == 1 )
			echo $minuten.' '.lang('GLOBAL_MINUTE');
		elseif	( $minuten < 60 )
			echo $minuten.' '.lang('GLOBAL_MINUTES');
		elseif	( $stunden == 1 )
			echo $stunden.' '.lang('GLOBAL_HOUR');
		elseif	( $stunden < 60 )
			echo $stunden.' '.lang('GLOBAL_HOURS');
		elseif	( $tage == 1 )
			echo $tage.' '.lang('GLOBAL_DAY');
		elseif	( $tage < 60 )
			echo $tage.' '.lang('GLOBAL_DAYS');
		elseif	( $monate == 1 )
			echo $monate.' '.lang('GLOBAL_MONTH');
		elseif	( $monate < 12 )
			echo $monate.' '.lang('GLOBAL_MONTHS');
		elseif	( $jahre == 1 )
			echo $jahre.' '.lang('GLOBAL_YEAR');
		else
			echo $jahre.' '.lang('GLOBAL_YEARS');
		echo '</span>';
	}
?><?php unset($a6_date) ?><br/><?php $a6_icon='user';$a6_align='left'; ?><?php
	$a6_tmp_image_file = $image_dir.'icon_'.$a6_icon.IMG_ICON_EXT;
	$a6_size = '16x16';
	$a6_tmp_title = basename($a6_tmp_image_file);
?><img alt="<?php echo $a6_tmp_title; if (isset($a6_size)) { echo ' ('; list($a6_tmp_width,$a6_tmp_height)=explode('x',$a6_size);echo $a6_tmp_width.'x'.$a6_tmp_height; echo')';} ?>" src="<?php echo $a6_tmp_image_file ?>" border="0"<?php if(isset($a6_align)) echo ' align="'.$a6_align.'"' ?><?php if (isset($a6_size)) { list($a6_tmp_width,$a6_tmp_height)=explode('x',$a6_size);echo ' width="'.$a6_tmp_width.'" height="'.$a6_tmp_height.'"';} ?> /><?php unset($a6_icon,$a6_align) ?><?php $a6_user=$lastchange_user; ?><?php
		if	( is_object($a6_user) )
			$user = $a6_user;
		else
			$user = $$a6_user;
		if	( empty($user->name) )
			$user->name = lang('GLOBAL_UNKNOWN');
		if	( empty($user->fullname) )
			$user->fullname = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
		if	( !empty($user->mail) && $conf['security']['user']['show_mail'] )
			echo '<a href="mailto:'.$user->mail.'" title="'.$user->fullname.'">'.$user->name.'</a>';
		else
			echo '<span title="'.$user->fullname.'">'.$user->name.'</span>';
?><?php unset($a6_user) ?></div></div></fieldset></form>
