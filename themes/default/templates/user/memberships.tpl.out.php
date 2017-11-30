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
      data-autosave="true"
      onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" />
      
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
<?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?>
<!-- Compiling table/table-begin --><?php $a3_width='100%';$a3_space='0px';$a3_padding='0px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a3_width,$a3_space,$a3_padding) ?><!-- Compiling row/row-begin --><?php $a4_class='headline'; ?><?php
	$column_idx = 0;
?>
<tr
 class="headline"
>
<?php unset($a4_class) ?>
					<td colspan="2"><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_key='group';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?>
					</td><!-- Compiling row/row-end --></tr><!-- Compiling list/list-begin --><?php $a4_list='memberships';$a4_extract=true;$a4_key='list_key';$a4_value='list_value'; ?><?php
	$a4_list_tmp_key   = $a4_key;
	$a4_list_tmp_value = $a4_value;
	$a4_list_extract   = $a4_extract;
	unset($a4_key);
	unset($a4_value);
	if	( !isset($$a4_list) || !is_array($$a4_list) )
		$$a4_list = array();
	foreach( $$a4_list as $$a4_list_tmp_key => $$a4_list_tmp_value )
	{
		if	( $a4_list_extract )
		{
			if	( !is_array($$a4_list_tmp_value) )
			{
				print_r($$a4_list_tmp_value);
				die( 'not an array at key: '.$$a4_list_tmp_key );
			}
			extract($$a4_list_tmp_value);
		}
?><?php unset($a4_list,$a4_extract,$a4_key,$a4_value) ?><!-- Compiling row/row-begin --><?php $a5_class='data'; ?><?php
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a5_class) ?>
						<td width="10%">
							<?php { $tmpname     = $var;$default  = '';$readonly = '';		
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
							
						</td>
						<td><!-- Compiling label/label-begin --><?php $a7_for=$var; ?><label<?php if (isset($a7_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" <?php if(hasLang(@$a7_key.'_desc')) { ?> title="<?php echo lang(@$a7_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); ?><?php if (isset($a7_text)) { echo $a7_text; } ?><?php } ?><?php unset($a7_for) ?>
								<img class="" title="" src="./themes/default/images/icon/icon_group.png" />
								<!-- Compiling text/text-begin --><?php $a8_class='text';$a8_var='name';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = isset($$a8_var)?$$a8_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_var,$a8_escape,$a8_cut) ?><!-- Compiling label/label-end --></label>
						</td><!-- Compiling row/row-end --></tr><!-- Compiling list/list-end --><?php } ?><!-- Compiling row/row-begin --><?php
	$column_idx = 0;
?>
<tr
>

					<td class="act" colspan="2">
								<div class="invisible"><input type="submit" 	name="ok" class="%class%"
	title="Bestätigen"
	value="&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;" />	
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
