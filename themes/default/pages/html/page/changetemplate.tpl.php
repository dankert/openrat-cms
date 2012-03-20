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
?><?php unset($a2_name,$a2_target,$a2_method,$a2_enctype,$a2_type) ?><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='text';$a5_text='page_template_old';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_text,$a5_escape,$a5_cut) ?></div><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_title='';$a5_type='';$a5_target='cms_main';$a5_url=$template_url;$a5_class='';$a5_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$params[REQ_PARAM_TARGET] = $a5_target;
	switch( $a5_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a5_action)?$a5_action:$this->actionName,'subaction'=>!empty($a5_subaction)?$a5_subaction:$this->subActionName,'id'=>!empty($a5_id)?$a5_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a5_subaction)?$a5_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a5_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a5_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a5_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a5_frame ?>"<?php if (isset($a5_name)) { ?> name="<?php echo $a5_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a5_class ?>"<?php if (isset($a5_accesskey)) echo ' accesskey="'.$a5_accesskey.'"' ?>  title="<?php echo encodeHtml($a5_title) ?>"><?php unset($a5_title,$a5_type,$a5_target,$a5_url,$a5_class,$a5_frame) ?><?php $a6_align='left';$a6_type='template'; ?><?php
	$a6_tmp_image_file = $image_dir.'icon_'.$a6_type.IMG_ICON_EXT;
	$a6_size = '16x16';
	$a6_tmp_title = basename($a6_tmp_image_file);
?><img alt="<?php echo $a6_tmp_title; if (isset($a6_size)) { echo ' ('; list($a6_tmp_width,$a6_tmp_height)=explode('x',$a6_size);echo $a6_tmp_width.'x'.$a6_tmp_height; echo')';} ?>" src="<?php echo $a6_tmp_image_file ?>" border="0"<?php if(isset($a6_align)) echo ' align="'.$a6_align.'"' ?><?php if (isset($a6_size)) { list($a6_tmp_width,$a6_tmp_height)=explode('x',$a6_size);echo ' width="'.$a6_tmp_width.'" height="'.$a6_tmp_height.'"';} ?> /><?php unset($a6_align,$a6_type) ?><?php $a6_class='text';$a6_var='template_name';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?></a></div></div><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='text';$a5_text='page_template_new';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_text,$a5_escape,$a5_cut) ?></div><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_list='templates';$a5_name='templateid';$a5_onchange='';$a5_title='';$a5_class='focus';$a5_addempty=false;$a5_multiple=false;$a5_size='1';$a5_lang=false; ?><?php
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
?><?php unset($a5_list,$a5_name,$a5_onchange,$a5_title,$a5_class,$a5_addempty,$a5_multiple,$a5_size,$a5_lang) ?></div></div></form>
