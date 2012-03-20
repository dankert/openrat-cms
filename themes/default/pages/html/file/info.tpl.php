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
?><?php unset($a2_name,$a2_target,$a2_method,$a2_enctype,$a2_type) ?><fieldset><?php if(isset($a3_title)) { ?><legend><?php if(isset($a3_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a3_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a3_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='text';$a6_text='global_name';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='name';$a6_var='name';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?></div></div><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='text';$a6_text='global_filename';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='filename';$a6_var='filename';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?></div></div><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='text';$a6_text='file_extension';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='extension';$a6_var='extension';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?></div></div><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='text';$a6_text='global_description';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='text';$a6_var='description';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?></div></div></fieldset><?php $a3_title=lang('additional_info'); ?><fieldset><?php if(isset($a3_title)) { ?><legend><?php if(isset($a3_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a3_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a3_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a3_title) ?><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_for='full_filename'; ?><label<?php if (isset($a6_for)) { ?> for="id_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); if(hasLang($a6_key.'_desc')) { ?><div class="description"><?php echo lang($a6_key.'_desc')?></div> <?php } } ?><?php unset($a6_for) ?><?php $a7_class='text';$a7_text='global_full_filename';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?></label></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='text';$a6_var='full_filename';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?></div></div><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_for='size'; ?><label<?php if (isset($a6_for)) { ?> for="id_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); if(hasLang($a6_key.'_desc')) { ?><div class="description"><?php echo lang($a6_key.'_desc')?></div> <?php } } ?><?php unset($a6_for) ?><?php $a7_class='text';$a7_text='FILE_SIZE';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?></label></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?></div><?php $a5_class='text';$a5_var='size';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = isset($$a5_var)?$$a5_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_var,$a5_escape,$a5_cut) ?></div><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_for='mimetype'; ?><label<?php if (isset($a6_for)) { ?> for="id_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); if(hasLang($a6_key.'_desc')) { ?><div class="description"><?php echo lang($a6_key.'_desc')?></div> <?php } } ?><?php unset($a6_for) ?><?php $a7_class='text';$a7_text='FILE_mimetype';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?></label></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='text';$a6_var='mimetype';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?><br/><?php $a6_title='';$a6_type='';$a6_class='action';$a6_action='file';$a6_subaction='size';$a6_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$a6_target = $view;
	switch( $a6_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a6_action)?$a6_action:$this->actionName,'subaction'=>!empty($a6_subaction)?$a6_subaction:$this->subActionName,'id'=>!empty($a6_id)?$a6_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a6_subaction)?$a6_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a6_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a6_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a6_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> name="<?php echo $a6_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a6_class ?>"<?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_action,$a6_subaction,$a6_frame) ?><?php $a7_class='text';$a7_key='menu_file_size';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?></a></div></div><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='text';$a6_text=lang('id');$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='text';$a6_var='objectid';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?></div></div><?php $a4_present='cache_filename'; ?><?php 
	$a4_tmp_exec = isset($$a4_present);
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_present) ?><?php $a5_class='line'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='label'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_for='cache_filename'; ?><label<?php if (isset($a7_for)) { ?> for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); if(hasLang($a7_key.'_desc')) { ?><div class="description"><?php echo lang($a7_key.'_desc')?></div> <?php } } ?><?php unset($a7_for) ?><?php $a8_class='text';$a8_text='CACHE_FILENAME';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></label></div><?php $a6_class='input'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_class='text';$a7_var='cache_filename';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = isset($$a7_var)?$$a7_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_var,$a7_escape,$a7_cut) ?><br/><?php $a7_icon='el_date';$a7_align='left'; ?><?php
	$a7_tmp_image_file = $image_dir.'icon_'.$a7_icon.IMG_ICON_EXT;
	$a7_size = '16x16';
	$a7_tmp_title = basename($a7_tmp_image_file);
?><img alt="<?php echo $a7_tmp_title; if (isset($a7_size)) { echo ' ('; list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo $a7_tmp_width.'x'.$a7_tmp_height; echo')';} ?>" src="<?php echo $a7_tmp_image_file ?>" border="0"<?php if(isset($a7_align)) echo ' align="'.$a7_align.'"' ?><?php if (isset($a7_size)) { list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo ' width="'.$a7_tmp_width.'" height="'.$a7_tmp_height.'"';} ?> /><?php unset($a7_icon,$a7_align) ?><?php $a7_date=$cache_filemtime; ?><?php	
    global $conf;
	$time = $a7_date;
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
?><?php unset($a7_date) ?></div></div><?php } ?><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_for='pages'; ?><label<?php if (isset($a6_for)) { ?> for="id_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); if(hasLang($a6_key.'_desc')) { ?><div class="description"><?php echo lang($a6_key.'_desc')?></div> <?php } } ?><?php unset($a6_for) ?><?php $a7_class='text';$a7_text='FILE_PAGES';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?></label></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_width='100%';$a6_space='0px';$a6_padding='0px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a6_width,$a6_space,$a6_padding) ?><?php $a7_list='pages';$a7_extract=true;$a7_key='list_key';$a7_value='list_value'; ?><?php
	$a7_list_tmp_key   = $a7_key;
	$a7_list_tmp_value = $a7_value;
	$a7_list_extract   = $a7_extract;
	unset($a7_key);
	unset($a7_value);
	if	( !isset($$a7_list) || !is_array($$a7_list) )
		$$a7_list = array();
	foreach( $$a7_list as $$a7_list_tmp_key => $$a7_list_tmp_value )
	{
		if	( $a7_list_extract )
		{
			if	( !is_array($$a7_list_tmp_value) )
			{
				print_r($$a7_list_tmp_value);
				die( 'not an array at key: '.$$a7_list_tmp_key );
			}
			extract($$a7_list_tmp_value);
		}
?><?php unset($a7_list,$a7_extract,$a7_key,$a7_value) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a9_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a9_header) ?><?php $a10_title='';$a10_type='';$a10_target='cms_main';$a10_url=$url;$a10_class='';$a10_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$params[REQ_PARAM_TARGET] = $a10_target;
	switch( $a10_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a10_action)?$a10_action:$this->actionName,'subaction'=>!empty($a10_subaction)?$a10_subaction:$this->subActionName,'id'=>!empty($a10_id)?$a10_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a10_subaction)?$a10_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a10_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a10_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a10_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a10_frame ?>"<?php if (isset($a10_name)) { ?> name="<?php echo $a10_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a10_class ?>"<?php if (isset($a10_accesskey)) echo ' accesskey="'.$a10_accesskey.'"' ?>  title="<?php echo encodeHtml($a10_title) ?>"><?php unset($a10_title,$a10_type,$a10_target,$a10_url,$a10_class,$a10_frame) ?><?php $a11_align='left';$a11_type='page'; ?><?php
	$a11_tmp_image_file = $image_dir.'icon_'.$a11_type.IMG_ICON_EXT;
	$a11_size = '16x16';
	$a11_tmp_title = basename($a11_tmp_image_file);
?><img alt="<?php echo $a11_tmp_title; if (isset($a11_size)) { echo ' ('; list($a11_tmp_width,$a11_tmp_height)=explode('x',$a11_size);echo $a11_tmp_width.'x'.$a11_tmp_height; echo')';} ?>" src="<?php echo $a11_tmp_image_file ?>" border="0"<?php if(isset($a11_align)) echo ' align="'.$a11_align.'"' ?><?php if (isset($a11_size)) { list($a11_tmp_width,$a11_tmp_height)=explode('x',$a11_size);echo ' width="'.$a11_tmp_width.'" height="'.$a11_tmp_height.'"';} ?> /><?php unset($a11_align,$a11_type) ?><?php $a11_class='text';$a11_var='name';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = isset($$a11_var)?$$a11_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_var,$a11_escape,$a11_cut) ?></a></td></tr><?php } ?><?php
	$column_idx = $last_column_idx;
?>
</table><?php $a6_empty='pages'; ?><?php 
	if	( !isset($$a6_empty) )
		$a6_tmp_exec = empty($a6_empty);
	elseif	( is_array($$a6_empty) )
		$a6_tmp_exec = (count($$a6_empty)==0);
	elseif	( is_bool($$a6_empty) )
		$a6_tmp_exec = true;
	else
		$a6_tmp_exec = empty( $$a6_empty );
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_empty) ?><?php $a7_class='text';$a7_text='GLOBAL_NOT_FOUND';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?><?php } ?></div></div></fieldset><?php $a3_title=lang('prop_userinfo'); ?><fieldset><?php if(isset($a3_title)) { ?><legend><?php if(isset($a3_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a3_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a3_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a3_title) ?><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='text';$a6_text='global_created';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_icon='el_date';$a6_align='left'; ?><?php
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
?><?php unset($a6_user) ?></div></div><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='text';$a6_text='global_lastchange';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_icon='el_date';$a6_align='left'; ?><?php
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
