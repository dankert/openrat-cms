<?php
 if (!defined('OR_VERSION')) die('Forbidden');
 if (!headers_sent()) header('Content-Type: text/html; charset='.$charset)
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo isset($attr_title)?$attr_title.' - ':(isset($windowTitle)?langHtml($windowTitle).' - ':'') ?><?php echo $cms_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset ?>" >
  <meta name="MSSmartTagsPreventParsing" content="true" >
  <meta name="robots" content="noindex,nofollow" >
<?php if (isset($windowMenu) && is_array($windowMenu)) foreach( $windowMenu as $menu )
      {
       	?>
  <link rel="section" href="<?php echo Html::url($actionName,@$menu['subaction'],$this->getRequestId() ) ?>" title="<?php echo lang($menu['text']) ?>" >
<?php
      }
?><?php if (isset($metaList) && is_array($metaList)) foreach( $metaList as $meta )
      {
       	?>
  <link rel="<?php echo $meta['name'] ?>" href="<?php echo $meta['url'] ?>" title="<?php echo lang($meta['title']) ?>" ><?php
      }
?><?php if(!empty($root_stylesheet)) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $root_stylesheet ?>" >
<?php } ?>
<?php if($root_stylesheet!=$user_stylesheet) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $user_stylesheet ?>" >
<?php } ?>
</head>

<body class="<?php echo $attr_class ?>" <?php if (@$conf['interface']['application_mode']) { ?> style="padding:0px;margin:0px;"<?php } ?> >

<?php /* Debug-Information */ if ($showDuration) { echo "<!-- Output Variables are:\n";echo str_replace('-->','-- >',print_r($this->templateVars,true));echo "\n-->";} ?>