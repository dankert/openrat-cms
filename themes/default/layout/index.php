<?php
 if (!defined('OR_VERSION')) die('Forbidden');
 if (!headers_sent()) header('Content-Type: text/html; charset=UTF-8')
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo OR_TITLE.' '.OR_VERSION ?></title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" >
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
  <link id="userstyle" rel="stylesheet" type="text/css" href="<?php echo css_link($style) ?>" >
  
  <link rel="stylesheet" type="text/css" href="<?php echo OR_THEMES_EXT_DIR ?>../editor/markitup/markitup/skins/markitup/style.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo OR_THEMES_EXT_DIR ?>../editor/markitup/markitup/sets/default/style.css" />
  <script src="<?php echo OR_THEMES_EXT_DIR ?>default/js/jquery-1.6.2.min.js"></script>
  <script src="<?php echo OR_THEMES_EXT_DIR ?>default/js/jquery-ui/js/jquery-ui-1.8.16.custom.min.js"></script>
  <script src="<?php echo OR_THEMES_EXT_DIR ?>default/js/jquery.scrollTo.js"></script>
  <!-- 
  <script src="<?php echo OR_THEMES_EXT_DIR ?>default/js/jquery.mjs.nestedSortable.js"></script>
   -->

  <!-- OpenRat internal JS -->
  <script src="<?php echo OR_THEMES_EXT_DIR ?>default/js/openrat.js"></script>
  <script src="<?php echo OR_THEMES_EXT_DIR ?>default/js/plugin/jquery-plugin-orHint.js"></script>
  <script src="<?php echo OR_THEMES_EXT_DIR ?>default/js/plugin/jquery-plugin-orSearch.js"></script>
  <script src="<?php echo OR_THEMES_EXT_DIR ?>default/js/plugin/jquery-plugin-orLinkify.js"></script>
  <script src="<?php echo OR_THEMES_EXT_DIR ?>default/js/plugin/jquery-plugin-orTree.js"></script>
  <script src="<?php echo OR_THEMES_EXT_DIR ?>default/js/plugin/jquery-plugin-orLoadView.js"></script>
  <script src="<?php echo OR_THEMES_EXT_DIR ?>default/js/plugin/jquery-plugin-orAutoheight.js"></script>
  <!-- 
  <script src="<?php echo OR_THEMES_EXT_DIR ?>../editor/wymeditor/wymeditor/jquery.wymeditor.min.js"></script>
   -->
  <script src="<?php echo OR_THEMES_EXT_DIR ?>../editor/markitup/markitup/jquery.markitup.js"></script>
  <script src="<?php echo OR_THEMES_EXT_DIR ?>../editor/editor/ckeditor.js"></script>
  <script src="<?php echo OR_THEMES_EXT_DIR ?>../editor/editor/adapters/jquery.js"></script>
  <!-- 
  <script src="/~dankert/cms-test/cms09/themes/default/js/jquery-ui/js/jquery-ui-1.8.9.custom.min.js"></script>
  <script src="/~dankert/cms/themes/default/js/xxxxxxxxxxxjquery-plugin-orSearchBox.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo OR_THEMES_EXT_DIR ?>default/js/jquery-ui/css/pepper-grinder/jquery-ui-1.8.9.custom.css" >
   -->
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

<script type="text/javascript">
<!--
// Konstanten
var OR_THEMES_EXT_DIR = '<?php echo OR_THEMES_EXT_DIR ?>';
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
	<div id="title">
	</div>
	<ul id="history">
	</ul>
</div>


<div id="workbench">
</div>


<div id="dialog" class="panel wide">
</div>


<script type="text/javascript">
<!--
document.writeln("<div class=\"invisible\">");
// -->
</script>
<noscript><em>Javascript is required to view this site</em></noscript>
<script type="text/javascript">
<!--
document.writeln("</div>");
// -->
</script>

<form class="invisible" target="temp" action="">
<input type="text" id="uname" name="l1" /><input id="upassword" type="password" name="l2" /><input type="submit" /> 
</form>
<iframe src="about:blank" name="temp" class="invisiblex" width="0px" height="0px" style="width:0px;height:0px;"></iframe>

<div id="filler">
</div>


</body>
</html>
