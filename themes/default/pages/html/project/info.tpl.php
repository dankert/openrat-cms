<?php $a2_list='info';$a2_extract=false;$a2_key='list_key';$a2_value='list_value'; ?><?php
	$a2_list_tmp_key   = $a2_key;
	$a2_list_tmp_value = $a2_value;
	$a2_list_extract   = $a2_extract;
	unset($a2_key);
	unset($a2_value);
	if	( !isset($$a2_list) || !is_array($$a2_list) )
		$$a2_list = array();
	foreach( $$a2_list as $$a2_list_tmp_key => $$a2_list_tmp_value )
	{
		if	( $a2_list_extract )
		{
			if	( !is_array($$a2_list_tmp_value) )
			{
				print_r($$a2_list_tmp_value);
				die( 'not an array at key: '.$$a2_list_tmp_key );
			}
			extract($$a2_list_tmp_value);
		}
?><?php unset($a2_list,$a2_extract,$a2_key,$a2_value) ?><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><?php $a4_class='label'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_for=''; ?><label<?php if (isset($a5_for)) { ?> for="id_<?php echo $a5_for ?><?php if (!empty($a5_value)) echo '_'.$a5_value ?>" class="label"<?php } ?>>
<?php if (isset($a5_key)) { echo lang($a5_key); if(hasLang($a5_key.'_desc')) { ?><div class="description"><?php echo lang($a5_key.'_desc')?></div> <?php } } ?><?php unset($a5_for) ?><?php $a6_class='text';$a6_key=$list_key;$a6_prefix='project_info_';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_key = $a6_prefix.$a6_key;
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_prefix,$a6_escape,$a6_cut) ?></label></div><?php $a4_class='input'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_class='text';$a5_var='list_value';$a5_escape=true;$a5_type='strong';$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'strong';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = isset($$a5_var)?$$a5_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_var,$a5_escape,$a5_type,$a5_cut) ?></div></div><?php } ?>