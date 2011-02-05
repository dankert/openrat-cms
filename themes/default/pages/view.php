<?php
 if (!defined('OR_VERSION')) die('Forbidden');
 if (!headers_sent()) header('Content-Type: text/html; charset='.$charset)
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo isset($attr_title)?langHtml($attr_title).' - ':(isset($windowTitle)?langHtml($windowTitle).' - ':'') ?><?php echo $cms_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset ?>" >
<?php if ( isset($refresh_url) ) { ?>
  <meta http-equiv="refresh" content="<?php echo isset($refresh_timeout)?$refresh_timeout:0 ?>; URL=<?php echo $refresh_url; if (ini_get('session.use_trans_sid')) echo '&'.session_name().'='.session_id(); ?>">
<?php } ?>
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
  <link rel="<?php echo $meta['name'] ?>" href="<?php echo $meta['url'] ?>" title="<?php echo $meta['title'] ?>" ><?php
      }
?><?php if(!empty($root_stylesheet)) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $root_stylesheet ?>" >
<?php } ?>
<?php if($root_stylesheet!=$user_stylesheet) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $user_stylesheet ?>" >
  <script src="<?php echo OR_THEMES_EXT_DIR.'/default/js/jquery-1.5.min.jsx'; ?>"></script>
  <script src="/~dankert/cms-test/cms09/themes/default/js/jquery-1.5.min.js"></script>
<?php } ?>
</head>

<?php
$ping_url     = @$viewCache['header']['ping_url'    ];
$ping_timeout = @$viewCache['header']['ping_timeout'];
 ?>
<?php if (!empty($ping_url)) { ?>
<script type="text/javascript">
  <!--
    function ping() {
	    
	    var xmlHttpObject = new XMLHttpRequest();
	    
        xmlHttpObject.open('GET', '<?php echo $ping_url ?>');
        xmlHttpObject.send(null);
	    window.setTimeout("ping()", <?php echo $ping_timeout*1000 ?>);
    }
  
    //window.setTimeout("ping()", <?php echo $ping_timeout*1000 ?>);
    window.setTimeout("ping()", 5000);
  
  // -->
  </script>
<?php } ?>

<body>

<?php global $viewCache; /* Debug-Information */ if ($showDuration||true) { echo "<!-- Output Variables are:\n";echo str_replace('-->','-- >',print_r($viewCache,true));echo "\n-->";} ?>

<div id="header">
<?php showView('header') ?>
</div>

<div id="tree">
<?php showView('tree') ?>
</div>

<div id="content">
<?php showView('content') ?>
</div>

<script name="JavaScript" type="text/javascript">
$('form.login').parents('body').addClass('dark');

if	( $('form.login').size() > 0 )
{
	$('div#header, div#tree').animate({
		opacity: .4
		}, 1000, function() {
		// Animation complete; works in all browsers
	});
}

//$('form.login').modal();

</script>

</body>
</html>
