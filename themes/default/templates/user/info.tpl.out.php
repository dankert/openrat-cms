<!-- Compiling output/output-begin --><!-- Compiling header/header-begin --><?php $a2_name='';$a2_back=false; ?><?php if(!empty($a2_views)) { ?>
  <div class="headermenu">
    <?php foreach( explode(',',$a2_views) as $a2_tmp_view ) { ?>
  	<div class="toolbar-icon clickable">
    <a href="javascript:void(0);" data-type="dialog" data-name="<?php echo lang('MENU_'.$a2_tmp_view) ?>" data-method="<?php echo $a2_tmp_view ?>">
		  <img src="<?php  echo $image_dir ?>icon/<?php echo $a2_tmp_view ?>.png" title="<?php echo lang('MENU_'.$a2_tmp_view.'_DESC') ?>" /> <?php echo lang('MENU_'.$a2_tmp_view) ?>
		</a>
  </div>
		<?php } ?>
  </div>
<?php } ?>
<?php unset($a2_name,$a2_back) ?>
		<?php $if2=!(empty('image')); if($if2){?><!-- Compiling part/part-begin --><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling part/part-begin --><?php $a4_class='line'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?>
					<img class="" title="" src="<?php echo $image ?>" />
					<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
		<?php } ?><!-- Compiling part/part-begin --><?php $a2_class='line'; ?><div class="<?php echo $a2_class ?>"><?php unset($a2_class) ?><!-- Compiling text/text-begin --><?php $a3_class='name';$a3_var='name';$a3_escape=true;$a3_cut='both'; ?><?php
		$a3_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = isset($$a3_var)?$$a3_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_class,$a3_var,$a3_escape,$a3_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a2_class='line'; ?><div class="<?php echo $a2_class ?>"><?php unset($a2_class) ?><!-- Compiling text/text-begin --><?php $a3_class='text';$a3_var='fullname';$a3_escape=true;$a3_cut='both'; ?><?php
		$a3_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = isset($$a3_var)?$$a3_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_class,$a3_var,$a3_escape,$a3_cut) ?><!-- Compiling part/part-end --></div>
		<?php $if2=(@$conf['security']['user']['show_admin_mail']); if($if2){?><!-- Compiling part/part-begin --><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling link/link-begin --><?php $a4_title='';$a4_type='';$a4_class='';$a4_action=$mail;$a4_frame='_self';$a4_modal=false; ?><?php
	$params = array();
		$a4_url='';
	$tmp_url = '';
	$a4_target = $view;
	$tmp_href = 'javascript:void(0);';		                          
	switch( $a4_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a4_action)?$a4_action:$this->actionName,'subaction'=>!empty($a4_subaction)?$a4_subaction:$this->subActionName,'id'=>!empty($a4_id)?$a4_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_data = str_replace("\n",'',str_replace('"','&quot;',$tmp_data));
			break;
		case 'html';
			$tmp_href = $a4_url;
		default:
			$tmp_data = '';
	}
?><a data-url="<?php echo $a4_url ?>" target="<?php echo $a4_frame ?>"<?php if (isset($a4_name)) { ?> data-name="<?php echo $a4_name ?>" name="<?php echo $a4_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a4_class ?>" data-id="<?php echo @$a4_id ?>" data-type="<?php echo $a4_type ?>" data-action="<?php echo @$a4_action ?>" data-method="<?php echo @$a4_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a4_accesskey)) echo ' accesskey="'.$a4_accesskey.'"' ?>  title="<?php echo encodeHtml($a4_title) ?>"><?php unset($a4_title,$a4_type,$a4_class,$a4_action,$a4_frame,$a4_modal) ?><!-- Compiling text/text-begin --><?php $a5_class='text';$a5_var='mail';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = isset($$a5_var)?$$a5_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_var,$a5_escape,$a5_cut) ?><!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div>
		<?php } ?><!-- Compiling part/part-begin --><?php $a2_class='line'; ?><div class="<?php echo $a2_class ?>"><?php unset($a2_class) ?><!-- Compiling text/text-begin --><?php $a3_class='text';$a3_var='desc';$a3_escape=true;$a3_cut='both'; ?><?php
		$a3_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = isset($$a3_var)?$$a3_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_class,$a3_var,$a3_escape,$a3_cut) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a2_class='line'; ?><div class="<?php echo $a2_class ?>"><?php unset($a2_class) ?><!-- Compiling text/text-begin --><?php $a3_class='text';$a3_text='user_tel';$a3_escape=true;$a3_cut='both'; ?><?php
		$a3_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = $langF($a3_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_class,$a3_text,$a3_escape,$a3_cut) ?><!-- Compiling text/text-begin --><?php $a3_class='text';$a3_var='tel';$a3_escape=true;$a3_cut='both'; ?><?php
		$a3_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = isset($$a3_var)?$$a3_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_class,$a3_var,$a3_escape,$a3_cut) ?><!-- Compiling part/part-end --></div>
		<?php $if2=('is_admin'); if($if2){?><!-- Compiling part/part-begin --><?php $a3_class='line'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling text/text-begin --><?php $a4_class='text';$a4_key='user_admin';$a4_escape=true;$a4_cut='both'; ?><?php
		$a4_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a4_class ?>" title="<?php echo $a4_title ?>"><?php
		$langF = $a4_escape?'langHtml':'lang';
		$tmp_text = $langF($a4_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a4_class,$a4_key,$a4_escape,$a4_cut) ?><!-- Compiling part/part-end --></div>
		<?php } ?>