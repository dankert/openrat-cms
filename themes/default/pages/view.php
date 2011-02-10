<?php
 if (!defined('OR_VERSION')) die('Forbidden');
 if (!headers_sent()) header('Content-Type: text/html; charset='.$charset)
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo OR_TITLE.' '.OR_VERSION ?></title>
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
      } ?>
  <link rel="stylesheet" type="text/css" href="<?php echo OR_THEMES_EXT_DIR ?>default/css/layout.css" >
  <link rel="stylesheet" type="text/css" href="<?php echo OR_THEMES_EXT_DIR ?>default/css/user/default.css" >
  <script src="/~dankert/cms-test/cms09/themes/default/js/jquery-1.5.min.js"></script>
  <script src="/~dankert/cms-test/cms09/themes/default/js/jquery-ui/js/jquery-ui-1.8.9.custom.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo OR_THEMES_EXT_DIR ?>default/js/jquery-ui/css/pepper-grinder/jquery-ui-1.8.9.custom.css" >
  <script src="/~dankert/cms-test/cms09/themes/default/js/openrat.js"></script>
</head>

<?php
$ping_url     = @$viewCache['header']['ping_url'    ];
$ping_timeout = @$viewCache['header']['ping_timeout'];
 ?>
<?php if (!empty($ping_url)) { ?>
<script type="text/javascript">
  <!--
    function ping() {
		$.getJSON('<?php echo str_replace('&amp;','&',$ping_url) ?>', function(json) {});
		window.setTimeout("ping()", <?php echo $ping_timeout*1000 ?>);
	}
  
    //window.setTimeout("ping()", <?php echo $ping_timeout*1000 ?>);
    window.setTimeout("ping()", 5000);
  
  // -->
  </script>
<?php } ?>

<body>

<?php global $viewCache; /* Debug-Information */ if (@$showDuration||true) { echo "<!-- Output Variables are:\n";echo str_replace('-->','-- >',print_r($viewCache,true));echo "\n-->";} ?>

<div id="header">
</div>

<div id="tree">
</div>

<div id="content">
</div>

<noscript><em>Javascript is required to view this site</em></noscript>

</body>
</html>
