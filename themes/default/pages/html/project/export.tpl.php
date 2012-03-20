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
?><?php unset($a2_name,$a2_target,$a2_method,$a2_enctype,$a2_type) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a4_width='50%';$a4_header=false; ?><?php $column_idx++; ?><td
 width="50%"
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a4_width,$a4_header) ?><?php $a5_class='text';$a5_key='GLOBAL_DATABASE';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?></td><?php $a4_width='50%';$a4_header=false; ?><?php $column_idx++; ?><td
 width="50%"
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a4_width,$a4_header) ?><?php $a5_list='dbids';$a5_name='dbid';$a5_default='actdbid';$a5_onchange='';$a5_title='';$a5_class='';$a5_addempty=false;$a5_multiple=false;$a5_size='1';$a5_lang=false; ?><?php
$a5_readonly=false;
$a5_tmp_list = $$a5_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a5_name)?'- '.lang('EMPTY').' -':$a5_tmp_list[$$a5_name];
}
else
{
if ( $a5_addempty!==FALSE  )
{
	if ($a5_addempty===TRUE)
		$a5_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a5_tmp_list;
	else
		$a5_tmp_list = array(''=>'- '.lang($a5_addempty).' -')+$a5_tmp_list;
}
?><select<?php if ($a5_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $a5_name ?>"  name="<?php echo $a5_name; if ($a5_multiple) echo '[]'; ?>" onchange="<?php echo $a5_onchange ?>" title="<?php echo $a5_title ?>" class="<?php echo $a5_class ?>"<?php
if (count($$a5_list)<=1) echo ' disabled="disabled"';
if	($a5_multiple) echo ' multiple="multiple"';
if (in_array($a5_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($a5_size).'"';
?>><?php
		if	( isset($$a5_name) && isset($a5_tmp_list[$$a5_name]) )
			$a5_tmp_default = $$a5_name;
		elseif ( isset($a5_default) )
			$a5_tmp_default = $a5_default;
		else
			$a5_tmp_default = '';
		foreach( $a5_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a5_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a5_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a5_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$a5_list)==0) echo '<input type="hidden" name="'.$a5_name.'" value="" />';
if (count($$a5_list)==1) echo '<input type="hidden" name="'.$a5_name.'" value="'.$box_key.'" />';
}
?><?php unset($a5_list,$a5_name,$a5_default,$a5_onchange,$a5_title,$a5_class,$a5_addempty,$a5_multiple,$a5_size,$a5_lang) ?></td></tr><?php
	$column_idx = 0;
?>
<tr
>
<?php $a4_class='act';$a4_colspan='2';$a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="act"
 colspan="2"
><?php unset($a4_class,$a4_colspan,$a4_header) ?><?php $a5_type='submit';$a5_class='ok';$a5_value='ok';$a5_text='button_ok'; ?><div class="invisible">
<?php
		$a5_tmp_src  = '';
	if	( !empty($a5_type)) { 
?>
<input type="<?php echo $a5_type ?>"<?php if(isset($a5_src)) { ?> src="<?php $a5_tmp_src ?>"<?php } ?> name="<?php echo $a5_value ?>" class="ok" title="<?php echo lang($a5_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($a5_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($a5_src); ?>
<?php }
?>
</div><?php unset($a5_type,$a5_class,$a5_value,$a5_text) ?></td></tr></form>
