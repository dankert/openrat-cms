<?php $a2_name='';$a2_back=true; ?><div class="header">
  <?php if ($a2_back) { ?>
  <a href="javascript:void(0);" onclick="javascript:refreshActualView(this);" class="back button">
    <img src="<?php  echo $image_dir ?>icon/window/back.gif" />
    <?php echo lang('BACK') ?>
  </a>
  <?php } ?><?php if(!empty($a2_views)) { ?>
  <img src="<?php  echo $image_dir ?>icon/window/down.gif" />
  <div class="headermenu">
    <?php foreach( explode(',',$a2_views) as $a2_tmp_view ) { ?>
	<a class="entry" href="javascript:void(0);" onclick="javascript:startView(this,'<?php echo $a2_tmp_view ?>');">
	  <img src="<?php  echo $image_dir ?>icon/<?php echo $a2_tmp_view ?>.png" /><?php echo lang('MENU_'.$a2_tmp_view) ?>
	</a>
    <?php } ?>
  </div>
<?php } ?>
</div><?php unset($a2_name,$a2_back) ?><?php $a2_name='';$a2_target='_self';$a2_method='post';$a2_enctype='application/x-www-form-urlencoded';$a2_type=''; ?><?php
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
?><?php unset($a2_name,$a2_target,$a2_method,$a2_enctype,$a2_type) ?><?php $a3_title=lang('users'); ?><fieldset><?php if(isset($a3_title)) { ?><legend><?php if(isset($a3_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a3_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a3_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a3_title) ?><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_readonly=false;$a6_name='type';$a6_value='all';$a6_default=false;$a6_prefix='';$a6_suffix='';$a6_class='';$a6_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
		if	( isset($$a6_name)  )
			$a6_tmp_default = $$a6_name;
		elseif ( isset($a6_default) )
			$a6_tmp_default = $a6_default;
		else
			$a6_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="id_<?php echo $a6_name.'_'.$a6_value ?>"  name="<?php echo $a6_prefix.$a6_name ?>"<?php if ( $a6_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a6_value ?>" <?php if($a6_value==$a6_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a6_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a6_readonly,$a6_name,$a6_value,$a6_default,$a6_prefix,$a6_suffix,$a6_class,$a6_onchange) ?><?php $a6_for='type';$a6_value='all'; ?><label<?php if (isset($a6_for)) { ?> for="id_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); if(hasLang($a6_key.'_desc')) { ?><div class="description"><?php echo lang($a6_key.'_desc')?></div> <?php } } ?><?php unset($a6_for,$a6_value) ?><?php $a7_class='text';$a7_text='GLOBAL_ALL';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?></label></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?></div></div><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_readonly=false;$a6_name='type';$a6_value='user';$a6_default=false;$a6_prefix='';$a6_suffix='';$a6_class='';$a6_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a6_readonly=true;
		if	( isset($$a6_name)  )
			$a6_tmp_default = $$a6_name;
		elseif ( isset($a6_default) )
			$a6_tmp_default = $a6_default;
		else
			$a6_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="id_<?php echo $a6_name.'_'.$a6_value ?>"  name="<?php echo $a6_prefix.$a6_name ?>"<?php if ( $a6_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a6_value ?>" <?php if($a6_value==$a6_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a6_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a6_readonly,$a6_name,$a6_value,$a6_default,$a6_prefix,$a6_suffix,$a6_class,$a6_onchange) ?><?php $a6_for='type';$a6_value='user'; ?><label<?php if (isset($a6_for)) { ?> for="id_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); if(hasLang($a6_key.'_desc')) { ?><div class="description"><?php echo lang($a6_key.'_desc')?></div> <?php } } ?><?php unset($a6_for,$a6_value) ?><?php $a7_class='text';$a7_text='GLOBAL_USER';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?></label></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_list='users';$a6_name='userid';$a6_onchange='';$a6_title='';$a6_class='';$a6_addempty=true;$a6_multiple=false;$a6_size='1';$a6_lang=false; ?><?php
$a6_readonly=false;
$a6_tmp_list = $$a6_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a6_name)?'- '.lang('EMPTY').' -':$a6_tmp_list[$$a6_name];
}
else
{
if ( $a6_addempty!==FALSE  )
{
	if ($a6_addempty===TRUE)
		$a6_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a6_tmp_list;
	else
		$a6_tmp_list = array(''=>'- '.lang($a6_addempty).' -')+$a6_tmp_list;
}
?><select<?php if ($a6_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $a6_name ?>"  name="<?php echo $a6_name; if ($a6_multiple) echo '[]'; ?>" onchange="<?php echo $a6_onchange ?>" title="<?php echo $a6_title ?>" class="<?php echo $a6_class ?>"<?php
if (count($$a6_list)<=1) echo ' disabled="disabled"';
if	($a6_multiple) echo ' multiple="multiple"';
if (in_array($a6_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($a6_size).'"';
?>><?php
		if	( isset($$a6_name) && isset($a6_tmp_list[$$a6_name]) )
			$a6_tmp_default = $$a6_name;
		elseif ( isset($a6_default) )
			$a6_tmp_default = $a6_default;
		else
			$a6_tmp_default = '';
		foreach( $a6_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a6_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a6_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a6_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$a6_list)==0) echo '<input type="hidden" name="'.$a6_name.'" value="" />';
if (count($$a6_list)==1) echo '<input type="hidden" name="'.$a6_name.'" value="'.$box_key.'" />';
}
?><?php unset($a6_list,$a6_name,$a6_onchange,$a6_title,$a6_class,$a6_addempty,$a6_multiple,$a6_size,$a6_lang) ?></div></div><?php $a4_present='groups'; ?><?php 
	$a4_tmp_exec = isset($$a4_present);
	$a4_tmp_last_exec = $a4_tmp_exec;
	if	( $a4_tmp_exec )
	{
?>
<?php unset($a4_present) ?><?php $a5_class='line'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_class='label'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_readonly=false;$a7_name='type';$a7_value='group';$a7_default=false;$a7_prefix='';$a7_suffix='';$a7_class='';$a7_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
		if	( isset($$a7_name)  )
			$a7_tmp_default = $$a7_name;
		elseif ( isset($a7_default) )
			$a7_tmp_default = $a7_default;
		else
			$a7_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="id_<?php echo $a7_name.'_'.$a7_value ?>"  name="<?php echo $a7_prefix.$a7_name ?>"<?php if ( $a7_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a7_value ?>" <?php if($a7_value==$a7_tmp_default) echo 'checked="checked"' ?><?php if (in_array($a7_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />
<?php /* #END-IF# */ ?><?php unset($a7_readonly,$a7_name,$a7_value,$a7_default,$a7_prefix,$a7_suffix,$a7_class,$a7_onchange) ?><?php $a7_for='type';$a7_value='group'; ?><label<?php if (isset($a7_for)) { ?> for="id_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); if(hasLang($a7_key.'_desc')) { ?><div class="description"><?php echo lang($a7_key.'_desc')?></div> <?php } } ?><?php unset($a7_for,$a7_value) ?><?php $a8_class='text';$a8_text='GLOBAL_GROUP';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?></label></div><?php $a6_class='input'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><?php $a7_list='groups';$a7_name='groupid';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=true;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><select<?php if ($a7_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $a7_name ?>"  name="<?php echo $a7_name; if ($a7_multiple) echo '[]'; ?>" onchange="<?php echo $a7_onchange ?>" title="<?php echo $a7_title ?>" class="<?php echo $a7_class ?>"<?php
if (count($$a7_list)<=1) echo ' disabled="disabled"';
if	($a7_multiple) echo ' multiple="multiple"';
if (in_array($a7_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
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
?></select><?php
if (count($$a7_list)==0) echo '<input type="hidden" name="'.$a7_name.'" value="" />';
if (count($$a7_list)==1) echo '<input type="hidden" name="'.$a7_name.'" value="'.$box_key.'" />';
}
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?></div></div><?php } ?></fieldset><?php $a3_title=lang('language'); ?><fieldset><?php if(isset($a3_title)) { ?><legend><?php if(isset($a3_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a3_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a3_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a3_title) ?><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_for='languageid'; ?><label<?php if (isset($a6_for)) { ?> for="id_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); if(hasLang($a6_key.'_desc')) { ?><div class="description"><?php echo lang($a6_key.'_desc')?></div> <?php } } ?><?php unset($a6_for) ?><?php $a7_class='text';$a7_text='GLOBAL_LANGUAGE';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?></label></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_list='languages';$a6_name='languageid';$a6_onchange='';$a6_title='';$a6_class='';$a6_addempty=false;$a6_multiple=false;$a6_size='1';$a6_lang=false; ?><?php
$a6_readonly=false;
$a6_tmp_list = $$a6_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a6_name)?'- '.lang('EMPTY').' -':$a6_tmp_list[$$a6_name];
}
else
{
if ( $a6_addempty!==FALSE  )
{
	if ($a6_addempty===TRUE)
		$a6_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a6_tmp_list;
	else
		$a6_tmp_list = array(''=>'- '.lang($a6_addempty).' -')+$a6_tmp_list;
}
?><select<?php if ($a6_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $a6_name ?>"  name="<?php echo $a6_name; if ($a6_multiple) echo '[]'; ?>" onchange="<?php echo $a6_onchange ?>" title="<?php echo $a6_title ?>" class="<?php echo $a6_class ?>"<?php
if (count($$a6_list)<=1) echo ' disabled="disabled"';
if	($a6_multiple) echo ' multiple="multiple"';
if (in_array($a6_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($a6_size).'"';
?>><?php
		if	( isset($$a6_name) && isset($a6_tmp_list[$$a6_name]) )
			$a6_tmp_default = $$a6_name;
		elseif ( isset($a6_default) )
			$a6_tmp_default = $a6_default;
		else
			$a6_tmp_default = '';
		foreach( $a6_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a6_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a6_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a6_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$a6_list)==0) echo '<input type="hidden" name="'.$a6_name.'" value="" />';
if (count($$a6_list)==1) echo '<input type="hidden" name="'.$a6_name.'" value="'.$box_key.'" />';
}
?><?php unset($a6_list,$a6_name,$a6_onchange,$a6_title,$a6_class,$a6_addempty,$a6_multiple,$a6_size,$a6_lang) ?></div></div></fieldset><?php $a3_title=lang('acl'); ?><fieldset><?php if(isset($a3_title)) { ?><legend><?php if(isset($a3_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a3_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a3_title) ?>&nbsp;&nbsp;</legend><?php } ?><?php unset($a3_title) ?><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?></div><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><?php $a6_list='show';$a6_extract=false;$a6_key='k';$a6_value='t'; ?><?php
	$a6_list_tmp_key   = $a6_key;
	$a6_list_tmp_value = $a6_value;
	$a6_list_extract   = $a6_extract;
	unset($a6_key);
	unset($a6_value);
	if	( !isset($$a6_list) || !is_array($$a6_list) )
		$$a6_list = array();
	foreach( $$a6_list as $$a6_list_tmp_key => $$a6_list_tmp_value )
	{
		if	( $a6_list_extract )
		{
			if	( !is_array($$a6_list_tmp_value) )
			{
				print_r($$a6_list_tmp_value);
				die( 'not an array at key: '.$$a6_list_tmp_key );
			}
			extract($$a6_list_tmp_value);
		}
?><?php unset($a6_list,$a6_extract,$a6_key,$a6_value) ?><div><?php $a8_equals='read';$a8_value=$t; ?><?php 
	$a8_tmp_exec = $a8_equals == $a8_value;
	$a8_tmp_last_exec = $a8_tmp_exec;
	if	( $a8_tmp_exec )
	{
?>
<?php unset($a8_equals,$a8_value) ?><?php $a9_var=$t;$a9_value=true; ?><?php
	if (isset($a9_key))
		$$a9_var = $a9_value[$a9_key];
	else
		$$a9_var = $a9_value;
?><?php unset($a9_var,$a9_value) ?><?php $a9_default=false;$a9_readonly=true;$a9_name=$t; ?><?php
	if ($this->isEditable() && !$this->isEditMode()) $a9_readonly=true;
	if	( isset($$a9_name) )
		$checked = $$a9_name;
	else
		$checked = $a9_default;
?><input class="checkbox" type="checkbox" id="id_<?php echo $a9_name ?>" name="<?php echo $a9_name  ?>"  <?php if ($a9_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($a9_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $a9_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $a9_name ?>" value="1" /><?php
}
?><?php unset($a9_name); unset($a9_readonly); unset($a9_default); ?><?php unset($a9_default,$a9_readonly,$a9_name) ?><?php } ?><?php if (!$a8_tmp_last_exec) { ?>
<?php $a9_var=$t;$a9_value=false; ?><?php
	if (isset($a9_key))
		$$a9_var = $a9_value[$a9_key];
	else
		$$a9_var = $a9_value;
?><?php unset($a9_var,$a9_value) ?><?php $a9_default=false;$a9_readonly=false;$a9_name=$t; ?><?php
	if ($this->isEditable() && !$this->isEditMode()) $a9_readonly=true;
	if	( isset($$a9_name) )
		$checked = $$a9_name;
	else
		$checked = $a9_default;
?><input class="checkbox" type="checkbox" id="id_<?php echo $a9_name ?>" name="<?php echo $a9_name  ?>"  <?php if ($a9_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($a9_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
if ( $a9_readonly && $checked )
{ 
?><input type="hidden" name="<?php echo $a9_name ?>" value="1" /><?php
}
?><?php unset($a9_name); unset($a9_readonly); unset($a9_default); ?><?php unset($a9_default,$a9_readonly,$a9_name) ?><?php }
unset($a7_tmp_last_exec) ?><?php $a8_for=$t;$a8_value=''; ?><label<?php if (isset($a8_for)) { ?> for="id_<?php echo $a8_for ?><?php if (!empty($a8_value)) echo '_'.$a8_value ?>" class="label"<?php } ?>>
<?php if (isset($a8_key)) { echo lang($a8_key); if(hasLang($a8_key.'_desc')) { ?><div class="description"><?php echo lang($a8_key.'_desc')?></div> <?php } } ?><?php unset($a8_for,$a8_value) ?><?php $a9_class='text';$a9_key=$t;$a9_prefix='acl_';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_key = $a9_prefix.$a9_key;
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_key,$a9_prefix,$a9_escape,$a9_cut) ?></label></div><?php } ?></div></div></fieldset></form>
