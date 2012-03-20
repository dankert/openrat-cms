<?php $a3_name='';$a3_back=false; ?><div class="header">
  <?php if ($a3_back) { ?>
  <a href="javascript:void(0);" onclick="javascript:refreshActualView(this);" class="back button">
    <img src="<?php  echo $image_dir ?>icon/window/back.gif" />
    <?php echo lang('BACK') ?>
  </a>
  <?php } ?><?php if(!empty($a3_views)) { ?>
  <img src="<?php  echo $image_dir ?>icon/window/down.gif" />
  <div class="headermenu">
    <?php foreach( explode(',',$a3_views) as $a3_tmp_view ) { ?>
	<a class="entry" href="javascript:void(0);" onclick="javascript:startView(this,'<?php echo $a3_tmp_view ?>');">
	  <img src="<?php  echo $image_dir ?>icon/<?php echo $a3_tmp_view ?>.png" /><?php echo lang('MENU_'.$a3_tmp_view) ?>
	</a>
    <?php } ?>
  </div>
<?php } ?>
</div><?php unset($a3_name,$a3_back) ?><?php $a4_title='';$a4_type='external';$a4_target='_top';$a4_url=@$conf['login']['gpl']['url'];$a4_class='copyright';$a4_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$params[REQ_PARAM_TARGET] = $a4_target;
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
?><a target="<?php echo $a4_frame ?>"<?php if (isset($a4_name)) { ?> name="<?php echo $a4_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a4_class ?>"<?php if (isset($a4_accesskey)) echo ' accesskey="'.$a4_accesskey.'"' ?>  title="<?php echo encodeHtml($a4_title) ?>"><?php unset($a4_title,$a4_type,$a4_target,$a4_url,$a4_class,$a4_frame) ?><?php $a5_class='text';$a5_key='GPL';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?></a><fieldset><?php if(isset($a4_title)) { ?><legend><?php if(isset($a4_icon)) { ?><img src="<?php echo $image_dir.'icon_'.$a4_icon.IMG_ICON_EXT ?>" align="left" border="0" /><?php } ?>&nbsp;&nbsp;<?php echo encodeHtml($a4_title) ?>&nbsp;&nbsp;</legend><?php } ?></fieldset><?php $a4_list='software';$a4_extract=true;$a4_key='list_key';$a4_value='list_value'; ?><?php
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
?><?php unset($a4_list,$a4_extract,$a4_key,$a4_value) ?><?php $a5_title='';$a5_type='external';$a5_url=$url;$a5_class='';$a5_frame='_self'; ?><?php
	$params = array();
	$tmp_url = '';
	$a5_target = $view;
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
?><a target="<?php echo $a5_frame ?>"<?php if (isset($a5_name)) { ?> name="<?php echo $a5_name ?>"<?php }else{ ?> href="javascript:void(0);" onclick="<?php echo $tmp_function_call ?>" <?php } ?> class="<?php echo $a5_class ?>"<?php if (isset($a5_accesskey)) echo ' accesskey="'.$a5_accesskey.'"' ?>  title="<?php echo encodeHtml($a5_title) ?>"><?php unset($a5_title,$a5_type,$a5_url,$a5_class,$a5_frame) ?><?php $a6_class='text';$a6_var='name';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_escape,$a6_cut) ?></a><?php $a5_class='text';$a5_var='license';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = isset($$a5_var)?$$a5_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_var,$a5_escape,$a5_cut) ?><br/><br/><?php } ?>