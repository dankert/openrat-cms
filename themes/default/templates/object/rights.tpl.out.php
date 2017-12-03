<!-- Compiling output/output-begin -->
		<?php $if2=($type=='folder'); if($if2){?>
			
			
		<?php } ?>
		<?php if(!$if2){?>
			
			
		<?php } ?>
		<table width="100%">
			<tr class="headline">
				<td class="help">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_NAME'.'')))); ?></span>
					
				</td>
				<td class="help">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_LANGUAGE'.'')))); ?></span>
					
				</td><!-- Compiling list/list-begin --><?php $a4_list='show';$a4_extract=false;$a4_key='list_key';$a4_value='t'; ?><?php
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
?><?php unset($a4_list,$a4_extract,$a4_key,$a4_value) ?>
					<td class="help">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('acl_'.$t.'_abbrev')))); ?></span>
						
					</td><!-- Compiling list/list-end --><?php } ?>
				<td class="help">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'global_delete'.'')))); ?></span>
					
				</td>
			</tr>
			<?php $if3=(empty($acls)); if($if3){?>
				<tr class="data">
					<td colspan="99">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NOT_FOUND')))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<?php $if3=!(empty($acls)); if($if3){?>
			<?php } ?><!-- Compiling list/list-begin --><?php $a3_list='acls';$a3_extract=true;$a3_key='aclid';$a3_value='acl'; ?><?php
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
?><?php unset($a3_list,$a3_extract,$a3_key,$a3_value) ?>
				<tr class="data">
					<td>
						<?php $if6=(!empty($username)); if($if6){?>
							<img class="" title="" src="./themes/default/images/icon_user.png" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($username))); ?></span>
							
						<?php } ?>
						<?php $if6=(!empty($groupname)); if($if6){?>
							<img class="" title="" src="./themes/default/images/icon_group.png" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($groupname))); ?></span>
							
						<?php } ?>
						<?php $if6=!(!empty($username)); if($if6){?>
							<?php $if7=!(!empty($groupname)); if($if7){?>
								<img class="" title="" src="./themes/default/images/icon_group.png" />
								
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'global_all'.'')))); ?></span>
								
							<?php } ?>
						<?php } ?>
					</td>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($languagename))); ?></span>
						
					</td><!-- Compiling list/list-begin --><?php $a5_list='show';$a5_extract=false;$a5_key='list_key';$a5_value='t'; ?><?php
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
?><?php unset($a5_list,$a5_extract,$a5_key,$a5_value) ?>
						<td>
							<?php { $tmpname     = $t;$default  = false;$readonly = true;		
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
							
						</td><!-- Compiling list/list-end --><?php } ?>
					<td class="clickable"><!-- Compiling link/link-begin --><?php $a6_title='';$a6_type='post';$a6_class='';$a6_subaction='delacl';$a6_var1='aclid';$a6_value1=$aclid;$a6_frame='_self';$a6_modal=false; ?><?php
	$params = array();
		$params[$a6_var1]=$a6_value1;
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
?><a data-url="<?php echo $a6_url ?>" target="<?php echo $a6_frame ?>"<?php if (isset($a6_name)) { ?> data-name="<?php echo $a6_name ?>" name="<?php echo $a6_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a6_class ?>" data-id="<?php echo @$a6_id ?>" data-type="<?php echo $a6_type ?>" data-action="<?php echo @$a6_action ?>" data-method="<?php echo @$a6_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_type,$a6_class,$a6_subaction,$a6_var1,$a6_value1,$a6_frame,$a6_modal) ?>
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_DELETE'.'')))); ?></span>
							<!-- Compiling link/link-end --></a>
					</td>
				</tr><!-- Compiling list/list-end --><?php } ?>
			<tr class="data">
				<td class="clickable" colspan="99"><!-- Compiling link/link-begin --><?php $a5_title='';$a5_type='dialog';$a5_class='';$a5_subaction='aclform';$a5_name=lang('menu_aclform');$a5_frame='_self';$a5_modal=false; ?><?php
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
?><a data-url="<?php echo $a5_url ?>" target="<?php echo $a5_frame ?>"<?php if (isset($a5_name)) { ?> data-name="<?php echo $a5_name ?>" name="<?php echo $a5_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a5_class ?>" data-id="<?php echo @$a5_id ?>" data-type="<?php echo $a5_type ?>" data-action="<?php echo @$a5_action ?>" data-method="<?php echo @$a5_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a5_accesskey)) echo ' accesskey="'.$a5_accesskey.'"' ?>  title="<?php echo encodeHtml($a5_title) ?>"><?php unset($a5_title,$a5_type,$a5_class,$a5_subaction,$a5_name,$a5_frame,$a5_modal) ?>
						<img class="" title="" src="./themes/default/images/icon/add.png" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('new')))); ?></span>
						<!-- Compiling link/link-end --></a>
				</td>
			</tr>
		</table>