<!-- Compiling output/output-begin --><!-- Compiling table/table-begin --><?php $a2_width='100%';$a2_space='0px';$a2_padding='0px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a2_width,$a2_space,$a2_padding) ?><!-- Compiling row/row-begin --><?php
	$column_idx = 0;
?>
<tr
>

				<td class="logo" colspan="2"><!-- Compiling logo/logo-begin --><?php $a5_name='projectmenu'; ?><div class="line logo">
	<div class="label">
		<img src="<?php echo $image_dir.'logo_'.$a5_name.IMG_ICON_EXT ?>"
			border="0" />
	</div>
	<div class="input">
		<h2>
			<?php echo langHtml('logo_'.$a5_name) ?>
		</h2>
		<p>
			<?php echo langHtml('logo_'.$a5_name.'_text') ?>
		</p>
	</div>
</div>
<?php unset($a5_name) ?>
				</td><!-- Compiling row/row-end --></tr><!-- Compiling row/row-begin --><?php $a3_class='headline'; ?><?php
	$column_idx = 0;
?>
<tr
 class="headline"
>
<?php unset($a3_class) ?>
				<td><!-- Compiling text/text-begin --><?php $a5_class='text';$a5_key='project';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?>
				</td><!-- Compiling row/row-end --></tr><!-- Compiling list/list-begin --><?php $a3_list='projects';$a3_extract=true;$a3_key='list_key';$a3_value='list_value'; ?><?php
	$a3_list_tmp_key   = $a3_key;
	$a3_list_tmp_value = $a3_value;
	$a3_list_extract   = $a3_extract;
	unset($a3_key);
	unset($a3_value);
	if	( !isset($$a3_list) || !is_array($$a3_list) )
		$$a3_list = array();
	foreach( $$a3_list as $$a3_list_tmp_key => $$a3_list_tmp_value )
	{
		if	( $a3_list_extract )
		{
			if	( !is_array($$a3_list_tmp_value) )
			{
				print_r($$a3_list_tmp_value);
				die( 'not an array at key: '.$$a3_list_tmp_key );
			}
			extract($$a3_list_tmp_value);
		}
?><?php unset($a3_list,$a3_extract,$a3_key,$a3_value) ?><!-- Compiling row/row-begin --><?php $a4_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?>
					<td class="clickable"><!-- Compiling link/link-begin --><?php $a6_title=lang('TREE_CHOOSE_PROJECT');$a6_type='post';$a6_class='';$a6_id=$id;$a6_frame='_self';$a6_modal=false; ?><?php
	$params = array();
		$a6_url='';
	$tmp_url = '';
	$a6_target = $view;
	$tmp_href = 'javascript:void(0);';		                          
	switch( $a6_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a6_action)?$a6_action:$this->actionName,'subaction'=>!empty($a6_subaction)?$a6_subaction:$this->subActionName,'id'=>!empty($a6_id)?$a6_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_data = str_replace("\n",'',str_replace('"','&quot;',$tmp_data));
			break;
		case 'html';
			$tmp_href = $a6_url;
		default:
			$tmp_data = '';
	}
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_id,$a6_frame,$a6_modal) ?>
							<?php $project= 'project'; ?>
							
							<img class="" title="" src="./themes/default/images/icon_project.png" />
							<!-- Compiling text/text-begin --><?php $a7_class='text';$a7_var='name';$a7_maxlength='30';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = isset($$a7_var)?$$a7_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a7_maxlength),'..',constant('STR_PAD_'.strtoupper($a7_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_var,$a7_maxlength,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end --></a><!-- Compiling part/part-begin --><?php $a6_class='onrowvisible'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><!-- Compiling part/part-begin --><?php $a7_class='arrow-down'; ?><div class="<?php echo $a7_class ?>"><?php unset($a7_class) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a7_class='dropdown'; ?><div class="<?php echo $a7_class ?>"><?php unset($a7_class) ?>
								<form name=""
      target="_self"
      action="index"
      data-method="project"
      data-action="index"
      data-id="var:id"
      method="project"
      enctype="application/x-www-form-urlencoded"
      class="index"
      data-async=""
      data-autosave=""
      onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" />
      
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="index" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="project" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="var:id" />
<?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?>
<!-- Compiling table/table-begin --><?php $a9_width='100%';$a9_space='0px';$a9_padding='0px';$a9_widths='150px,150px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
		$column_widths = explode(',',$a9_widths);
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a9_width,$a9_space,$a9_padding,$a9_widths) ?><!-- Compiling row/row-begin --><?php
	$column_idx = 0;
?>
<tr
>

											<td><!-- Compiling radiobox/radiobox-begin --><?php $a12_list='models';$a12_name='modelid';$a12_default=$defaultmodelid;$a12_onchange='';$a12_title='';$a12_class=''; ?><?php $a12_tmp_list = $$a12_list;
		if	( isset($$a12_name) && isset($a12_tmp_list[$$a12_name]) )
			$a12_tmp_default = $$a12_name;
		elseif ( isset($a12_default) )
			$a12_tmp_default = $a12_default;
		else
			$a12_tmp_default = '';
		foreach( $a12_tmp_list as $box_key=>$box_value )
		{
			$box_value = is_array($box_value)?(isset($box_value['lang'])?langHtml($box_value['lang']):$box_value['value']):$box_value;
			$id = REQUEST_ID.'_'.$a12_name.'_'.$box_key;
			echo '<input id="'.$id.'" name="'.$a12_name.'" type="radio" class="'.$a12_class.'" value="'.$box_key.'"';
			if ($box_key==$a12_tmp_default)
				echo ' checked="checked"';
			echo ' />&nbsp;<label for="'.$id.'">'.$box_value.'</label><br />';
		}
?><?php unset($a12_list,$a12_name,$a12_default,$a12_onchange,$a12_title,$a12_class) ?>
											</td>
											<td><!-- Compiling radiobox/radiobox-begin --><?php $a12_list='languages';$a12_name='languageid';$a12_default=$defaultlanguageid;$a12_onchange='';$a12_title='';$a12_class=''; ?><?php $a12_tmp_list = $$a12_list;
		if	( isset($$a12_name) && isset($a12_tmp_list[$$a12_name]) )
			$a12_tmp_default = $$a12_name;
		elseif ( isset($a12_default) )
			$a12_tmp_default = $a12_default;
		else
			$a12_tmp_default = '';
		foreach( $a12_tmp_list as $box_key=>$box_value )
		{
			$box_value = is_array($box_value)?(isset($box_value['lang'])?langHtml($box_value['lang']):$box_value['value']):$box_value;
			$id = REQUEST_ID.'_'.$a12_name.'_'.$box_key;
			echo '<input id="'.$id.'" name="'.$a12_name.'" type="radio" class="'.$a12_class.'" value="'.$box_key.'"';
			if ($box_key==$a12_tmp_default)
				echo ' checked="checked"';
			echo ' />&nbsp;<label for="'.$id.'">'.$box_value.'</label><br />';
		}
?><?php unset($a12_list,$a12_name,$a12_default,$a12_onchange,$a12_title,$a12_class) ?>
											</td>
											<td>
														<div class="invisible"><input type="submit" 	name="ok" class="%class%"
	title="?message:start_DESC?"
	value="&nbsp;&nbsp;&nbsp;&nbsp;?message:start?&nbsp;&nbsp;&nbsp;&nbsp;" />	
												</div>
											</td><!-- Compiling row/row-end --></tr><!-- Compiling table/table-end --><?php
	$column_idx = $last_column_idx;
?>
</table>
								
<div class="bottom">
	<div class="command ">
	
		<input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->	</div>
</div>

</form>
<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
					</td><!-- Compiling row/row-end --></tr><!-- Compiling list/list-end --><?php } ?><!-- Compiling table/table-end --><?php
	$column_idx = $last_column_idx;
?>
</table>