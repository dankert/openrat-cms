<!-- Compiling output/output-begin @ Wed, 29 Nov 2017 00:26:42 +0100 -->
		<?php $if2=(!empty($dbname)); if($if2){?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a3_class='toolbar-icon'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?>
				<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/database.svg" />
				<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='text';$a4_raw='_';$a4_escape=true;$a4_cut='both'; ?><?php
		$a4_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a4_class ?>" title="<?php echo $a4_title ?>"><?php
		$langF = $a4_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a4_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a4_class,$a4_raw,$a4_escape,$a4_cut) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='arrow-down'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='dropdown'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_class='entry'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_title=$dbid;$a6_class='text';$a6_var='dbname';$a6_maxlength='50';$a6_escape=true;$a6_cut='both'; ?><?php
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a6_maxlength),'..',constant('STR_PAD_'.strtoupper($a6_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_title,$a6_class,$a6_var,$a6_maxlength,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div>
		<?php } ?>
		<?php $if2=($this->userIsLoggedIn()); if($if2){?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a3_class='toolbar-icon menu'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?>
				<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/file.svg" />
				<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='text';$a4_key='file';$a4_escape=true;$a4_cut='both'; ?><?php
		$a4_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a4_class ?>" title="<?php echo $a4_title ?>"><?php
		$langF = $a4_escape?'langHtml':'lang';
		$tmp_text = $langF($a4_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a4_class,$a4_key,$a4_escape,$a4_cut) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='arrow-down'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='dropdown'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_class='entry clickable filtered on-action-folder on-action-page on-action-file'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_title=lang('menu_new_desc');$a6_type='dialog';$a6_class='';$a6_subaction='new';$a6_frame='_self';$a6_modal=false; ?><?php
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_subaction,$a6_frame,$a6_modal) ?>
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/add.svg" />
							<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a7_class='text';$a7_key='menu_new';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></a><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_class='divide'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_class='entry clickable'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_title=lang('menu_save_desc');$a6_type='post';$a6_class='';$a6_subaction='save';$a6_frame='_self';$a6_modal=false; ?><?php
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_subaction,$a6_frame,$a6_modal) ?>
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/save.svg" />
							<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a7_class='text';$a7_key='menu_save';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></a><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_class='entry clickable'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_title=lang('menu_saveall_desc');$a6_type='post';$a6_class='';$a6_subaction='saveall';$a6_frame='_self';$a6_modal=false; ?><?php
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_subaction,$a6_frame,$a6_modal) ?>
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/save.svg" />
							<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a7_class='text';$a7_key='menu_saveall';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></a><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_class='entry clickable filtered on-action-page on-action-file on-action-template on-action-pageelement'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_title=lang('menu_preview_desc');$a6_type='dialog';$a6_class='';$a6_subaction='preview';$a6_frame='_self';$a6_modal=false; ?><?php
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_subaction,$a6_frame,$a6_modal) ?>
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/preview.svg" />
							<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a7_class='text';$a7_key='menu_preview';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></a><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_class='divide'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_class='entry clickable'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_title=lang('USER_LOGOUT_DESC');$a6_type='post';$a6_class='entry';$a6_action='login';$a6_subaction='logout';$a6_frame='_self';$a6_modal=false; ?><?php
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_action,$a6_subaction,$a6_frame,$a6_modal) ?>
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/logout.svg" />
							<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a7_class='text';$a7_key='USER_LOGOUT';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></a><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div>
		<?php } ?>
		<?php $if2=($this->userIsLoggedIn()); if($if2){?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a3_class='toolbar-icon menu'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?>
				<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/edit.svg" />
				<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='text';$a4_key='edit';$a4_escape=true;$a4_cut='both'; ?><?php
		$a4_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a4_class ?>" title="<?php echo $a4_title ?>"><?php
		$langF = $a4_escape?'langHtml':'lang';
		$tmp_text = $langF($a4_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a4_class,$a4_key,$a4_escape,$a4_cut) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='arrow-down'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='dropdown'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_class='entry clickable filtered on-action-link on-action-folder on-action-page on-action-template on-action-element on-action-file'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_title=lang('menu_prop_desc');$a6_type='dialog';$a6_class='';$a6_subaction='prop';$a6_frame='_self';$a6_modal=false; ?><?php
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_subaction,$a6_frame,$a6_modal) ?>
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/prop.svg" />
							<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a7_class='text';$a7_key='menu_prop';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></a><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_class='entry clickable filtered on-action-page on-action-file on-action-folder on-action-pageelement on-action-template'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_title=lang('menu_pub_desc');$a6_type='dialog';$a6_class='';$a6_subaction='pub';$a6_frame='_self';$a6_modal=false; ?><?php
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_subaction,$a6_frame,$a6_modal) ?>
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/publish.svg" />
							<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a7_class='text';$a7_key='menu_pub';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></a><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_class='entry clickable filtered on-action-pageelement'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_title=lang('menu_archive_desc');$a6_type='dialog';$a6_class='entry';$a6_subaction='archive';$a6_frame='_self';$a6_modal=false; ?><?php
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_subaction,$a6_frame,$a6_modal) ?>
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/archive.svg" />
							<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a7_class='text';$a7_key='menu_archive';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></a><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_class='entry clickable filtered on-action-folder on-action-link on-action-user on-action-page on-action-file'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_title=lang('menu_rights_desc');$a6_type='dialog';$a6_class='';$a6_subaction='rights';$a6_frame='_self';$a6_modal=false; ?><?php
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_subaction,$a6_frame,$a6_modal) ?>
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/rights.svg" />
							<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a7_class='text';$a7_key='menu_rights';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></a><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_class='divide'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_class='entry clickable filtered on-action-page'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_title=lang('menu_changetemplate_desc');$a6_type='dialog';$a6_class='';$a6_subaction='changetemplate';$a6_frame='_self';$a6_modal=false; ?><?php
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_subaction,$a6_frame,$a6_modal) ?>
							<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/changetemplate.svg" />
							<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a7_class='text';$a7_key='menu_changetemplate';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></a><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div>
		<?php } ?>
		<?php $if2=($this->userIsLoggedIn()); if($if2){?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a3_class='toolbar-icon projects'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?>
				<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/project.svg" />
				<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='titletext';$a4_key='GLOBAL_PROJECT';$a4_escape=true;$a4_cut='both'; ?><?php
		$a4_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a4_class ?>" title="<?php echo $a4_title ?>"><?php
		$langF = $a4_escape?'langHtml':'lang';
		$tmp_text = $langF($a4_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a4_class,$a4_key,$a4_escape,$a4_cut) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='dropdown'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?>
					<?php $if5=($this->userIsAdmin()); if($if5){?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_class='entry clickable'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a7_title='';$a7_type='post';$a7_target='tree';$a7_class='entry';$a7_action='start';$a7_subaction='administration';$a7_id='-1';$a7_frame='_self';$a7_modal=false; ?><?php
	$params = array();
		$a7_url='';
	$tmp_url = '';
	$params[REQ_PARAM_TARGET] = $a7_target;
	$tmp_href = 'javascript:void(0);';		                          
	switch( $a7_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a7_action)?$a7_action:$this->actionName,'subaction'=>!empty($a7_subaction)?$a7_subaction:$this->subActionName,'id'=>!empty($a7_id)?$a7_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_data = str_replace("\n",'',str_replace('"','&quot;',$tmp_data));
			break;
		case 'html';
			$tmp_href = $a7_url;
		default:
			$tmp_data = '';
	}
?><a data-url="<?php echo $a7_url ?>" target="<?php echo $a7_frame ?>"<?php if (isset($a7_name)) { ?> data-name="<?php echo $a7_name ?>" name="<?php echo $a7_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a7_class ?>" data-id="<?php echo @$a7_id ?>" data-type="<?php echo $a7_type ?>" data-action="<?php echo @$a7_action ?>" data-method="<?php echo @$a7_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a7_accesskey)) echo ' accesskey="'.$a7_accesskey.'"' ?>  title="<?php echo encodeHtml($a7_title) ?>"><?php unset($a7_title,$a7_type,$a7_target,$a7_class,$a7_action,$a7_subaction,$a7_id,$a7_frame,$a7_modal) ?>
								<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/settings.svg" />
								<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a8_class='text';$a8_key='administration';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></a><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_class='divide'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div>
					<?php } ?>
					<?php $if5=(intval('00')<intval(@count($languages))); if($if5){?><!-- Compiling list/list-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_list='languages';$a6_extract=false;$a6_key='id';$a6_value='name'; ?><?php
	$a6_list_tmp_key   = $a6_key;
	$a6_list_tmp_value = $a6_value;
	$a6_list_extract   = $a6_extract;
	unset($a6_key);
	unset($a6_value);
	if	( !isset($$a6_list) || !is_array($$a6_list) )
		$$a6_list = array();
	foreach( $$a6_list as $$a6_list_tmp_key => $$a6_list_tmp_value )
	{
		if	( $a6_list_extract )
		{
			if	( !is_array($$a6_list_tmp_value) )
			{
				print_r($$a6_list_tmp_value);
				die( 'not an array at key: '.$$a6_list_tmp_key );
			}
			extract($$a6_list_tmp_value);
		}
?><?php unset($a6_list,$a6_extract,$a6_key,$a6_value) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a7_class='entry clickable'; ?><div class="<?php echo $a7_class ?>"><?php unset($a7_class) ?>
								<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/language.svg" />
								<!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a8_title=lang('select_language');$a8_type='post';$a8_class='';$a8_action='tree';$a8_subaction='language';$a8_id=$id;$a8_frame='_self';$a8_modal=false; ?><?php
	$params = array();
		$a8_url='';
	$tmp_url = '';
	$a8_target = $view;
	$tmp_href = 'javascript:void(0);';		                          
	switch( $a8_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a8_action)?$a8_action:$this->actionName,'subaction'=>!empty($a8_subaction)?$a8_subaction:$this->subActionName,'id'=>!empty($a8_id)?$a8_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_data = str_replace("\n",'',str_replace('"','&quot;',$tmp_data));
			break;
		case 'html';
			$tmp_href = $a8_url;
		default:
			$tmp_data = '';
	}
?><a data-url="<?php echo $a8_url ?>" target="<?php echo $a8_frame ?>"<?php if (isset($a8_name)) { ?> data-name="<?php echo $a8_name ?>" name="<?php echo $a8_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a8_class ?>" data-id="<?php echo @$a8_id ?>" data-type="<?php echo $a8_type ?>" data-action="<?php echo @$a8_action ?>" data-method="<?php echo @$a8_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a8_accesskey)) echo ' accesskey="'.$a8_accesskey.'"' ?>  title="<?php echo encodeHtml($a8_title) ?>"><?php unset($a8_title,$a8_type,$a8_class,$a8_action,$a8_subaction,$a8_id,$a8_frame,$a8_modal) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a9_class='text';$a9_var='name';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = isset($$a9_var)?$$a9_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_var,$a9_escape,$a9_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></a><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling list/list-end @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php } ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_class='divide'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div>
					<?php } ?>
					<?php $if5=(intval('0')<intval(@count($models))); if($if5){?><!-- Compiling list/list-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_list='models';$a6_extract=false;$a6_key='id';$a6_value='name'; ?><?php
	$a6_list_tmp_key   = $a6_key;
	$a6_list_tmp_value = $a6_value;
	$a6_list_extract   = $a6_extract;
	unset($a6_key);
	unset($a6_value);
	if	( !isset($$a6_list) || !is_array($$a6_list) )
		$$a6_list = array();
	foreach( $$a6_list as $$a6_list_tmp_key => $$a6_list_tmp_value )
	{
		if	( $a6_list_extract )
		{
			if	( !is_array($$a6_list_tmp_value) )
			{
				print_r($$a6_list_tmp_value);
				die( 'not an array at key: '.$$a6_list_tmp_key );
			}
			extract($$a6_list_tmp_value);
		}
?><?php unset($a6_list,$a6_extract,$a6_key,$a6_value) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a7_class='entry clickable'; ?><div class="<?php echo $a7_class ?>"><?php unset($a7_class) ?>
								<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/model.svg" />
								<!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a8_title=lang('select_model');$a8_type='post';$a8_class='';$a8_action='tree';$a8_subaction='model';$a8_id=$id;$a8_frame='_self';$a8_modal=false; ?><?php
	$params = array();
		$a8_url='';
	$tmp_url = '';
	$a8_target = $view;
	$tmp_href = 'javascript:void(0);';		                          
	switch( $a8_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a8_action)?$a8_action:$this->actionName,'subaction'=>!empty($a8_subaction)?$a8_subaction:$this->subActionName,'id'=>!empty($a8_id)?$a8_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_data = str_replace("\n",'',str_replace('"','&quot;',$tmp_data));
			break;
		case 'html';
			$tmp_href = $a8_url;
		default:
			$tmp_data = '';
	}
?><a data-url="<?php echo $a8_url ?>" target="<?php echo $a8_frame ?>"<?php if (isset($a8_name)) { ?> data-name="<?php echo $a8_name ?>" name="<?php echo $a8_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a8_class ?>" data-id="<?php echo @$a8_id ?>" data-type="<?php echo $a8_type ?>" data-action="<?php echo @$a8_action ?>" data-method="<?php echo @$a8_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a8_accesskey)) echo ' accesskey="'.$a8_accesskey.'"' ?>  title="<?php echo encodeHtml($a8_title) ?>"><?php unset($a8_title,$a8_type,$a8_class,$a8_action,$a8_subaction,$a8_id,$a8_frame,$a8_modal) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a9_class='text';$a9_var='name';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = isset($$a9_var)?$$a9_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_var,$a9_escape,$a9_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></a><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling list/list-end @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php } ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_class='divide'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div>
					<?php } ?><!-- Compiling list/list-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_list='projects';$a5_extract=false;$a5_key='id';$a5_value='name'; ?><?php
	$a5_list_tmp_key   = $a5_key;
	$a5_list_tmp_value = $a5_value;
	$a5_list_extract   = $a5_extract;
	unset($a5_key);
	unset($a5_value);
	if	( !isset($$a5_list) || !is_array($$a5_list) )
		$$a5_list = array();
	foreach( $$a5_list as $$a5_list_tmp_key => $$a5_list_tmp_value )
	{
		if	( $a5_list_extract )
		{
			if	( !is_array($$a5_list_tmp_value) )
			{
				print_r($$a5_list_tmp_value);
				die( 'not an array at key: '.$$a5_list_tmp_key );
			}
			extract($$a5_list_tmp_value);
		}
?><?php unset($a5_list,$a5_extract,$a5_key,$a5_value) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_class='entry clickable'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?>
							<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/project.svg" />
							<!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a7_title=lang('select_project');$a7_type='post';$a7_class='';$a7_action='start';$a7_subaction='projectmenu';$a7_id=$id;$a7_frame='_self';$a7_modal=false; ?><?php
	$params = array();
		$a7_url='';
	$tmp_url = '';
	$a7_target = $view;
	$tmp_href = 'javascript:void(0);';		                          
	switch( $a7_type )
	{
		case 'post':
			$json = new JSON();
			$tmp_data = $json->encode( array('action'=>!empty($a7_action)?$a7_action:$this->actionName,'subaction'=>!empty($a7_subaction)?$a7_subaction:$this->subActionName,'id'=>!empty($a7_id)?$a7_id:$this->getRequestId())
		                          +array(REQ_PARAM_TOKEN=>token())
		                          +$params );
			$tmp_data = str_replace("\n",'',str_replace('"','&quot;',$tmp_data));
			break;
		case 'html';
			$tmp_href = $a7_url;
		default:
			$tmp_data = '';
	}
?><a data-url="<?php echo $a7_url ?>" target="<?php echo $a7_frame ?>"<?php if (isset($a7_name)) { ?> data-name="<?php echo $a7_name ?>" name="<?php echo $a7_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a7_class ?>" data-id="<?php echo @$a7_id ?>" data-type="<?php echo $a7_type ?>" data-action="<?php echo @$a7_action ?>" data-method="<?php echo @$a7_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a7_accesskey)) echo ' accesskey="'.$a7_accesskey.'"' ?>  title="<?php echo encodeHtml($a7_title) ?>"><?php unset($a7_title,$a7_type,$a7_class,$a7_action,$a7_subaction,$a7_id,$a7_frame,$a7_modal) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a8_class='text';$a8_var='name';$a8_maxlength='45';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = isset($$a8_var)?$$a8_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a8_maxlength),'..',constant('STR_PAD_'.strtoupper($a8_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_var,$a8_maxlength,$a8_escape,$a8_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></a><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling list/list-end @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php } ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='arrow-down'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div>
		<?php } ?>
		<?php $if2=($this->userIsLoggedIn()); if($if2){?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a3_class='toolbar-icon clickable filtered on-action-folder on-action-file on-action-page on-action-link on-action-template on-action-element'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_title=lang('menu_prop_desc');$a4_type='dialog';$a4_class='';$a4_subaction='prop';$a4_frame='_self';$a4_modal=false; ?><?php
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
?><a data-url="<?php echo $a4_url ?>" target="<?php echo $a4_frame ?>"<?php if (isset($a4_name)) { ?> data-name="<?php echo $a4_name ?>" name="<?php echo $a4_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a4_class ?>" data-id="<?php echo @$a4_id ?>" data-type="<?php echo $a4_type ?>" data-action="<?php echo @$a4_action ?>" data-method="<?php echo @$a4_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a4_accesskey)) echo ' accesskey="'.$a4_accesskey.'"' ?>  title="<?php echo encodeHtml($a4_title) ?>"><?php unset($a4_title,$a4_type,$a4_class,$a4_subaction,$a4_frame,$a4_modal) ?>
					<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/prop.svg" />
					<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_class='text';$a5_key='menu_prop';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></a><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a3_class='toolbar-icon clickable filtered on-action-folder on-action-page on-action-file on-action-pageelement on-action-template'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_title=lang('menu_pub_desc');$a4_type='dialog';$a4_class='';$a4_subaction='pub';$a4_frame='_self';$a4_modal=false; ?><?php
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
?><a data-url="<?php echo $a4_url ?>" target="<?php echo $a4_frame ?>"<?php if (isset($a4_name)) { ?> data-name="<?php echo $a4_name ?>" name="<?php echo $a4_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a4_class ?>" data-id="<?php echo @$a4_id ?>" data-type="<?php echo $a4_type ?>" data-action="<?php echo @$a4_action ?>" data-method="<?php echo @$a4_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a4_accesskey)) echo ' accesskey="'.$a4_accesskey.'"' ?>  title="<?php echo encodeHtml($a4_title) ?>"><?php unset($a4_title,$a4_type,$a4_class,$a4_subaction,$a4_frame,$a4_modal) ?>
					<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/publish.svg" />
					<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_class='text';$a5_key='menu_pub';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></a><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div>
		<?php } ?>
		<?php $if2=(empty(@$conf['login']['motd'])); if($if2){?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a3_class='toolbar-icon'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?>
				<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/motd.svg" />
				<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='text';$a4_raw='_';$a4_escape=true;$a4_cut='both'; ?><?php
		$a4_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a4_class ?>" title="<?php echo $a4_title ?>"><?php
		$langF = $a4_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a4_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a4_class,$a4_raw,$a4_escape,$a4_cut) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='arrow-down'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='dropdown'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_class='entry'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_class='text';$a6_raw=@$conf['login']['motd'];$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_raw,$a6_escape,$a6_cut) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div>
		<?php } ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a2_class='search'; ?><div class="<?php echo $a2_class ?>"><?php unset($a2_class) ?><!-- Compiling input/input-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a3_class='text';$a3_default='';$a3_type='text';$a3_name='text';$a3_size='';$a3_maxlength='256';$a3_onchange='';$a3_readonly=false;$a3_hint=lang('search');$a3_icon='search'; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a3_readonly=true;
	  if ($a3_readonly && empty($$a3_name)) $$a3_name = '- '.lang('EMPTY').' -';
      if(!isset($a3_default)) $a3_default='';
      $tmp_value = Text::encodeHtml(isset($$a3_name)?$$a3_name:$a3_default);
?><?php if (!$a3_readonly || $a3_type=='hidden') {
?><div class="<?php echo $a3_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a3_readonly) echo ' disabled="true"' ?><?php if ($a3_hint) echo ' data-hint="'.$a3_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a3_name ?><?php if ($a3_readonly) echo '_disabled' ?>" name="<?php echo $a3_name ?><?php if ($a3_readonly) echo '_disabled' ?>" type="<?php echo $a3_type ?>" maxlength="<?php echo $a3_maxlength ?>" class="<?php echo str_replace(',',' ',$a3_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a3_icon) echo '<img src="'.$image_dir.'icon_'.$a3_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a3_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a3_name ?>" name="<?php echo $a3_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a3_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a3_class,$a3_default,$a3_type,$a3_name,$a3_size,$a3_maxlength,$a3_onchange,$a3_readonly,$a3_hint,$a3_icon) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a3_class='dropdown'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='text';$a4_raw='';$a4_escape=true;$a4_cut='both'; ?><?php
		$a4_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a4_class ?>" title="<?php echo $a4_title ?>"><?php
		$langF = $a4_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a4_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a4_class,$a4_raw,$a4_escape,$a4_cut) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a2_class='toolbar-icon user'; ?><div class="<?php echo $a2_class ?>"><?php unset($a2_class) ?>
			<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/user.svg" />
			<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a3_class='titletext';$a3_var='userfullname';$a3_maxlength='25';$a3_escape=true;$a3_cut='both'; ?><?php
		$a3_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a3_class ?>" title="<?php echo $a3_title ?>"><?php
		$langF = $a3_escape?'langHtml':'lang';
		$tmp_text = isset($$a3_var)?$$a3_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a3_maxlength),'..',constant('STR_PAD_'.strtoupper($a3_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a3_class,$a3_var,$a3_maxlength,$a3_escape,$a3_cut) ?>
			<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/arrow_down.svg" />
			<!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a3_class='dropdown'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='entry clickable'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_title=lang('USER_PROFILE_DESC');$a5_type='post';$a5_class='';$a5_action='start';$a5_subaction='profile';$a5_frame='_self';$a5_modal=false; ?><?php
	$params = array();
		$a5_url='';
	$tmp_url = '';
	$a5_target = $view;
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
?><a data-url="<?php echo $a5_url ?>" target="<?php echo $a5_frame ?>"<?php if (isset($a5_name)) { ?> data-name="<?php echo $a5_name ?>" name="<?php echo $a5_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a5_class ?>" data-id="<?php echo @$a5_id ?>" data-type="<?php echo $a5_type ?>" data-action="<?php echo @$a5_action ?>" data-method="<?php echo @$a5_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a5_accesskey)) echo ' accesskey="'.$a5_accesskey.'"' ?>  title="<?php echo encodeHtml($a5_title) ?>"><?php unset($a5_title,$a5_type,$a5_class,$a5_action,$a5_subaction,$a5_frame,$a5_modal) ?>
						<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/user.svg" />
						<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_class='text';$a6_key='profile';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></a><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='entry clickable'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_title=lang('start');$a5_type='post';$a5_class='';$a5_action='start';$a5_subaction='start';$a5_frame='_self';$a5_modal=false; ?><?php
	$params = array();
		$a5_url='';
	$tmp_url = '';
	$a5_target = $view;
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
?><a data-url="<?php echo $a5_url ?>" target="<?php echo $a5_frame ?>"<?php if (isset($a5_name)) { ?> data-name="<?php echo $a5_name ?>" name="<?php echo $a5_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a5_class ?>" data-id="<?php echo @$a5_id ?>" data-type="<?php echo $a5_type ?>" data-action="<?php echo @$a5_action ?>" data-method="<?php echo @$a5_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a5_accesskey)) echo ' accesskey="'.$a5_accesskey.'"' ?>  title="<?php echo encodeHtml($a5_title) ?>"><?php unset($a5_title,$a5_type,$a5_class,$a5_action,$a5_subaction,$a5_frame,$a5_modal) ?>
						<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/dashboard.svg" />
						<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_class='text';$a6_key='start';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></a><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='divide'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a4_class='entry clickable'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling link/link-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a5_title=lang('USER_LOGOUT_DESC');$a5_type='post';$a5_class='entry';$a5_action='login';$a5_subaction='logout';$a5_frame='_self';$a5_modal=false; ?><?php
	$params = array();
		$a5_url='';
	$tmp_url = '';
	$a5_target = $view;
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
?><a data-url="<?php echo $a5_url ?>" target="<?php echo $a5_frame ?>"<?php if (isset($a5_name)) { ?> data-name="<?php echo $a5_name ?>" name="<?php echo $a5_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a5_class ?>" data-id="<?php echo @$a5_id ?>" data-type="<?php echo $a5_type ?>" data-action="<?php echo @$a5_action ?>" data-method="<?php echo @$a5_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a5_accesskey)) echo ' accesskey="'.$a5_accesskey.'"' ?>  title="<?php echo encodeHtml($a5_title) ?>"><?php unset($a5_title,$a5_type,$a5_class,$a5_action,$a5_subaction,$a5_frame,$a5_modal) ?>
						<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/close.svg" />
						<!-- Compiling text/text-begin @ Wed, 29 Nov 2017 00:26:42 +0100 --><?php $a6_class='text';$a6_key='USER_LOGOUT';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?><!-- Compiling link/link-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></a><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:26:42 +0100 --></div>