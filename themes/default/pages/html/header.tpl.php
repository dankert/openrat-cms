<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<!-- $Id$ -->
<head>
  <title><?php echo $cms_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="MSSmartTagsPreventParsing" content="true" />
  <meta name="robots" content="noindex,nofollow" />
  <link rel="stylesheet" type="text/css" href="<?php echo $stylesheet ?>" />
</head>

<body<?php if( isset($css_body_class) )echo ' class="'.$css_body_class.'"' ?>>


<?php if (isset($notices) && count($notices)>0 )
      { ?>
<!-- $Id$ -->
<center>

<table class="main" width="99%" cellspacing="0" cellpadding="4">

  <tr>
    <th colspan="3"><?php echo lang('GLOBAL_NOTICES') ?></th>
  </tr>

  <?php foreach( $notices as $notice ) { ?>
  <tr>
    <td class="f1"><img src="<?php echo $image_dir.'icon_'.$notice['type'].IMG_EXT ?>" align="left" /><?php echo $notice['name'] ?></td>
    <td class="f1"><img src="<?php echo $image_dir.'notice_'.$notice['status'].IMG_EXT ?>" align="left" />
                   <strong><?php echo $notice['text'] ?></strong></td>
  </tr>
  <?php } ?>

</table>

</center>

<?php } ?>
