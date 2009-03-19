<?php  $attr1_class='main';  ?>  <?php
   if (!headers_sent()) header('Content-Type: text/html; charset='.$charset)
  ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
  <html>
  <head>
    <title><?php echo isset($attr1_title)?$attr1_title.' - ':(isset($windowTitle)?lang($windowTitle).' - ':'') ?><?php echo $cms_title ?></title>
    <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset ?>" />
    <meta name="MSSmartTagsPreventParsing" content="true" />
    <meta name="robots" content="noindex,nofollow" />
  <?php if (isset($windowMenu) && is_array($windowMenu)) foreach( $windowMenu as $menu )
        {
         	?>
    <link rel="section" href="<?php echo Html::url($actionName,@$menu['subaction'],$this->getRequestId() ) ?>" title="<?php echo lang($menu['text']) ?>" />
  <?php
        }
  ?><?php if (isset($metaList) && is_array($metaList)) foreach( $metaList as $meta )
        {
         	?>
    <link rel="<?php echo $meta['name'] ?>" href="<?php echo $meta['url'] ?>" title="<?php echo lang($meta['title']) ?>" /><?php
        }
  ?><?php if(!empty($root_stylesheet)) { ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $root_stylesheet ?>" />
  <?php } ?>
  <?php if($root_stylesheet!=$user_stylesheet) { ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $user_stylesheet ?>" />
  <?php } ?>
  </head>
  <body class="<?php echo $attr1_class ?>" <?php if (@$conf['interface']['application_mode']) { ?> style="padding:0px;margin:0px;"<?php } ?> >
<?php unset($attr1_class); ?><?php  $attr2_name='';  $attr2_target='_self';  $attr2_method='post';  $attr2_enctype='application/x-www-form-urlencoded';  ?>    <?php
    	if	(empty($attr2_action))
    		$attr2_action = $actionName;
    	if	(empty($attr2_subaction))
    		$attr2_subaction = $targetSubActionName;
    	if	(empty($attr2_id))
    		$attr2_id = $this->getRequestId();
    	if ($this->isEditable() && !$this->isEditMode())
    		$attr2_subaction = $subActionName;
    ?><form name="<?php echo $attr2_name ?>"
          target="<?php echo $attr2_target ?>"
          action="<?php echo Html::url( $attr2_action,$attr2_subaction,$attr2_id ) ?>"
          method="<?php echo $attr2_method ?>"
          enctype="<?php echo $attr2_enctype ?>" style="margin:0px;padding:0px;">
    <?php if ($this->isEditable() && !$this->isEditMode()) { ?>
    <input type="hidden" name="mode" value="edit" />
    <?php } ?>
    <input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr2_action ?>" />
    <input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr2_subaction ?>" />
    <input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr2_id ?>" /><?php
    		if	( $conf['interface']['url_sessionid'] )
    			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
    ?><?php unset($attr2_name);unset($attr2_target);unset($attr2_method);unset($attr2_enctype); ?><?php  $attr3_widths='5%,5%,5%,15%,15%,35%,10%,10%';  $attr3_width='93%';  $attr3_rowclasses='odd,even';  $attr3_columnclasses='1,2,3';  ?>      <?php
      	$coloumn_widths=array();
      	if	(!empty($attr3_widths))
      	{
      		$column_widths = explode(',',$attr3_widths);
      		unset($attr3['widths']);
      	}
      	if	(!empty($attr3_rowclasses))
      	{
      		$row_classes   = explode(',',$attr3_rowclasses);
      		$row_class_idx = 999;
      		unset($attr3['rowclasses']);
      	}
      	if	(!empty($attr3_columnclasses))
      	{
      		$column_classes = explode(',',$attr3_columnclasses);
      		unset($attr3['columnclasses']);
      	}
      		global $image_dir;
      		if (@$conf['interface']['application_mode'] )
      		{
      			echo '<table class="main" cellspacing="0" cellpadding="4" width="100%" style="margin:0px;border:0px; padding:0px;" height_oo="100%">';
      		}
      		else
      		{
      			echo '<br/><br/><br/><center>';
      			echo '<table class="main" cellspacing="0" cellpadding="4" width="'.$attr3_width.'">';
      		}
      		if (!@$conf['interface']['application_mode'] )
      		{
      		echo '<tr><td class="menu">';
      		echo '<img src="'.$image_dir.'icon_'.$actionName.IMG_ICON_EXT.'" align="left" border="0">';
      		if ($this->isEditable()) { ?>
        <?php if ($this->isEditMode()) { 
        ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId()                       ) ?>" accesskey="1" title="<?php echo langHtml('MODE_EDIT_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>mode-edit.png" style="vertical-align:top; " border="0" /></a> <?php } else {
        ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId(),array('mode'=>'edit') ) ?>" accesskey="1" title="<?php echo langHtml('MODE_SHOW_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>readonly.png" style="vertical-align:top; " border="0" /></a> <?php }
        ?><?php }
      		echo '<span class="path">'.langHtml('GLOBAL_'.$actionName).'</span>&nbsp;<strong>&raquo;</strong>&nbsp;';
      		if	( !isset($path) || is_array($path) )
      			$path = array();
      		foreach( $path as $pathElement)
      		{
      			extract($pathElement);
      			echo '<a href="'.$url.'" class="path">'.langHtml($name).'</a>';
      			echo '&nbsp;&raquo;&nbsp;';
      		}
      		echo '<span class="title">'.langHtml($windowTitle).'</span>';
      		?>
      		</td>
      		<?php
      		}
      		?>
      <?php ?>		<!--<td class="menu" style="align:right;">
          <?php if (isset($windowIcons)) foreach( $windowIcons as $icon )
                {
                	?><a href="<?php echo $icon['url'] ?>" title="<?php echo 'ICON_'.langHtml($menu['type'].'_DESC') ?>"><image border="0" src="<?php echo $image_dir.$icon['type'].IMG_ICON_EXT ?>"></a>&nbsp;<?php
                }
           ?>
          </td>-->
        </tr>
        <tr><td class="subaction">
          <?php if	( !isset($windowMenu) || !is_array($windowMenu) )
      			$windowMenu = array();
          foreach( $windowMenu as $menu )
                {
                	$tmp_text = langHtml($menu['text']);
                	$tmp_key  = strtoupper(langHtml($menu['key' ]));
      			$tmp_pos = strpos(strtolower($tmp_text),strtolower($tmp_key));
      			if	( $tmp_pos !== false )
      				$tmp_text = substr($tmp_text,0,max($tmp_pos,0)).'<span class="accesskey">'. substr($tmp_text,$tmp_pos,1).'</span>'.substr($tmp_text,$tmp_pos+1);
                	if	( isset($menu['url']) )
                	{
                		?><a href="<?php echo Html::url($actionName,$menu['subaction'],$this->getRequestId() ) ?>" accesskey="<?php echo $tmp_key ?>" title="<?php echo langHtml($menu['text'].'_DESC') ?>" class="menu<?php echo $this->subActionName==$menu['subaction']?'_highlight':'' ?>"><?php echo $tmp_text ?></a>&nbsp;&nbsp;&nbsp;<?php
                	}
                	else
                	{
                		?><span class="menu_disabled" title="<?php echo langHtml($menu['text'].'_DESC') ?>" class="menu_disabled"><?php echo $tmp_text ?></span>&nbsp;&nbsp;&nbsp;<?php
                	}
                }
                	if (@$conf['help']['enabled'] )
                	{
                   ?><a href="<?php echo $conf['help']['url'].$actionName.'/'.$subActionName.@$conf['help']['suffix'] ?> " target="_new" title="<?php echo langHtml('MENU_HELP_DESC') ?>" class="menu" style="cursor:help;"><?php echo @$conf['help']['only_question_mark']?'?':langHtml('MENU_HELP') ?></a><?php
                	}
                	?></td>
        </tr>
      <?php if (isset($notices) && count($notices)>0 )
            { ?>
        <tr>
          <td align="center" class="notice">
        <?php foreach( $notices as $notice_idx=>$notice ) { ?>
          	<br><table class="notice" width="80%">
        <?php if ($notice['name']!='') { ?>
        <tr>
          <td colspan="2" class="subaction" style="padding:2px; white-space:nowrap; border-bottom:1px solid black;"><img src="<?php echo $image_dir.'icon_'.$notice['type'].IMG_ICON_EXT ?>" align="left" /><?php echo $notice['name'] ?>
          </td>
        </tr>
      <?php } ?>
        <tr class="notice_<?php echo $notice['status'] ?>">
          <td style="padding:10px;" width="30px"><img src="<?php echo $image_dir.'notice_'.$notice['status'].IMG_ICON_EXT ?>" style="padding:10px" /></td>
          <td style="padding:10px;padding-right:10px;padding-bottom:10px;"><?php if ($notice['status']=='error') { ?><strong><?php } ?><?php echo langHtml($notice['key'],$notice['vars']) ?><?php if ($notice['status']=='error') { ?></strong><?php } ?>
          <?php if (!empty($notice['log'])) { ?><pre><?php echo htmlentities(implode("\n",$notice['log'])) ?></pre><?php } ?>
          </td>
        </tr>
          </table>
        <?php } ?>
          </td>
        </tr>
        <tr>
        <td colspan="2"><fieldset></fieldset></td>
        </tr>
      <?php } ?>
        <tr>
          <td>
            <table class="n" cellspacing="0" width="100%" cellpadding="4">
<?php unset($attr3_widths);unset($attr3_width);unset($attr3_rowclasses);unset($attr3_columnclasses); ?><?php  ?>        <?php
        	$row_class_idx++;
        	if ($row_class_idx > count($row_classes))
        		$row_class_idx=1;
        	$row_class=$row_classes[$row_class_idx-1];
        	if (empty($attr4_class))
        		$attr4_class=$row_class;
        	global $cell_column_nr;
        	$cell_column_nr=0;
        	$column_class_idx = 999;
        ?><tr class="<?php echo $attr4_class ?>"><?php  ?><?php  $attr5_class='help';  ?>          <?php
          	$column_class_idx++;
          	if ($column_class_idx > count($column_classes))
          		$column_class_idx=1;
          	$column_class=$column_classes[$column_class_idx-1];
          	if (empty($attr5_class))
          		$attr5_class=$column_class;
          	global $cell_column_nr;
          	$cell_column_nr++;
          	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
          		$attr5_width=$column_widths[$cell_column_nr-1];
          ?><td<?php
          if	( isset($attr5_width  )) { ?> width="<?php echo $attr5_width ?>" <?php }
          if	( isset($attr5_style  )) { ?> style="<?php echo $attr5_style?>" <?php }
          if	( isset($attr5_class  )) { ?> class="<?php echo $attr5_class ?>"  <?php }
          if	( isset($attr5_colspan)) { ?> colspan="<?php echo $attr5_colspan ?>"  <?php }
          if	( isset($attr5_rowspan)) { ?> rowspan="<?php echo $attr5_rowspan ?>" <?php }
          ?>><?php unset($attr5_class); ?><?php  $attr6_class='text';  $attr6_text='GLOBAL_NR';  $attr6_escape=true;  ?>            <?php
            	if	( isset($attr6_prefix)&& isset($attr6_key))
            		$attr6_key = $attr6_prefix.$attr6_key;
            	if	( isset($attr6_suffix)&& isset($attr6_key))
            		$attr6_key = $attr6_key.$attr6_suffix;
            	if(empty($attr6_title))
            			$attr6_title = '';
            	if	(empty($attr6_type))
            		$tmp_tag = 'span';
            	else
            		switch( $attr6_type )
            		{
            			case 'emphatic':
            			case 'italic':
            				$tmp_tag = 'em';
            				break;
            			case 'strong':
            			case 'bold':
            				$tmp_tag = 'strong';
            				break;
            			case 'tt':
            			case 'teletype':
            				$tmp_tag = 'tt';
            				break;
            			default:
            				$tmp_tag = 'span';
            		}
            ?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
            	$attr6_title = '';
            	if	( $attr6_escape )
            		$langF = 'langHtml';
            	else
            		$langF = 'lang';
            	if (!empty($attr6_array))
            	{
            		$tmpArray = $$attr6_array;
            		if (!empty($attr6_var))
            			$tmp_text = $tmpArray[$attr6_var];
            		else
            			$tmp_text = $langF($tmpArray[$attr6_text]);
            	}
            	elseif (!empty($attr6_text))
            		$tmp_text = $langF($attr6_text);
            	elseif (!empty($attr6_textvar))
            		$tmp_text = $langF($$attr6_textvar);
            	elseif (!empty($attr6_key))
            		$tmp_text = $langF($attr6_key);
            	elseif (!empty($attr6_var))
            		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';	
            	elseif (!empty($attr6_raw))
            		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
            	elseif (!empty($attr6_value))
            		$tmp_text = $attr6_value;
            	else
            	  $tmp_text = '&nbsp;';
            	if	( !empty($attr6_maxlength) && intval($attr6_maxlength)!=0  )
            		$tmp_text = Text::maxLength( $tmp_text,intval($attr6_maxlength) );
            	if	(isset($attr6_accesskey))
            	{
            		$pos = strpos(strtolower($tmp_text),strtolower($attr6_accesskey));
            		if	( $pos !== false )
            			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
            	}
            	echo $tmp_text;
            	unset($tmp_text);
            ?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?>        </td><?php  ?><?php  $attr5_class='help';  $attr5_colspan='2';  ?>          <?php
          	$column_class_idx++;
          	if ($column_class_idx > count($column_classes))
          		$column_class_idx=1;
          	$column_class=$column_classes[$column_class_idx-1];
          	if (empty($attr5_class))
          		$attr5_class=$column_class;
          	global $cell_column_nr;
          	$cell_column_nr++;
          	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
          		$attr5_width=$column_widths[$cell_column_nr-1];
          ?><td<?php
          if	( isset($attr5_width  )) { ?> width="<?php echo $attr5_width ?>" <?php }
          if	( isset($attr5_style  )) { ?> style="<?php echo $attr5_style?>" <?php }
          if	( isset($attr5_class  )) { ?> class="<?php echo $attr5_class ?>"  <?php }
          if	( isset($attr5_colspan)) { ?> colspan="<?php echo $attr5_colspan ?>"  <?php }
          if	( isset($attr5_rowspan)) { ?> rowspan="<?php echo $attr5_rowspan ?>" <?php }
          ?>><?php unset($attr5_class);unset($attr5_colspan); ?><?php  $attr6_present='compareid';  ?>            <?php 
            	$attr6_tmp_exec = isset($$attr6_present);
            	$attr6_tmp_last_exec = $attr6_tmp_exec;
            	if	( $attr6_tmp_exec )
            	{
            ?>
<?php unset($attr6_present); ?><?php  $attr7_class='text';  $attr7_text='GLOBAL_COMPARE';  $attr7_escape=true;  ?>              <?php
              	if	( isset($attr7_prefix)&& isset($attr7_key))
              		$attr7_key = $attr7_prefix.$attr7_key;
              	if	( isset($attr7_suffix)&& isset($attr7_key))
              		$attr7_key = $attr7_key.$attr7_suffix;
              	if(empty($attr7_title))
              			$attr7_title = '';
              	if	(empty($attr7_type))
              		$tmp_tag = 'span';
              	else
              		switch( $attr7_type )
              		{
              			case 'emphatic':
              			case 'italic':
              				$tmp_tag = 'em';
              				break;
              			case 'strong':
              			case 'bold':
              				$tmp_tag = 'strong';
              				break;
              			case 'tt':
              			case 'teletype':
              				$tmp_tag = 'tt';
              				break;
              			default:
              				$tmp_tag = 'span';
              		}
              ?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
              	$attr7_title = '';
              	if	( $attr7_escape )
              		$langF = 'langHtml';
              	else
              		$langF = 'lang';
              	if (!empty($attr7_array))
              	{
              		$tmpArray = $$attr7_array;
              		if (!empty($attr7_var))
              			$tmp_text = $tmpArray[$attr7_var];
              		else
              			$tmp_text = $langF($tmpArray[$attr7_text]);
              	}
              	elseif (!empty($attr7_text))
              		$tmp_text = $langF($attr7_text);
              	elseif (!empty($attr7_textvar))
              		$tmp_text = $langF($$attr7_textvar);
              	elseif (!empty($attr7_key))
              		$tmp_text = $langF($attr7_key);
              	elseif (!empty($attr7_var))
              		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
              	elseif (!empty($attr7_raw))
              		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
              	elseif (!empty($attr7_value))
              		$tmp_text = $attr7_value;
              	else
              	  $tmp_text = '&nbsp;';
              	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
              		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
              	if	(isset($attr7_accesskey))
              	{
              		$pos = strpos(strtolower($tmp_text),strtolower($attr7_accesskey));
              		if	( $pos !== false )
              			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
              	}
              	echo $tmp_text;
              	unset($tmp_text);
              ?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_text);unset($attr7_escape); ?><?php  ?>          <?php } ?><?php  ?><?php  ?>        </td><?php  ?><?php  $attr5_class='help';  ?>          <?php
          	$column_class_idx++;
          	if ($column_class_idx > count($column_classes))
          		$column_class_idx=1;
          	$column_class=$column_classes[$column_class_idx-1];
          	if (empty($attr5_class))
          		$attr5_class=$column_class;
          	global $cell_column_nr;
          	$cell_column_nr++;
          	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
          		$attr5_width=$column_widths[$cell_column_nr-1];
          ?><td<?php
          if	( isset($attr5_width  )) { ?> width="<?php echo $attr5_width ?>" <?php }
          if	( isset($attr5_style  )) { ?> style="<?php echo $attr5_style?>" <?php }
          if	( isset($attr5_class  )) { ?> class="<?php echo $attr5_class ?>"  <?php }
          if	( isset($attr5_colspan)) { ?> colspan="<?php echo $attr5_colspan ?>"  <?php }
          if	( isset($attr5_rowspan)) { ?> rowspan="<?php echo $attr5_rowspan ?>" <?php }
          ?>><?php unset($attr5_class); ?><?php  $attr6_class='text';  $attr6_text='DATE';  $attr6_escape=true;  ?>            <?php
            	if	( isset($attr6_prefix)&& isset($attr6_key))
            		$attr6_key = $attr6_prefix.$attr6_key;
            	if	( isset($attr6_suffix)&& isset($attr6_key))
            		$attr6_key = $attr6_key.$attr6_suffix;
            	if(empty($attr6_title))
            			$attr6_title = '';
            	if	(empty($attr6_type))
            		$tmp_tag = 'span';
            	else
            		switch( $attr6_type )
            		{
            			case 'emphatic':
            			case 'italic':
            				$tmp_tag = 'em';
            				break;
            			case 'strong':
            			case 'bold':
            				$tmp_tag = 'strong';
            				break;
            			case 'tt':
            			case 'teletype':
            				$tmp_tag = 'tt';
            				break;
            			default:
            				$tmp_tag = 'span';
            		}
            ?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
            	$attr6_title = '';
            	if	( $attr6_escape )
            		$langF = 'langHtml';
            	else
            		$langF = 'lang';
            	if (!empty($attr6_array))
            	{
            		$tmpArray = $$attr6_array;
            		if (!empty($attr6_var))
            			$tmp_text = $tmpArray[$attr6_var];
            		else
            			$tmp_text = $langF($tmpArray[$attr6_text]);
            	}
            	elseif (!empty($attr6_text))
            		$tmp_text = $langF($attr6_text);
            	elseif (!empty($attr6_textvar))
            		$tmp_text = $langF($$attr6_textvar);
            	elseif (!empty($attr6_key))
            		$tmp_text = $langF($attr6_key);
            	elseif (!empty($attr6_var))
            		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';	
            	elseif (!empty($attr6_raw))
            		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
            	elseif (!empty($attr6_value))
            		$tmp_text = $attr6_value;
            	else
            	  $tmp_text = '&nbsp;';
            	if	( !empty($attr6_maxlength) && intval($attr6_maxlength)!=0  )
            		$tmp_text = Text::maxLength( $tmp_text,intval($attr6_maxlength) );
            	if	(isset($attr6_accesskey))
            	{
            		$pos = strpos(strtolower($tmp_text),strtolower($attr6_accesskey));
            		if	( $pos !== false )
            			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
            	}
            	echo $tmp_text;
            	unset($tmp_text);
            ?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?>        </td><?php  ?><?php  $attr5_class='help';  ?>          <?php
          	$column_class_idx++;
          	if ($column_class_idx > count($column_classes))
          		$column_class_idx=1;
          	$column_class=$column_classes[$column_class_idx-1];
          	if (empty($attr5_class))
          		$attr5_class=$column_class;
          	global $cell_column_nr;
          	$cell_column_nr++;
          	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
          		$attr5_width=$column_widths[$cell_column_nr-1];
          ?><td<?php
          if	( isset($attr5_width  )) { ?> width="<?php echo $attr5_width ?>" <?php }
          if	( isset($attr5_style  )) { ?> style="<?php echo $attr5_style?>" <?php }
          if	( isset($attr5_class  )) { ?> class="<?php echo $attr5_class ?>"  <?php }
          if	( isset($attr5_colspan)) { ?> colspan="<?php echo $attr5_colspan ?>"  <?php }
          if	( isset($attr5_rowspan)) { ?> rowspan="<?php echo $attr5_rowspan ?>" <?php }
          ?>><?php unset($attr5_class); ?><?php  $attr6_class='text';  $attr6_text='GLOBAL_USER';  $attr6_escape=true;  ?>            <?php
            	if	( isset($attr6_prefix)&& isset($attr6_key))
            		$attr6_key = $attr6_prefix.$attr6_key;
            	if	( isset($attr6_suffix)&& isset($attr6_key))
            		$attr6_key = $attr6_key.$attr6_suffix;
            	if(empty($attr6_title))
            			$attr6_title = '';
            	if	(empty($attr6_type))
            		$tmp_tag = 'span';
            	else
            		switch( $attr6_type )
            		{
            			case 'emphatic':
            			case 'italic':
            				$tmp_tag = 'em';
            				break;
            			case 'strong':
            			case 'bold':
            				$tmp_tag = 'strong';
            				break;
            			case 'tt':
            			case 'teletype':
            				$tmp_tag = 'tt';
            				break;
            			default:
            				$tmp_tag = 'span';
            		}
            ?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
            	$attr6_title = '';
            	if	( $attr6_escape )
            		$langF = 'langHtml';
            	else
            		$langF = 'lang';
            	if (!empty($attr6_array))
            	{
            		$tmpArray = $$attr6_array;
            		if (!empty($attr6_var))
            			$tmp_text = $tmpArray[$attr6_var];
            		else
            			$tmp_text = $langF($tmpArray[$attr6_text]);
            	}
            	elseif (!empty($attr6_text))
            		$tmp_text = $langF($attr6_text);
            	elseif (!empty($attr6_textvar))
            		$tmp_text = $langF($$attr6_textvar);
            	elseif (!empty($attr6_key))
            		$tmp_text = $langF($attr6_key);
            	elseif (!empty($attr6_var))
            		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';	
            	elseif (!empty($attr6_raw))
            		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
            	elseif (!empty($attr6_value))
            		$tmp_text = $attr6_value;
            	else
            	  $tmp_text = '&nbsp;';
            	if	( !empty($attr6_maxlength) && intval($attr6_maxlength)!=0  )
            		$tmp_text = Text::maxLength( $tmp_text,intval($attr6_maxlength) );
            	if	(isset($attr6_accesskey))
            	{
            		$pos = strpos(strtolower($tmp_text),strtolower($attr6_accesskey));
            		if	( $pos !== false )
            			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
            	}
            	echo $tmp_text;
            	unset($tmp_text);
            ?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?>        </td><?php  ?><?php  $attr5_class='help';  ?>          <?php
          	$column_class_idx++;
          	if ($column_class_idx > count($column_classes))
          		$column_class_idx=1;
          	$column_class=$column_classes[$column_class_idx-1];
          	if (empty($attr5_class))
          		$attr5_class=$column_class;
          	global $cell_column_nr;
          	$cell_column_nr++;
          	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
          		$attr5_width=$column_widths[$cell_column_nr-1];
          ?><td<?php
          if	( isset($attr5_width  )) { ?> width="<?php echo $attr5_width ?>" <?php }
          if	( isset($attr5_style  )) { ?> style="<?php echo $attr5_style?>" <?php }
          if	( isset($attr5_class  )) { ?> class="<?php echo $attr5_class ?>"  <?php }
          if	( isset($attr5_colspan)) { ?> colspan="<?php echo $attr5_colspan ?>"  <?php }
          if	( isset($attr5_rowspan)) { ?> rowspan="<?php echo $attr5_rowspan ?>" <?php }
          ?>><?php unset($attr5_class); ?><?php  $attr6_class='text';  $attr6_text='GLOBAL_VALUE';  $attr6_escape=true;  ?>            <?php
            	if	( isset($attr6_prefix)&& isset($attr6_key))
            		$attr6_key = $attr6_prefix.$attr6_key;
            	if	( isset($attr6_suffix)&& isset($attr6_key))
            		$attr6_key = $attr6_key.$attr6_suffix;
            	if(empty($attr6_title))
            			$attr6_title = '';
            	if	(empty($attr6_type))
            		$tmp_tag = 'span';
            	else
            		switch( $attr6_type )
            		{
            			case 'emphatic':
            			case 'italic':
            				$tmp_tag = 'em';
            				break;
            			case 'strong':
            			case 'bold':
            				$tmp_tag = 'strong';
            				break;
            			case 'tt':
            			case 'teletype':
            				$tmp_tag = 'tt';
            				break;
            			default:
            				$tmp_tag = 'span';
            		}
            ?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
            	$attr6_title = '';
            	if	( $attr6_escape )
            		$langF = 'langHtml';
            	else
            		$langF = 'lang';
            	if (!empty($attr6_array))
            	{
            		$tmpArray = $$attr6_array;
            		if (!empty($attr6_var))
            			$tmp_text = $tmpArray[$attr6_var];
            		else
            			$tmp_text = $langF($tmpArray[$attr6_text]);
            	}
            	elseif (!empty($attr6_text))
            		$tmp_text = $langF($attr6_text);
            	elseif (!empty($attr6_textvar))
            		$tmp_text = $langF($$attr6_textvar);
            	elseif (!empty($attr6_key))
            		$tmp_text = $langF($attr6_key);
            	elseif (!empty($attr6_var))
            		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';	
            	elseif (!empty($attr6_raw))
            		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
            	elseif (!empty($attr6_value))
            		$tmp_text = $attr6_value;
            	else
            	  $tmp_text = '&nbsp;';
            	if	( !empty($attr6_maxlength) && intval($attr6_maxlength)!=0  )
            		$tmp_text = Text::maxLength( $tmp_text,intval($attr6_maxlength) );
            	if	(isset($attr6_accesskey))
            	{
            		$pos = strpos(strtolower($tmp_text),strtolower($attr6_accesskey));
            		if	( $pos !== false )
            			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
            	}
            	echo $tmp_text;
            	unset($tmp_text);
            ?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?>        </td><?php  ?><?php  $attr5_class='help';  ?>          <?php
          	$column_class_idx++;
          	if ($column_class_idx > count($column_classes))
          		$column_class_idx=1;
          	$column_class=$column_classes[$column_class_idx-1];
          	if (empty($attr5_class))
          		$attr5_class=$column_class;
          	global $cell_column_nr;
          	$cell_column_nr++;
          	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
          		$attr5_width=$column_widths[$cell_column_nr-1];
          ?><td<?php
          if	( isset($attr5_width  )) { ?> width="<?php echo $attr5_width ?>" <?php }
          if	( isset($attr5_style  )) { ?> style="<?php echo $attr5_style?>" <?php }
          if	( isset($attr5_class  )) { ?> class="<?php echo $attr5_class ?>"  <?php }
          if	( isset($attr5_colspan)) { ?> colspan="<?php echo $attr5_colspan ?>"  <?php }
          if	( isset($attr5_rowspan)) { ?> rowspan="<?php echo $attr5_rowspan ?>" <?php }
          ?>><?php unset($attr5_class); ?><?php  $attr6_class='text';  $attr6_text='GLOBAL_STATE';  $attr6_escape=true;  ?>            <?php
            	if	( isset($attr6_prefix)&& isset($attr6_key))
            		$attr6_key = $attr6_prefix.$attr6_key;
            	if	( isset($attr6_suffix)&& isset($attr6_key))
            		$attr6_key = $attr6_key.$attr6_suffix;
            	if(empty($attr6_title))
            			$attr6_title = '';
            	if	(empty($attr6_type))
            		$tmp_tag = 'span';
            	else
            		switch( $attr6_type )
            		{
            			case 'emphatic':
            			case 'italic':
            				$tmp_tag = 'em';
            				break;
            			case 'strong':
            			case 'bold':
            				$tmp_tag = 'strong';
            				break;
            			case 'tt':
            			case 'teletype':
            				$tmp_tag = 'tt';
            				break;
            			default:
            				$tmp_tag = 'span';
            		}
            ?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
            	$attr6_title = '';
            	if	( $attr6_escape )
            		$langF = 'langHtml';
            	else
            		$langF = 'lang';
            	if (!empty($attr6_array))
            	{
            		$tmpArray = $$attr6_array;
            		if (!empty($attr6_var))
            			$tmp_text = $tmpArray[$attr6_var];
            		else
            			$tmp_text = $langF($tmpArray[$attr6_text]);
            	}
            	elseif (!empty($attr6_text))
            		$tmp_text = $langF($attr6_text);
            	elseif (!empty($attr6_textvar))
            		$tmp_text = $langF($$attr6_textvar);
            	elseif (!empty($attr6_key))
            		$tmp_text = $langF($attr6_key);
            	elseif (!empty($attr6_var))
            		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';	
            	elseif (!empty($attr6_raw))
            		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
            	elseif (!empty($attr6_value))
            		$tmp_text = $attr6_value;
            	else
            	  $tmp_text = '&nbsp;';
            	if	( !empty($attr6_maxlength) && intval($attr6_maxlength)!=0  )
            		$tmp_text = Text::maxLength( $tmp_text,intval($attr6_maxlength) );
            	if	(isset($attr6_accesskey))
            	{
            		$pos = strpos(strtolower($tmp_text),strtolower($attr6_accesskey));
            		if	( $pos !== false )
            			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
            	}
            	echo $tmp_text;
            	unset($tmp_text);
            ?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?>        </td><?php  ?><?php  $attr5_class='help';  ?>          <?php
          	$column_class_idx++;
          	if ($column_class_idx > count($column_classes))
          		$column_class_idx=1;
          	$column_class=$column_classes[$column_class_idx-1];
          	if (empty($attr5_class))
          		$attr5_class=$column_class;
          	global $cell_column_nr;
          	$cell_column_nr++;
          	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
          		$attr5_width=$column_widths[$cell_column_nr-1];
          ?><td<?php
          if	( isset($attr5_width  )) { ?> width="<?php echo $attr5_width ?>" <?php }
          if	( isset($attr5_style  )) { ?> style="<?php echo $attr5_style?>" <?php }
          if	( isset($attr5_class  )) { ?> class="<?php echo $attr5_class ?>"  <?php }
          if	( isset($attr5_colspan)) { ?> colspan="<?php echo $attr5_colspan ?>"  <?php }
          if	( isset($attr5_rowspan)) { ?> rowspan="<?php echo $attr5_rowspan ?>" <?php }
          ?>><?php unset($attr5_class); ?><?php  $attr6_class='text';  $attr6_text='GLOBAL_ACTION';  $attr6_escape=true;  ?>            <?php
            	if	( isset($attr6_prefix)&& isset($attr6_key))
            		$attr6_key = $attr6_prefix.$attr6_key;
            	if	( isset($attr6_suffix)&& isset($attr6_key))
            		$attr6_key = $attr6_key.$attr6_suffix;
            	if(empty($attr6_title))
            			$attr6_title = '';
            	if	(empty($attr6_type))
            		$tmp_tag = 'span';
            	else
            		switch( $attr6_type )
            		{
            			case 'emphatic':
            			case 'italic':
            				$tmp_tag = 'em';
            				break;
            			case 'strong':
            			case 'bold':
            				$tmp_tag = 'strong';
            				break;
            			case 'tt':
            			case 'teletype':
            				$tmp_tag = 'tt';
            				break;
            			default:
            				$tmp_tag = 'span';
            		}
            ?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
            	$attr6_title = '';
            	if	( $attr6_escape )
            		$langF = 'langHtml';
            	else
            		$langF = 'lang';
            	if (!empty($attr6_array))
            	{
            		$tmpArray = $$attr6_array;
            		if (!empty($attr6_var))
            			$tmp_text = $tmpArray[$attr6_var];
            		else
            			$tmp_text = $langF($tmpArray[$attr6_text]);
            	}
            	elseif (!empty($attr6_text))
            		$tmp_text = $langF($attr6_text);
            	elseif (!empty($attr6_textvar))
            		$tmp_text = $langF($$attr6_textvar);
            	elseif (!empty($attr6_key))
            		$tmp_text = $langF($attr6_key);
            	elseif (!empty($attr6_var))
            		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';	
            	elseif (!empty($attr6_raw))
            		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
            	elseif (!empty($attr6_value))
            		$tmp_text = $attr6_value;
            	else
            	  $tmp_text = '&nbsp;';
            	if	( !empty($attr6_maxlength) && intval($attr6_maxlength)!=0  )
            		$tmp_text = Text::maxLength( $tmp_text,intval($attr6_maxlength) );
            	if	(isset($attr6_accesskey))
            	{
            		$pos = strpos(strtolower($tmp_text),strtolower($attr6_accesskey));
            		if	( $pos !== false )
            			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
            	}
            	echo $tmp_text;
            	unset($tmp_text);
            ?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?>        </td><?php  ?><?php  ?>      </tr><?php  ?><?php  $attr4_empty='el';  ?>        <?php 
        	if	( !isset($$attr4_empty) )
        		$attr4_tmp_exec = empty($attr4_empty);
        	elseif	( is_array($$attr4_empty) )
        		$attr4_tmp_exec = (count($$attr4_empty)==0);
        	elseif	( is_bool($$attr4_empty) )
        		$attr4_tmp_exec = true;
        	else
        		$attr4_tmp_exec = empty( $$attr4_empty );
        	$attr4_tmp_last_exec = $attr4_tmp_exec;
        	if	( $attr4_tmp_exec )
        	{
        ?>
<?php unset($attr4_empty); ?><?php  ?>          <?php
          	$row_class_idx++;
          	if ($row_class_idx > count($row_classes))
          		$row_class_idx=1;
          	$row_class=$row_classes[$row_class_idx-1];
          	if (empty($attr5_class))
          		$attr5_class=$row_class;
          	global $cell_column_nr;
          	$cell_column_nr=0;
          	$column_class_idx = 999;
          ?><tr class="<?php echo $attr5_class ?>"><?php  ?><?php  $attr6_class='fx';  $attr6_colspan='8';  ?>            <?php
            	$column_class_idx++;
            	if ($column_class_idx > count($column_classes))
            		$column_class_idx=1;
            	$column_class=$column_classes[$column_class_idx-1];
            	if (empty($attr6_class))
            		$attr6_class=$column_class;
            	global $cell_column_nr;
            	$cell_column_nr++;
            	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
            		$attr6_width=$column_widths[$cell_column_nr-1];
            ?><td<?php
            if	( isset($attr6_width  )) { ?> width="<?php echo $attr6_width ?>" <?php }
            if	( isset($attr6_style  )) { ?> style="<?php echo $attr6_style?>" <?php }
            if	( isset($attr6_class  )) { ?> class="<?php echo $attr6_class ?>"  <?php }
            if	( isset($attr6_colspan)) { ?> colspan="<?php echo $attr6_colspan ?>"  <?php }
            if	( isset($attr6_rowspan)) { ?> rowspan="<?php echo $attr6_rowspan ?>" <?php }
            ?>><?php unset($attr6_class);unset($attr6_colspan); ?><?php  $attr7_class='text';  $attr7_text='GLOBAL_NOT_FOUND';  $attr7_escape=true;  ?>              <?php
              	if	( isset($attr7_prefix)&& isset($attr7_key))
              		$attr7_key = $attr7_prefix.$attr7_key;
              	if	( isset($attr7_suffix)&& isset($attr7_key))
              		$attr7_key = $attr7_key.$attr7_suffix;
              	if(empty($attr7_title))
              			$attr7_title = '';
              	if	(empty($attr7_type))
              		$tmp_tag = 'span';
              	else
              		switch( $attr7_type )
              		{
              			case 'emphatic':
              			case 'italic':
              				$tmp_tag = 'em';
              				break;
              			case 'strong':
              			case 'bold':
              				$tmp_tag = 'strong';
              				break;
              			case 'tt':
              			case 'teletype':
              				$tmp_tag = 'tt';
              				break;
              			default:
              				$tmp_tag = 'span';
              		}
              ?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
              	$attr7_title = '';
              	if	( $attr7_escape )
              		$langF = 'langHtml';
              	else
              		$langF = 'lang';
              	if (!empty($attr7_array))
              	{
              		$tmpArray = $$attr7_array;
              		if (!empty($attr7_var))
              			$tmp_text = $tmpArray[$attr7_var];
              		else
              			$tmp_text = $langF($tmpArray[$attr7_text]);
              	}
              	elseif (!empty($attr7_text))
              		$tmp_text = $langF($attr7_text);
              	elseif (!empty($attr7_textvar))
              		$tmp_text = $langF($$attr7_textvar);
              	elseif (!empty($attr7_key))
              		$tmp_text = $langF($attr7_key);
              	elseif (!empty($attr7_var))
              		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
              	elseif (!empty($attr7_raw))
              		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
              	elseif (!empty($attr7_value))
              		$tmp_text = $attr7_value;
              	else
              	  $tmp_text = '&nbsp;';
              	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
              		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
              	if	(isset($attr7_accesskey))
              	{
              		$pos = strpos(strtolower($tmp_text),strtolower($attr7_accesskey));
              		if	( $pos !== false )
              			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
              	}
              	echo $tmp_text;
              	unset($tmp_text);
              ?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_text);unset($attr7_escape); ?><?php  ?>          </td><?php  ?><?php  ?>        </tr><?php  ?><?php  ?>      <?php } ?><?php  ?><?php  $attr4_list='el';  $attr4_extract=true;  $attr4_key='list_key';  $attr4_value='list_value';  ?>        <?php
        	$attr4_list_tmp_key   = $attr4_key;
        	$attr4_list_tmp_value = $attr4_value;
        	$attr4_list_extract   = $attr4_extract;
        	unset($attr4_key);
        	unset($attr4_value);
        	if	( !isset($$attr4_list) || !is_array($$attr4_list) )
        		$$attr4_list = array();
        	foreach( $$attr4_list as $$attr4_list_tmp_key => $$attr4_list_tmp_value )
        	{
        		if	( $attr4_list_extract )
        		{
        			if	( !is_array($$attr4_list_tmp_value) )
        			{
        				print_r($$attr4_list_tmp_value);
        				die( 'not an array at key: '.$$attr4_list_tmp_key );
        			}
        			extract($$attr4_list_tmp_value);
        		}
        ?><?php unset($attr4_list);unset($attr4_extract);unset($attr4_key);unset($attr4_value); ?><?php  ?>          <?php
          	$row_class_idx++;
          	if ($row_class_idx > count($row_classes))
          		$row_class_idx=1;
          	$row_class=$row_classes[$row_class_idx-1];
          	if (empty($attr5_class))
          		$attr5_class=$row_class;
          	global $cell_column_nr;
          	$cell_column_nr=0;
          	$column_class_idx = 999;
          ?><tr class="<?php echo $attr5_class ?>"><?php  ?><?php  $attr6_class='fx';  ?>            <?php
            	$column_class_idx++;
            	if ($column_class_idx > count($column_classes))
            		$column_class_idx=1;
            	$column_class=$column_classes[$column_class_idx-1];
            	if (empty($attr6_class))
            		$attr6_class=$column_class;
            	global $cell_column_nr;
            	$cell_column_nr++;
            	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
            		$attr6_width=$column_widths[$cell_column_nr-1];
            ?><td<?php
            if	( isset($attr6_width  )) { ?> width="<?php echo $attr6_width ?>" <?php }
            if	( isset($attr6_style  )) { ?> style="<?php echo $attr6_style?>" <?php }
            if	( isset($attr6_class  )) { ?> class="<?php echo $attr6_class ?>"  <?php }
            if	( isset($attr6_colspan)) { ?> colspan="<?php echo $attr6_colspan ?>"  <?php }
            if	( isset($attr6_rowspan)) { ?> rowspan="<?php echo $attr6_rowspan ?>" <?php }
            ?>><?php unset($attr6_class); ?><?php  $attr7_class='text';  $attr7_var='lfd_nr';  $attr7_escape=true;  ?>              <?php
              	if	( isset($attr7_prefix)&& isset($attr7_key))
              		$attr7_key = $attr7_prefix.$attr7_key;
              	if	( isset($attr7_suffix)&& isset($attr7_key))
              		$attr7_key = $attr7_key.$attr7_suffix;
              	if(empty($attr7_title))
              			$attr7_title = '';
              	if	(empty($attr7_type))
              		$tmp_tag = 'span';
              	else
              		switch( $attr7_type )
              		{
              			case 'emphatic':
              			case 'italic':
              				$tmp_tag = 'em';
              				break;
              			case 'strong':
              			case 'bold':
              				$tmp_tag = 'strong';
              				break;
              			case 'tt':
              			case 'teletype':
              				$tmp_tag = 'tt';
              				break;
              			default:
              				$tmp_tag = 'span';
              		}
              ?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
              	$attr7_title = '';
              	if	( $attr7_escape )
              		$langF = 'langHtml';
              	else
              		$langF = 'lang';
              	if (!empty($attr7_array))
              	{
              		$tmpArray = $$attr7_array;
              		if (!empty($attr7_var))
              			$tmp_text = $tmpArray[$attr7_var];
              		else
              			$tmp_text = $langF($tmpArray[$attr7_text]);
              	}
              	elseif (!empty($attr7_text))
              		$tmp_text = $langF($attr7_text);
              	elseif (!empty($attr7_textvar))
              		$tmp_text = $langF($$attr7_textvar);
              	elseif (!empty($attr7_key))
              		$tmp_text = $langF($attr7_key);
              	elseif (!empty($attr7_var))
              		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
              	elseif (!empty($attr7_raw))
              		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
              	elseif (!empty($attr7_value))
              		$tmp_text = $attr7_value;
              	else
              	  $tmp_text = '&nbsp;';
              	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
              		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
              	if	(isset($attr7_accesskey))
              	{
              		$pos = strpos(strtolower($tmp_text),strtolower($attr7_accesskey));
              		if	( $pos !== false )
              			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
              	}
              	echo $tmp_text;
              	unset($tmp_text);
              ?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_var);unset($attr7_escape); ?><?php  ?>          </td><?php  ?><?php  $attr6_class='fx';  ?>            <?php
            	$column_class_idx++;
            	if ($column_class_idx > count($column_classes))
            		$column_class_idx=1;
            	$column_class=$column_classes[$column_class_idx-1];
            	if (empty($attr6_class))
            		$attr6_class=$column_class;
            	global $cell_column_nr;
            	$cell_column_nr++;
            	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
            		$attr6_width=$column_widths[$cell_column_nr-1];
            ?><td<?php
            if	( isset($attr6_width  )) { ?> width="<?php echo $attr6_width ?>" <?php }
            if	( isset($attr6_style  )) { ?> style="<?php echo $attr6_style?>" <?php }
            if	( isset($attr6_class  )) { ?> class="<?php echo $attr6_class ?>"  <?php }
            if	( isset($attr6_colspan)) { ?> colspan="<?php echo $attr6_colspan ?>"  <?php }
            if	( isset($attr6_rowspan)) { ?> rowspan="<?php echo $attr6_rowspan ?>" <?php }
            ?>><?php unset($attr6_class); ?><?php  $attr7_present='compareid';  ?>              <?php 
              	$attr7_tmp_exec = isset($$attr7_present);
              	$attr7_tmp_last_exec = $attr7_tmp_exec;
              	if	( $attr7_tmp_exec )
              	{
              ?>
<?php unset($attr7_present); ?><?php  $attr8_readonly=false;  $attr8_name='compareid';  $attr8_value=$id;  $attr8_default=false;  $attr8_prefix='';  $attr8_suffix='';  $attr8_class='';  $attr8_onchange='';  ?>                <?php
                		if ($this->isEditable() && !$this->isEditMode()) $attr8_readonly=true;
                		if	( isset($$attr8_name)  )
                			$attr8_tmp_default = $$attr8_name;
                		elseif ( isset($attr8_default) )
                			$attr8_tmp_default = $attr8_default;
                		else
                			$attr8_tmp_default = '';
                 ?><input type="radio" id="id_<?php echo $attr8_name.'_'.$attr8_value ?>"  name="<?php echo $attr8_prefix.$attr8_name ?>"<?php if ( $attr8_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $attr8_value ?>" <?php if($attr8_value==$attr8_tmp_default) echo 'checked="checked"' ?><?php if (in_array($attr8_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> /><?php unset($attr8_readonly);unset($attr8_name);unset($attr8_value);unset($attr8_default);unset($attr8_prefix);unset($attr8_suffix);unset($attr8_class);unset($attr8_onchange); ?><?php  ?>            <?php } ?><?php  ?><?php  ?>          </td><?php  ?><?php  $attr6_class='fx';  ?>            <?php
            	$column_class_idx++;
            	if ($column_class_idx > count($column_classes))
            		$column_class_idx=1;
            	$column_class=$column_classes[$column_class_idx-1];
            	if (empty($attr6_class))
            		$attr6_class=$column_class;
            	global $cell_column_nr;
            	$cell_column_nr++;
            	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
            		$attr6_width=$column_widths[$cell_column_nr-1];
            ?><td<?php
            if	( isset($attr6_width  )) { ?> width="<?php echo $attr6_width ?>" <?php }
            if	( isset($attr6_style  )) { ?> style="<?php echo $attr6_style?>" <?php }
            if	( isset($attr6_class  )) { ?> class="<?php echo $attr6_class ?>"  <?php }
            if	( isset($attr6_colspan)) { ?> colspan="<?php echo $attr6_colspan ?>"  <?php }
            if	( isset($attr6_rowspan)) { ?> rowspan="<?php echo $attr6_rowspan ?>" <?php }
            ?>><?php unset($attr6_class); ?><?php  $attr7_present='compareid';  ?>              <?php 
              	$attr7_tmp_exec = isset($$attr7_present);
              	$attr7_tmp_last_exec = $attr7_tmp_exec;
              	if	( $attr7_tmp_exec )
              	{
              ?>
<?php unset($attr7_present); ?><?php  $attr8_readonly=false;  $attr8_name='withid';  $attr8_value=$id;  $attr8_default=false;  $attr8_prefix='';  $attr8_suffix='';  $attr8_class='';  $attr8_onchange='';  ?>                <?php
                		if ($this->isEditable() && !$this->isEditMode()) $attr8_readonly=true;
                		if	( isset($$attr8_name)  )
                			$attr8_tmp_default = $$attr8_name;
                		elseif ( isset($attr8_default) )
                			$attr8_tmp_default = $attr8_default;
                		else
                			$attr8_tmp_default = '';
                 ?><input type="radio" id="id_<?php echo $attr8_name.'_'.$attr8_value ?>"  name="<?php echo $attr8_prefix.$attr8_name ?>"<?php if ( $attr8_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $attr8_value ?>" <?php if($attr8_value==$attr8_tmp_default) echo 'checked="checked"' ?><?php if (in_array($attr8_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> /><?php unset($attr8_readonly);unset($attr8_name);unset($attr8_value);unset($attr8_default);unset($attr8_prefix);unset($attr8_suffix);unset($attr8_class);unset($attr8_onchange); ?><?php  ?>            <?php } ?><?php  ?><?php  ?>          </td><?php  ?><?php  $attr6_class='fx';  ?>            <?php
            	$column_class_idx++;
            	if ($column_class_idx > count($column_classes))
            		$column_class_idx=1;
            	$column_class=$column_classes[$column_class_idx-1];
            	if (empty($attr6_class))
            		$attr6_class=$column_class;
            	global $cell_column_nr;
            	$cell_column_nr++;
            	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
            		$attr6_width=$column_widths[$cell_column_nr-1];
            ?><td<?php
            if	( isset($attr6_width  )) { ?> width="<?php echo $attr6_width ?>" <?php }
            if	( isset($attr6_style  )) { ?> style="<?php echo $attr6_style?>" <?php }
            if	( isset($attr6_class  )) { ?> class="<?php echo $attr6_class ?>"  <?php }
            if	( isset($attr6_colspan)) { ?> colspan="<?php echo $attr6_colspan ?>"  <?php }
            if	( isset($attr6_rowspan)) { ?> rowspan="<?php echo $attr6_rowspan ?>" <?php }
            ?>><?php unset($attr6_class); ?><?php  $attr7_date=$date;  ?>              <?php	
                  global $conf;
              	$time = $attr7_date;
              	if	( $time==0)
              		echo lang('GLOBAL_UNKNOWN');
              	elseif ( !$conf['interface']['human_date_format'] )
              	{
              		echo '<span title="';
              		$dl = date(lang('DATE_FORMAT_LONG'),$time);
              		$dl = str_replace('{weekday}',lang('DATE_WEEKDAY'.strval(date('w',$time))),$dl);
              		$dl = str_replace('{month}'  ,lang('DATE_MONTH'  .strval(date('n',$time))),$dl);
              		echo $dl;
              		unset($dl);
              		echo '">';
              		echo date(lang('DATE_FORMAT'),$time);
              		echo '</span>';
              	}
              	else
              	{
              		$sekunden = time()-$time;
              		$minuten = intval($sekunden/60);
              		$stunden = intval($minuten /60);
              		$tage    = intval($stunden /24);
              		$monate  = intval($tage    /30);
              		$jahre   = intval($monate  /12);
              		echo '<span title="'.date(lang('DATE_FORMAT'),$time).'"">';
              		if	( $time==0)
              			echo lang('GLOBAL_UNKNOWN');
              		elseif ( !$conf['interface']['human_date_format'] )
              			echo date(lang('DATE_FORMAT'),$time);
              		elseif	( $sekunden == 1 )
              			echo $sekunden.' '.lang('GLOBAL_SECOND');
              		elseif	( $sekunden < 60 )
              			echo $sekunden.' '.lang('GLOBAL_SECONDS');
              		elseif	( $minuten == 1 )
              			echo $minuten.' '.lang('GLOBAL_MINUTE');
              		elseif	( $minuten < 60 )
              			echo $minuten.' '.lang('GLOBAL_MINUTES');
              		elseif	( $stunden == 1 )
              			echo $stunden.' '.lang('GLOBAL_HOUR');
              		elseif	( $stunden < 60 )
              			echo $stunden.' '.lang('GLOBAL_HOURS');
              		elseif	( $tage == 1 )
              			echo $tage.' '.lang('GLOBAL_DAY');
              		elseif	( $tage < 60 )
              			echo $tage.' '.lang('GLOBAL_DAYS');
              		elseif	( $monate == 1 )
              			echo $monate.' '.lang('GLOBAL_MONTH');
              		elseif	( $monate < 12 )
              			echo $monate.' '.lang('GLOBAL_MONTHS');
              		elseif	( $jahre == 1 )
              			echo $jahre.' '.lang('GLOBAL_YEAR');
              		else
              			echo $jahre.' '.lang('GLOBAL_YEARS');
              		echo '</span>';
              	}
              ?><?php unset($attr7_date); ?><?php  ?>          </td><?php  ?><?php  $attr6_class='fx';  ?>            <?php
            	$column_class_idx++;
            	if ($column_class_idx > count($column_classes))
            		$column_class_idx=1;
            	$column_class=$column_classes[$column_class_idx-1];
            	if (empty($attr6_class))
            		$attr6_class=$column_class;
            	global $cell_column_nr;
            	$cell_column_nr++;
            	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
            		$attr6_width=$column_widths[$cell_column_nr-1];
            ?><td<?php
            if	( isset($attr6_width  )) { ?> width="<?php echo $attr6_width ?>" <?php }
            if	( isset($attr6_style  )) { ?> style="<?php echo $attr6_style?>" <?php }
            if	( isset($attr6_class  )) { ?> class="<?php echo $attr6_class ?>"  <?php }
            if	( isset($attr6_colspan)) { ?> colspan="<?php echo $attr6_colspan ?>"  <?php }
            if	( isset($attr6_rowspan)) { ?> rowspan="<?php echo $attr6_rowspan ?>" <?php }
            ?>><?php unset($attr6_class); ?><?php  $attr7_class='text';  $attr7_var='user';  $attr7_escape=true;  ?>              <?php
              	if	( isset($attr7_prefix)&& isset($attr7_key))
              		$attr7_key = $attr7_prefix.$attr7_key;
              	if	( isset($attr7_suffix)&& isset($attr7_key))
              		$attr7_key = $attr7_key.$attr7_suffix;
              	if(empty($attr7_title))
              			$attr7_title = '';
              	if	(empty($attr7_type))
              		$tmp_tag = 'span';
              	else
              		switch( $attr7_type )
              		{
              			case 'emphatic':
              			case 'italic':
              				$tmp_tag = 'em';
              				break;
              			case 'strong':
              			case 'bold':
              				$tmp_tag = 'strong';
              				break;
              			case 'tt':
              			case 'teletype':
              				$tmp_tag = 'tt';
              				break;
              			default:
              				$tmp_tag = 'span';
              		}
              ?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
              	$attr7_title = '';
              	if	( $attr7_escape )
              		$langF = 'langHtml';
              	else
              		$langF = 'lang';
              	if (!empty($attr7_array))
              	{
              		$tmpArray = $$attr7_array;
              		if (!empty($attr7_var))
              			$tmp_text = $tmpArray[$attr7_var];
              		else
              			$tmp_text = $langF($tmpArray[$attr7_text]);
              	}
              	elseif (!empty($attr7_text))
              		$tmp_text = $langF($attr7_text);
              	elseif (!empty($attr7_textvar))
              		$tmp_text = $langF($$attr7_textvar);
              	elseif (!empty($attr7_key))
              		$tmp_text = $langF($attr7_key);
              	elseif (!empty($attr7_var))
              		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
              	elseif (!empty($attr7_raw))
              		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
              	elseif (!empty($attr7_value))
              		$tmp_text = $attr7_value;
              	else
              	  $tmp_text = '&nbsp;';
              	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
              		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
              	if	(isset($attr7_accesskey))
              	{
              		$pos = strpos(strtolower($tmp_text),strtolower($attr7_accesskey));
              		if	( $pos !== false )
              			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
              	}
              	echo $tmp_text;
              	unset($tmp_text);
              ?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_var);unset($attr7_escape); ?><?php  ?>          </td><?php  ?><?php  $attr6_class='fx';  ?>            <?php
            	$column_class_idx++;
            	if ($column_class_idx > count($column_classes))
            		$column_class_idx=1;
            	$column_class=$column_classes[$column_class_idx-1];
            	if (empty($attr6_class))
            		$attr6_class=$column_class;
            	global $cell_column_nr;
            	$cell_column_nr++;
            	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
            		$attr6_width=$column_widths[$cell_column_nr-1];
            ?><td<?php
            if	( isset($attr6_width  )) { ?> width="<?php echo $attr6_width ?>" <?php }
            if	( isset($attr6_style  )) { ?> style="<?php echo $attr6_style?>" <?php }
            if	( isset($attr6_class  )) { ?> class="<?php echo $attr6_class ?>"  <?php }
            if	( isset($attr6_colspan)) { ?> colspan="<?php echo $attr6_colspan ?>"  <?php }
            if	( isset($attr6_rowspan)) { ?> rowspan="<?php echo $attr6_rowspan ?>" <?php }
            ?>><?php unset($attr6_class); ?><?php  $attr7_class='text';  $attr7_var='value';  $attr7_escape=true;  ?>              <?php
              	if	( isset($attr7_prefix)&& isset($attr7_key))
              		$attr7_key = $attr7_prefix.$attr7_key;
              	if	( isset($attr7_suffix)&& isset($attr7_key))
              		$attr7_key = $attr7_key.$attr7_suffix;
              	if(empty($attr7_title))
              			$attr7_title = '';
              	if	(empty($attr7_type))
              		$tmp_tag = 'span';
              	else
              		switch( $attr7_type )
              		{
              			case 'emphatic':
              			case 'italic':
              				$tmp_tag = 'em';
              				break;
              			case 'strong':
              			case 'bold':
              				$tmp_tag = 'strong';
              				break;
              			case 'tt':
              			case 'teletype':
              				$tmp_tag = 'tt';
              				break;
              			default:
              				$tmp_tag = 'span';
              		}
              ?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
              	$attr7_title = '';
              	if	( $attr7_escape )
              		$langF = 'langHtml';
              	else
              		$langF = 'lang';
              	if (!empty($attr7_array))
              	{
              		$tmpArray = $$attr7_array;
              		if (!empty($attr7_var))
              			$tmp_text = $tmpArray[$attr7_var];
              		else
              			$tmp_text = $langF($tmpArray[$attr7_text]);
              	}
              	elseif (!empty($attr7_text))
              		$tmp_text = $langF($attr7_text);
              	elseif (!empty($attr7_textvar))
              		$tmp_text = $langF($$attr7_textvar);
              	elseif (!empty($attr7_key))
              		$tmp_text = $langF($attr7_key);
              	elseif (!empty($attr7_var))
              		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
              	elseif (!empty($attr7_raw))
              		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
              	elseif (!empty($attr7_value))
              		$tmp_text = $attr7_value;
              	else
              	  $tmp_text = '&nbsp;';
              	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
              		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
              	if	(isset($attr7_accesskey))
              	{
              		$pos = strpos(strtolower($tmp_text),strtolower($attr7_accesskey));
              		if	( $pos !== false )
              			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
              	}
              	echo $tmp_text;
              	unset($tmp_text);
              ?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_var);unset($attr7_escape); ?><?php  ?>          </td><?php  ?><?php  $attr6_class='fx';  ?>            <?php
            	$column_class_idx++;
            	if ($column_class_idx > count($column_classes))
            		$column_class_idx=1;
            	$column_class=$column_classes[$column_class_idx-1];
            	if (empty($attr6_class))
            		$attr6_class=$column_class;
            	global $cell_column_nr;
            	$cell_column_nr++;
            	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
            		$attr6_width=$column_widths[$cell_column_nr-1];
            ?><td<?php
            if	( isset($attr6_width  )) { ?> width="<?php echo $attr6_width ?>" <?php }
            if	( isset($attr6_style  )) { ?> style="<?php echo $attr6_style?>" <?php }
            if	( isset($attr6_class  )) { ?> class="<?php echo $attr6_class ?>"  <?php }
            if	( isset($attr6_colspan)) { ?> colspan="<?php echo $attr6_colspan ?>"  <?php }
            if	( isset($attr6_rowspan)) { ?> rowspan="<?php echo $attr6_rowspan ?>" <?php }
            ?>><?php unset($attr6_class); ?><?php  $attr7_true=$public;  ?>              <?php 
              	if	(gettype($attr7_true) === '' && gettype($attr7_true) === '1')
              		$attr7_tmp_exec = $$attr7_true == true;
              	else
              		$attr7_tmp_exec = $attr7_true == true;
              	$attr7_tmp_last_exec = $attr7_tmp_exec;
              	if	( $attr7_tmp_exec )
              	{
              ?>
<?php unset($attr7_true); ?><?php  $attr8_class='text';  $attr8_key='GLOBAL_PUBLIC';  $attr8_escape=true;  $attr8_type='strong';  ?>                <?php
                	if	( isset($attr8_prefix)&& isset($attr8_key))
                		$attr8_key = $attr8_prefix.$attr8_key;
                	if	( isset($attr8_suffix)&& isset($attr8_key))
                		$attr8_key = $attr8_key.$attr8_suffix;
                	if(empty($attr8_title))
                			$attr8_title = '';
                	if	(empty($attr8_type))
                		$tmp_tag = 'span';
                	else
                		switch( $attr8_type )
                		{
                			case 'emphatic':
                			case 'italic':
                				$tmp_tag = 'em';
                				break;
                			case 'strong':
                			case 'bold':
                				$tmp_tag = 'strong';
                				break;
                			case 'tt':
                			case 'teletype':
                				$tmp_tag = 'tt';
                				break;
                			default:
                				$tmp_tag = 'span';
                		}
                ?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
                	$attr8_title = '';
                	if	( $attr8_escape )
                		$langF = 'langHtml';
                	else
                		$langF = 'lang';
                	if (!empty($attr8_array))
                	{
                		$tmpArray = $$attr8_array;
                		if (!empty($attr8_var))
                			$tmp_text = $tmpArray[$attr8_var];
                		else
                			$tmp_text = $langF($tmpArray[$attr8_text]);
                	}
                	elseif (!empty($attr8_text))
                		$tmp_text = $langF($attr8_text);
                	elseif (!empty($attr8_textvar))
                		$tmp_text = $langF($$attr8_textvar);
                	elseif (!empty($attr8_key))
                		$tmp_text = $langF($attr8_key);
                	elseif (!empty($attr8_var))
                		$tmp_text = isset($$attr8_var)?$$attr8_var:'?unset:'.$attr8_var.'?';	
                	elseif (!empty($attr8_raw))
                		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
                	elseif (!empty($attr8_value))
                		$tmp_text = $attr8_value;
                	else
                	  $tmp_text = '&nbsp;';
                	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
                		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
                	if	(isset($attr8_accesskey))
                	{
                		$pos = strpos(strtolower($tmp_text),strtolower($attr8_accesskey));
                		if	( $pos !== false )
                			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
                	}
                	echo $tmp_text;
                	unset($tmp_text);
                ?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_key);unset($attr8_escape);unset($attr8_type); ?><?php  ?>            <?php } ?><?php  ?><?php  ?>              <?php if (!$attr7_tmp_last_exec) { ?>
<?php  ?><?php  $attr8_present='releaseUrl';  ?>                <?php 
                	$attr8_tmp_exec = isset($$attr8_present);
                	$attr8_tmp_last_exec = $attr8_tmp_exec;
                	if	( $attr8_tmp_exec )
                	{
                ?>
<?php unset($attr8_present); ?><?php  $attr9_title=lang('GLOBAL_RELEASE_DESC');  $attr9_target='_self';  $attr9_url=$releaseUrl;  $attr9_class='';  ?>                  <?php
                  	$params = array();
                  	if (!empty($attr9_var1) && isset($attr9_value1))
                  		$params[$attr9_var1]=$attr9_value1;
                  	if (!empty($attr9_var2) && isset($attr9_value2))
                  		$params[$attr9_var2]=$attr9_value2;
                  	if (!empty($attr9_var3) && isset($attr9_value3))
                  		$params[$attr9_var3]=$attr9_value3;
                  	if (!empty($attr9_var4) && isset($attr9_value4))
                  		$params[$attr9_var4]=$attr9_value4;
                  	if (!empty($attr9_var5) && isset($attr9_value5))
                  		$params[$attr9_var5]=$attr9_value5;
                  	if(empty($attr9_class))
                  		$attr9_class='';
                  	if(empty($attr9_title))
                  		$attr9_title = '';
                  	if(!empty($attr9_url))
                  		$tmp_url = $attr9_url;
                  	else
                  		$tmp_url = Html::url($attr9_action,$attr9_subaction,!empty($attr9_id)?$attr9_id:$this->getRequestId(),$params);
                  ?><a<?php if (isset($attr9_name)) echo ' name="'.$attr9_name.'"'; else echo ' href="'.$tmp_url.($attr9_anchor?'#'.$attr9_anchor:'').'"' ?> class="<?php echo $attr9_class ?>" target="<?php echo $attr9_target ?>"<?php if (isset($attr9_accesskey)) echo ' accesskey="'.$attr9_accesskey.'"' ?>  title="<?php echo encodeHtml($attr9_title) ?>"><?php unset($attr9_title);unset($attr9_target);unset($attr9_url);unset($attr9_class); ?><?php  $attr10_class='text';  $attr10_key='GLOBAL_RELEASE';  $attr10_escape=true;  $attr10_type='strong';  ?>                    <?php
                    	if	( isset($attr10_prefix)&& isset($attr10_key))
                    		$attr10_key = $attr10_prefix.$attr10_key;
                    	if	( isset($attr10_suffix)&& isset($attr10_key))
                    		$attr10_key = $attr10_key.$attr10_suffix;
                    	if(empty($attr10_title))
                    			$attr10_title = '';
                    	if	(empty($attr10_type))
                    		$tmp_tag = 'span';
                    	else
                    		switch( $attr10_type )
                    		{
                    			case 'emphatic':
                    			case 'italic':
                    				$tmp_tag = 'em';
                    				break;
                    			case 'strong':
                    			case 'bold':
                    				$tmp_tag = 'strong';
                    				break;
                    			case 'tt':
                    			case 'teletype':
                    				$tmp_tag = 'tt';
                    				break;
                    			default:
                    				$tmp_tag = 'span';
                    		}
                    ?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
                    	$attr10_title = '';
                    	if	( $attr10_escape )
                    		$langF = 'langHtml';
                    	else
                    		$langF = 'lang';
                    	if (!empty($attr10_array))
                    	{
                    		$tmpArray = $$attr10_array;
                    		if (!empty($attr10_var))
                    			$tmp_text = $tmpArray[$attr10_var];
                    		else
                    			$tmp_text = $langF($tmpArray[$attr10_text]);
                    	}
                    	elseif (!empty($attr10_text))
                    		$tmp_text = $langF($attr10_text);
                    	elseif (!empty($attr10_textvar))
                    		$tmp_text = $langF($$attr10_textvar);
                    	elseif (!empty($attr10_key))
                    		$tmp_text = $langF($attr10_key);
                    	elseif (!empty($attr10_var))
                    		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
                    	elseif (!empty($attr10_raw))
                    		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
                    	elseif (!empty($attr10_value))
                    		$tmp_text = $attr10_value;
                    	else
                    	  $tmp_text = '&nbsp;';
                    	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
                    		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
                    	if	(isset($attr10_accesskey))
                    	{
                    		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
                    		if	( $pos !== false )
                    			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
                    	}
                    	echo $tmp_text;
                    	unset($tmp_text);
                    ?></<?php echo $tmp_tag ?>><?php unset($attr10_class);unset($attr10_key);unset($attr10_escape);unset($attr10_type); ?><?php  ?>                </a><?php  ?><?php  ?>              <?php } ?><?php  ?><?php  ?>                <?php if (!$attr8_tmp_last_exec) { ?>
<?php  ?><?php  $attr9_class='text';  $attr9_key='GLOBAL_INACTIVE';  $attr9_escape=true;  $attr9_type='emphatic';  ?>                  <?php
                  	if	( isset($attr9_prefix)&& isset($attr9_key))
                  		$attr9_key = $attr9_prefix.$attr9_key;
                  	if	( isset($attr9_suffix)&& isset($attr9_key))
                  		$attr9_key = $attr9_key.$attr9_suffix;
                  	if(empty($attr9_title))
                  			$attr9_title = '';
                  	if	(empty($attr9_type))
                  		$tmp_tag = 'span';
                  	else
                  		switch( $attr9_type )
                  		{
                  			case 'emphatic':
                  			case 'italic':
                  				$tmp_tag = 'em';
                  				break;
                  			case 'strong':
                  			case 'bold':
                  				$tmp_tag = 'strong';
                  				break;
                  			case 'tt':
                  			case 'teletype':
                  				$tmp_tag = 'tt';
                  				break;
                  			default:
                  				$tmp_tag = 'span';
                  		}
                  ?><<?php echo $tmp_tag ?> class="<?php echo $attr9_class ?>" title="<?php echo $attr9_title ?>"><?php
                  	$attr9_title = '';
                  	if	( $attr9_escape )
                  		$langF = 'langHtml';
                  	else
                  		$langF = 'lang';
                  	if (!empty($attr9_array))
                  	{
                  		$tmpArray = $$attr9_array;
                  		if (!empty($attr9_var))
                  			$tmp_text = $tmpArray[$attr9_var];
                  		else
                  			$tmp_text = $langF($tmpArray[$attr9_text]);
                  	}
                  	elseif (!empty($attr9_text))
                  		$tmp_text = $langF($attr9_text);
                  	elseif (!empty($attr9_textvar))
                  		$tmp_text = $langF($$attr9_textvar);
                  	elseif (!empty($attr9_key))
                  		$tmp_text = $langF($attr9_key);
                  	elseif (!empty($attr9_var))
                  		$tmp_text = isset($$attr9_var)?$$attr9_var:'?unset:'.$attr9_var.'?';	
                  	elseif (!empty($attr9_raw))
                  		$tmp_text = str_replace('_','&nbsp;',$attr9_raw);
                  	elseif (!empty($attr9_value))
                  		$tmp_text = $attr9_value;
                  	else
                  	  $tmp_text = '&nbsp;';
                  	if	( !empty($attr9_maxlength) && intval($attr9_maxlength)!=0  )
                  		$tmp_text = Text::maxLength( $tmp_text,intval($attr9_maxlength) );
                  	if	(isset($attr9_accesskey))
                  	{
                  		$pos = strpos(strtolower($tmp_text),strtolower($attr9_accesskey));
                  		if	( $pos !== false )
                  			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
                  	}
                  	echo $tmp_text;
                  	unset($tmp_text);
                  ?></<?php echo $tmp_tag ?>><?php unset($attr9_class);unset($attr9_key);unset($attr9_escape);unset($attr9_type); ?><?php  ?>              <?php }
              unset($attr7_tmp_last_exec) ?><?php  ?><?php  ?>            <?php }
            unset($attr6_tmp_last_exec) ?><?php  ?><?php  ?>          </td><?php  ?><?php  $attr6_class='fx';  ?>            <?php
            	$column_class_idx++;
            	if ($column_class_idx > count($column_classes))
            		$column_class_idx=1;
            	$column_class=$column_classes[$column_class_idx-1];
            	if (empty($attr6_class))
            		$attr6_class=$column_class;
            	global $cell_column_nr;
            	$cell_column_nr++;
            	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
            		$attr6_width=$column_widths[$cell_column_nr-1];
            ?><td<?php
            if	( isset($attr6_width  )) { ?> width="<?php echo $attr6_width ?>" <?php }
            if	( isset($attr6_style  )) { ?> style="<?php echo $attr6_style?>" <?php }
            if	( isset($attr6_class  )) { ?> class="<?php echo $attr6_class ?>"  <?php }
            if	( isset($attr6_colspan)) { ?> colspan="<?php echo $attr6_colspan ?>"  <?php }
            if	( isset($attr6_rowspan)) { ?> rowspan="<?php echo $attr6_rowspan ?>" <?php }
            ?>><?php unset($attr6_class); ?><?php  $attr7_true=$active;  ?>              <?php 
              	if	(gettype($attr7_true) === '' && gettype($attr7_true) === '1')
              		$attr7_tmp_exec = $$attr7_true == true;
              	else
              		$attr7_tmp_exec = $attr7_true == true;
              	$attr7_tmp_last_exec = $attr7_tmp_exec;
              	if	( $attr7_tmp_exec )
              	{
              ?>
<?php unset($attr7_true); ?><?php  $attr8_class='text';  $attr8_key='GLOBAL_ACTIVE';  $attr8_escape=true;  $attr8_type='emphatic';  ?>                <?php
                	if	( isset($attr8_prefix)&& isset($attr8_key))
                		$attr8_key = $attr8_prefix.$attr8_key;
                	if	( isset($attr8_suffix)&& isset($attr8_key))
                		$attr8_key = $attr8_key.$attr8_suffix;
                	if(empty($attr8_title))
                			$attr8_title = '';
                	if	(empty($attr8_type))
                		$tmp_tag = 'span';
                	else
                		switch( $attr8_type )
                		{
                			case 'emphatic':
                			case 'italic':
                				$tmp_tag = 'em';
                				break;
                			case 'strong':
                			case 'bold':
                				$tmp_tag = 'strong';
                				break;
                			case 'tt':
                			case 'teletype':
                				$tmp_tag = 'tt';
                				break;
                			default:
                				$tmp_tag = 'span';
                		}
                ?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
                	$attr8_title = '';
                	if	( $attr8_escape )
                		$langF = 'langHtml';
                	else
                		$langF = 'lang';
                	if (!empty($attr8_array))
                	{
                		$tmpArray = $$attr8_array;
                		if (!empty($attr8_var))
                			$tmp_text = $tmpArray[$attr8_var];
                		else
                			$tmp_text = $langF($tmpArray[$attr8_text]);
                	}
                	elseif (!empty($attr8_text))
                		$tmp_text = $langF($attr8_text);
                	elseif (!empty($attr8_textvar))
                		$tmp_text = $langF($$attr8_textvar);
                	elseif (!empty($attr8_key))
                		$tmp_text = $langF($attr8_key);
                	elseif (!empty($attr8_var))
                		$tmp_text = isset($$attr8_var)?$$attr8_var:'?unset:'.$attr8_var.'?';	
                	elseif (!empty($attr8_raw))
                		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
                	elseif (!empty($attr8_value))
                		$tmp_text = $attr8_value;
                	else
                	  $tmp_text = '&nbsp;';
                	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
                		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
                	if	(isset($attr8_accesskey))
                	{
                		$pos = strpos(strtolower($tmp_text),strtolower($attr8_accesskey));
                		if	( $pos !== false )
                			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
                	}
                	echo $tmp_text;
                	unset($tmp_text);
                ?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_key);unset($attr8_escape);unset($attr8_type); ?><?php  ?>            <?php } ?><?php  ?><?php  ?>              <?php if (!$attr7_tmp_last_exec) { ?>
<?php  ?><?php  $attr8_present='useUrl';  ?>                <?php 
                	$attr8_tmp_exec = isset($$attr8_present);
                	$attr8_tmp_last_exec = $attr8_tmp_exec;
                	if	( $attr8_tmp_exec )
                	{
                ?>
<?php unset($attr8_present); ?><?php  $attr9_title=lang('GLOBAL_USE_DESC');  $attr9_target='_self';  $attr9_url=$useUrl;  $attr9_class='';  ?>                  <?php
                  	$params = array();
                  	if (!empty($attr9_var1) && isset($attr9_value1))
                  		$params[$attr9_var1]=$attr9_value1;
                  	if (!empty($attr9_var2) && isset($attr9_value2))
                  		$params[$attr9_var2]=$attr9_value2;
                  	if (!empty($attr9_var3) && isset($attr9_value3))
                  		$params[$attr9_var3]=$attr9_value3;
                  	if (!empty($attr9_var4) && isset($attr9_value4))
                  		$params[$attr9_var4]=$attr9_value4;
                  	if (!empty($attr9_var5) && isset($attr9_value5))
                  		$params[$attr9_var5]=$attr9_value5;
                  	if(empty($attr9_class))
                  		$attr9_class='';
                  	if(empty($attr9_title))
                  		$attr9_title = '';
                  	if(!empty($attr9_url))
                  		$tmp_url = $attr9_url;
                  	else
                  		$tmp_url = Html::url($attr9_action,$attr9_subaction,!empty($attr9_id)?$attr9_id:$this->getRequestId(),$params);
                  ?><a<?php if (isset($attr9_name)) echo ' name="'.$attr9_name.'"'; else echo ' href="'.$tmp_url.($attr9_anchor?'#'.$attr9_anchor:'').'"' ?> class="<?php echo $attr9_class ?>" target="<?php echo $attr9_target ?>"<?php if (isset($attr9_accesskey)) echo ' accesskey="'.$attr9_accesskey.'"' ?>  title="<?php echo encodeHtml($attr9_title) ?>"><?php unset($attr9_title);unset($attr9_target);unset($attr9_url);unset($attr9_class); ?><?php  $attr10_class='text';  $attr10_key='GLOBAL_USE';  $attr10_escape=true;  ?>                    <?php
                    	if	( isset($attr10_prefix)&& isset($attr10_key))
                    		$attr10_key = $attr10_prefix.$attr10_key;
                    	if	( isset($attr10_suffix)&& isset($attr10_key))
                    		$attr10_key = $attr10_key.$attr10_suffix;
                    	if(empty($attr10_title))
                    			$attr10_title = '';
                    	if	(empty($attr10_type))
                    		$tmp_tag = 'span';
                    	else
                    		switch( $attr10_type )
                    		{
                    			case 'emphatic':
                    			case 'italic':
                    				$tmp_tag = 'em';
                    				break;
                    			case 'strong':
                    			case 'bold':
                    				$tmp_tag = 'strong';
                    				break;
                    			case 'tt':
                    			case 'teletype':
                    				$tmp_tag = 'tt';
                    				break;
                    			default:
                    				$tmp_tag = 'span';
                    		}
                    ?><<?php echo $tmp_tag ?> class="<?php echo $attr10_class ?>" title="<?php echo $attr10_title ?>"><?php
                    	$attr10_title = '';
                    	if	( $attr10_escape )
                    		$langF = 'langHtml';
                    	else
                    		$langF = 'lang';
                    	if (!empty($attr10_array))
                    	{
                    		$tmpArray = $$attr10_array;
                    		if (!empty($attr10_var))
                    			$tmp_text = $tmpArray[$attr10_var];
                    		else
                    			$tmp_text = $langF($tmpArray[$attr10_text]);
                    	}
                    	elseif (!empty($attr10_text))
                    		$tmp_text = $langF($attr10_text);
                    	elseif (!empty($attr10_textvar))
                    		$tmp_text = $langF($$attr10_textvar);
                    	elseif (!empty($attr10_key))
                    		$tmp_text = $langF($attr10_key);
                    	elseif (!empty($attr10_var))
                    		$tmp_text = isset($$attr10_var)?$$attr10_var:'?unset:'.$attr10_var.'?';	
                    	elseif (!empty($attr10_raw))
                    		$tmp_text = str_replace('_','&nbsp;',$attr10_raw);
                    	elseif (!empty($attr10_value))
                    		$tmp_text = $attr10_value;
                    	else
                    	  $tmp_text = '&nbsp;';
                    	if	( !empty($attr10_maxlength) && intval($attr10_maxlength)!=0  )
                    		$tmp_text = Text::maxLength( $tmp_text,intval($attr10_maxlength) );
                    	if	(isset($attr10_accesskey))
                    	{
                    		$pos = strpos(strtolower($tmp_text),strtolower($attr10_accesskey));
                    		if	( $pos !== false )
                    			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
                    	}
                    	echo $tmp_text;
                    	unset($tmp_text);
                    ?></<?php echo $tmp_tag ?>><?php unset($attr10_class);unset($attr10_key);unset($attr10_escape); ?><?php  ?>                </a><?php  ?><?php  ?>              <?php } ?><?php  ?><?php  ?>            <?php }
            unset($attr6_tmp_last_exec) ?><?php  ?><?php  ?>          </td><?php  ?><?php  ?>        </tr><?php  ?><?php  ?>      <?php } ?><?php  ?><?php  $attr4_present='compareid';  ?>        <?php 
        	$attr4_tmp_exec = isset($$attr4_present);
        	$attr4_tmp_last_exec = $attr4_tmp_exec;
        	if	( $attr4_tmp_exec )
        	{
        ?>
<?php unset($attr4_present); ?><?php  ?>          <?php
          	$row_class_idx++;
          	if ($row_class_idx > count($row_classes))
          		$row_class_idx=1;
          	$row_class=$row_classes[$row_class_idx-1];
          	if (empty($attr5_class))
          		$attr5_class=$row_class;
          	global $cell_column_nr;
          	$cell_column_nr=0;
          	$column_class_idx = 999;
          ?><tr class="<?php echo $attr5_class ?>"><?php  ?><?php  $attr6_class='act';  $attr6_colspan='8';  ?>            <?php
            	$column_class_idx++;
            	if ($column_class_idx > count($column_classes))
            		$column_class_idx=1;
            	$column_class=$column_classes[$column_class_idx-1];
            	if (empty($attr6_class))
            		$attr6_class=$column_class;
            	global $cell_column_nr;
            	$cell_column_nr++;
            	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
            		$attr6_width=$column_widths[$cell_column_nr-1];
            ?><td<?php
            if	( isset($attr6_width  )) { ?> width="<?php echo $attr6_width ?>" <?php }
            if	( isset($attr6_style  )) { ?> style="<?php echo $attr6_style?>" <?php }
            if	( isset($attr6_class  )) { ?> class="<?php echo $attr6_class ?>"  <?php }
            if	( isset($attr6_colspan)) { ?> colspan="<?php echo $attr6_colspan ?>"  <?php }
            if	( isset($attr6_rowspan)) { ?> rowspan="<?php echo $attr6_rowspan ?>" <?php }
            ?>><?php unset($attr6_class);unset($attr6_colspan); ?><?php  $attr7_type='ok';  $attr7_class='ok';  $attr7_value='ok';  $attr7_text='button_ok';  ?>              <?php
              	if ($attr7_type=='ok')
              	{
              		if ($this->isEditable() && !$this->isEditMode())
              		$attr7_text = 'MODE_EDIT';
              	}
              	if ($attr7_type=='ok')
              		$attr7_type  = 'submit';
              	if (isset($attr7_src))
              		$attr7_type  = 'image';
              	else
              		$attr7_src  = '';
              ?><input type="<?php echo $attr7_type ?>"<?php if(isset($attr7_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr7_value ?>" class="<?php echo $attr7_class ?>" title="<?php echo lang($attr7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($attr7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr7_src) ?><?php
              ?><?php unset($attr7_type);unset($attr7_class);unset($attr7_value);unset($attr7_text); ?><?php  ?>          </td><?php  ?><?php  ?>        </tr><?php  ?><?php  ?>      <?php } ?><?php  ?><?php  ?>          </table>
    	</td>
      </tr>
    </table>
    </center>
    <?php if ($showDuration)
          { ?>
    <br/>
    <center><small>&nbsp;
    <?php $dur = time()-START_TIME;
          echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small></center>
    <?php } ?>
<?php  ?><?php  ?>  </form>
<?php  ?><?php  ?></body>
</html><?php  ?>