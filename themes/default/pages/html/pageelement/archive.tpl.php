<?php $a3_name='';$a3_target='_self';$a3_method='post';$a3_enctype='application/x-www-form-urlencoded';$a3_type=''; ?><?php
		$a3_action = $actionName;
		$a3_subaction = $targetSubActionName;
		$a3_id = $this->getRequestId();
	if ($this->isEditable())
	{
		if	($this->isEditMode())
		{
			$a3_method    = 'POST';
		}
		else
		{
			$a3_method    = 'GET';
			$a3_subaction = $subActionName;
		}
	}
	switch( $a3_type )
	{
		case 'upload':
			$a3_tmp_submitFunction = '';
			break;
		default:
			$a3_tmp_submitFunction = 'formSubmit( $(this) ); return false;';
	}
?><form name="<?php echo $a3_name ?>"
      target="<?php echo $a3_target ?>"
      action="<?php echo Html::url( $a3_action,$a3_subaction,$a3_id ) ?>"
      method="<?php echo $a3_method ?>"
      enctype="<?php echo $a3_enctype ?>" style="margin:0px;padding:0px;"
      class="<?php echo $a3_action ?>"
      onSubmit="<?php echo $a3_tmp_submitFunction ?>"><input type="submit" class="invisible" />
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $this->actionName ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $this->subActionName ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $this->getRequestId() ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($a3_name,$a3_target,$a3_method,$a3_enctype,$a3_type) ?><?php $a4_width='93%';$a4_rowclasses='odd,even';$a4_columnclasses='1,2,3'; ?><?php if (false) { ?>
<div class="window">
<div class="title">
		<?php $icon=$actionName; ?>
		<img src="<?php echo $image_dir.'icon_'.$icon.IMG_ICON_EXT ?>" align="left" />
		<?php if ($this->isEditable()) { ?>
  <?php if ($this->isEditMode()) { 
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId()                       ) ?>" accesskey="1" title="<?php echo langHtml('MODE_EDIT_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>mode-edit.png" style="vertical-align:top; " border="0" /></a> <?php }
   elseif (readonly()) {
  ?><img src="<?php echo $image_dir ?>readonly.png" style="vertical-align:top; " border="0" /> <?php } else {
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId(),array('mode'=>'edit') ) ?>" accesskey="1" title="<?php echo langHtml('MODE_SHOW_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>readonly.png" style="vertical-align:top; " border="0" /></a> <?php }
  ?><?php } ?>
		<span class="path"><?php echo langHtml($actionName) ?></span>&nbsp;<strong>&rarr;</strong>&nbsp;
		<?php
		if	( !isset($path) || !is_array($path) )
			$path = array();
		foreach( $path as $pathElement)
		{
			extract($pathElement); ?>
			<a javascript:void(0);" onclick="javascript:loadViewByName('<?php echo $view ?>','<?php echo $url ?>'); return false; " title="<?php echo $title ?>" class="path"><?php echo (!empty($key)?langHtml($key):$name) ?></a>
			&nbsp;&rarr;&nbsp;
		<?php } ?>
		<span class="title"><?php echo langHtml(@$windowTitle) ?></span>
		<?php
		if	( isset($notice_status))
		{
			?><img src="<?php echo $image_dir.'notice_'.$notice_status.IMG_ICON_EXT ?>" align="right" /><?php
		}
		?>
		<?php ?>		
    <?php if (isset($windowIcons)) foreach( $windowIcons as $icon )
          {
          	?><a href="<?php echo $icon['url'] ?>" title="<?php echo 'ICON_'.langHtml($menu['type'].'_DESC') ?>"><image border="0" src="<?php echo $image_dir.$icon['type'].IMG_ICON_EXT ?>"></a>&nbsp;<?php
          }
     ?>
</div>
<ul class="menu">
<?php
	if	( !isset($windowMenu) || !is_array($windowMenu) ) $windowMenu = array();
    foreach( $windowMenu as $menu )
          {
          	$tmp_text = langHtml($menu['text']);
          	$tmp_key  = strtoupper(langHtml($menu['key' ]));
			$tmp_pos = strpos(strtolower($tmp_text),strtolower($tmp_key));
			if	( $tmp_pos !== false )
				$tmp_text = substr($tmp_text,0,max($tmp_pos,0)).'<span class="accesskey">'. substr($tmp_text,$tmp_pos,1).'</span>'.substr($tmp_text,$tmp_pos+1);
			$liClass  = (isset($menu['url'])?'':'no').'action'.($this->subActionName==$menu['subaction']?' active':'');
			$icon_url = $image_dir.'icon/'.$menu['subaction'].'.png';
			?><li class="<?php echo $liClass?>"><?php
          	if	( isset($menu['url']) )
          	{
          		$link_url = Html::url($actionName,$menu['subaction'],$this->getRequestId() );
          		?><a href="javascript:void(0);" onclick="javascript:loadSubaction(this,'<?php echo $actionName ?>','<?php echo $menu['subaction'] ?>','<?php echo $this->getRequestId() ?>'); return false; " accesskey="<?php echo $tmp_key ?>" title="<?php echo langHtml($menu['text'].'_DESC') ?>"><img src="<?php echo $icon_url ?>" /><?php echo $tmp_text ?></a><?php
          	}
          	else
          	{
          		?><span><img src="<?php echo $icon_url ?>" /><?php echo $tmp_text ?></span><?php
          	}
          }
          	?></li><?php
          if ( /* Deaktiviert */ false && @$conf['help']['enabled'] )
          	{
             ?><a class="help" href="<?php echo $conf['help']['url'].$actionName.'/'.$subActionName.@$conf['help']['suffix'] ?> " target="_new" title="<?php echo langHtml('MENU_HELP_DESC') ?>"><img src="<?php echo $image_dir.'icon/help.png' ?>" /><?php echo @$conf['help']['only_question_mark']?'?':langHtml('MENU_HELP') ?></a><?php
          	}
          	?><?php
		?>
</ul>
<?php 		global $image_dir; 
      if (isset($notices) && count($notices)>0 )
      { ?>
    	<dl class="notice">
  <?php foreach( $notices as $notice_idx=>$notice ) { ?>
  <?php if ($notice['name']!='') { ?>
    <dt><img src="<?php echo $image_dir.'icon_'.$notice['type'].IMG_ICON_EXT ?>" align="left" /><?php echo $notice['name'] ?></dt>
<?php } ?>
  <dd class="<?php echo $notice['status'] ?>">
    <td style="padding:10px;" width="30px"><img src="<?php echo $image_dir.'notice_'.$notice['status'].IMG_ICON_EXT ?>" style="padding:10px" /></td>
    <td style="padding:10px;padding-right:10px;padding-bottom:10px;"><?php if ($notice['status']=='error') { ?><strong><?php } ?><?php echo langHtml($notice['key'],$notice['vars']) ?><?php if ($notice['status']=='error') { ?></strong><?php } ?>
    <?php if (!empty($notice['log'])) { ?><pre><?php echo htmlentities(implode("\n",$notice['log'])) ?></pre><?php } ?>
    </td>
  </dd>
  <?php } ?>
    </dl>
<?php } ?>
<div class="content"><div class="filler">
<?php } ?><?php unset($a4_width,$a4_rowclasses,$a4_columnclasses) ?><fieldset><?php if(isset($a5_title)) { ?><legend><?php if(isset($a5_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a5_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a5_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php $a6_width='100%';$a6_space='0px';$a6_padding='0px';$a6_widths='5%,5%,5%,15%,15%,35%,10%,10%'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
		$column_widths = explode(',',$a6_widths);
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a6_width,$a6_space,$a6_padding,$a6_widths) ?><?php $a7_class='headline'; ?><?php
	$column_idx = 0;
?>
<tr
 class="headline"
>
<?php unset($a7_class) ?><?php $a8_class='help';$a8_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a8_class,$a8_header) ?><?php $a9_class='text';$a9_text='GLOBAL_NR';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?></td><?php $a8_class='help';$a8_colspan='2';$a8_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
 colspan="2"
><?php unset($a8_class,$a8_colspan,$a8_header) ?><?php $a9_present='compareid'; ?><?php 
	$a9_tmp_exec = isset($$a9_present);
	$a9_tmp_last_exec = $a9_tmp_exec;
	if	( $a9_tmp_exec )
	{
?>
<?php unset($a9_present) ?><?php $a10_class='text';$a10_text='GLOBAL_COMPARE';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $langF($a10_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_text,$a10_escape,$a10_cut) ?><?php } ?></td><?php $a8_class='help';$a8_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a8_class,$a8_header) ?><?php $a9_class='text';$a9_text='DATE';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?></td><?php $a8_class='help';$a8_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a8_class,$a8_header) ?><?php $a9_class='text';$a9_text='GLOBAL_USER';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?></td><?php $a8_class='help';$a8_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a8_class,$a8_header) ?><?php $a9_class='text';$a9_text='GLOBAL_VALUE';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?></td><?php $a8_class='help';$a8_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a8_class,$a8_header) ?><?php $a9_class='text';$a9_text='GLOBAL_STATE';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?></td><?php $a8_class='help';$a8_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a8_class,$a8_header) ?><?php $a9_class='text';$a9_text='GLOBAL_ACTION';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?></td></tr><?php $a7_empty='el'; ?><?php 
	if	( !isset($$a7_empty) )
		$a7_tmp_exec = empty($a7_empty);
	elseif	( is_array($$a7_empty) )
		$a7_tmp_exec = (count($$a7_empty)==0);
	elseif	( is_bool($$a7_empty) )
		$a7_tmp_exec = true;
	else
		$a7_tmp_exec = empty( $$a7_empty );
	$a7_tmp_last_exec = $a7_tmp_exec;
	if	( $a7_tmp_exec )
	{
?>
<?php unset($a7_empty) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a9_colspan='8';$a9_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="8"
><?php unset($a9_colspan,$a9_header) ?><?php $a10_class='text';$a10_text='GLOBAL_NOT_FOUND';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $langF($a10_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_text,$a10_escape,$a10_cut) ?></td></tr><?php } ?><?php $a7_list='el';$a7_extract=true;$a7_key='list_key';$a7_value='list_value'; ?><?php
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
?><?php unset($a7_list,$a7_extract,$a7_key,$a7_value) ?><?php $a8_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a8_class) ?><?php $a9_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a9_header) ?><?php $a10_class='text';$a10_var='lfd_nr';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = isset($$a10_var)?$$a10_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_var,$a10_escape,$a10_cut) ?></td><?php $a9_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a9_header) ?><?php $a10_present='compareid'; ?><?php 
	$a10_tmp_exec = isset($$a10_present);
	$a10_tmp_last_exec = $a10_tmp_exec;
	if	( $a10_tmp_exec )
	{
?>
<?php unset($a10_present) ?><?php $a11_readonly=false;$a11_name='compareid';$a11_value=$id;$a11_default=false;$a11_prefix='';$a11_suffix='';$a11_class='';$a11_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a11_readonly=true;
		if	( isset($$a11_name)  )
			$a11_tmp_default = $$a11_name;
		elseif ( isset($a11_default) )
			$a11_tmp_default = $a11_default;
		else
			$a11_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="id_<?php echo $a11_name.'_'.$a11_value ?>"  name="<?php echo $a11_prefix.$a11_name ?>"<?php if ( $a11_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a11_value ?>" <?php if($a11_value==$a11_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a11_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a11_readonly,$a11_name,$a11_value,$a11_default,$a11_prefix,$a11_suffix,$a11_class,$a11_onchange) ?><?php } ?></td><?php $a9_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a9_header) ?><?php $a10_present='compareid'; ?><?php 
	$a10_tmp_exec = isset($$a10_present);
	$a10_tmp_last_exec = $a10_tmp_exec;
	if	( $a10_tmp_exec )
	{
?>
<?php unset($a10_present) ?><?php $a11_readonly=false;$a11_name='withid';$a11_value=$id;$a11_default=false;$a11_prefix='';$a11_suffix='';$a11_class='';$a11_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a11_readonly=true;
		if	( isset($$a11_name)  )
			$a11_tmp_default = $$a11_name;
		elseif ( isset($a11_default) )
			$a11_tmp_default = $a11_default;
		else
			$a11_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="id_<?php echo $a11_name.'_'.$a11_value ?>"  name="<?php echo $a11_prefix.$a11_name ?>"<?php if ( $a11_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a11_value ?>" <?php if($a11_value==$a11_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a11_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a11_readonly,$a11_name,$a11_value,$a11_default,$a11_prefix,$a11_suffix,$a11_class,$a11_onchange) ?><?php } ?></td><?php $a9_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a9_header) ?><?php $a10_date=$date; ?><?php	
    global $conf;
	$time = $a10_date;
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
?><?php unset($a10_date) ?></td><?php $a9_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a9_header) ?><?php $a10_class='text';$a10_var='user';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = isset($$a10_var)?$$a10_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_var,$a10_escape,$a10_cut) ?></td><?php $a9_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a9_header) ?><?php $a10_class='text';$a10_var='value';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = isset($$a10_var)?$$a10_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_var,$a10_escape,$a10_cut) ?></td><?php $a9_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a9_header) ?><?php $a10_true=$public; ?><?php 
	if	(gettype($a10_true) === '' && gettype($a10_true) === '1')
		$a10_tmp_exec = $$a10_true == true;
	else
		$a10_tmp_exec = $a10_true == true;
	$a10_tmp_last_exec = $a10_tmp_exec;
	if	( $a10_tmp_exec )
	{
?>
<?php unset($a10_true) ?><?php $a11_class='text';$a11_key='GLOBAL_PUBLIC';$a11_escape=true;$a11_type='strong';$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'strong';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $langF($a11_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_key,$a11_escape,$a11_type,$a11_cut) ?><?php } ?><?php if (!$a10_tmp_last_exec) { ?>
<?php $a11_present='releaseUrl'; ?><?php 
	$a11_tmp_exec = isset($$a11_present);
	$a11_tmp_last_exec = $a11_tmp_exec;
	if	( $a11_tmp_exec )
	{
?>
<?php unset($a11_present) ?><?php $a12_title=lang('GLOBAL_RELEASE_DESC');$a12_type='';$a12_url=$releaseUrl;$a12_class='';$a12_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$a12_target = $view;
	switch( $a12_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a12_action)?$a12_action:$this->actionName,'subaction'=>!empty($a12_subaction)?$a12_subaction:$this->subActionName,'id'=>!empty($a12_id)?$a12_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a12_subaction)?$a12_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a12_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a12_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a12_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a12_frame ?>"<?php if (isset($a12_name)) { ?> name="<?php echo $a12_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a12_class ?>"<?php if (isset($a12_accesskey)) echo ' accesskey="'.$a12_accesskey.'"' ?>  title="<?php echo encodeHtml($a12_title) ?>"><?php unset($a12_title,$a12_type,$a12_url,$a12_class,$a12_frame) ?><?php $a13_class='text';$a13_key='GLOBAL_RELEASE';$a13_escape=true;$a13_type='strong';$a13_cut='both'; ?><?php
		$a13_title = '';
		$tmp_tag = 'strong';
?><<?php echo $tmp_tag ?> class="<?php echo $a13_class ?>" title="<?php echo $a13_title ?>"><?php
		$langF = $a13_escape?'langHtml':'lang';
		$tmp_text = $langF($a13_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a13_class,$a13_key,$a13_escape,$a13_type,$a13_cut) ?></a><?php } ?><?php if (!$a11_tmp_last_exec) { ?>
<?php $a12_class='text';$a12_key='GLOBAL_INACTIVE';$a12_escape=true;$a12_type='emphatic';$a12_cut='both'; ?><?php
		$a12_title = '';
		$tmp_tag = 'em';
?><<?php echo $tmp_tag ?> class="<?php echo $a12_class ?>" title="<?php echo $a12_title ?>"><?php
		$langF = $a12_escape?'langHtml':'lang';
		$tmp_text = $langF($a12_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a12_class,$a12_key,$a12_escape,$a12_type,$a12_cut) ?><?php }
unset($a10_tmp_last_exec) ?><?php }
unset($a9_tmp_last_exec) ?></td><?php $a9_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a9_header) ?><?php $a10_true=$active; ?><?php 
	if	(gettype($a10_true) === '' && gettype($a10_true) === '1')
		$a10_tmp_exec = $$a10_true == true;
	else
		$a10_tmp_exec = $a10_true == true;
	$a10_tmp_last_exec = $a10_tmp_exec;
	if	( $a10_tmp_exec )
	{
?>
<?php unset($a10_true) ?><?php $a11_class='text';$a11_key='GLOBAL_ACTIVE';$a11_escape=true;$a11_type='emphatic';$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'em';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $langF($a11_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_key,$a11_escape,$a11_type,$a11_cut) ?><?php } ?><?php if (!$a10_tmp_last_exec) { ?>
<?php $a11_present='useUrl'; ?><?php 
	$a11_tmp_exec = isset($$a11_present);
	$a11_tmp_last_exec = $a11_tmp_exec;
	if	( $a11_tmp_exec )
	{
?>
<?php unset($a11_present) ?><?php $a12_title=lang('GLOBAL_USE_DESC');$a12_type='';$a12_url=$useUrl;$a12_class='';$a12_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$a12_target = $view;
	switch( $a12_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a12_action)?$a12_action:$this->actionName,'subaction'=>!empty($a12_subaction)?$a12_subaction:$this->subActionName,'id'=>!empty($a12_id)?$a12_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a12_subaction)?$a12_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a12_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a12_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a12_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a12_frame ?>"<?php if (isset($a12_name)) { ?> name="<?php echo $a12_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a12_class ?>"<?php if (isset($a12_accesskey)) echo ' accesskey="'.$a12_accesskey.'"' ?>  title="<?php echo encodeHtml($a12_title) ?>"><?php unset($a12_title,$a12_type,$a12_url,$a12_class,$a12_frame) ?><?php $a13_class='text';$a13_key='GLOBAL_USE';$a13_escape=true;$a13_cut='both'; ?><?php
		$a13_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a13_class ?>" title="<?php echo $a13_title ?>"><?php
		$langF = $a13_escape?'langHtml':'lang';
		$tmp_text = $langF($a13_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a13_class,$a13_key,$a13_escape,$a13_cut) ?></a><?php } ?><?php }
unset($a9_tmp_last_exec) ?></td></tr><?php } ?><?php
	$column_idx = $last_column_idx;
?>
</table></fieldset><?php $a5_present='compareid'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a7_class='act';$a7_colspan='8';$a7_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="act"
 colspan="8"
><?php unset($a7_class,$a7_colspan,$a7_header) ?><?php $a8_type='ok';$a8_class='ok';$a8_value='ok';$a8_text='button_ok'; ?><div class="invisible">
<?php
		if ($this->isEditable() && !$this->isEditMode() && !readonly() )
		{
			$a8_type = ''; // Knopf nicht anzeigen
			?><a class="action" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span title="<?php echo lang('MODE_EDIT_DESC') ?>"><?php echo langHtml('MODE_EDIT') ?></span></a><?php
		} else
		{
			$a8_type = 'submit';
		}
		$a8_tmp_src  = '';
	if	( !empty($a8_type)) { 
?>
<input type="<?php echo $a8_type ?>"<?php if(isset($a8_src)) { ?> src="<?php $a8_tmp_src ?>"<?php } ?> name="<?php echo $a8_value ?>" class="ok" title="<?php echo lang($a8_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($a8_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($a8_src); ?>
<?php }
		if ($this->isEditable() && $this->isEditMode() )
		{
			?><a class="action" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'')) ?>"><span title="<?php echo lang('CANCEL_DESC') ?>"><?php echo langHtml('CANCEL') ?></span></a><?php
		}
?>
</div><?php unset($a8_type,$a8_class,$a8_value,$a8_text) ?></td></tr><?php } ?><?php if (false) { ?>
</div>
</div>
<div class="bottom">
	<div class="status">
	</div>
	<div class="command">
	<input type="button" value="<?php echo lang('OK') ?>" onclick="formSubmit( $(this),'<?php echo $view ?>');" />
	<input type="cancel" value="<?php echo lang('CANCEL') ?>" />
	</div>
</div>
</div>
<?php if ($showDuration)
      { ?>
<br/>
<center><small>&nbsp;
<?php $dur = time()-START_TIME;
      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small></center>
<?php } ?>
<?php } ?></form>
