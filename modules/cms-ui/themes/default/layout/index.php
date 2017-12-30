<?php
 if (!defined('OR_VERSION')) die('Forbidden');
 if (!headers_sent()) header('Content-Type: text/html; charset=UTF-8')
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html class="theme-<?php echo strtolower($style) ?> nojs">
<head>
<?php $appName = config('application','name'); $appOperator = config('application','operator');
      $title = $appName.(($appOperator!=$appName)?' - '.$appOperator:''); ?>
  <title data-default="<?php echo $title ?>"><?php echo $title ?></title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" >
<?php if ( isset($refresh_url) ) { ?>
  <meta http-equiv="refresh" content="<?php echo isset($refresh_timeout)?$refresh_timeout:0 ?>; URL=<?php echo $refresh_url; if (ini_get('session.use_trans_sid')) echo '&'.session_name().'='.session_id(); ?>">
<?php } ?>
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

<?php foreach( $jsFiles  as $jsFile ) { ?>  <script src="<?php echo $jsFile ?>" defer></script>
<?php } ?>
  <link rel="stylesheet" type="text/css" href="<?php echo OR_HTML_MODULES_DIR . 'editor/codemirror/lib/codemirror.css' ?>" />
<?php foreach( $cssFiles as $cssFile) { ?>  <link rel="stylesheet" type="text/css" href="<?php echo $cssFile ?>" />
<?php } ?>
  <style type="text/css">
    <?php echo $themeCss ?>
  </style>
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
    
    window.addEventListener('DOMContentLoaded', function ()
    {
    		window.setTimeout("ping()", 5000);
    }, false);
  
  // -->
  </script>
<?php } ?>


<body>

<script type="text/javascript">
<!--
// Konstanten
var OR_THEMES_EXT_DIR = '<?php echo OR_THEMES_DIR ?>';
var OR_CONTROLLER_FILE  = '<?php echo  OR_CONTROLLER_FILE ?>';
var REQ_PARAM_TOKEN  = '<?php echo  REQ_PARAM_TOKEN ?>';
var REQ_PARAM_ACTION  = '<?php echo  REQ_PARAM_ACTION ?>';
var REQ_PARAM_SUBACTION  = '<?php echo  REQ_PARAM_SUBACTION ?>';
var REQ_PARAM_TARGETSUBACTION  = '<?php echo  REQ_PARAM_TARGETSUBACTION ?>';
var REQ_PARAM_ID  = '<?php echo  REQ_PARAM_ID ?>';
var REQ_PARAM_OBJECT_ID  = '<?php echo  REQ_PARAM_OBJECT_ID ?>';
var REQ_PARAM_LANGUAGE_ID  = '<?php echo  REQ_PARAM_LANGUAGE_ID ?>';
var REQ_PARAM_MODEL_ID  = '<?php echo  REQ_PARAM_MODEL_ID ?>';
var REQ_PARAM_PROJECT_ID  = '<?php echo  REQ_PARAM_PROJECT_ID ?>';
var REQ_PARAM_ELEMENT_ID  = '<?php echo  REQ_PARAM_ELEMENT_ID ?>';
var REQ_PARAM_TEMPLATE_ID  = '<?php echo  REQ_PARAM_TEMPLATE_ID ?>';
var REQ_PARAM_DATABASE_ID  = '<?php echo  REQ_PARAM_DATABASE_ID ?>';
var REQ_PARAM_TARGET  = '<?php echo  REQ_PARAM_TARGET ?>';
// -->
</script>


<?php global $viewCache; /* Debug-Information */ if (@$showDuration||true) { echo "<!-- Output Variables are:\n";echo str_replace('-->','-- >',print_r($viewCache,true));echo "\n-->";} ?>

<div id="noticebar">
</div>

<div id="header">
	<ul id="history">
	</ul>
</div>


<div id="workbench">
</div>


<div id="dialog" class="panel wide">
</div>


<div class="noscript"><em>Javascript is required to view this site</em></div>

<form class="invisible" target="temp" action="">
<input type="text" id="uname" name="l1" /><input id="upassword" type="password" name="l2" /><input type="submit" /> 
</form>
<iframe src="about:blank" name="temp" class="invisiblex" width="0px" height="0px" style="width:0px;height:0px;"></iframe>

<div id="filler">
</div>


</body>
</html>
