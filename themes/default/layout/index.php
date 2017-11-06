<?php
 if (!defined('OR_VERSION')) die('Forbidden');
 if (!headers_sent()) header('Content-Type: text/html; charset=UTF-8')
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title data-default="<?php config('application','name') ?>"><?php echo config('application','name') ?> ?></title>
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
      
  <?php
  
  $css = array();
//   $css[] = link id="userstyle" rel="stylesheet" type="text/css" href="<?php echo css_link($style) "
  $css['userstyle'] = css_link($style);
  
  $css[] = OR_THEMES_EXT_DIR.'../editor/markitup/markitup/skins/markitup/style.css';
  $css[] = OR_THEMES_EXT_DIR.'../editor/markitup/markitup/sets/default/style.css';
  
    // Komponentenbasiertes CSS
		$elements = parse_ini_file( OR_THEMES_DIR.$conf['interface']['theme'].'/include/elements.ini.'.PHP_EXT);
		
		foreach( array_keys($elements) as $c )
		{
		    $componentCssFile = OR_THEMES_DIR.$conf['interface']['theme'].'/include/html/'.$c.'/'.$c.'.css';
		    if    ( is_file($componentCssFile) )
		        $css[] = $componentCssFile;
		        
		}
		
  foreach( $css as $id=>$cssFile )
  {
      ?><link <?php if ( !is_numeric($id)) {?>id="<?php echo $id ?>" <?php } ?>rel="stylesheet" type="text/css" href="<?php echo $cssFile ?>" />
      <?php
  }
  
  $js = array();
  $js[] = OR_THEMES_EXT_DIR.'default/js/jquery-1.12.4.min.js';
  $js[] =  OR_THEMES_EXT_DIR.'default/js/jquery-ui/js/jquery-ui-1.8.16.custom.min.js';
  $js[] =  OR_THEMES_EXT_DIR.'default/js/jquery.scrollTo.js';
  //$js[] =  OR_THEMES_EXT_DIR default/js/jquery.mjs.nestedSortable.js"></script>

  //<!-- OpenRat internal JS -->
  $js[] =  OR_THEMES_EXT_DIR.'default/js/openrat.js';
  $js[] =  OR_THEMES_EXT_DIR.'default/js/plugin/jquery-plugin-orHint.js';
  $js[] =  OR_THEMES_EXT_DIR.'default/js/plugin/jquery-plugin-orSearch.js';
  $js[] =  OR_THEMES_EXT_DIR.'default/js/plugin/jquery-plugin-orLinkify.js';
  $js[] =  OR_THEMES_EXT_DIR.'default/js/plugin/jquery-plugin-orTree.js';
  $js[] =  OR_THEMES_EXT_DIR.'default/js/plugin/jquery-plugin-orLoadView.js';
  $js[] =  OR_THEMES_EXT_DIR.'default/js/plugin/jquery-plugin-orAutoheight.js';
  $js[] =  OR_THEMES_EXT_DIR.'default/js/jquery-qrcode.min.js';
    //  $js[] =  OR_THEMES_EXT_DIR.'../editor/wymeditor/wymeditor/jquery.wymeditor.min.js"></script> -->
  $js[] =  OR_THEMES_EXT_DIR.'../editor/markitup/markitup/jquery.markitup.js';
  $js[] =  OR_THEMES_EXT_DIR.'../editor/editor/ckeditor.js';
  $js[] =  OR_THEMES_EXT_DIR.'../editor/ace/src-min-noconflict/ace.js';
  $js[] =  OR_THEMES_EXT_DIR.'../editor/editor/adapters/jquery.js';

    // Komponentenbasiertes Javascript
		
		foreach( array_keys($elements) as $c )
		{
		    $componentJsFile = OR_THEMES_DIR.$conf['interface']['theme'].'/include/html/'.$c.'/'.$c.'.js';
		    if    ( is_file($componentJsFile) )
		        $js[] = $componentJsFile;
		        
		}
		
		foreach( $js as $jsFile )
		{
		  ?><script src="<?php echo $jsFile ?>" defer></script>
		  <?php 
		}
?>  

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
