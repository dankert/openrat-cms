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
  <link rel="stylesheet" type="text/css" href="<?php echo Html::url('index','themestyle') ?>" />
  <meta name="theme-color" content="<?php echo $themeColor ?>" />
  <link rel="manifest" href="<?php echo Html::url('index','manifest') ?>" />
</head>

<body>


<header id="header" class="initial-hidden">
	<ul id="history">
	</ul>
</header>


<main id="workbench" class="initial-hidden">

    <?php
    global $viewconfig;
    $viewconfig = parse_ini_file(__DIR__.'/perspective/normal.ini.php',true);

    require_once(__DIR__.'/perspective/window.php');
    ?>

    <!-- Workbench 2 -->
    <div class="container axle-x">

        <div id="panel-tree" class="panel small resizable" id="navigationbar" data-size-factor="0.2">
            <?php
            view_header('tree');
            ?>
        </div>

        <div class="divider to-right"></div>

        <div class="container axle-y autosize">

            <div class="container axle-x autosize">

                <div id="panel-content" class="panel wide autosize">
                    <?php
                    view_header('content');
                    ?>
                </div>

                <div class="divider to-left"></div>

                <div id="panel-side" class="panel small resizable" data-size-factor="0.25">
                    <?php
                    view_header('side');
                    ?>
                </div>

            </div>


            <div class="divider to-top"></div>

            <div id="panel-bottom" class="panel wide resizable" data-size-factor="0.25">
                <?php
                view_header('bottom');
                ?>
            </div>

        </div>

    </div>

</main>

<?php /* Modal dialog */ ?>
<div id="dialog" class="panel wide">
</div>

<div id="filler">
</div>

<div id="noticebar">
</div>

<footer class="initial-hidden" id="footer">

</footer>

<noscript><div class="noscript"><em>Javascript is required to view this site</em></div></noscript>

</body>
</html>
