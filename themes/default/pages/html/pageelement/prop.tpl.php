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
    ?><?php unset($attr2_name);unset($attr2_target);unset($attr2_method);unset($attr2_enctype); ?><?php  $attr3_icon='folder';  $attr3_widths='40%,60%';  $attr3_width='93%';  $attr3_rowclasses='odd,even';  $attr3_columnclasses='1,2,3';  ?>      <?php
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
<?php unset($attr3_icon);unset($attr3_widths);unset($attr3_width);unset($attr3_rowclasses);unset($attr3_columnclasses); ?><?php  ?>        <?php
        	$row_class_idx++;
        	if ($row_class_idx > count($row_classes))
        		$row_class_idx=1;
        	$row_class=$row_classes[$row_class_idx-1];
        	if (empty($attr4_class))
        		$attr4_class=$row_class;
        	global $cell_column_nr;
        	$cell_column_nr=0;
        	$column_class_idx = 999;
        ?><tr class="<?php echo $attr4_class ?>"><?php  ?><?php  ?>          <?php
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
          ?>><?php  ?><?php  $attr6_class='text';  $attr6_text='name';  $attr6_escape=true;  ?>            <?php
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
            ?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?>        </td><?php  ?><?php  $attr5_class='name';  ?>          <?php
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
          ?>><?php unset($attr5_class); ?><?php  $attr6_class='text';  $attr6_var='name';  $attr6_escape=true;  ?>            <?php
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
            ?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_var);unset($attr6_escape); ?><?php  ?>        </td><?php  ?><?php  ?>      </tr><?php  ?><?php  ?>        <?php
        	$row_class_idx++;
        	if ($row_class_idx > count($row_classes))
        		$row_class_idx=1;
        	$row_class=$row_classes[$row_class_idx-1];
        	if (empty($attr4_class))
        		$attr4_class=$row_class;
        	global $cell_column_nr;
        	$cell_column_nr=0;
        	$column_class_idx = 999;
        ?><tr class="<?php echo $attr4_class ?>"><?php  ?><?php  ?>          <?php
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
          ?>><?php  ?><?php  $attr6_class='text';  $attr6_text='description';  $attr6_escape=true;  ?>            <?php
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
            ?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?>        </td><?php  ?><?php  ?>          <?php
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
          ?>><?php  ?><?php  $attr6_class='text';  $attr6_var='description';  $attr6_escape=true;  ?>            <?php
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
            ?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_var);unset($attr6_escape); ?><?php  ?>        </td><?php  ?><?php  ?>      </tr><?php  ?><?php  ?>        <?php
        	$row_class_idx++;
        	if ($row_class_idx > count($row_classes))
        		$row_class_idx=1;
        	$row_class=$row_classes[$row_class_idx-1];
        	if (empty($attr4_class))
        		$attr4_class=$row_class;
        	global $cell_column_nr;
        	$cell_column_nr=0;
        	$column_class_idx = 999;
        ?><tr class="<?php echo $attr4_class ?>"><?php  ?><?php  ?>          <?php
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
          ?>><?php  ?><?php  $attr6_class='text';  $attr6_text='type';  $attr6_escape=true;  ?>            <?php
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
            ?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?>        </td><?php  ?><?php  $attr5_class='filename';  ?>          <?php
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
          ?>><?php unset($attr5_class); ?><?php  $attr6_align='left';  $attr6_elementtype=$element_type;  ?>            <?php
            	$attr6_tmp_image_file = $image_dir.'icon_el_'.$attr6_elementtype.IMG_ICON_EXT;
            	$attr6_size           = '16x16';
            ?><img src="<?php echo $attr6_tmp_image_file ?>" border="0"<?php if(isset($attr6_align)) echo ' align="'.$attr6_align.'"' ?><?php if (isset($attr6_size)) { list($attr6_tmp_width,$attr6_tmp_height)=explode('x',$attr6_size);echo ' width="'.$attr6_tmp_width.'" height="'.$attr6_tmp_height.'"';} ?>><?php unset($attr6_align);unset($attr6_elementtype); ?><?php  $attr6_class='text';  $attr6_key='el_'.$element_type.'';  $attr6_escape=true;  ?>            <?php
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
            ?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_key);unset($attr6_escape); ?><?php  ?>        </td><?php  ?><?php  ?>      </tr><?php  ?><?php  ?>        <?php
        	$row_class_idx++;
        	if ($row_class_idx > count($row_classes))
        		$row_class_idx=1;
        	$row_class=$row_classes[$row_class_idx-1];
        	if (empty($attr4_class))
        		$attr4_class=$row_class;
        	global $cell_column_nr;
        	$cell_column_nr=0;
        	$column_class_idx = 999;
        ?><tr class="<?php echo $attr4_class ?>"><?php  ?><?php  $attr5_colspan='2';  ?>          <?php
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
          ?>><?php unset($attr5_colspan); ?><?php  $attr6_title=lang('additional_info');  ?>            <fieldset><?php if(isset($attr6_title)) { ?><legend><?php echo encodeHtml($attr6_title) ?></legend><?php } ?><?php unset($attr6_title); ?><?php  ?>          </fieldset><?php  ?><?php  ?>        </td><?php  ?><?php  ?>      </tr><?php  ?><?php  ?>        <?php
        	$row_class_idx++;
        	if ($row_class_idx > count($row_classes))
        		$row_class_idx=1;
        	$row_class=$row_classes[$row_class_idx-1];
        	if (empty($attr4_class))
        		$attr4_class=$row_class;
        	global $cell_column_nr;
        	$cell_column_nr=0;
        	$column_class_idx = 999;
        ?><tr class="<?php echo $attr4_class ?>"><?php  ?><?php  ?>          <?php
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
          ?>><?php  ?><?php  $attr6_class='text';  $attr6_key='template';  $attr6_escape=true;  ?>            <?php
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
            ?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_key);unset($attr6_escape); ?><?php  ?>        </td><?php  ?><?php  ?>          <?php
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
          ?>><?php  ?><?php  $attr6_present='template_url';  ?>            <?php 
            #END-IF#
            #END-IF#
            #END-IF#
            #END-IF#
            #END-IF#
            #END-IF#
            #END-IF#
            #IF-ATTR present#
            	$attr6_tmp_exec = isset($$attr6_present);
            #END-IF#
            #END-IF#
            #END-IF#
            	unset($attr6_true);
            	unset($attr6_false);
            	unset($attr6_notempty);
            	unset($attr6_empty);
            	unset($attr6_contains);
            	unset($attr6_present);
            	unset($attr6_invert);
            	unset($attr6_not);
            	unset($attr6_value);
            	unset($attr6_equals);
            	$last_exec = $attr6_tmp_exec;
            	if	( $attr6_tmp_exec )
            	{
            ?>
<?php unset($attr6_present); ?><?php  $attr7_title='';  $attr7_target='cms_main_main';  $attr7_url=$template_url;  $attr7_class='';  ?>              <?php
              	$params = array();
              	if (!empty($attr7_var1) && isset($attr7_value1))
              		$params[$attr7_var1]=$attr7_value1;
              	if (!empty($attr7_var2) && isset($attr7_value2))
              		$params[$attr7_var2]=$attr7_value2;
              	if (!empty($attr7_var3) && isset($attr7_value3))
              		$params[$attr7_var3]=$attr7_value3;
              	if (!empty($attr7_var4) && isset($attr7_value4))
              		$params[$attr7_var4]=$attr7_value4;
              	if (!empty($attr7_var5) && isset($attr7_value5))
              		$params[$attr7_var5]=$attr7_value5;
              	if(empty($attr7_class))
              		$attr7_class='';
              	if(empty($attr7_title))
              		$attr7_title = '';
              	if(!empty($attr7_url))
              		$tmp_url = $attr7_url;
              	else
              		$tmp_url = Html::url($attr7_action,$attr7_subaction,!empty($attr7_id)?$attr7_id:$this->getRequestId(),$params);
              ?><a<?php if (isset($attr7_name)) echo ' name="'.$attr7_name.'"'; else echo ' href="'.$tmp_url.($attr7_anchor?'#'.$attr7_anchor:'').'"' ?> class="<?php echo $attr7_class ?>" target="<?php echo $attr7_target ?>"<?php if (isset($attr7_accesskey)) echo ' accesskey="'.$attr7_accesskey.'"' ?>  title="<?php echo encodeHtml($attr7_title) ?>"><?php unset($attr7_title);unset($attr7_target);unset($attr7_url);unset($attr7_class); ?><?php  $attr8_file='icon_template';  $attr8_align='left';  ?>                <?php
                	$attr8_tmp_image_file = $image_dir.$attr8_fileext;
                	$attr8_tmp_image_file = $image_dir.$attr8_file.IMG_ICON_EXT;
                ?><img src="<?php echo $attr8_tmp_image_file ?>" border="0"<?php if(isset($attr8_align)) echo ' align="'.$attr8_align.'"' ?><?php if (isset($attr8_size)) { list($attr8_tmp_width,$attr8_tmp_height)=explode('x',$attr8_size);echo ' width="'.$attr8_tmp_width.'" height="'.$attr8_tmp_height.'"';} ?>><?php unset($attr8_file);unset($attr8_align); ?><?php  $attr8_class='text';  $attr8_var='template_name';  $attr8_escape=true;  ?>                <?php
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
                ?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_var);unset($attr8_escape); ?><?php  ?>            </a><?php  ?><?php  ?>          <?php } ?><?php  ?><?php  $attr6_empty='template_url';  ?>            <?php 
            #END-IF#
            #END-IF#
            #END-IF#
            #END-IF#
            #END-IF#
            #END-IF#
            #IF-ATTR empty#
            	if	( !isset($$attr6_empty) )
            		$attr6_tmp_exec = empty($attr6_empty);
            	elseif	( is_array($$attr6_empty) )
            		$attr6_tmp_exec = (count($$attr6_empty)==0);
            	elseif	( is_bool($$attr6_empty) )
            		$attr6_tmp_exec = true;
            	else
            		$attr6_tmp_exec = empty( $$attr6_empty );
            #END-IF#
            #END-IF#
            #END-IF#
            #END-IF#
            	unset($attr6_true);
            	unset($attr6_false);
            	unset($attr6_notempty);
            	unset($attr6_empty);
            	unset($attr6_contains);
            	unset($attr6_present);
            	unset($attr6_invert);
            	unset($attr6_not);
            	unset($attr6_value);
            	unset($attr6_equals);
            	$last_exec = $attr6_tmp_exec;
            	if	( $attr6_tmp_exec )
            	{
            ?>
<?php unset($attr6_empty); ?><?php  $attr7_file='icon_template';  $attr7_align='left';  ?>              <?php
              	$attr7_tmp_image_file = $image_dir.$attr7_fileext;
              	$attr7_tmp_image_file = $image_dir.$attr7_file.IMG_ICON_EXT;
              ?><img src="<?php echo $attr7_tmp_image_file ?>" border="0"<?php if(isset($attr7_align)) echo ' align="'.$attr7_align.'"' ?><?php if (isset($attr7_size)) { list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo ' width="'.$attr7_tmp_width.'" height="'.$attr7_tmp_height.'"';} ?>><?php unset($attr7_file);unset($attr7_align); ?><?php  $attr7_class='text';  $attr7_var='template_name';  $attr7_escape=true;  ?>              <?php
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
              ?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_var);unset($attr7_escape); ?><?php  ?>          <?php } ?><?php  ?><?php  ?>        </td><?php  ?><?php  ?>      </tr><?php  ?><?php  ?>        <?php
        	$row_class_idx++;
        	if ($row_class_idx > count($row_classes))
        		$row_class_idx=1;
        	$row_class=$row_classes[$row_class_idx-1];
        	if (empty($attr4_class))
        		$attr4_class=$row_class;
        	global $cell_column_nr;
        	$cell_column_nr=0;
        	$column_class_idx = 999;
        ?><tr class="<?php echo $attr4_class ?>"><?php  ?><?php  ?>          <?php
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
          ?>><?php  ?><?php  $attr6_class='text';  $attr6_key='element';  $attr6_escape=true;  ?>            <?php
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
            ?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_key);unset($attr6_escape); ?><?php  ?>        </td><?php  ?><?php  ?>          <?php
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
          ?>><?php  ?><?php  $attr6_present='element_url';  ?>            <?php 
            #END-IF#
            #END-IF#
            #END-IF#
            #END-IF#
            #END-IF#
            #END-IF#
            #END-IF#
            #IF-ATTR present#
            	$attr6_tmp_exec = isset($$attr6_present);
            #END-IF#
            #END-IF#
            #END-IF#
            	unset($attr6_true);
            	unset($attr6_false);
            	unset($attr6_notempty);
            	unset($attr6_empty);
            	unset($attr6_contains);
            	unset($attr6_present);
            	unset($attr6_invert);
            	unset($attr6_not);
            	unset($attr6_value);
            	unset($attr6_equals);
            	$last_exec = $attr6_tmp_exec;
            	if	( $attr6_tmp_exec )
            	{
            ?>
<?php unset($attr6_present); ?><?php  $attr7_title='';  $attr7_target='cms_main_main';  $attr7_url=$element_url;  $attr7_class='';  ?>              <?php
              	$params = array();
              	if (!empty($attr7_var1) && isset($attr7_value1))
              		$params[$attr7_var1]=$attr7_value1;
              	if (!empty($attr7_var2) && isset($attr7_value2))
              		$params[$attr7_var2]=$attr7_value2;
              	if (!empty($attr7_var3) && isset($attr7_value3))
              		$params[$attr7_var3]=$attr7_value3;
              	if (!empty($attr7_var4) && isset($attr7_value4))
              		$params[$attr7_var4]=$attr7_value4;
              	if (!empty($attr7_var5) && isset($attr7_value5))
              		$params[$attr7_var5]=$attr7_value5;
              	if(empty($attr7_class))
              		$attr7_class='';
              	if(empty($attr7_title))
              		$attr7_title = '';
              	if(!empty($attr7_url))
              		$tmp_url = $attr7_url;
              	else
              		$tmp_url = Html::url($attr7_action,$attr7_subaction,!empty($attr7_id)?$attr7_id:$this->getRequestId(),$params);
              ?><a<?php if (isset($attr7_name)) echo ' name="'.$attr7_name.'"'; else echo ' href="'.$tmp_url.($attr7_anchor?'#'.$attr7_anchor:'').'"' ?> class="<?php echo $attr7_class ?>" target="<?php echo $attr7_target ?>"<?php if (isset($attr7_accesskey)) echo ' accesskey="'.$attr7_accesskey.'"' ?>  title="<?php echo encodeHtml($attr7_title) ?>"><?php unset($attr7_title);unset($attr7_target);unset($attr7_url);unset($attr7_class); ?><?php  $attr8_align='left';  $attr8_elementtype=$element_type;  ?>                <?php
                	$attr8_tmp_image_file = $image_dir.'icon_el_'.$attr8_elementtype.IMG_ICON_EXT;
                	$attr8_size           = '16x16';
                ?><img src="<?php echo $attr8_tmp_image_file ?>" border="0"<?php if(isset($attr8_align)) echo ' align="'.$attr8_align.'"' ?><?php if (isset($attr8_size)) { list($attr8_tmp_width,$attr8_tmp_height)=explode('x',$attr8_size);echo ' width="'.$attr8_tmp_width.'" height="'.$attr8_tmp_height.'"';} ?>><?php unset($attr8_align);unset($attr8_elementtype); ?><?php  $attr8_class='text';  $attr8_var='element_name';  $attr8_escape=true;  ?>                <?php
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
                ?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_var);unset($attr8_escape); ?><?php  ?>            </a><?php  ?><?php  ?>          <?php } ?><?php  ?><?php  $attr6_empty='element_url';  ?>            <?php 
            #END-IF#
            #END-IF#
            #END-IF#
            #END-IF#
            #END-IF#
            #END-IF#
            #IF-ATTR empty#
            	if	( !isset($$attr6_empty) )
            		$attr6_tmp_exec = empty($attr6_empty);
            	elseif	( is_array($$attr6_empty) )
            		$attr6_tmp_exec = (count($$attr6_empty)==0);
            	elseif	( is_bool($$attr6_empty) )
            		$attr6_tmp_exec = true;
            	else
            		$attr6_tmp_exec = empty( $$attr6_empty );
            #END-IF#
            #END-IF#
            #END-IF#
            #END-IF#
            	unset($attr6_true);
            	unset($attr6_false);
            	unset($attr6_notempty);
            	unset($attr6_empty);
            	unset($attr6_contains);
            	unset($attr6_present);
            	unset($attr6_invert);
            	unset($attr6_not);
            	unset($attr6_value);
            	unset($attr6_equals);
            	$last_exec = $attr6_tmp_exec;
            	if	( $attr6_tmp_exec )
            	{
            ?>
<?php unset($attr6_empty); ?><?php  $attr7_icon='element';  $attr7_align='left';  ?>              <?php
              	$attr7_tmp_image_file = $image_dir.'icon_'.$attr7_icon.IMG_ICON_EXT;
              	$attr7_size = '16x16';
              ?><img src="<?php echo $attr7_tmp_image_file ?>" border="0"<?php if(isset($attr7_align)) echo ' align="'.$attr7_align.'"' ?><?php if (isset($attr7_size)) { list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo ' width="'.$attr7_tmp_width.'" height="'.$attr7_tmp_height.'"';} ?>><?php unset($attr7_icon);unset($attr7_align); ?><?php  $attr7_class='text';  $attr7_var='element_name';  $attr7_escape=true;  ?>              <?php
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
              ?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_var);unset($attr7_escape); ?><?php  ?>          <?php } ?><?php  ?><?php  ?>        </td><?php  ?><?php  ?>      </tr><?php  ?><?php  $attr4_present='text';  ?>        <?php 
        #END-IF#
        #END-IF#
        #END-IF#
        #END-IF#
        #END-IF#
        #END-IF#
        #END-IF#
        #IF-ATTR present#
        	$attr4_tmp_exec = isset($$attr4_present);
        #END-IF#
        #END-IF#
        #END-IF#
        	unset($attr4_true);
        	unset($attr4_false);
        	unset($attr4_notempty);
        	unset($attr4_empty);
        	unset($attr4_contains);
        	unset($attr4_present);
        	unset($attr4_invert);
        	unset($attr4_not);
        	unset($attr4_value);
        	unset($attr4_equals);
        	$last_exec = $attr4_tmp_exec;
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
          ?><tr class="<?php echo $attr5_class ?>"><?php  ?><?php  $attr6_colspan='2';  ?>            <?php
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
            ?>><?php unset($attr6_colspan); ?><?php  $attr7_title=lang('DOCUMENT_TREE');  ?>              <fieldset><?php if(isset($attr7_title)) { ?><legend><?php echo encodeHtml($attr7_title) ?></legend><?php } ?><?php unset($attr7_title); ?><?php  ?>            </fieldset><?php  ?><?php  ?>          </td><?php  ?><?php  ?>        </tr><?php  ?><?php  ?>          <?php
          	$row_class_idx++;
          	if ($row_class_idx > count($row_classes))
          		$row_class_idx=1;
          	$row_class=$row_classes[$row_class_idx-1];
          	if (empty($attr5_class))
          		$attr5_class=$row_class;
          	global $cell_column_nr;
          	$cell_column_nr=0;
          	$column_class_idx = 999;
          ?><tr class="<?php echo $attr5_class ?>"><?php  ?><?php  $attr6_colspan='2';  ?>            <?php
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
            ?>><?php unset($attr6_colspan); ?><?php  $attr7_name='text';  $attr7_type='dom';  ?>              <?php
              	function checkbox( $name,$value=false,$writable=true,$params=Array() )
              	{
              		$src = '<input type="checkbox" name="'.$name.'"';
              		foreach( $params as $name=>$val )
              			$src .= " $name=\"$val\"";
              		if	( !$writable )
              			$src .= ' disabled="disabled"';
              		if	( $value )
              			$src .= ' value="1" checked="checked"';
              		$src .= ' />';
              		return $src;
              	}
              	function selectBox( $name,$values,$default='',$params=Array() )
              	{
              		if	( ! is_array($values) )
              			$values = array($values);
              		$src = '<select size="1" name="'.$name.'"';
              		foreach( $params as $name=>$value )
              			$src .= " $name=\"$value\"";
              		$src .= '>';
              		foreach( $values as $key=>$value )
              		{
              			$src .= '<option value="'.$key.'"';
              			if ($key == $default)
              				$src .= ' selected="selected"';
              			$src .= '>'.$value.'</option>';
              		}
              		$src .= '</select>';
              		return $src;
              	}
               ?><?php
              switch( $attr7_type )
              {
              	case 'fckeditor':
              	case 'html':
              		if	( $this->isEditMode() )
              		{
              			include('./editor/fckeditor.php');
              			$editor = new FCKeditor( $attr7_name ) ;
              			$editor->BasePath	= defined('OR_BASE_URL')?slashify(OR_BASE_URL).'editor/':'./editor/';
              			$editor->Value = $$attr7_name;
              			$editor->Height = '290';
              			$editor->Config['CustomConfigurationsPath'] = '../openrat-fckconfig.js';
              			$editor->Create();
              		}
              		else
              		{
              			echo ($$attr7_name);
              		}
              		break;
              	case 'wiki':
              		$conf_tags = $conf['editor']['text-markup'];
              		if	( $this->isEditMode() )
              		{
              		?>
              <script name="Javascript" type="text/javascript" src="<?php echo $tpl_dir ?>../../js/editor.js"></script>
              <script name="JavaScript" type="text/javascript">
              function strong()
              {
              	insert('<?php echo $attr7_name ?>','<?php echo $conf_tags['strong-begin'] ?>','<?php echo $conf_tags['strong-end'] ?>');
              }
              function emphatic()
              {
              	insert('<?php echo $attr7_name ?>','<?php echo $conf_tags['emphatic-begin'] ?>','<?php echo $conf_tags['emphatic-end'] ?>');
              }
              function link()
              {
              	objectid = document.forms[0].objectid.value;
              	if	(objectid=="" ||objectid=="0"||objectid==null)
              		objectid = window.prompt("Id","");
              	if	(objectid=="" ||objectid=="0"||objectid==null)
              		return;
              	insert('<?php echo $attr7_name ?>','"','"<?php echo $conf_tags['linkto'] ?>"'+objectid+'"');
              }
              function image()
              {
              	objectid = document.forms[0].objectid.value;
              	if	(objectid=="" ||objectid=="0"||objectid==null)
              		objectid = window.prompt("Id","");
              	if	(objectid=="" ||objectid=="0"||objectid==null)
              		return;
              	insert('<?php echo $attr7_name ?>','','<?php echo $conf_tags['image-begin'] ?>"'+objectid+'"<?php echo $conf_tags['image-end'] ?>');
              }
              function list()
              {
               	insert('<?php echo $attr7_name ?>',"","\n");
              	while( true )
              	{
              		t = window.prompt('<?php echo lang('EDITOR_PROMPT_LIST_ENTRY') ?>','');
              		if	( t != '' && t != null )
              		 	insert('<?php echo $attr7_name ?>',"<?php echo $conf_tags['list-unnumbered'] ?> "+t+"\n","");
              		else
              			break;
              	}
              }
              function numlist()
              {
              	insert('<?php echo $attr7_name ?>',"\n\n<?php echo $conf_tags['list-numbered'] ?> ","\n<?php echo $conf_tags['list-numbered'] ?> \n<?php echo $conf_tags['list-numbered'] ?> \n");
              }
              function table()
              {
              	column=1;
              	while( true )
              	{
              		if	( column==1 )
              			text='<?php echo lang('EDITOR_PROMPT_TABLE_CELL_FIRST_COLUMN') ?>';
              		else
              			text='<?php echo lang('EDITOR_PROMPT_TABLE_CELL') ?>';
              		t = window.prompt(text,'');
              		if	( t != '' && t != null )
              		{
              		 	insert('<?php echo $attr7_name ?>',"<?php echo $conf_tags['table-cell-sep'] ?>"+t,"");
              		 	column++;
              		}
              		else
              		{
              			if (column==1)
              			{
              				break;
              			}
              			else
              			{
              			 	insert('text',"\n","");
              			 	column=1;
              			 }
              		}
              	}
              }
              </script>
                  <table>
                    <tr>
                      <noscript><input type="text" name="addtext" size="10" /></noscript>
                      <td><noscript><?php echo checkbox('strong') ?></noscript><a href="javascript:strong();" title="<?php echo lang('PAGE_EDITOR_ADD_STRONG') ?>"><img src="<?php echo $image_dir ?>/editor/bold.png" border"0"   /></a></td>
                      <td><noscript><?php echo checkbox('emphatic') ?></noscript><a href="javascript:emphatic();" title="<?php echo lang('PAGE_EDITOR_ADD_EMPHATIC') ?>"><img src="<?php echo $image_dir ?>/editor/italic.png" border"0" /></a></td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td><noscript><?php echo checkbox('table') ?></noscript><a href="javascript:table();" title="<?php echo lang('PAGE_EDITOR_ADD_TABLE') ?>"><img src="<?php echo $image_dir ?>/editor/table.png" border"0" /></a></td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td><noscript><?php echo checkbox('list') ?></noscript><a href="javascript:list();" title="<?php echo lang('PAGE_EDITOR_ADD_LIST') ?>"><img src="<?php echo $image_dir ?>/editor/list.png" border"0" /></a></td>
                      <td><noscript><?php echo checkbox('numlist') ?></noscript><a href="javascript:numlist();" title="<?php echo lang('PAGE_EDITOR_ADD_NUMLIST') ?>"><img src="<?php echo $image_dir ?>/editor/numlist.png" border"0" /></a></td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td><noscript><?php echo checkbox('image') ?></noscript><a href="javascript:image();" title="<?php echo lang('PAGE_EDITOR_ADD_IMAGE') ?>"><img src="<?php echo $image_dir ?>/editor/image.png" border"0" /></a></td>
                      <td><noscript><?php echo checkbox('link') ?></noscript><a href="javascript:link();" title="<?php echo lang('PAGE_EDITOR_ADD_LINK') ?>"><img src="<?php echo $image_dir ?>/editor/link.png" border"0" /></a></td>
                      <td><?php echo selectBox('objectid',$objects) ?><noscript>&nbsp;&nbsp;&nbsp;<input type="submit" class="submit" name="addmarkup" value="<?php echo lang('GLOBAL_ADD') ?>"/></noscript></td>
                      <td>&nbsp;&nbsp;&nbsp;<input type="submit" class="submit" name="preview" value="<?php echo lang('PAGE_PREVIEW') ?>" style="width:200px;"/></td>
                    </tr>
                  </table>
              	<?php ?>
              <?php
              			echo '<textarea name="'.$attr7_name.'" class="editor" style="width:100%;height:300px;">'.$$attr7_name.'</textarea>';
              		}
              		else
              		{
              			$attr7_tmp_doc = new DocumentElement();
              			$attr7_tmp_text = $$attr7_name;
              			if	( !is_array($attr7_tmp_text))
              				$attr7_tmp_text = explode("\n",$attr7_tmp_text);
              			$attr7_tmp_doc->parse($attr7_tmp_text);
              			echo $attr7_tmp_doc->render('application/html');
              		}
              		break;
              	case 'text':
              	case 'raw':
              		if	( $this->isEditMode() )
              			echo '<textarea name="'.$attr7_name.'" class="editor" style="width:100%;height:300px;">'.$$attr7_name.'</textarea>';
              		else
              			echo nl2br($$attr7_name);
              		break;
              	case 'dom':
              	case 'tree':
              		$attr7_tmp_doc = new DocumentElement();
              		$attr7_tmp_text = $$attr7_name;
              		if	( !is_array($attr7_tmp_text))
              			$attr7_tmp_text = explode("\n",$attr7_tmp_text);
              		$attr7_tmp_doc->parse($attr7_tmp_text);
              		echo $attr7_tmp_doc->render('application/html-dom');
              		break;
              	default:
              		echo "Unknown editor type: ".$attr7_type;
              }
              ?><?php unset($attr7_name);unset($attr7_type); ?><?php  ?>          </td><?php  ?><?php  ?>        </tr><?php  ?><?php  ?>      <?php } ?><?php  ?><?php  ?>        <?php
        	$row_class_idx++;
        	if ($row_class_idx > count($row_classes))
        		$row_class_idx=1;
        	$row_class=$row_classes[$row_class_idx-1];
        	if (empty($attr4_class))
        		$attr4_class=$row_class;
        	global $cell_column_nr;
        	$cell_column_nr=0;
        	$column_class_idx = 999;
        ?><tr class="<?php echo $attr4_class ?>"><?php  ?><?php  $attr5_colspan='2';  ?>          <?php
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
          ?>><?php unset($attr5_colspan); ?><?php  $attr6_title=lang('prop_userinfo');  ?>            <fieldset><?php if(isset($attr6_title)) { ?><legend><?php echo encodeHtml($attr6_title) ?></legend><?php } ?><?php unset($attr6_title); ?><?php  ?>          </fieldset><?php  ?><?php  ?>        </td><?php  ?><?php  ?>      </tr><?php  ?><?php  ?>        <?php
        	$row_class_idx++;
        	if ($row_class_idx > count($row_classes))
        		$row_class_idx=1;
        	$row_class=$row_classes[$row_class_idx-1];
        	if (empty($attr4_class))
        		$attr4_class=$row_class;
        	global $cell_column_nr;
        	$cell_column_nr=0;
        	$column_class_idx = 999;
        ?><tr class="<?php echo $attr4_class ?>"><?php  ?><?php  ?>          <?php
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
          ?>><?php  ?><?php  $attr6_class='text';  $attr6_text='lastchange';  $attr6_escape=true;  ?>            <?php
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
            ?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_text);unset($attr6_escape); ?><?php  ?>        </td><?php  ?><?php  ?>          <?php
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
          ?>><?php  ?><?php  $attr6_width='100%';  $attr6_space='0px';  $attr6_padding='0px';  $attr6_rowclasses='odd,even';  ?>            <?php
            	$coloumn_widths=array();
            	$row_classes   = array('');
            	$column_classes= array('');
            	if(empty($attr6_class))
            		$attr6_class='';
            	if	(!empty($attr6_widths))
            	{
            		$column_widths = explode(',',$attr6_widths);
            		unset($attr6['widths']);
            	}
            	if	(!empty($attr6_classes))
            	{
            		$row_classes   = explode(',',$attr6_rowclasses);
            		$row_class_idx = 999;
            		unset($attr6['rowclasses']);
            	}
            	if	(!empty($attr6_rowclasses))
            	{
            		$row_classes   = explode(',',$attr6_rowclasses);
            		$row_class_idx = 999;
            		unset($attr6['rowclasses']);
            	}
            	if	(!empty($attr6_columnclasses))
            	{
            		$column_classes   = explode(',',$attr6_columnclasses);
            		unset($attr6['columnclasses']);
            	}
            ?><table class="<?php echo $attr6_class ?>" cellspacing="<?php echo $attr6_space ?>" width="<?php echo $attr6_width ?>" cellpadding="<?php echo $attr6_padding ?>"><?php unset($attr6_width);unset($attr6_space);unset($attr6_padding);unset($attr6_rowclasses); ?><?php  ?>              <?php
              	$row_class_idx++;
              	if ($row_class_idx > count($row_classes))
              		$row_class_idx=1;
              	$row_class=$row_classes[$row_class_idx-1];
              	if (empty($attr7_class))
              		$attr7_class=$row_class;
              	global $cell_column_nr;
              	$cell_column_nr=0;
              	$column_class_idx = 999;
              ?><tr class="<?php echo $attr7_class ?>"><?php  ?><?php  ?>                <?php
                	$column_class_idx++;
                	if ($column_class_idx > count($column_classes))
                		$column_class_idx=1;
                	$column_class=$column_classes[$column_class_idx-1];
                	if (empty($attr8_class))
                		$attr8_class=$column_class;
                	global $cell_column_nr;
                	$cell_column_nr++;
                	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr8_rowspan) )
                		$attr8_width=$column_widths[$cell_column_nr-1];
                ?><td<?php
                if	( isset($attr8_width  )) { ?> width="<?php echo $attr8_width ?>" <?php }
                if	( isset($attr8_style  )) { ?> style="<?php echo $attr8_style?>" <?php }
                if	( isset($attr8_class  )) { ?> class="<?php echo $attr8_class ?>"  <?php }
                if	( isset($attr8_colspan)) { ?> colspan="<?php echo $attr8_colspan ?>"  <?php }
                if	( isset($attr8_rowspan)) { ?> rowspan="<?php echo $attr8_rowspan ?>" <?php }
                ?>><?php  ?><?php  $attr9_icon='el_date';  $attr9_align='left';  ?>                  <?php
                  	$attr9_tmp_image_file = $image_dir.'icon_'.$attr9_icon.IMG_ICON_EXT;
                  	$attr9_size = '16x16';
                  ?><img src="<?php echo $attr9_tmp_image_file ?>" border="0"<?php if(isset($attr9_align)) echo ' align="'.$attr9_align.'"' ?><?php if (isset($attr9_size)) { list($attr9_tmp_width,$attr9_tmp_height)=explode('x',$attr9_size);echo ' width="'.$attr9_tmp_width.'" height="'.$attr9_tmp_height.'"';} ?>><?php unset($attr9_icon);unset($attr9_align); ?><?php  $attr9_date=$lastchange_date;  ?>                  <?php	
                      global $conf;
                  	$time = $attr9_date;
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
                  ?><?php unset($attr9_date); ?><?php  ?>              </td><?php  ?><?php  ?>                <?php
                	$column_class_idx++;
                	if ($column_class_idx > count($column_classes))
                		$column_class_idx=1;
                	$column_class=$column_classes[$column_class_idx-1];
                	if (empty($attr8_class))
                		$attr8_class=$column_class;
                	global $cell_column_nr;
                	$cell_column_nr++;
                	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr8_rowspan) )
                		$attr8_width=$column_widths[$cell_column_nr-1];
                ?><td<?php
                if	( isset($attr8_width  )) { ?> width="<?php echo $attr8_width ?>" <?php }
                if	( isset($attr8_style  )) { ?> style="<?php echo $attr8_style?>" <?php }
                if	( isset($attr8_class  )) { ?> class="<?php echo $attr8_class ?>"  <?php }
                if	( isset($attr8_colspan)) { ?> colspan="<?php echo $attr8_colspan ?>"  <?php }
                if	( isset($attr8_rowspan)) { ?> rowspan="<?php echo $attr8_rowspan ?>" <?php }
                ?>><?php  ?><?php  $attr9_icon='user';  $attr9_align='left';  ?>                  <?php
                  	$attr9_tmp_image_file = $image_dir.'icon_'.$attr9_icon.IMG_ICON_EXT;
                  	$attr9_size = '16x16';
                  ?><img src="<?php echo $attr9_tmp_image_file ?>" border="0"<?php if(isset($attr9_align)) echo ' align="'.$attr9_align.'"' ?><?php if (isset($attr9_size)) { list($attr9_tmp_width,$attr9_tmp_height)=explode('x',$attr9_size);echo ' width="'.$attr9_tmp_width.'" height="'.$attr9_tmp_height.'"';} ?>><?php unset($attr9_icon);unset($attr9_align); ?><?php  $attr9_user=$lastchange_user;  ?>                  <?php
                  		if	( is_object($attr9_user) )
                  			$user = $attr9_user;
                  		else
                  			$user = $$attr9_user;
                  		if	( empty($user->name) )
                  			$user->name = lang('GLOBAL_UNKNOWN');
                  		if	( empty($user->fullname) )
                  			$user->fullname = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
                  		if	( !empty($user->mail) && $conf['security']['user']['show_mail'] )
                  			echo '<a href="mailto:'.$user->mail.'" title="'.$user->fullname.'">'.$user->name.'</a>';
                  		else
                  			echo '<span title="'.$user->fullname.'">'.$user->name.'</span>';
                  ?><?php unset($attr9_user); ?><?php  ?>              </td><?php  ?><?php  ?>            </tr><?php  ?><?php  ?>          </table><?php  ?><?php  ?>        </td><?php  ?><?php  ?>      </tr><?php  ?><?php  ?>          </table>
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