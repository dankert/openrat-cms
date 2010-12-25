<div class="breadcrumb">
		<?php 
#IF-ATTR icon#
	$icon=$attr_icon;
#ELSE#
	$icon=$actionName;
#END-IF#
		
		echo '<img src="'.$image_dir.'icon_'.$icon.IMG_ICON_EXT.'" align="left" border="0">';
		
		if ($this->isEditable()) { ?>
  <?php if ($this->isEditMode()) { 
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId()                       ) ?>" accesskey="1" title="<?php echo langHtml('MODE_EDIT_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>mode-edit.png" style="vertical-align:top; " border="0" /></a> <?php }
   elseif (readonly()) {
  ?><img src="<?php echo $image_dir ?>readonly.png" style="vertical-align:top; " border="0" /> <?php } else {
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId(),array('mode'=>'edit') ) ?>" accesskey="1" title="<?php echo langHtml('MODE_SHOW_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>readonly.png" style="vertical-align:top; " border="0" /></a> <?php }
  ?><?php }
				
		
		
		echo '<span class="path">'.langHtml($actionName).'</span>&nbsp;<strong>&rarr;</strong>&nbsp;';
//		if	( !empty($attr_icon) )
//			echo '<img src="'.$image_dir.'icon_'.$attr_icon.IMG_ICON_EXT.'" align="left" border="0">';
		if	( !isset($path) || is_array($path) )
			$path = array();
		foreach( $path as $pathElement)
		{
			extract($pathElement);
			echo '<a href="'.$url.'" class="path">'.langHtml($name).'</a>';
			echo '&nbsp;&raquo;&nbsp;';
		}
		echo '<span class="title">'.langHtml($windowTitle).'</span>';
		
		if	( isset($notice_status))
		{
			?><img src="<?php echo $image_dir.'notice_'.$notice_status.IMG_ICON_EXT ?>" align="right" /><?php
		}
		
		
		?>
		
</div>
<?php ?>		<!--<td class="menu" style="align:right;">
    <?php if (isset($windowIcons)) foreach( $windowIcons as $icon )
          {
          	?><a href="<?php echo $icon['url'] ?>" title="<?php echo 'ICON_'.langHtml($menu['type'].'_DESC') ?>"><image border="0" src="<?php echo $image_dir.$icon['type'].IMG_ICON_EXT ?>"></a>&nbsp;<?php
          }
     ?>
    </td>--><nix/>
  </tr>









<?php
	$coloumn_widths=array();
	
#IF-ATTR widths#
	$coldumn_widths = explode(',',$attr_widths);
#END-IF#
#IF-ATTR rowclasses#
	$row_classes   = explode(',',$attr_rowclasses);
	$row_class_idx = 999;
#END-IF#
#IF-ATTR columnclasses#
	$column_classes = explode(',',$attr_columnclasses);
#END-IF#
	$row_idx    = 0;
	$column_idx = 0;

	    if	( !isset($windowMenu) || !is_array($windowMenu) )
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
          		?><a class="action<?php echo $this->subActionName==$menu['subaction']?'_active':'' ?>" href="<?php echo Html::url($actionName,$menu['subaction'],$this->getRequestId() ) ?>" accesskey="<?php echo $tmp_key ?>" title="<?php echo langHtml($menu['text'].'_DESC') ?>"><!-- <img src="<?php echo $image_dir.'icon_'.$menu['subaction'].'.png' ?>" align="left" />--><?php echo $tmp_text ?></a><?php
          	}
          	else
          	{
          		?><div class="noaction"><!-- <img src="<?php echo $image_dir.'icon_'.$menu['subaction'].'.png' ?>" align="left" />--><?php echo $tmp_text ?></div><?php
          	}
          }
          	if (@$conf['help']['enabled'] )
          	{
             ?><a class="help" href="<?php echo $conf['help']['url'].$actionName.'/'.$subActionName.@$conf['help']['suffix'] ?> " target="_new" title="<?php echo langHtml('MENU_HELP_DESC') ?>"><!-- <img src="<?php echo $image_dir.'icon_help.png' ?>" align="left" />--><?php echo @$conf['help']['only_question_mark']?'?':langHtml('MENU_HELP') ?></a><?php
          	}
          	?><br/><?php
	
	
	
		global $image_dir;
		echo '<br/><br/>';
		echo '<table class="x-main" cellspacing="0" cellpadding="4" width="'.$attr_width.'">';
		?>
		

<?php if (isset($notices) && count($notices)>0 )
      { ?>

  <tr>
    <td align="center" class="notice">

  <?php foreach( $notices as $notice_idx=>$notice ) { ?>
    	<br><table class="notice">
    
  <?php if ($notice['name']!='') { ?>
  <tr>
    <th colspan="2"><img src="<?php echo $image_dir.'icon_'.$notice['type'].IMG_ICON_EXT ?>" align="left" /><?php echo $notice['name'] ?>
    </th>
  </tr>
<?php } ?>
  <tr class="<?php echo $notice['status'] ?>">
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
    <td class="x-window">
      <table cellspacing="0" width="100%" cellpadding="4">
      

      