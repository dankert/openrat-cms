<?php $attr = array('class'=>'') ?><?php $attr_class='' ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<!-- $Id$ -->
<head>
  <title><?php echo $cms_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="MSSmartTagsPreventParsing" content="true" />
  <meta name="robots" content="noindex,nofollow" />
  <link rel="stylesheet" type="text/css" href="./themes/default/css/default.css" />
<?php if($stylesheet!='default') { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $stylesheet ?>" />
<?php } ?>
</head>

<body<?php echo !empty($$attr_class)?' class="'.$$attr_class.'"':' class="'.$attr_class.'"' ?>>


<?php unset($attr) ?><?php unset($attr_class) ?><!-- $Id$ -->
<table cellpadding="0" cellspacing="0" border="0">
<?php foreach( $zeilen as $z )
{ ?>
<tr>
<?php if   (is_array($z['cols'])) foreach( $z['cols'] as $i )
{ ?>
<td width="1%"><img src="<?php echo $image_dir.'tree_'.$i.IMG_EXT ?>" border="0" alt=""></td>
<?php } ?>
<?php if (isset($z['image']))
{ ?>
<td width="1%">
<?php if (isset($z['image_url'])) { ?><a href="<?php echo $z['image_url'].'#'.$z['name'] ?>" class="tree" target="_self" title="<?php echo $z['image_url_desc'] ?>"><?php } ?><img src="<?php echo $image_dir.'tree_'.$z['image'].IMG_EXT ?>" alt="" border="0"><?php if (isset($z['image_url'])) { ?></a><?php } ?>
</td>
<?php } ?>
<td colspan="<?php echo intval(20-count($z['cols'])) ?>" id="<?php echo $z['name'] ?>" valign="middle" style="white-space:nowrap;">
<a name="<?php echo $z['name'] ?>"></a>
<?php if (isset($z['url'])) { ?><a href="<?php echo $z['url'] ?>" <?php if($z['desc']!='') echo 'title="'.$z['desc'].'" ' ?>class="tree" target="<?php echo $z['target'] ?>"><?php } ?><img src="<?php echo $image_dir.'icon_'.$z['icon'].IMG_ICON_EXT ?>" border="0" alt="" align="left"><?php echo $z['text'] ?><?php if (isset($z['url'])) { ?></a><?php if(isset($z['add'])) echo '&nbsp;<small>'.$z['add'].'<small>' ?><?php } ?>
</td>
</tr>
<?php } ?>
</table>
<?php $attr = array() ?>
<!-- $Id$ -->

<?php if ($showDuration) { ?>
<br/>
<small>&nbsp;
<?php $dur = time()-START_TIME;
//      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small>
<?php } ?>

</body>
</html><?php unset($attr) ?>