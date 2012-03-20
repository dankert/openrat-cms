<?php $a2_name='';$a2_back=false; ?><div class="header">
  <?php if ($a2_back) { ?>
  <a href="javascript:void(0);" onclick="javascript:refreshActualView(this);">
    <img src="<?php  echo $image_dir ?>icon/window/back.gif" />
    <?php echo lang('BACK') ?>
  </a>
  <?php } ?><?php if(!empty($a2_views)) { ?>
  <img src="<?php  echo $image_dir ?>icon/window/down.gif" />
  <div class="dropdown">
    <?php foreach( explode(',',$a2_views) as $a2_tmp_view ) { ?>
	<a class="entry" href="javascript:void(0);" onclick="javascript:startView(this,'<?php echo $a2_tmp_view ?>');"><?php echo lang('MENU_'.$a2_tmp_view) ?></a>
    <?php } ?>
  </div>
<?php } ?>
</div><?php unset($a2_name,$a2_back) ?><?php $a2_not=true;$a2_empty='image'; ?><?php 
	if	( !isset($$a2_empty) )
		$a2_tmp_exec = empty($a2_empty);
	elseif	( is_array($$a2_empty) )
		$a2_tmp_exec = (count($$a2_empty)==0);
	elseif	( is_bool($$a2_empty) )
		$a2_tmp_exec = true;
	else
		$a2_tmp_exec = empty( $$a2_empty );
	$a2_tmp_exec = !$a2_tmp_exec;
	$a2_tmp_last_exec = $a2_tmp_exec;
	if	( $a2_tmp_exec )
	{
?>
<?php unset($a2_not,$a2_empty) ?><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><?php $a5_url=$image;$a5_align='left';$a5_size='80x80'; ?><?php
	$a5_tmp_image_file = $a5_url;
	$a5_tmp_title = basename($a5_tmp_image_file);
?><img alt="<?php echo $a5_tmp_title; if (isset($a5_size)) { echo ' ('; list($a5_tmp_width,$a5_tmp_height)=explode('x',$a5_size);echo $a5_tmp_width.'x'.$a5_tmp_height; echo')';} ?>" src="<?php echo $a5_tmp_image_file ?>" border="0"<?php if(isset($a5_align)) echo ' align="'.$a5_align.'"' ?><?php if (isset($a5_size)) { list($a5_tmp_width,$a5_tmp_height)=explode('x',$a5_size);echo ' width="'.$a5_tmp_width.'" height="'.$a5_tmp_height.'"';} ?> /><?php unset($a5_url,$a5_align,$a5_size) ?></div></div><?php } ?><?php $a2_class='line'; ?><div class="<?php echo $a2_class ?>"><?php unset($a2_class) ?><?php $a3_class='name';$a3_var='name';$a3_escape=true;$a3_cut='both'; ?><?php
		$a3_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = isset($$a3_var)?$$a3_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_class,$a3_var,$a3_escape,$a3_cut) ?></div><?php $a2_class='line'; ?><div class="<?php echo $a2_class ?>"><?php unset($a2_class) ?><?php $a3_class='text';$a3_var='fullname';$a3_escape=true;$a3_cut='both'; ?><?php
		$a3_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = isset($$a3_var)?$$a3_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_class,$a3_var,$a3_escape,$a3_cut) ?></div><?php $a2_true=@$conf['security']['user']['show_admin_mail']; ?><?php 
	if	(gettype($a2_true) === '' && gettype($a2_true) === '1')
		$a2_tmp_exec = $$a2_true == true;
	else
		$a2_tmp_exec = $a2_true == true;
	$a2_tmp_last_exec = $a2_tmp_exec;
	if	( $a2_tmp_exec )
	{
?>
<?php unset($a2_true) ?><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><?php $a4_title='';$a4_type='';$a4_class='';$a4_action=$mail;$a4_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$a4_target = $view;
	switch( $a4_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a4_action)?$a4_action:$this->actionName,'subaction'=>!empty($a4_subaction)?$a4_subaction:$this->subActionName,'id'=>!empty($a4_id)?$a4_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_function_call = "submitLink(this,'".str_replace("\n",'',str_replace('"','&quot;',$tmp_data))."');";
			break;
		case 'view':
			$tmp_function_call = "startView(this,'".(!empty($a4_subaction)?$a4_subaction:$this->subActionName)."');";
			break;
		case 'url':
			$tmp_function_call = "submitUrl(this,'".($a4_url)."');";
			break;
		case 'external':
			$tmp_function_call = "location.href='".$a4_url."';";
			break;
		case 'popup':
			$tmp_function_call = "window.open('".$a4_url."', 'Popup', 'location=no,menubar=no,scrollbars=yes,toolbar=no,resizable=yes');";
			break;
		default:
			$tmp_function_call = "alert('TODO');";
	}
?><a target="<?php echo $a4_frame ?>"<?php if (isset($a4_name)) { ?> name="<?php echo $a4_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a4_class ?>"<?php if (isset($a4_accesskey)) echo ' accesskey="'.$a4_accesskey.'"' ?>  title="<?php echo encodeHtml($a4_title) ?>"><?php unset($a4_title,$a4_type,$a4_class,$a4_action,$a4_frame) ?><?php $a5_class='text';$a5_var='mail';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = isset($$a5_var)?$$a5_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_var,$a5_escape,$a5_cut) ?></a></div><?php } ?><?php $a2_class='line'; ?><div class="<?php echo $a2_class ?>"><?php unset($a2_class) ?><?php $a3_class='text';$a3_var='desc';$a3_escape=true;$a3_cut='both'; ?><?php
		$a3_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = isset($$a3_var)?$$a3_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_class,$a3_var,$a3_escape,$a3_cut) ?></div><?php $a2_class='line'; ?><div class="<?php echo $a2_class ?>"><?php unset($a2_class) ?><?php $a3_class='text';$a3_text='user_tel';$a3_escape=true;$a3_cut='both'; ?><?php
		$a3_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = $langF($a3_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_class,$a3_text,$a3_escape,$a3_cut) ?><?php $a3_class='text';$a3_var='tel';$a3_escape=true;$a3_cut='both'; ?><?php
		$a3_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = isset($$a3_var)?$$a3_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_class,$a3_var,$a3_escape,$a3_cut) ?></div><?php $a2_true='is_admin'; ?><?php 
	if	(gettype($a2_true) === '' && gettype($a2_true) === '1')
		$a2_tmp_exec = $$a2_true == true;
	else
		$a2_tmp_exec = $a2_true == true;
	$a2_tmp_last_exec = $a2_tmp_exec;
	if	( $a2_tmp_exec )
	{
?>
<?php unset($a2_true) ?><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><?php $a4_class='text';$a4_key='user_admin';$a4_escape=true;$a4_cut='both'; ?><?php
		$a4_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a4_class ?>" title="<?php echo $a4_title ?>"><?php
		$langF = $a4_escape?'langHtml':'lang';
		$tmp_text = $langF($a4_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a4_class,$a4_key,$a4_escape,$a4_cut) ?></div><?php } ?>