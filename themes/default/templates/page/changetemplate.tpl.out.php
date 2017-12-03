<!-- Compiling output/output-begin -->
		<form name=""
      target="_self"
      action="<?php echo OR_ACTION ?>"
      data-method="changetemplateselectelements"
      data-action="<?php echo OR_ACTION ?>"
      data-id="<?php echo OR_ID ?>"
      method="changetemplateselectelements"
      enctype="application/x-www-form-urlencoded"
      class="<?php echo OR_ACTION ?>"
      data-async=""
      data-autosave=""
      onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" />
      
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="changetemplateselectelements" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
<?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?>

			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('page_template_old')))); ?></span>
					
				</div>
				<div class="input"><!-- Compiling link/link-begin --><?php $a5_title='';$a5_type='';$a5_target='cms_main';$a5_url=$template_url;$a5_class='';$a5_frame='_self';$a5_modal=false; ?><?php
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
						<img class="" title="" src="./themes/default/images/icon_template.png" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($template_name))); ?></span>
						<!-- Compiling link/link-end --></a>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('page_template_new')))); ?></span>
					
				</div>
				<div class="input"><!-- Compiling selectbox/selectbox-begin --><?php $a5_list='templates';$a5_name='newtemplateid';$a5_onchange='';$a5_title='';$a5_class='focus';$a5_addempty=false;$a5_multiple=false;$a5_size='1';$a5_lang=false; ?><?php
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
?><div class="inputholder"><select<?php if ($a5_readonly) echo ' disabled="disabled"' ?> id="<?php echo REQUEST_ID ?>_<?php echo $a5_name ?>"  name="<?php echo $a5_name; if ($a5_multiple) echo '[]'; ?>" onchange="<?php echo $a5_onchange ?>" title="<?php echo $a5_title ?>" class="<?php echo $a5_class ?>"<?php
if (count($$a5_list)<=1) echo ' disabled="disabled"';
if	($a5_multiple) echo ' multiple="multiple"';
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
?></select></div><?php
if (count($$a5_list)==0) echo '<input type="hidden" name="'.$a5_name.'" value="" />';
if (count($$a5_list)==1) echo '<input type="hidden" name="'.$a5_name.'" value="'.$box_key.'" />';
}
?><?php unset($a5_list,$a5_name,$a5_onchange,$a5_title,$a5_class,$a5_addempty,$a5_multiple,$a5_size,$a5_lang) ?>
				</div>
			</div>
		
<div class="bottom">
	<div class="command true">
	
		<input type="button" class="submit ok" value="<?php echo lang('BUTTON_NEXT') ?>" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. --><input type="button" class="submit cancel" value="<?php echo lang("CANCEL") ?>" onclick="$(div#dialog').hide(); $('div#filler').fadeOut(500); $(this).closest('div.panel').find('ul.views > li.active').click();" />	</div>
</div>

</form>
