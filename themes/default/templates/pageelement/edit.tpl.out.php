<!-- Compiling output/output-begin -->
		
		
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
<!-- Compiling input/input-begin --><?php $a3_class='text';$a3_default='';$a3_type='hidden';$a3_name='elementid';$a3_size='';$a3_maxlength='256';$a3_onchange='';$a3_readonly=false;$a3_hint='';$a3_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a3_readonly=true;
	  if ($a3_readonly && empty($$a3_name)) $$a3_name = '- '.lang('EMPTY').' -';
      if(!isset($a3_default)) $a3_default='';
      $tmp_value = Text::encodeHtml(isset($$a3_name)?$$a3_name:$a3_default);
?><?php if (!$a3_readonly || $a3_type=='hidden') {
?><div class="<?php echo $a3_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a3_readonly) echo ' disabled="true"' ?><?php if ($a3_hint) echo ' data-hint="'.$a3_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a3_name ?><?php if ($a3_readonly) echo '_disabled' ?>" name="<?php echo $a3_name ?><?php if ($a3_readonly) echo '_disabled' ?>" type="<?php echo $a3_type ?>" maxlength="<?php echo $a3_maxlength ?>" class="<?php echo str_replace(',',' ',$a3_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a3_icon) echo '<img src="'.$image_dir.'icon_'.$a3_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a3_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a3_name ?>" name="<?php echo $a3_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a3_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a3_class,$a3_default,$a3_type,$a3_name,$a3_size,$a3_maxlength,$a3_onchange,$a3_readonly,$a3_hint,$a3_icon) ?><!-- Compiling input/input-begin --><?php $a3_class='text';$a3_default='';$a3_type='hidden';$a3_name='value_time';$a3_size='';$a3_maxlength='256';$a3_onchange='';$a3_readonly=false;$a3_hint='';$a3_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a3_readonly=true;
	  if ($a3_readonly && empty($$a3_name)) $$a3_name = '- '.lang('EMPTY').' -';
      if(!isset($a3_default)) $a3_default='';
      $tmp_value = Text::encodeHtml(isset($$a3_name)?$$a3_name:$a3_default);
?><?php if (!$a3_readonly || $a3_type=='hidden') {
?><div class="<?php echo $a3_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a3_readonly) echo ' disabled="true"' ?><?php if ($a3_hint) echo ' data-hint="'.$a3_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a3_name ?><?php if ($a3_readonly) echo '_disabled' ?>" name="<?php echo $a3_name ?><?php if ($a3_readonly) echo '_disabled' ?>" type="<?php echo $a3_type ?>" maxlength="<?php echo $a3_maxlength ?>" class="<?php echo str_replace(',',' ',$a3_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a3_icon) echo '<img src="'.$image_dir.'icon_'.$a3_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a3_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a3_name ?>" name="<?php echo $a3_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a3_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a3_class,$a3_default,$a3_type,$a3_name,$a3_size,$a3_maxlength,$a3_onchange,$a3_readonly,$a3_hint,$a3_icon) ?>
			
				<span class="help"><?php echo nl2br(encodeHtml(htmlentities($desc))); ?></span>
				
				<?php $if4=($type=='date'); if($if4){?>
					<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('calendar') ?></legend><div>
						<div>
							<table class="calendar" width="85%">
								<tr>
									<td class="help" colspan="8">
										<a target="_self" data-url="<?php echo $lastmonthurl ?>" data-action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
											<img class="" title="" src="./themes/default/images/icon/left.png" />
											
										</a>

										<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
										
										<strong class="text"><?php echo nl2br(encodeHtml(htmlentities($monthname))); ?></strong>
										
										<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
										
										<a target="_self" data-url="<?php echo $nextmonthurl ?>" data-action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
											<img class="" title="" src="./themes/default/images/icon/right.png" />
											
										</a>

										<span class="text"><?php echo nl2br('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'); ?></span>
										
										<a target="_self" data-url="<?php echo $lastyearurl ?>" data-action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
											<img class="" title="" src="./themes/default/images/icon/left.png" />
											
										</a>

										<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
										
										<strong class="text"><?php echo nl2br(encodeHtml(htmlentities($yearname))); ?></strong>
										
										<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
										
										<a target="_self" data-url="<?php echo $nextyearurl ?>" data-action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
											<img class="" title="" src="./themes/default/images/icon/right.png" />
											
										</a>

									</td>
								</tr>
								<tr>
									<td>
										<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'week'.'')))); ?></span>
										
									</td><!-- Compiling list/list-begin --><?php $a9_list='weekdays';$a9_extract=false;$a9_key='list_key';$a9_value='weekday'; ?><?php
	$a9_list_tmp_key   = $a9_key;
	$a9_list_tmp_value = $a9_value;
	$a9_list_extract   = $a9_extract;
	unset($a9_key);
	unset($a9_value);
	if	( !isset($$a9_list) || !is_array($$a9_list) )
		$$a9_list = array();
	foreach( $$a9_list as $$a9_list_tmp_key => $$a9_list_tmp_value )
	{
		if	( $a9_list_extract )
		{
			if	( !is_array($$a9_list_tmp_value) )
			{
				print_r($$a9_list_tmp_value);
				die( 'not an array at key: '.$$a9_list_tmp_key );
			}
			extract($$a9_list_tmp_value);
		}
?><?php unset($a9_list,$a9_extract,$a9_key,$a9_value) ?>
										<td>
											<span class="text"><?php echo nl2br(encodeHtml(htmlentities($weekday))); ?></span>
											
										</td><!-- Compiling list/list-end --><?php } ?>
								</tr><!-- Compiling list/list-begin --><?php $a8_list='weeklist';$a8_extract=false;$a8_key='weeknr';$a8_value='week'; ?><?php
	$a8_list_tmp_key   = $a8_key;
	$a8_list_tmp_value = $a8_value;
	$a8_list_extract   = $a8_extract;
	unset($a8_key);
	unset($a8_value);
	if	( !isset($$a8_list) || !is_array($$a8_list) )
		$$a8_list = array();
	foreach( $$a8_list as $$a8_list_tmp_key => $$a8_list_tmp_value )
	{
		if	( $a8_list_extract )
		{
			if	( !is_array($$a8_list_tmp_value) )
			{
				print_r($$a8_list_tmp_value);
				die( 'not an array at key: '.$$a8_list_tmp_key );
			}
			extract($$a8_list_tmp_value);
		}
?><?php unset($a8_list,$a8_extract,$a8_key,$a8_value) ?>
									<tr>
										<td width="12%">
											<span class="text"><?php echo nl2br(encodeHtml(htmlentities($weeknr))); ?></span>
											
										</td><!-- Compiling list/list-begin --><?php $a10_list='week';$a10_extract=true;$a10_key='list_key';$a10_value='list_value'; ?><?php
	$a10_list_tmp_key   = $a10_key;
	$a10_list_tmp_value = $a10_value;
	$a10_list_extract   = $a10_extract;
	unset($a10_key);
	unset($a10_value);
	if	( !isset($$a10_list) || !is_array($$a10_list) )
		$$a10_list = array();
	foreach( $$a10_list as $$a10_list_tmp_key => $$a10_list_tmp_value )
	{
		if	( $a10_list_extract )
		{
			if	( !is_array($$a10_list_tmp_value) )
			{
				print_r($$a10_list_tmp_value);
				die( 'not an array at key: '.$$a10_list_tmp_key );
			}
			extract($$a10_list_tmp_value);
		}
?><?php unset($a10_list,$a10_extract,$a10_key,$a10_value) ?>
											<td width="12%">
												<?php $if12=(empty($url)); if($if12){?>
													<span class="text"><?php echo nl2br('&nbsp;&nbsp;'); ?></span>
													
													<strong class="text"><?php echo nl2br(encodeHtml(htmlentities($nr))); ?></strong>
													
													<span class="text"><?php echo nl2br('&nbsp;&nbsp;'); ?></span>
													
												<?php } ?>
												<?php $if12=!(empty($url)); if($if12){?>
													<a target="_self" data-url="<?php echo $url ?>" data-action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
														<span class="text"><?php echo nl2br('&nbsp;&nbsp;'); ?></span>
														
														<span class="text"><?php echo nl2br(encodeHtml(htmlentities($nr))); ?></span>
														
														<span class="text"><?php echo nl2br('&nbsp;&nbsp;'); ?></span>
														
													</a>

												<?php } ?>
												<?php $if12=($today); if($if12){?>
													<span class="text"><?php echo nl2br('*'); ?></span>
													
												<?php } ?>
											</td><!-- Compiling list/list-end --><?php } ?>
									</tr><!-- Compiling list/list-end --><?php } ?>
							</table>
						</div>
					</div></fieldset>
					<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('date') ?></legend><div>
						<div><!-- Compiling label/label-begin --><?php $a7_for='year'; ?><label<?php if (isset($a7_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" <?php if(hasLang(@$a7_key.'_desc')) { ?> title="<?php echo lang(@$a7_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); ?><?php if (isset($a7_text)) { echo $a7_text; } ?><?php } ?><?php unset($a7_for) ?>
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'date'.'')))); ?></span>
								<!-- Compiling label/label-end --></label><!-- Compiling selectbox/selectbox-begin --><?php $a7_list='all_years';$a7_name='year';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?>
							<span class="text"><?php echo nl2br('&nbsp;-&nbsp;'); ?></span>
							<!-- Compiling selectbox/selectbox-begin --><?php $a7_list='all_months';$a7_name='month';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?>
							<span class="text"><?php echo nl2br('&nbsp;-&nbsp;'); ?></span>
							<!-- Compiling selectbox/selectbox-begin --><?php $a7_list='all_days';$a7_name='day';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?>
						</div>
						<div><!-- Compiling label/label-begin --><?php $a7_for='hour'; ?><label<?php if (isset($a7_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" <?php if(hasLang(@$a7_key.'_desc')) { ?> title="<?php echo lang(@$a7_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); ?><?php if (isset($a7_text)) { echo $a7_text; } ?><?php } ?><?php unset($a7_for) ?>
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'date_time'.'')))); ?></span>
								<!-- Compiling label/label-end --></label><!-- Compiling selectbox/selectbox-begin --><?php $a7_list='all_hours';$a7_name='hour';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?>
							<span class="text"><?php echo nl2br('&nbsp;-&nbsp;'); ?></span>
							<!-- Compiling selectbox/selectbox-begin --><?php $a7_list='all_minutes';$a7_name='minute';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?>
							<span class="text"><?php echo nl2br('&nbsp;-&nbsp;'); ?></span>
							<!-- Compiling selectbox/selectbox-begin --><?php $a7_list='all_seconds';$a7_name='second';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?>
						</div>
					</div></fieldset>
				<?php } ?>
				<?php $if4=($type=='text'); if($if4){?>
					<tr>
						<td colspan="2"><!-- Compiling input/input-begin --><?php $a7_class='text';$a7_default='';$a7_type='text';$a7_name='text';$a7_size='50';$a7_maxlength='255';$a7_onchange='';$a7_readonly=false;$a7_hint='';$a7_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
	  if ($a7_readonly && empty($$a7_name)) $$a7_name = '- '.lang('EMPTY').' -';
      if(!isset($a7_default)) $a7_default='';
      $tmp_value = Text::encodeHtml(isset($$a7_name)?$$a7_name:$a7_default);
?><?php if (!$a7_readonly || $a7_type=='hidden') {
?><div class="<?php echo $a7_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a7_readonly) echo ' disabled="true"' ?><?php if ($a7_hint) echo ' data-hint="'.$a7_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" name="<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" type="<?php echo $a7_type ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo str_replace(',',' ',$a7_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a7_icon) echo '<img src="'.$image_dir.'icon_'.$a7_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a7_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?>" name="<?php echo $a7_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a7_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a7_class,$a7_default,$a7_type,$a7_name,$a7_size,$a7_maxlength,$a7_onchange,$a7_readonly,$a7_hint,$a7_icon) ?>
							
							
						</td>
					</tr>
				<?php } ?>
				<?php $if4=($type=='longtext'); if($if4){?>
					<?php $if5=(!empty($preview)); if($if5){?>
						<div class="preview">
							<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('page_preview') ?></legend><div>
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities($preview))); ?></span>
								
							</div></fieldset>
						</div>
					<?php } ?>
					<?php $if5=($editor=='html'); if($if5){?>
						<textarea name="text" class="editor__html-editor" id="pageelement_edit_editor"><?php echo ${'text'} ?></textarea>
						
					<?php } ?>
					<?php $if5=($editor=='wiki'); if($if5){?>
						<?php $if6=(!empty($languagetext)); if($if6){?>
							<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo $languagename ?></legend><div>
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities($languagetext))); ?></span>
								
							</div></fieldset><!-- Compiling newline/newline-begin --><br/><!-- Compiling newline/newline-begin --><br/>
						<?php } ?>
						<textarea name="text" class="editor__wiki-editor"><?php echo ${'text'} ?></textarea>
						
						<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('help') ?></legend><div>
							<table width="100%">
								<td>
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(@$conf['editor']['text-markup']['strong-begin']))); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'text_markup_strong'.'')))); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(@$conf['editor']['text-markup']['strong-end']))); ?></span>
									<!-- Compiling newline/newline-begin --><br/>
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(@$conf['editor']['text-markup']['emphatic-begin']))); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'text_markup_emphatic'.'')))); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(@$conf['editor']['text-markup']['emphatic-end']))); ?></span>
									
								</td>
								<td>
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(@$conf['editor']['text-markup']['list-numbered']))); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'text_markup_numbered_list'.'')))); ?></span>
									<!-- Compiling newline/newline-begin --><br/>
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(@$conf['editor']['text-markup']['list-numbered']))); ?></span>
									
									<span class="text"><?php echo nl2br('...'); ?></span>
									<!-- Compiling newline/newline-begin --><br/>
								</td>
								<td>
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(@$conf['editor']['text-markup']['list-unnumbered']))); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'text_markup_unnumbered_list'.'')))); ?></span>
									<!-- Compiling newline/newline-begin --><br/>
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(@$conf['editor']['text-markup']['list-unnumbered']))); ?></span>
									
									<span class="text"><?php echo nl2br('...'); ?></span>
									<!-- Compiling newline/newline-begin --><br/>
								</td>
								<td>
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(@$conf['editor']['text-markup']['table-cell-sep']))); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'text_markup_table'.'')))); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(@$conf['editor']['text-markup']['table-cell-sep']))); ?></span>
									
									<span class="text"><?php echo nl2br('...'); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(@$conf['editor']['text-markup']['table-cell-sep']))); ?></span>
									
									<span class="text"><?php echo nl2br('...'); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(@$conf['editor']['text-markup']['table-cell-sep']))); ?></span>
									<!-- Compiling newline/newline-begin --><br/>
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(@$conf['editor']['text-markup']['table-cell-sep']))); ?></span>
									
									<span class="text"><?php echo nl2br('...'); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(@$conf['editor']['text-markup']['table-cell-sep']))); ?></span>
									
									<span class="text"><?php echo nl2br('...'); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(@$conf['editor']['text-markup']['table-cell-sep']))); ?></span>
									
									<span class="text"><?php echo nl2br('...'); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(@$conf['editor']['text-markup']['table-cell-sep']))); ?></span>
									<!-- Compiling newline/newline-begin --><br/>
								</td>
							</table>
						</div></fieldset>
					<?php } ?>
					<?php $if5=($editor=='text'); if($if5){?><!-- Compiling inputarea/inputarea-begin --><?php $a6_name='text';$a6_rows='25';$a6_cols='70';$a6_class='longtext';$a6_default=''; ?><div class="inputholder"><textarea class="<?php echo $a6_class ?>" name="<?php echo $a6_name ?>" ><?php echo Text::encodeHtml(isset($$a6_name)?$$a6_name:$a6_default) ?></textarea></div><?php unset($a6_name,$a6_rows,$a6_cols,$a6_class,$a6_default) ?>
						
						
					<?php } ?>
				<?php } ?>
				<?php $if4=($type=='link'); if($if4){?>
					<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><div>
						<div class="line">
							<div class="label"><!-- Compiling label/label-begin --><?php $a8_for='linkobjectid'; ?><label<?php if (isset($a8_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a8_for ?><?php if (!empty($a8_value)) echo '_'.$a8_value ?>" <?php if(hasLang(@$a8_key.'_desc')) { ?> title="<?php echo lang(@$a8_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a8_key)) { echo lang($a8_key); ?><?php if (isset($a8_text)) { echo $a8_text; } ?><?php } ?><?php unset($a8_for) ?>
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'link_target'.'')))); ?></span>
									<!-- Compiling label/label-end --></label>
							</div>
							<div class="input">
								<div class="selector">
<div class="inputholder">
<input type="hidden" name="linkobjectid" value="{id}" />
<input type="text" disabled="disabled" value="{name}" />
</div>
<div class="tree selector" data-types="{types}" data-init-id="<?php echo $linkobjectid ?>" data-init-folderid="<?php echo $rootfolderid ?>">
								
							</div>
						</div>
						<div class="line">
							<div class="label"><!-- Compiling label/label-begin --><?php $a8_for='link_url'; ?><label<?php if (isset($a8_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a8_for ?><?php if (!empty($a8_value)) echo '_'.$a8_value ?>" <?php if(hasLang(@$a8_key.'_desc')) { ?> title="<?php echo lang(@$a8_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a8_key)) { echo lang($a8_key); ?><?php if (isset($a8_text)) { echo $a8_text; } ?><?php } ?><?php unset($a8_for) ?>
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'link_url'.'')))); ?></span>
									<!-- Compiling label/label-end --></label>
							</div>
							<div class="input"><!-- Compiling input/input-begin --><?php $a8_class='text';$a8_default='';$a8_type='text';$a8_name='linkurl';$a8_size='';$a8_maxlength='256';$a8_onchange='';$a8_readonly=false;$a8_hint='';$a8_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
	  if ($a8_readonly && empty($$a8_name)) $$a8_name = '- '.lang('EMPTY').' -';
      if(!isset($a8_default)) $a8_default='';
      $tmp_value = Text::encodeHtml(isset($$a8_name)?$$a8_name:$a8_default);
?><?php if (!$a8_readonly || $a8_type=='hidden') {
?><div class="<?php echo $a8_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a8_readonly) echo ' disabled="true"' ?><?php if ($a8_hint) echo ' data-hint="'.$a8_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" name="<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" type="<?php echo $a8_type ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo str_replace(',',' ',$a8_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a8_icon) echo '<img src="'.$image_dir.'icon_'.$a8_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a8_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a8_name ?>" name="<?php echo $a8_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a8_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a8_class,$a8_default,$a8_type,$a8_name,$a8_size,$a8_maxlength,$a8_onchange,$a8_readonly,$a8_hint,$a8_icon) ?>
							</div>
						</div>
					</div></fieldset>
				<?php } ?>
				<?php $if4=($type=='list'); if($if4){?>
					<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><div>
						<div><!-- Compiling selectbox/selectbox-begin --><?php $a7_list='objects';$a7_name='linkobjectid';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?>
							
							
						</div>
					</div></fieldset>
				<?php } ?>
				<?php $if4=($type=='insert'); if($if4){?>
					<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><div>
						<div><!-- Compiling selectbox/selectbox-begin --><?php $a7_list='objects';$a7_name='linkobjectid';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?>
							
							
						</div>
					</div></fieldset>
				<?php } ?>
				<?php $if4=($type=='number'); if($if4){?>
					<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><div>
						<div><!-- Compiling hidden/hidden-begin --><?php $a7_name='decimals';$a7_default='decimals'; ?><?php
if (isset($$a7_name))
	$a7_tmp_value = $$a7_name;
elseif ( isset($a7_default) )
	$a7_tmp_value = $a7_default;
else
	$a7_tmp_value = "";
?><input type="hidden" name="<?php echo $a7_name ?>" value="<?php echo $a7_tmp_value ?>" /><?php unset($a7_name,$a7_default) ?><!-- Compiling input/input-begin --><?php $a7_class='text';$a7_default='';$a7_type='text';$a7_name='number';$a7_size='15';$a7_maxlength='20';$a7_onchange='';$a7_readonly=false;$a7_hint='';$a7_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
	  if ($a7_readonly && empty($$a7_name)) $$a7_name = '- '.lang('EMPTY').' -';
      if(!isset($a7_default)) $a7_default='';
      $tmp_value = Text::encodeHtml(isset($$a7_name)?$$a7_name:$a7_default);
?><?php if (!$a7_readonly || $a7_type=='hidden') {
?><div class="<?php echo $a7_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a7_readonly) echo ' disabled="true"' ?><?php if ($a7_hint) echo ' data-hint="'.$a7_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" name="<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" type="<?php echo $a7_type ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo str_replace(',',' ',$a7_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a7_icon) echo '<img src="'.$image_dir.'icon_'.$a7_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a7_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?>" name="<?php echo $a7_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a7_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a7_class,$a7_default,$a7_type,$a7_name,$a7_size,$a7_maxlength,$a7_onchange,$a7_readonly,$a7_hint,$a7_icon) ?>
							
							
						</div>
					</div></fieldset>
				<?php } ?>
				<?php $if4=($type=='select'); if($if4){?>
					<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><div>
						<div><!-- Compiling selectbox/selectbox-begin --><?php $a7_list='items';$a7_name='text';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
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
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?>
							
							
						</div>
					</div></fieldset>
				<?php } ?>
				<?php $if4=($type=='longtext'); if($if4){?>
					<?php $if5=($editor=='wiki'); if($if5){?>
						<?php $if6=(!empty($languages)); if($if6){?>
							<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('editor_show_language') ?></legend><div>
								<div><!-- Compiling list/list-begin --><?php $a9_list='languages';$a9_extract=false;$a9_key='languageid';$a9_value='languagename'; ?><?php
	$a9_list_tmp_key   = $a9_key;
	$a9_list_tmp_value = $a9_value;
	$a9_list_extract   = $a9_extract;
	unset($a9_key);
	unset($a9_value);
	if	( !isset($$a9_list) || !is_array($$a9_list) )
		$$a9_list = array();
	foreach( $$a9_list as $$a9_list_tmp_key => $$a9_list_tmp_value )
	{
		if	( $a9_list_extract )
		{
			if	( !is_array($$a9_list_tmp_value) )
			{
				print_r($$a9_list_tmp_value);
				die( 'not an array at key: '.$$a9_list_tmp_key );
			}
			extract($$a9_list_tmp_value);
		}
?><?php unset($a9_list,$a9_extract,$a9_key,$a9_value) ?><!-- Compiling radio/radio-begin --><?php $a10_readonly=false;$a10_name='otherlanguageid';$a10_value=$languageid;$a10_default=false;$a10_prefix='';$a10_suffix='';$a10_class='';$a10_onchange=''; ?><?php
		if ($this->isEditable() && !$this->isEditMode()) $a10_readonly=true;
		if	( isset($$a10_name)  )
			$a10_tmp_default = $$a10_name;
		elseif ( isset($a10_default) )
			$a10_tmp_default = $a10_default;
		else
			$a10_tmp_default = '';
 ?><input onclick="" class="radio" type="radio" id="<?php echo REQUEST_ID ?>_<?php echo $a10_name.'_'.$a10_value ?>"  name="<?php echo $a10_prefix.$a10_name ?>"<?php if ( $a10_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $a10_value ?>"<?php if($a10_value==$a10_tmp_default||@$a10_checked) echo ' checked="checked"' ?> />
<?php /* #END-IF# */ ?><?php unset($a10_readonly,$a10_name,$a10_value,$a10_default,$a10_prefix,$a10_suffix,$a10_class,$a10_onchange) ?><!-- Compiling label/label-begin -->