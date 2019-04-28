    <?php
        extract($output);
 if (!defined('OR_VERSION')) die('Forbidden');
 if (!headers_sent()) header('Content-Type: text/html; charset=UTF-8')
?><!DOCTYPE html>
<html class="theme-<?php echo strtolower($style) ?> nojs" lang="<?php echo Conf()->subset('language')->get('language_code') ?>">
<head>
<?php $appName = config('application','name'); $appOperator = config('application','operator');
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
  <link rel="stylesheet" type="text/css" href="<?php echo OR_HTML_MODULES_DIR . 'editor/codemirror/lib/codemirror.css' ?>" />
<?php foreach( $cssFiles as $cssFile) { ?>  <link rel="stylesheet" type="text/css" href="<?php echo $cssFile ?>" />
<?php } ?>
  <link rel="stylesheet" type="text/css" href="<?php echo Html::url('index','themestyle',0,array('embed'=>'1')) ?>" />
  <meta name="theme-color" content="<?php echo $themeColor ?>" />
  <link rel="manifest" href="<?php echo Html::url('index','manifest',0,array('embed'=>'1')) ?>" />
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $favicon_url ?>">
</head>

<body>


<div id="workbench" class="initial-hidden">

    <header id="title" class="view view-static" data-action="title" data-method="show">
        <?php echo embedView('title','show', 0); ?>
    </header>


    <div>

        <nav>
            <header>
                <a href=""></a>
            </header>
            <div id="navigation" class="or-navtree view view-static" data-action="tree" data-method="tree">
                <?php embedView('tree','tree',0); ?>
            </div>

        </nav>

        <main id="editor">
            <header>
                <span class="title"></span>
            </header>

            <?php foreach( $methodList as $method ) { ?>
            <?php if (DEVELOPMENT) echo "<!-- Section for : $action / ".$method['name']." / $id  -->";  ?>
            <section class="toggle-open-close <?php echo $method ['open']?'open':'closed' ?>">

                <header class="on-click-open-close">
                    <!--
                    <div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div>
                    -->
                    <img src="<?php echo OR_THEMES_DIR ?>/default/images/icon/method/<?php echo $method['name'] ?>.svg" class="image-icon" />
                    <h1><?php echo lang('METHOD_'.$method['name'] ) ?></h1>
                </header>

                <!--
                <div class="view-toolbar">
                    <img src="<?php echo OR_THEMES_DIR ?>/default/images/icon/menu/fullscreen.svg" class="image-icon on-normalscreen toolbar-action-fullscreen" />
                    <img src="<?php echo OR_THEMES_DIR ?>/default/images/icon/menu/fullscreen_exit.svg" class="image-icon on-fullscreen toolbar-action-exit-fullscreen"  />
                    <img src="<?php echo OR_THEMES_DIR ?>/default/images/icon/menu/refresh.svg" class="image-icon toolbar-action-refresh" />
                </div>
                    -->


                <div class="view view-loader" data-method="<?php echo $method['name'] ?>"><?php if($method ['open']) {embedView($action,$method['name'],$id);}else{echo '';} ?></div>

            </section>
            <?php } ?>

        </main>

        <section id="edit" class="">
            <div class="view"></div>
        </section>

    </div>

</div>


<?php /* Modal dialog */ ?>
<div id="dialog" class="is-<?php echo empty($dialogAction)?'closed':'open' ?>">
    <div class="view or-round-corners">
        <?php // Shows directly a modal dialog (if present)
              if(!empty($dialogAction))
                  embedView($dialogAction,$dialogMethod, 0);
        ?>
    </div>

    <div id="filler"><?php /* empty element, this is only for styling the background. */ ?>
        <span class="icon">X</span>
    </div>
</div>


<div id="noticebar">
    <?php /* Inline Notices */ foreach( $notices as $notice ) { ?>
        <div class="notice <?php echo $notice['status'] ?>">
            <div class="or-notice-toolbar"><i class="or-action-close image-icon image-icon--menu-close"></i></div>
            <div class="text"><?php echo $notice['text'] ?></div></div>
    <?php } ?>
</div>

<footer class="initial-hidden" id="footer">

</footer>

<noscript><div class="noscript"><em>Javascript is required to view this site</em></div></noscript>

</body>
</html>
<?php
function embedView( $action, $method,$id ) {
        cms_ui\UI::executeEmbedded($action,$method,$id);
}
?>