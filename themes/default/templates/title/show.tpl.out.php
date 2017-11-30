<!-- Compiling output/output-begin -->
		<?php $if2=(!empty($dbname)); if($if2){?><!-- Compiling part/part-begin --><?php $a3_class='toolbar-icon'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?>
				<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/database.svg" />
				
				<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
				<!-- Compiling part/part-begin --><?php $a4_class='arrow-down'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='dropdown'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='entry'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?>
						<span class="text" title="<?php echo $dbid ?>"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $dbname,50,'..',constant('STR_PAD_BOTH') )))); ?></span>
						<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
		<?php } ?>
		<?php $if2=($this->userIsLoggedIn()); if($if2){?><!-- Compiling part/part-begin --><?php $a3_class='toolbar-icon menu'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?>
				<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/file.svg" />
				
				<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'file'.'')))); ?></span>
				<!-- Compiling part/part-begin --><?php $a4_class='arrow-down'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='dropdown'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='entry clickable filtered on-action-folder on-action-page on-action-file'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin --><?php $a6_title=lang('menu_new_desc');$a6_type='dialog';$a6_class='';$a6_subaction='new';$a6_frame='_self';$a6_modal=false; ?><?php
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
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_new'.'')))); ?></span>
							<!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='divide'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='entry clickable'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin --><?php $a6_title=lang('menu_save_desc');$a6_type='post';$a6_class='';$a6_subaction='save';$a6_frame='_self';$a6_modal=false; ?><?php
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
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_save'.'')))); ?></span>
							<!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='entry clickable'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin --><?php $a6_title=lang('menu_saveall_desc');$a6_type='post';$a6_class='';$a6_subaction='saveall';$a6_frame='_self';$a6_modal=false; ?><?php
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
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_saveall'.'')))); ?></span>
							<!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='entry clickable filtered on-action-page on-action-file on-action-template on-action-pageelement'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin --><?php $a6_title=lang('menu_preview_desc');$a6_type='dialog';$a6_class='';$a6_subaction='preview';$a6_frame='_self';$a6_modal=false; ?><?php
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
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_preview'.'')))); ?></span>
							<!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='divide'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='entry clickable'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin --><?php $a6_title=lang('USER_LOGOUT_DESC');$a6_type='post';$a6_class='entry';$a6_action='login';$a6_subaction='logout';$a6_frame='_self';$a6_modal=false; ?><?php
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
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_LOGOUT'.'')))); ?></span>
							<!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
		<?php } ?>
		<?php $if2=($this->userIsLoggedIn()); if($if2){?><!-- Compiling part/part-begin --><?php $a3_class='toolbar-icon menu'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?>
				<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/edit.svg" />
				
				<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'edit'.'')))); ?></span>
				<!-- Compiling part/part-begin --><?php $a4_class='arrow-down'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='dropdown'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='entry clickable filtered on-action-link on-action-folder on-action-page on-action-template on-action-element on-action-file'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin --><?php $a6_title=lang('menu_prop_desc');$a6_type='dialog';$a6_class='';$a6_subaction='prop';$a6_frame='_self';$a6_modal=false; ?><?php
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
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_prop'.'')))); ?></span>
							<!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='entry clickable filtered on-action-page on-action-file on-action-folder on-action-pageelement on-action-template'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin --><?php $a6_title=lang('menu_pub_desc');$a6_type='dialog';$a6_class='';$a6_subaction='pub';$a6_frame='_self';$a6_modal=false; ?><?php
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
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_pub'.'')))); ?></span>
							<!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='entry clickable filtered on-action-pageelement'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin --><?php $a6_title=lang('menu_archive_desc');$a6_type='dialog';$a6_class='entry';$a6_subaction='archive';$a6_frame='_self';$a6_modal=false; ?><?php
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
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_archive'.'')))); ?></span>
							<!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='entry clickable filtered on-action-folder on-action-link on-action-user on-action-page on-action-file'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin --><?php $a6_title=lang('menu_rights_desc');$a6_type='dialog';$a6_class='';$a6_subaction='rights';$a6_frame='_self';$a6_modal=false; ?><?php
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
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_rights'.'')))); ?></span>
							<!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='divide'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a5_class='entry clickable filtered on-action-page'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?><!-- Compiling link/link-begin --><?php $a6_title=lang('menu_changetemplate_desc');$a6_type='dialog';$a6_class='';$a6_subaction='changetemplate';$a6_frame='_self';$a6_modal=false; ?><?php
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
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_changetemplate'.'')))); ?></span>
							<!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
		<?php } ?>
		<?php $if2=($this->userIsLoggedIn()); if($if2){?><!-- Compiling part/part-begin --><?php $a3_class='toolbar-icon projects'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?>
				<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/project.svg" />
				
				<span class="titletext"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_PROJECT'.'')))); ?></span>
				<!-- Compiling part/part-begin --><?php $a4_class='dropdown'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?>
					<?php $if5=($this->userIsAdmin()); if($if5){?><!-- Compiling part/part-begin --><?php $a6_class='entry clickable'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><!-- Compiling link/link-begin --><?php $a7_title='';$a7_type='post';$a7_target='tree';$a7_class='entry';$a7_action='start';$a7_subaction='administration';$a7_id='-1';$a7_frame='_self';$a7_modal=false; ?><?php
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
								
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'administration'.'')))); ?></span>
								<!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a6_class='divide'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><!-- Compiling part/part-end --></div>
					<?php } ?>
					<?php $if5=(intval('00')<intval(@count($languages))); if($if5){?><!-- Compiling list/list-begin --><?php $a6_list='languages';$a6_extract=false;$a6_key='id';$a6_value='name'; ?><?php
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
?><?php unset($a6_list,$a6_extract,$a6_key,$a6_value) ?><!-- Compiling part/part-begin --><?php $a7_class='entry clickable'; ?><div class="<?php echo $a7_class ?>"><?php unset($a7_class) ?>
								<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/language.svg" />
								<!-- Compiling link/link-begin --><?php $a8_title=lang('select_language');$a8_type='post';$a8_class='';$a8_action='tree';$a8_subaction='language';$a8_id=$id;$a8_frame='_self';$a8_modal=false; ?><?php
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
?><a data-url="<?php echo $a8_url ?>" target="<?php echo $a8_frame ?>"<?php if (isset($a8_name)) { ?> data-name="<?php echo $a8_name ?>" name="<?php echo $a8_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a8_class ?>" data-id="<?php echo @$a8_id ?>" data-type="<?php echo $a8_type ?>" data-action="<?php echo @$a8_action ?>" data-method="<?php echo @$a8_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a8_accesskey)) echo ' accesskey="'.$a8_accesskey.'"' ?>  title="<?php echo encodeHtml($a8_title) ?>"><?php unset($a8_title,$a8_type,$a8_class,$a8_action,$a8_subaction,$a8_id,$a8_frame,$a8_modal) ?>
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
									<!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div><!-- Compiling list/list-end --><?php } ?><!-- Compiling part/part-begin --><?php $a6_class='divide'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><!-- Compiling part/part-end --></div>
					<?php } ?>
					<?php $if5=(intval('0')<intval(@count($models))); if($if5){?><!-- Compiling list/list-begin --><?php $a6_list='models';$a6_extract=false;$a6_key='id';$a6_value='name'; ?><?php
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
?><?php unset($a6_list,$a6_extract,$a6_key,$a6_value) ?><!-- Compiling part/part-begin --><?php $a7_class='entry clickable'; ?><div class="<?php echo $a7_class ?>"><?php unset($a7_class) ?>
								<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/model.svg" />
								<!-- Compiling link/link-begin --><?php $a8_title=lang('select_model');$a8_type='post';$a8_class='';$a8_action='tree';$a8_subaction='model';$a8_id=$id;$a8_frame='_self';$a8_modal=false; ?><?php
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
?><a data-url="<?php echo $a8_url ?>" target="<?php echo $a8_frame ?>"<?php if (isset($a8_name)) { ?> data-name="<?php echo $a8_name ?>" name="<?php echo $a8_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a8_class ?>" data-id="<?php echo @$a8_id ?>" data-type="<?php echo $a8_type ?>" data-action="<?php echo @$a8_action ?>" data-method="<?php echo @$a8_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a8_accesskey)) echo ' accesskey="'.$a8_accesskey.'"' ?>  title="<?php echo encodeHtml($a8_title) ?>"><?php unset($a8_title,$a8_type,$a8_class,$a8_action,$a8_subaction,$a8_id,$a8_frame,$a8_modal) ?>
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
									<!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div><!-- Compiling list/list-end --><?php } ?><!-- Compiling part/part-begin --><?php $a6_class='divide'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?><!-- Compiling part/part-end --></div>
					<?php } ?><!-- Compiling list/list-begin --><?php $a5_list='projects';$a5_extract=false;$a5_key='id';$a5_value='name'; ?><?php
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
?><?php unset($a5_list,$a5_extract,$a5_key,$a5_value) ?><!-- Compiling part/part-begin --><?php $a6_class='entry clickable'; ?><div class="<?php echo $a6_class ?>"><?php unset($a6_class) ?>
							<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/project.svg" />
							<!-- Compiling link/link-begin --><?php $a7_title=lang('select_project');$a7_type='post';$a7_class='';$a7_action='start';$a7_subaction='projectmenu';$a7_id=$id;$a7_frame='_self';$a7_modal=false; ?><?php
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
?><a data-url="<?php echo $a7_url ?>" target="<?php echo $a7_frame ?>"<?php if (isset($a7_name)) { ?> data-name="<?php echo $a7_name ?>" name="<?php echo $a7_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a7_class ?>" data-id="<?php echo @$a7_id ?>" data-type="<?php echo $a7_type ?>" data-action="<?php echo @$a7_action ?>" data-method="<?php echo @$a7_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a7_accesskey)) echo ' accesskey="'.$a7_accesskey.'"' ?>  title="<?php echo encodeHtml($a7_title) ?>"><?php unset($a7_title,$a7_type,$a7_class,$a7_action,$a7_subaction,$a7_id,$a7_frame,$a7_modal) ?>
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $name,45,'..',constant('STR_PAD_BOTH') )))); ?></span>
								<!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div><!-- Compiling list/list-end --><?php } ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='arrow-down'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
		<?php } ?>
		<?php $if2=($this->userIsLoggedIn()); if($if2){?><!-- Compiling part/part-begin --><?php $a3_class='toolbar-icon clickable filtered on-action-folder on-action-file on-action-page on-action-link on-action-template on-action-element'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling link/link-begin --><?php $a4_title=lang('menu_prop_desc');$a4_type='dialog';$a4_class='';$a4_subaction='prop';$a4_frame='_self';$a4_modal=false; ?><?php
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
					
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_prop'.'')))); ?></span>
					<!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a3_class='toolbar-icon clickable filtered on-action-folder on-action-page on-action-file on-action-pageelement on-action-template'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling link/link-begin --><?php $a4_title=lang('menu_pub_desc');$a4_type='dialog';$a4_class='';$a4_subaction='pub';$a4_frame='_self';$a4_modal=false; ?><?php
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
					
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_pub'.'')))); ?></span>
					<!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div>
		<?php } ?>
		<?php $if2=(empty(@$conf['login']['motd'])); if($if2){?><!-- Compiling part/part-begin --><?php $a3_class='toolbar-icon'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?>
				<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/motd.svg" />
				
				<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
				<!-- Compiling part/part-begin --><?php $a4_class='arrow-down'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='dropdown'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-begin --><?php $a5_class='entry'; ?><div class="<?php echo $a5_class ?>"><?php unset($a5_class) ?>
						<span class="text"><?php echo nl2br('config:login/motd'); ?></span>
						<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>
		<?php } ?><!-- Compiling part/part-begin --><?php $a2_class='search'; ?><div class="<?php echo $a2_class ?>"><?php unset($a2_class) ?><!-- Compiling input/input-begin --><?php $a3_class='text';$a3_default='';$a3_type='text';$a3_name='text';$a3_size='';$a3_maxlength='256';$a3_onchange='';$a3_readonly=false;$a3_hint=lang('search');$a3_icon='search'; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a3_readonly=true;
	  if ($a3_readonly && empty($$a3_name)) $$a3_name = '- '.lang('EMPTY').' -';
      if(!isset($a3_default)) $a3_default='';
      $tmp_value = Text::encodeHtml(isset($$a3_name)?$$a3_name:$a3_default);
?><?php if (!$a3_readonly || $a3_type=='hidden') {
?><div class="<?php echo $a3_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a3_readonly) echo ' disabled="true"' ?><?php if ($a3_hint) echo ' data-hint="'.$a3_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a3_name ?><?php if ($a3_readonly) echo '_disabled' ?>" name="<?php echo $a3_name ?><?php if ($a3_readonly) echo '_disabled' ?>" type="<?php echo $a3_type ?>" maxlength="<?php echo $a3_maxlength ?>" class="<?php echo str_replace(',',' ',$a3_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a3_icon) echo '<img src="'.$image_dir.'icon_'.$a3_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a3_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a3_name ?>" name="<?php echo $a3_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a3_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a3_class,$a3_default,$a3_type,$a3_name,$a3_size,$a3_maxlength,$a3_onchange,$a3_readonly,$a3_hint,$a3_icon) ?><!-- Compiling part/part-begin --><?php $a3_class='dropdown'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?>
				<span class="text"><?php echo nl2br(encodeHtml(htmlentities())); ?></span>
				<!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a2_class='toolbar-icon user'; ?><div class="<?php echo $a2_class ?>"><?php unset($a2_class) ?>
			<img class="image-icon image-icon--action" title="" src="./themes/default/images/icon/action/user.svg" />
			
			<span class="titletext"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $userfullname,25,'..',constant('STR_PAD_BOTH') )))); ?></span>
			
			<img class="image-icon image-icon--method" title="" src="./themes/default/images/icon/method/arrow_down.svg" />
			<!-- Compiling part/part-begin --><?php $a3_class='dropdown'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling part/part-begin --><?php $a4_class='entry clickable'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling link/link-begin --><?php $a5_title=lang('USER_PROFILE_DESC');$a5_type='post';$a5_class='';$a5_action='start';$a5_subaction='profile';$a5_frame='_self';$a5_modal=false; ?><?php
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
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'profile'.'')))); ?></span>
						<!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='entry clickable'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling link/link-begin --><?php $a5_title=lang('start');$a5_type='post';$a5_class='';$a5_action='start';$a5_subaction='start';$a5_frame='_self';$a5_modal=false; ?><?php
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
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'start'.'')))); ?></span>
						<!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='divide'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling part/part-end --></div><!-- Compiling part/part-begin --><?php $a4_class='entry clickable'; ?><div class="<?php echo $a4_class ?>"><?php unset($a4_class) ?><!-- Compiling link/link-begin --><?php $a5_title=lang('USER_LOGOUT_DESC');$a5_type='post';$a5_class='entry';$a5_action='login';$a5_subaction='logout';$a5_frame='_self';$a5_modal=false; ?><?php
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
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_LOGOUT'.'')))); ?></span>
						<!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div><!-- Compiling part/part-end --></div>