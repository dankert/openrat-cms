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

			<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_text='global_name';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin --><?php $a6_class='name';$a6_var='name';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_text='global_filename';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin --><?php $a6_class='filename';$a6_var='filename';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_text='file_extension';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin --><?php $a6_class='extension';$a6_var='extension';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_text='global_description';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_var='description';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
			</div></fieldset>
			<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('additional_info') ?></legend><div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='full_filename'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for) ?><!-- Compiling text/text-begin --><?php $a7_class='text';$a7_text='global_full_filename';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_var='full_filename';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='size'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for) ?><!-- Compiling text/text-begin --><?php $a7_class='text';$a7_text='FILE_SIZE';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling part/part-end --></div><!-- Compiling text/text-begin --><?php $a5_class='text';$a5_var='size';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = isset($$a5_var)?$$a5_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_var,$a5_escape,$a5_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='mimetype'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for) ?><!-- Compiling text/text-begin --><?php $a7_class='text';$a7_text='FILE_mimetype';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_var='mimetype';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?><!-- Compiling newline/newline-begin --><br/><!-- Compiling link/link-begin --><?php $a6_title='';$a6_type='';$a6_class='action';$a6_action='file';$a6_subaction='size';$a6_frame='_self';$a6_modal=false; ?><?php
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_action,$a6_subaction,$a6_frame,$a6_modal) ?><!-- Compiling text/text-begin --><?php $a7_class='text';$a7_key='menu_file_size';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_text=lang('id');$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_var='objectid';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
				<?php $if4=(!empty('cache_filename')); if($if4){?><!-- Compiling part/part-begin --><?php $a5_class='line'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling part/part-begin --><?php $a6_class='label'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><!-- Compiling label/label-begin --><?php $a7_for='cache_filename'; ?><label<?php if (isset($a7_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" <?php if(hasLang(@$a7_key.'_desc')) { ?> title="<?php echo lang(@$a7_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); ?><?php if (isset($a7_text)) { echo $a7_text; } ?><?php } ?><?php unset($a7_for) ?><!-- Compiling text/text-begin --><?php $a8_class='text';$a8_text='CACHE_FILENAME';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_text,$a8_escape,$a8_cut) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a6_class='input'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><!-- Compiling text/text-begin --><?php $a7_class='text';$a7_var='cache_filename';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = isset($$a7_var)?$$a7_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_var,$a7_escape,$a7_cut) ?><!-- Compiling newline/newline-begin --><br/>
							<img class="" title="" src="./themes/default/images/icon/el_date.png" />
							
							<?php include_once( OR_THEMES_DIR.'default/include/html/date/component-date.php') ?><?php component_date($cache_filemtime) ?>
							<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
				<?php } ?><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling label/label-begin --><?php $a6_for='pages'; ?><label<?php if (isset($a6_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a6_for ?><?php if (!empty($a6_value)) echo '_'.$a6_value ?>" <?php if(hasLang(@$a6_key.'_desc')) { ?> title="<?php echo lang(@$a6_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a6_key)) { echo lang($a6_key); ?><?php if (isset($a6_text)) { echo $a6_text; } ?><?php } ?><?php unset($a6_for) ?><!-- Compiling text/text-begin --><?php $a7_class='text';$a7_text='FILE_PAGES';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?><!-- Compiling label/label-end --></label><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling table/table-begin --><?php $a6_width='100%';$a6_space='0px';$a6_padding='0px'; ?><?php
	$last_column_idx = @$column_idx;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a6_width,$a6_space,$a6_padding) ?><!-- Compiling list/list-begin --><?php $a7_list='pages';$a7_extract=true;$a7_key='list_key';$a7_value='list_value'; ?><?php
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
?><?php unset($a7_list,$a7_extract,$a7_key,$a7_value) ?><!-- Compiling row/row-begin --><?php
	$column_idx = 0;
?>
<tr
>

									<td><!-- Compiling link/link-begin --><?php $a10_title='';$a10_type='';$a10_target='cms_main';$a10_url=$url;$a10_class='';$a10_frame='_self';$a10_modal=false; ?><?php
	$params = array();
	$tmp_url = '';
	$params[REQ_PARAM_TARGET] = $a10_target;
	$tmp_href = 'javascript:void(0);';		                          
	switch( $a10_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a10_action)?$a10_action:$this->actionName,'subaction'=>!empty($a10_subaction)?$a10_subaction:$this->subActionName,'id'=>!empty($a10_id)?$a10_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_data = str_replace("\n",'',str_replace('"','&quot;',$tmp_data));
			break;
		case 'html';
			$tmp_href = $a10_url;
		default:
			$tmp_data = '';
	}
?><a data-url="<?php echo $a10_url ?>" target="<?php echo $a10_frame ?>"<?php if (isset($a10_name)) { ?> data-name="<?php echo $a10_name ?>" name="<?php echo $a10_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a10_class ?>" data-id="<?php echo @$a10_id ?>" data-type="<?php echo $a10_type ?>" data-action="<?php echo @$a10_action ?>" data-method="<?php echo @$a10_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a10_accesskey)) echo ' accesskey="'.$a10_accesskey.'"' ?>  title="<?php echo encodeHtml($a10_title) ?>"><?php unset($a10_title,$a10_type,$a10_target,$a10_url,$a10_class,$a10_frame,$a10_modal) ?>
											<img class="" title="" src="./themes/default/images/icon_page.png" />
											<!-- Compiling text/text-begin --><?php $a11_class='text';$a11_var='name';$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = isset($$a11_var)?$$a11_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_var,$a11_escape,$a11_cut) ?><!-- Compiling link/link-end --></a>
									</td><!-- Compiling row/row-end --></tr><!-- Compiling list/list-end --><?php } ?><!-- Compiling table/table-end --><?php
	$column_idx = $last_column_idx;
?>
</table>
						<?php $if6=(empty('pages')); if($if6){?><!-- Compiling text/text-begin --><?php $a7_class='text';$a7_text='GLOBAL_NOT_FOUND';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_text,$a7_escape,$a7_cut) ?>
						<?php } ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
			</div></fieldset>
			<fieldset class="<?php echo 1?" open":"" ?><?php echo 1?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('prop_userinfo') ?></legend><div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_text='global_created';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?>
						<img class="" title="" src="./themes/default/images/icon/el_date.png" />
						
						<?php include_once( OR_THEMES_DIR.'default/include/html/date/component-date.php') ?><?php component_date($create_date) ?>
						<!-- Compiling newline/newline-begin --><br/>
						<img class="" title="" src="./themes/default/images/icon/user.png" />
						
						<?php include_once( OR_THEMES_DIR.'default/include/html/user/component-user.php') ?><?php component_user($create_user) ?>
						<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='label'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin --><?php $a6_class='text';$a6_text='global_lastchange';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='input'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?>
						<img class="" title="" src="./themes/default/images/icon/el_date.png" />
						
						<?php include_once( OR_THEMES_DIR.'default/include/html/date/component-date.php') ?><?php component_date($lastchange_date) ?>
						<!-- Compiling newline/newline-begin --><br/>
						<img class="" title="" src="./themes/default/images/icon/user.png" />
						
						<?php include_once( OR_THEMES_DIR.'default/include/html/user/component-user.php') ?><?php component_user($lastchange_user) ?>
						<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
			</div></fieldset>
		
<div class="bottom">
	<div class="command ">
	
		<input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->	</div>
</div>

</form>
