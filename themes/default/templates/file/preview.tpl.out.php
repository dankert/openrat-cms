<!-- Compiling output/output-begin -->
		<?php $if2=($image); if($if2){?><!-- Compiling insert/insert-begin --><?php $a3_inline=false;$a3_url=$preview_url; ?><iframe
 src="<?php echo $a3_url ?>"
></iframe>
<?php unset($a3_inline,$a3_url) ?>
		<?php } ?>
		<?php if(!$if2){?><!-- Compiling part/part-begin --><?php $a3_class='clickable'; ?><div class="<?php echo $a3_class ?>"><?php unset($a3_class) ?><!-- Compiling link/link-begin --><?php $a4_title='';$a4_type='popup';$a4_url=$preview_url;$a4_class='action';$a4_frame='_self';$a4_modal=false; ?><?php
	$params = array();
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
?><a data-url="<?php echo $a4_url ?>" target="<?php echo $a4_frame ?>"<?php if (isset($a4_name)) { ?> data-name="<?php echo $a4_name ?>" name="<?php echo $a4_name ?>"<?php }else{ ?> href="<?php echo $tmp_href ?>" <?php } ?> class="<?php echo $a4_class ?>" data-id="<?php echo @$a4_id ?>" data-type="<?php echo $a4_type ?>" data-action="<?php echo @$a4_action ?>" data-method="<?php echo @$a4_subaction ?>" data-data="<?php echo $tmp_data ?>" <?php if (isset($a4_accesskey)) echo ' accesskey="'.$a4_accesskey.'"' ?>  title="<?php echo encodeHtml($a4_title) ?>"><?php unset($a4_title,$a4_type,$a4_url,$a4_class,$a4_frame,$a4_modal) ?><!-- Compiling text/text-begin --><?php $a5_class='text';$a5_key='LINK_OPEN_IN_NEW_WINDOW';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?><!-- Compiling link/link-end --></a><!-- Compiling part/part-end --></div>
		<?php } ?>