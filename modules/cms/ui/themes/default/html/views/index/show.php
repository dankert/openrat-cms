<?php
 defined('APP_STARTED') || die('Forbidden');
 use cms\base\Startup;use util\Html;
 if (!headers_sent()) header('Content-Type: text/html; charset=UTF-8')
?><!DOCTYPE html>
<html class="or-theme-<?php echo strtolower($style) ?> nojs" lang="<?php echo \cms\base\Configuration::Conf()->subset('language')->get('language_code') ?>">
<head>
<?php $appName = \cms\base\Configuration::config('application','name'); $appOperator = \cms\base\Configuration::config('application','operator');
      $title = $appName.(($appOperator!=$appName)?' - '.$appOperator:''); ?>
  <title data-default="<?php echo htmlentities($title,ENT_QUOTES|ENT_HTML5) ?>"><?php echo htmlentities($title,ENT_COMPAT|ENT_HTML5) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
    <?php if ( isset($refresh_url) ) { ?>
  <meta http-equiv="refresh" content="<?php echo isset($refresh_timeout)?$refresh_timeout:0 ?>; URL=<?php echo $refresh_url; if (ini_get('session.use_trans_sid')) echo '&'.session_name().'='.session_id(); ?>">
<?php } ?>
  <meta name="robots" content="noindex,nofollow" >
<?php foreach( $jsFiles  as $jsFile ) { ?>  <script src="<?php echo $jsFile ?>" defer></script>
<?php } ?>
  <link rel="stylesheet" type="text/css" href="<?php echo Startup::HTML_MODULES_DIR . 'editor/codemirror/lib/codemirror.css' ?>" />
<?php foreach( $cssFiles as $cssFile) { ?>  <link rel="stylesheet" type="text/css" href="<?php echo $cssFile ?>" />
<?php } ?>
  <link rel="stylesheet" type="text/css" href="<?php echo Html::url('index','themestyle',0,array('embed'=>'1')) ?>" />
  <meta id="theme-color" name="theme-color" content="<?php echo $themeColor ?>" />
  <link rel="manifest" href="<?php echo Html::url('index','manifest',0,array('embed'=>'1')) ?>" />
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $favicon_url ?>">
</head>

<body>


<div id="workbench" class="or--initial-hidden">

    <header id="title" class="or-view or-act-view-static" data-action="title" data-method="show">
    </header>


    <div class="or-main-area">

        <nav class="or-navigation">
            <div class="or-view or-act-view-static" data-action="tree" data-method="show">
            </div>

        </nav>

        <div class="or-workplace">

            <main id="editor">
                <header>
                    <div class="or-breadcrumb"></div>
                </header>

                <?php foreach( $methodList as $method ) { ?>
                <?php if (DEVELOPMENT) echo "<!-- Section for: ".$method['name']." -->";  ?>
                <section class="toggle-open-close <?php echo $method ['open']?'open':'closed' ?>">

                    <header class="or-view-header on-click-open-close">
                        <!--
                        <div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div>
                        -->
                        <span class="or-view-icon image-icon image-icon--method-<?php echo $method['name'] ?>" ></span>
                        <h1 class="or-view-headline"><?php echo \cms\base\Language::lang('METHOD_'.$method['name'] ) ?></h1>
                    </header>

                    <!--
                    <div class="view-toolbar">
                        <img src="<?php echo Startup::THEMES_DIR ?>/default/images/icon/menu/fullscreen.svg" class="image-icon on-normalscreen toolbar-action-fullscreen" />
                        <img src="<?php echo Startup::THEMES_DIR ?>/default/images/icon/menu/fullscreen_exit.svg" class="image-icon on-fullscreen toolbar-action-exit-fullscreen"  />
                        <img src="<?php echo Startup::THEMES_DIR ?>/default/images/icon/menu/refresh.svg" class="image-icon toolbar-action-refresh" />
                    </div>
                        -->


                    <div class="or-view or-act-view-loader or-closable" data-method="<?php echo $method['name'] ?>"></div>

                </section>
                <?php } ?>

            </main>
        </div>

    </div>

</div>


<?php /* Modal dialog */ ?>
<div id="dialog" class="or-dialog <?php echo empty($dialogAction)?'':'or-dialog--is-open' ?>" data-action="<?php echo (!empty($dialogAction)?$dialogAction:'') ?>" data-method="<?php echo (!empty($dialogMethod)?$dialogMethod:'') ?>">
    <div class="or-view or-round-corners">
    </div>

    <div class="or-dialog-filler"><?php /* empty element, this is only for styling the background. */ ?>
        <span class="or-dialog-filler-icon or-btn or-image-icon or-image-icon--menu-close"></span>
    </div>
</div>


<div id="noticebar" class="or-notices">
</div>

<?php /* Inline Notices */ foreach( $notices as $notice ) { ?>
<div class="or--invisible or-act-initial-notice"><?php echo $notice['text'] ?></div>
<?php } ?>


<footer class="or--initial-hidden" id="footer">

</footer>

<noscript><div class="noscript"><em>Javascript is required to view this site</em></div></noscript>

</body>
</html>