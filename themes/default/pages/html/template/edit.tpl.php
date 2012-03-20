<?php $a2_name='';$a2_views='src,addel,srcelement,el,remove';$a2_back=false; ?><div class="header">
  <?php if ($a2_back) { ?>
  <a href="javascript:void(0);" onclick="javascript:refreshActualView(this);" class="back button">
    <img src="<?php  echo $image_dir ?>icon/window/back.gif" />
    <?php echo lang('BACK') ?>
  </a>
  <?php } ?><?php if(!empty($a2_views)) { ?>
  <img src="<?php  echo $image_dir ?>icon/window/down.gif" />
  <div class="headermenu">
    <?php foreach( explode(',',$a2_views) as $a2_tmp_view ) { ?>
	<a class="entry" href="javascript:void(0);" onclick="javascript:startView(this,'<?php echo $a2_tmp_view ?>');">
	  <img src="<?php  echo $image_dir ?>icon/<?php echo $a2_tmp_view ?>.png" /><?php echo lang('MENU_'.$a2_tmp_view) ?>
	</a>
    <?php } ?>
  </div>
<?php } ?>
</div><?php unset($a2_name,$a2_views,$a2_back) ?><?php $a2_name='TEMPLATE_SHOW';$a2_width='93%';$a2_rowclasses='odd,even';$a2_columnclasses='1,2,3'; ?><?php if (false) { ?>
<div class="window">
<div class="title">
		<?php $icon=$actionName; ?>
		<img src="<?php echo $image_dir.'icon_'.$icon.IMG_ICON_EXT ?>" align="left" />
		<?php if ($this->isEditable()) { ?>
  <?php if ($this->isEditMode()) { 
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId()                       ) ?>" accesskey="1" title="<?php echo langHtml('MODE_EDIT_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>mode-edit.png" style="vertical-align:top; " border="0" /></a> <?php }
   elseif (readonly()) {
  ?><img src="<?php echo $image_dir ?>readonly.png" style="vertical-align:top; " border="0" /> <?php } else {
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId(),array('mode'=>'edit') ) ?>" accesskey="1" title="<?php echo langHtml('MODE_SHOW_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>readonly.png" style="vertical-align:top; " border="0" /></a> <?php }
  ?><?php } ?>
		<span class="path"><?php echo langHtml($actionName) ?></span>&nbsp;<strong>&rarr;</strong>&nbsp;
		<?php
		if	( !isset($path) || !is_array($path) )
			$path = array();
		foreach( $path as $pathElement)
		{
			extract($pathElement); ?>
			<a javascript:void(0);" onclick="javascript:loadViewByName('<?php echo $view ?>','<?php echo $url ?>'); return false; " title="<?php echo $title ?>" class="path"><?php echo (!empty($key)?langHtml($key):$name) ?></a>
			&nbsp;&rarr;&nbsp;
		<?php } ?>
		<span class="title"><?php echo langHtml(@$windowTitle) ?></span>
		<?php
		if	( isset($notice_status))
		{
			?><img src="<?php echo $image_dir.'notice_'.$notice_status.IMG_ICON_EXT ?>" align="right" /><?php
		}
		?>
		<?php ?>		
    <?php if (isset($windowIcons)) foreach( $windowIcons as $icon )
          {
          	?><a href="<?php echo $icon['url'] ?>" title="<?php echo 'ICON_'.langHtml($menu['type'].'_DESC') ?>"><image border="0" src="<?php echo $image_dir.$icon['type'].IMG_ICON_EXT ?>"></a>&nbsp;<?php
          }
     ?>
</div>
<ul class="menu">
<?php
	if	( !isset($windowMenu) || !is_array($windowMenu) ) $windowMenu = array();
    foreach( $windowMenu as $menu )
          {
          	$tmp_text = langHtml($menu['text']);
          	$tmp_key  = strtoupper(langHtml($menu['key' ]));
			$tmp_pos = strpos(strtolower($tmp_text),strtolower($tmp_key));
			if	( $tmp_pos !== false )
				$tmp_text = substr($tmp_text,0,max($tmp_pos,0)).'<span class="accesskey">'. substr($tmp_text,$tmp_pos,1).'</span>'.substr($tmp_text,$tmp_pos+1);
			$liClass  = (isset($menu['url'])?'':'no').'action'.($this->subActionName==$menu['subaction']?' active':'');
			$icon_url = $image_dir.'icon/'.$menu['subaction'].'.png';
			?><li class="<?php echo $liClass?>"><?php
          	if	( isset($menu['url']) )
          	{
          		$link_url = Html::url($actionName,$menu['subaction'],$this->getRequestId() );
          		?><a href="javascript:void(0);" onclick="javascript:loadSubaction(this,'<?php echo $actionName ?>','<?php echo $menu['subaction'] ?>','<?php echo $this->getRequestId() ?>'); return false; " accesskey="<?php echo $tmp_key ?>" title="<?php echo langHtml($menu['text'].'_DESC') ?>"><img src="<?php echo $icon_url ?>" /><?php echo $tmp_text ?></a><?php
          	}
          	else
          	{
          		?><span><img src="<?php echo $icon_url ?>" /><?php echo $tmp_text ?></span><?php
          	}
          }
          	?></li><?php
          if ( /* Deaktiviert */ false && @$conf['help']['enabled'] )
          	{
             ?><a class="help" href="<?php echo $conf['help']['url'].$actionName.'/'.$subActionName.@$conf['help']['suffix'] ?> " target="_new" title="<?php echo langHtml('MENU_HELP_DESC') ?>"><img src="<?php echo $image_dir.'icon/help.png' ?>" /><?php echo @$conf['help']['only_question_mark']?'?':langHtml('MENU_HELP') ?></a><?php
          	}
          	?><?php
		?>
</ul>
<?php 		global $image_dir; 
      if (isset($notices) && count($notices)>0 )
      { ?>
    	<dl class="notice">
  <?php foreach( $notices as $notice_idx=>$notice ) { ?>
  <?php if ($notice['name']!='') { ?>
    <dt><img src="<?php echo $image_dir.'icon_'.$notice['type'].IMG_ICON_EXT ?>" align="left" /><?php echo $notice['name'] ?></dt>
<?php } ?>
  <dd class="<?php echo $notice['status'] ?>">
    <td style="padding:10px;" width="30px"><img src="<?php echo $image_dir.'notice_'.$notice['status'].IMG_ICON_EXT ?>" style="padding:10px" /></td>
    <td style="padding:10px;padding-right:10px;padding-bottom:10px;"><?php if ($notice['status']=='error') { ?><strong><?php } ?><?php echo langHtml($notice['key'],$notice['vars']) ?><?php if ($notice['status']=='error') { ?></strong><?php } ?>
    <?php if (!empty($notice['log'])) { ?><pre><?php echo htmlentities(implode("\n",$notice['log'])) ?></pre><?php } ?>
    </td>
  </dd>
  <?php } ?>
    </dl>
<?php } ?>
<div class="content"><div class="filler">
<?php } ?><?php unset($a2_name,$a2_width,$a2_rowclasses,$a2_columnclasses) ?><?php
	$column_idx = 0;
?>
<tr
>
<?php $a4_header=false; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php unset($a4_header) ?><?php $a5_class='text';$a5_var='text';$a5_escape=false;$a5_type='code';$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'code';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = isset($$a5_var)?$$a5_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_var,$a5_escape,$a5_type,$a5_cut) ?></td></tr><?php if (false) { ?>
</div>
</div>
<div class="bottom">
	<div class="status">
	</div>
	<div class="command">
	<input type="button" value="<?php echo lang('OK') ?>" onclick="formSubmit( $(this),'<?php echo $view ?>');" />
	<input type="cancel" value="<?php echo lang('CANCEL') ?>" />
	</div>
</div>
</div>
<?php if ($showDuration)
      { ?>
<br/>
<center><small>&nbsp;
<?php $dur = time()-START_TIME;
      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small></center>
<?php } ?>
<?php } ?>