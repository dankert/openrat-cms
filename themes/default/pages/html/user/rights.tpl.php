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
<?php unset($attr1_class); ?><?php  $attr2_title='ACL';  $attr2_name='x';  $attr2_width='93%';  $attr2_rowclasses='odd,even';  $attr2_columnclasses='1,2,3';  ?>    <?php
    	$coloumn_widths=array();
    	if	(!empty($attr2_widths))
    	{
    		$column_widths = explode(',',$attr2_widths);
    		unset($attr2['widths']);
    	}
    	if	(!empty($attr2_rowclasses))
    	{
    		$row_classes   = explode(',',$attr2_rowclasses);
    		$row_class_idx = 999;
    		unset($attr2['rowclasses']);
    	}
    	if	(!empty($attr2_columnclasses))
    	{
    		$column_classes = explode(',',$attr2_columnclasses);
    		unset($attr2['columnclasses']);
    	}
    		global $image_dir;
    		if (@$conf['interface']['application_mode'] )
    		{
    			echo '<table class="main" cellspacing="0" cellpadding="4" width="100%" style="margin:0px;border:0px; padding:0px;" height_oo="100%">';
    		}
    		else
    		{
    			echo '<br/><br/><br/><center>';
    			echo '<table class="main" cellspacing="0" cellpadding="4" width="'.$attr2_width.'">';
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
<?php unset($attr2_title);unset($attr2_name);unset($attr2_width);unset($attr2_rowclasses);unset($attr2_columnclasses); ?><?php  $attr3_list='projects';  $attr3_extract=true;  $attr3_key='list_key';  $attr3_value='list_value';  ?>      <?php
      	$attr3_list_tmp_key   = $attr3_key;
      	$attr3_list_tmp_value = $attr3_value;
      	$attr3_list_extract   = $attr3_extract;
      	unset($attr3_key);
      	unset($attr3_value);
      	if	( !isset($$attr3_list) || !is_array($$attr3_list) )
      		$$attr3_list = array();
      	foreach( $$attr3_list as $$attr3_list_tmp_key => $$attr3_list_tmp_value )
      	{
      		if	( $attr3_list_extract )
      		{
      			if	( !is_array($$attr3_list_tmp_value) )
      			{
      				print_r($$attr3_list_tmp_value);
      				die( 'not an array at key: '.$$attr3_list_tmp_key );
      			}
      			extract($$attr3_list_tmp_value);
      		}
      ?><?php unset($attr3_list);unset($attr3_extract);unset($attr3_key);unset($attr3_value); ?><?php  ?>        <?php
        	$row_class_idx++;
        	if ($row_class_idx > count($row_classes))
        		$row_class_idx=1;
        	$row_class=$row_classes[$row_class_idx-1];
        	if (empty($attr4_class))
        		$attr4_class=$row_class;
        	global $cell_column_nr;
        	$cell_column_nr=0;
        	$column_class_idx = 999;
        ?><tr class="<?php echo $attr4_class ?>"><?php  ?><?php  $attr5_colspan='14';  ?>          <?php
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
          if	( isset($attr5_width  )) { ?> width="<?php   echo $attr5_width   ?>" <?php }
          if	( isset($attr5_style  )) { ?> style="<?php   echo $attr5_style   ?>" <?php }
          if	( isset($attr5_class  )) { ?> class="<?php   echo $attr5_class   ?>" <?php }
          if	( isset($attr5_colspan)) { ?> colspan="<?php echo $attr5_colspan ?>" <?php }
          if	( isset($attr5_rowspan)) { ?> rowspan="<?php echo $attr5_rowspan ?>" <?php }
          ?>><?php unset($attr5_colspan); ?><?php  $attr6_title=$projectname;  ?>            <fieldset><?php if(isset($attr6_title)) { ?><legend><?php echo encodeHtml($attr6_title) ?></legend><?php } ?><?php unset($attr6_title); ?><?php  ?>          </fieldset><?php  ?><?php  ?>        </td><?php  ?><?php  ?>      </tr><?php  ?><?php  $attr4_empty='acls';  ?>        <?php 
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
            if	( isset($attr6_width  )) { ?> width="<?php   echo $attr6_width   ?>" <?php }
            if	( isset($attr6_style  )) { ?> style="<?php   echo $attr6_style   ?>" <?php }
            if	( isset($attr6_class  )) { ?> class="<?php   echo $attr6_class   ?>" <?php }
            if	( isset($attr6_colspan)) { ?> colspan="<?php echo $attr6_colspan ?>" <?php }
            if	( isset($attr6_rowspan)) { ?> rowspan="<?php echo $attr6_rowspan ?>" <?php }
            ?>><?php unset($attr6_class); ?><?php  $attr7_class='text';  $attr7_text='GLOBAL_NOT_FOUND';  $attr7_escape=true;  ?>              <?php
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
              ?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_text);unset($attr7_escape); ?><?php  ?>          </td><?php  ?><?php  ?>        </tr><?php  ?><?php  ?>      <?php } ?><?php  ?><?php  $attr4_not=true;  $attr4_empty='acls';  ?>        <?php 
        	if	( !isset($$attr4_empty) )
        		$attr4_tmp_exec = empty($attr4_empty);
        	elseif	( is_array($$attr4_empty) )
        		$attr4_tmp_exec = (count($$attr4_empty)==0);
        	elseif	( is_bool($$attr4_empty) )
        		$attr4_tmp_exec = true;
        	else
        		$attr4_tmp_exec = empty( $$attr4_empty );
        	if  ( !empty($attr4_not) )
        		$attr4_tmp_exec = !$attr4_tmp_exec;
        	$attr4_tmp_last_exec = $attr4_tmp_exec;
        	if	( $attr4_tmp_exec )
        	{
        ?>
<?php unset($attr4_not);unset($attr4_empty); ?><?php  ?>          <?php
          	$row_class_idx++;
          	if ($row_class_idx > count($row_classes))
          		$row_class_idx=1;
          	$row_class=$row_classes[$row_class_idx-1];
          	if (empty($attr5_class))
          		$attr5_class=$row_class;
          	global $cell_column_nr;
          	$cell_column_nr=0;
          	$column_class_idx = 999;
          ?><tr class="<?php echo $attr5_class ?>"><?php  ?><?php  $attr6_class='help';  ?>            <?php
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
            if	( isset($attr6_width  )) { ?> width="<?php   echo $attr6_width   ?>" <?php }
            if	( isset($attr6_style  )) { ?> style="<?php   echo $attr6_style   ?>" <?php }
            if	( isset($attr6_class  )) { ?> class="<?php   echo $attr6_class   ?>" <?php }
            if	( isset($attr6_colspan)) { ?> colspan="<?php echo $attr6_colspan ?>" <?php }
            if	( isset($attr6_rowspan)) { ?> rowspan="<?php echo $attr6_rowspan ?>" <?php }
            ?>><?php unset($attr6_class); ?><?php  $attr7_class='text';  $attr7_text='GLOBAL_USER';  $attr7_escape=true;  ?>              <?php
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
              ?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_text);unset($attr7_escape); ?><?php  ?>          </td><?php  ?><?php  $attr6_class='help';  ?>            <?php
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
            if	( isset($attr6_width  )) { ?> width="<?php   echo $attr6_width   ?>" <?php }
            if	( isset($attr6_style  )) { ?> style="<?php   echo $attr6_style   ?>" <?php }
            if	( isset($attr6_class  )) { ?> class="<?php   echo $attr6_class   ?>" <?php }
            if	( isset($attr6_colspan)) { ?> colspan="<?php echo $attr6_colspan ?>" <?php }
            if	( isset($attr6_rowspan)) { ?> rowspan="<?php echo $attr6_rowspan ?>" <?php }
            ?>><?php unset($attr6_class); ?><?php  $attr7_class='text';  $attr7_text='GLOBAL_NAME';  $attr7_escape=true;  ?>              <?php
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
              ?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_text);unset($attr7_escape); ?><?php  ?>          </td><?php  ?><?php  $attr6_class='help';  ?>            <?php
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
            if	( isset($attr6_width  )) { ?> width="<?php   echo $attr6_width   ?>" <?php }
            if	( isset($attr6_style  )) { ?> style="<?php   echo $attr6_style   ?>" <?php }
            if	( isset($attr6_class  )) { ?> class="<?php   echo $attr6_class   ?>" <?php }
            if	( isset($attr6_colspan)) { ?> colspan="<?php echo $attr6_colspan ?>" <?php }
            if	( isset($attr6_rowspan)) { ?> rowspan="<?php echo $attr6_rowspan ?>" <?php }
            ?>><?php unset($attr6_class); ?><?php  $attr7_class='text';  $attr7_text='GLOBAL_LANGUAGE';  $attr7_escape=true;  ?>              <?php
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
              ?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_text);unset($attr7_escape); ?><?php  ?>          </td><?php  ?><?php  $attr6_list='show';  $attr6_extract=false;  $attr6_key='list_key';  $attr6_value='t';  ?>            <?php
            	$attr6_list_tmp_key   = $attr6_key;
            	$attr6_list_tmp_value = $attr6_value;
            	$attr6_list_extract   = $attr6_extract;
            	unset($attr6_key);
            	unset($attr6_value);
            	if	( !isset($$attr6_list) || !is_array($$attr6_list) )
            		$$attr6_list = array();
            	foreach( $$attr6_list as $$attr6_list_tmp_key => $$attr6_list_tmp_value )
            	{
            		if	( $attr6_list_extract )
            		{
            			if	( !is_array($$attr6_list_tmp_value) )
            			{
            				print_r($$attr6_list_tmp_value);
            				die( 'not an array at key: '.$$attr6_list_tmp_key );
            			}
            			extract($$attr6_list_tmp_value);
            		}
            ?><?php unset($attr6_list);unset($attr6_extract);unset($attr6_key);unset($attr6_value); ?><?php  $attr7_class='help';  ?>              <?php
              	$column_class_idx++;
              	if ($column_class_idx > count($column_classes))
              		$column_class_idx=1;
              	$column_class=$column_classes[$column_class_idx-1];
              	if (empty($attr7_class))
              		$attr7_class=$column_class;
              	global $cell_column_nr;
              	$cell_column_nr++;
              	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
              		$attr7_width=$column_widths[$cell_column_nr-1];
              ?><td<?php
              if	( isset($attr7_width  )) { ?> width="<?php   echo $attr7_width   ?>" <?php }
              if	( isset($attr7_style  )) { ?> style="<?php   echo $attr7_style   ?>" <?php }
              if	( isset($attr7_class  )) { ?> class="<?php   echo $attr7_class   ?>" <?php }
              if	( isset($attr7_colspan)) { ?> colspan="<?php echo $attr7_colspan ?>" <?php }
              if	( isset($attr7_rowspan)) { ?> rowspan="<?php echo $attr7_rowspan ?>" <?php }
              ?>><?php unset($attr7_class); ?><?php  $attr8_title=lang('acl_'.$t.'');  $attr8_class='text';  $attr8_key=$t;  $attr8_suffix='_abbrev';  $attr8_prefix='acl_';  $attr8_escape=true;  ?>                <?php
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
                ?></<?php echo $tmp_tag ?>><?php unset($attr8_title);unset($attr8_class);unset($attr8_key);unset($attr8_suffix);unset($attr8_prefix);unset($attr8_escape); ?><?php  ?>            </td><?php  ?><?php  ?>          <?php } ?><?php  ?><?php  ?>        </tr><?php  ?><?php  ?>      <?php } ?><?php  ?><?php  $attr4_list='rights';  $attr4_extract=true;  $attr4_key='aclid';  $attr4_value='acl';  ?>        <?php
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
          ?><tr class="<?php echo $attr5_class ?>"><?php  ?><?php  ?>            <?php
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
            if	( isset($attr6_width  )) { ?> width="<?php   echo $attr6_width   ?>" <?php }
            if	( isset($attr6_style  )) { ?> style="<?php   echo $attr6_style   ?>" <?php }
            if	( isset($attr6_class  )) { ?> class="<?php   echo $attr6_class   ?>" <?php }
            if	( isset($attr6_colspan)) { ?> colspan="<?php echo $attr6_colspan ?>" <?php }
            if	( isset($attr6_rowspan)) { ?> rowspan="<?php echo $attr6_rowspan ?>" <?php }
            ?>><?php  ?><?php  $attr7_present='username';  ?>              <?php 
              	$attr7_tmp_exec = isset($$attr7_present);
              	$attr7_tmp_last_exec = $attr7_tmp_exec;
              	if	( $attr7_tmp_exec )
              	{
              ?>
<?php unset($attr7_present); ?><?php  $attr8_align='left';  $attr8_type='user';  ?>                <?php
                	$attr8_tmp_image_file = $image_dir.'icon_'.$attr8_type.IMG_ICON_EXT;
                	$attr8_size = '16x16';
                ?><img src="<?php echo $attr8_tmp_image_file ?>" border="0"<?php if(isset($attr8_align)) echo ' align="'.$attr8_align.'"' ?><?php if (isset($attr8_size)) { list($attr8_tmp_width,$attr8_tmp_height)=explode('x',$attr8_size);echo ' width="'.$attr8_tmp_width.'" height="'.$attr8_tmp_height.'"';} ?>><?php unset($attr8_align);unset($attr8_type); ?><?php  $attr8_class='text';  $attr8_var='username';  $attr8_maxlength='20';  $attr8_escape=true;  ?>                <?php
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
                ?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_var);unset($attr8_maxlength);unset($attr8_escape); ?><?php  ?>            <?php } ?><?php  ?><?php  $attr7_present='groupname';  ?>              <?php 
              	$attr7_tmp_exec = isset($$attr7_present);
              	$attr7_tmp_last_exec = $attr7_tmp_exec;
              	if	( $attr7_tmp_exec )
              	{
              ?>
<?php unset($attr7_present); ?><?php  $attr8_align='left';  $attr8_type='group';  ?>                <?php
                	$attr8_tmp_image_file = $image_dir.'icon_'.$attr8_type.IMG_ICON_EXT;
                	$attr8_size = '16x16';
                ?><img src="<?php echo $attr8_tmp_image_file ?>" border="0"<?php if(isset($attr8_align)) echo ' align="'.$attr8_align.'"' ?><?php if (isset($attr8_size)) { list($attr8_tmp_width,$attr8_tmp_height)=explode('x',$attr8_size);echo ' width="'.$attr8_tmp_width.'" height="'.$attr8_tmp_height.'"';} ?>><?php unset($attr8_align);unset($attr8_type); ?><?php  $attr8_class='text';  $attr8_var='groupname';  $attr8_maxlength='20';  $attr8_escape=true;  ?>                <?php
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
                ?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_var);unset($attr8_maxlength);unset($attr8_escape); ?><?php  ?>            <?php } ?><?php  ?><?php  $attr7_not=true;  $attr7_present='username';  ?>              <?php 
              	$attr7_tmp_exec = isset($$attr7_present);
              	if  ( !empty($attr7_not) )
              		$attr7_tmp_exec = !$attr7_tmp_exec;
              	$attr7_tmp_last_exec = $attr7_tmp_exec;
              	if	( $attr7_tmp_exec )
              	{
              ?>
<?php unset($attr7_not);unset($attr7_present); ?><?php  $attr8_not=true;  $attr8_present='groupname';  ?>                <?php 
                	$attr8_tmp_exec = isset($$attr8_present);
                	if  ( !empty($attr8_not) )
                		$attr8_tmp_exec = !$attr8_tmp_exec;
                	$attr8_tmp_last_exec = $attr8_tmp_exec;
                	if	( $attr8_tmp_exec )
                	{
                ?>
<?php unset($attr8_not);unset($attr8_present); ?><?php  $attr9_align='left';  $attr9_type='group';  ?>                  <?php
                  	$attr9_tmp_image_file = $image_dir.'icon_'.$attr9_type.IMG_ICON_EXT;
                  	$attr9_size = '16x16';
                  ?><img src="<?php echo $attr9_tmp_image_file ?>" border="0"<?php if(isset($attr9_align)) echo ' align="'.$attr9_align.'"' ?><?php if (isset($attr9_size)) { list($attr9_tmp_width,$attr9_tmp_height)=explode('x',$attr9_size);echo ' width="'.$attr9_tmp_width.'" height="'.$attr9_tmp_height.'"';} ?>><?php unset($attr9_align);unset($attr9_type); ?><?php  $attr9_class='text';  $attr9_key='global_all';  $attr9_escape=true;  ?>                  <?php
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
                  ?></<?php echo $tmp_tag ?>><?php unset($attr9_class);unset($attr9_key);unset($attr9_escape); ?><?php  ?>              <?php } ?><?php  ?><?php  ?>            <?php } ?><?php  ?><?php  $attr7_var='username';  ?>              <?php
              	if (!isset($attr7_value))
              		unset($$attr7_var);
              	elseif (isset($attr7_key))
              		$$attr7_var = $attr7_value[$attr7_key];
              	else
              		$$attr7_var = $attr7_value;
              ?><?php unset($attr7_var); ?><?php  $attr7_var='groupname';  ?>              <?php
              	if (!isset($attr7_value))
              		unset($$attr7_var);
              	elseif (isset($attr7_key))
              		$$attr7_var = $attr7_value[$attr7_key];
              	else
              		$$attr7_var = $attr7_value;
              ?><?php unset($attr7_var); ?><?php  ?>          </td><?php  ?><?php  ?>            <?php
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
            if	( isset($attr6_width  )) { ?> width="<?php   echo $attr6_width   ?>" <?php }
            if	( isset($attr6_style  )) { ?> style="<?php   echo $attr6_style   ?>" <?php }
            if	( isset($attr6_class  )) { ?> class="<?php   echo $attr6_class   ?>" <?php }
            if	( isset($attr6_colspan)) { ?> colspan="<?php echo $attr6_colspan ?>" <?php }
            if	( isset($attr6_rowspan)) { ?> rowspan="<?php echo $attr6_rowspan ?>" <?php }
            ?>><?php  ?><?php  $attr7_align='left';  $attr7_type=$objecttype;  ?>              <?php
              	$attr7_tmp_image_file = $image_dir.'icon_'.$attr7_type.IMG_ICON_EXT;
              	$attr7_size = '16x16';
              ?><img src="<?php echo $attr7_tmp_image_file ?>" border="0"<?php if(isset($attr7_align)) echo ' align="'.$attr7_align.'"' ?><?php if (isset($attr7_size)) { list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo ' width="'.$attr7_tmp_width.'" height="'.$attr7_tmp_height.'"';} ?>><?php unset($attr7_align);unset($attr7_type); ?><?php  $attr7_title='';  $attr7_target='_top';  $attr7_class='';  $attr7_action='index';  $attr7_subaction='object';  $attr7_id=$objectid;  ?>              <?php
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
              ?><a<?php if (isset($attr7_name)) echo ' name="'.$attr7_name.'"'; else echo ' href="'.$tmp_url.($attr7_anchor?'#'.$attr7_anchor:'').'"' ?> class="<?php echo $attr7_class ?>" target="<?php echo $attr7_target ?>"<?php if (isset($attr7_accesskey)) echo ' accesskey="'.$attr7_accesskey.'"' ?>  title="<?php echo encodeHtml($attr7_title) ?>"><?php unset($attr7_title);unset($attr7_target);unset($attr7_class);unset($attr7_action);unset($attr7_subaction);unset($attr7_id); ?><?php  $attr8_title=lang('select');  $attr8_class='text';  $attr8_var='objectname';  $attr8_maxlength='20';  $attr8_escape=true;  ?>                <?php
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
                ?></<?php echo $tmp_tag ?>><?php unset($attr8_title);unset($attr8_class);unset($attr8_var);unset($attr8_maxlength);unset($attr8_escape); ?><?php  ?>            </a><?php  ?><?php  ?>          </td><?php  ?><?php  ?>            <?php
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
            if	( isset($attr6_width  )) { ?> width="<?php   echo $attr6_width   ?>" <?php }
            if	( isset($attr6_style  )) { ?> style="<?php   echo $attr6_style   ?>" <?php }
            if	( isset($attr6_class  )) { ?> class="<?php   echo $attr6_class   ?>" <?php }
            if	( isset($attr6_colspan)) { ?> colspan="<?php echo $attr6_colspan ?>" <?php }
            if	( isset($attr6_rowspan)) { ?> rowspan="<?php echo $attr6_rowspan ?>" <?php }
            ?>><?php  ?><?php  $attr7_class='text';  $attr7_var='languagename';  $attr7_maxlength='20';  $attr7_escape=true;  ?>              <?php
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
              ?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_var);unset($attr7_maxlength);unset($attr7_escape); ?><?php  ?>          </td><?php  ?><?php  $attr6_list='show';  $attr6_extract=false;  $attr6_key='list_key';  $attr6_value='list_value';  ?>            <?php
            	$attr6_list_tmp_key   = $attr6_key;
            	$attr6_list_tmp_value = $attr6_value;
            	$attr6_list_extract   = $attr6_extract;
            	unset($attr6_key);
            	unset($attr6_value);
            	if	( !isset($$attr6_list) || !is_array($$attr6_list) )
            		$$attr6_list = array();
            	foreach( $$attr6_list as $$attr6_list_tmp_key => $$attr6_list_tmp_value )
            	{
            		if	( $attr6_list_extract )
            		{
            			if	( !is_array($$attr6_list_tmp_value) )
            			{
            				print_r($$attr6_list_tmp_value);
            				die( 'not an array at key: '.$$attr6_list_tmp_key );
            			}
            			extract($$attr6_list_tmp_value);
            		}
            ?><?php unset($attr6_list);unset($attr6_extract);unset($attr6_key);unset($attr6_value); ?><?php  ?>              <?php
              	$column_class_idx++;
              	if ($column_class_idx > count($column_classes))
              		$column_class_idx=1;
              	$column_class=$column_classes[$column_class_idx-1];
              	if (empty($attr7_class))
              		$attr7_class=$column_class;
              	global $cell_column_nr;
              	$cell_column_nr++;
              	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
              		$attr7_width=$column_widths[$cell_column_nr-1];
              ?><td<?php
              if	( isset($attr7_width  )) { ?> width="<?php   echo $attr7_width   ?>" <?php }
              if	( isset($attr7_style  )) { ?> style="<?php   echo $attr7_style   ?>" <?php }
              if	( isset($attr7_class  )) { ?> class="<?php   echo $attr7_class   ?>" <?php }
              if	( isset($attr7_colspan)) { ?> colspan="<?php echo $attr7_colspan ?>" <?php }
              if	( isset($attr7_rowspan)) { ?> rowspan="<?php echo $attr7_rowspan ?>" <?php }
              ?>><?php  ?><?php  $attr8_var=$list_value;  $attr8_value=$bits;  $attr8_key=$list_value;  ?>                <?php
                	if (!isset($attr8_value))
                		unset($$attr8_var);
                	elseif (isset($attr8_key))
                		$$attr8_var = $attr8_value[$attr8_key];
                	else
                		$$attr8_var = $attr8_value;
                ?><?php unset($attr8_var);unset($attr8_value);unset($attr8_key); ?><?php  $attr8_default=false;  $attr8_readonly=true;  $attr8_name=$list_value;  ?>                <?php
                	if ($this->isEditable() && !$this->isEditMode()) $attr8_readonly=true;
                	if	( isset($$attr8_name) )
                		$checked = $$attr8_name;
                	else
                		$checked = $attr8_default;
                ?><input type="checkbox" id="id_<?php echo $attr8_name ?>" name="<?php echo $attr8_name  ?>"  <?php if ($attr8_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?><?php if (in_array($attr8_name,$errors)) echo ' style="background-color:red;"' ?> /><?php
                if ( $attr8_readonly && $checked )
                { 
                ?><input type="hidden" name="<?php echo $attr8_name ?>" value="1" /><?php
                }
                ?><?php unset($attr8_name); unset($attr8_readonly); unset($attr8_default); ?><?php unset($attr8_default);unset($attr8_readonly);unset($attr8_name); ?><?php  ?>            </td><?php  ?><?php  ?>          <?php } ?><?php  ?><?php  ?>        </tr><?php  ?><?php  ?>      <?php } ?><?php  ?><?php  ?>    <?php } ?><?php  ?><?php  ?>        </table>
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
<?php  ?><?php  ?></body>
</html><?php  ?>