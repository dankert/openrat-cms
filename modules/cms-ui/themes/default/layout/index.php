<?php
        extract($output);
 if (!defined('OR_VERSION')) die('Forbidden');
 if (!headers_sent()) header('Content-Type: text/html; charset=UTF-8')
?><!DOCTYPE html>
<html class="theme-<?php echo strtolower($style) ?> nojs">
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
<?php if (isset($metaList) && is_array($metaList)) foreach( $metaList as $meta )
      {
       	?>
  <link rel="<?php echo $meta['name'] ?>" href="<?php echo $meta['url'] ?>" title="<?php echo $meta['title'] ?>" ><?php
      } ?>

<?php foreach( $jsFiles  as $jsFile ) { ?>  <script src="<?php echo $jsFile ?>" defer></script>
<?php } ?>
  <link rel="stylesheet" type="text/css" href="<?php echo OR_HTML_MODULES_DIR . 'editor/codemirror/lib/codemirror.css' ?>" />
<?php foreach( $cssFiles as $cssFile) { ?>  <link rel="stylesheet" type="text/css" href="<?php echo $cssFile ?>" />
<?php } ?>
  <link rel="stylesheet" type="text/css" href="<?php echo Html::url('index','themestyle',0,array('embed'=>'1')) ?>" />
  <meta name="theme-color" content="<?php echo $themeColor ?>" />
  <link rel="manifest" href="<?php echo Html::url('index','manifest',0,array('embed'=>'1')) ?>" />
</head>

<body>


<div id="workbench" class="initial-hidden">

    <header id="title" class="view view-static" data-action="title" data-method="show">
        <?php echo embedView('title','show'); ?>
    </header>


    <div>

        <nav>
            <header>
                <a href=""></a>
            </header>
            <div id="navigation" class="view view-static" data-action="tree" data-method="tree">
                <?php embedView('tree','tree'); ?>
            </div>

        </nav>

        <main>
            <header>
                <span class="title"></span>
            </header>
            <div id="editor" class="view view-loader" data-action="<?php echo $action ?>" data-method="edit" data-id="<?php echo $id ?>">
                <?php embedView($action,'edit'); ?>
            </div>

        </main>

        <aside>
            <header>
                <a href=""></a>
            </header>
            <div id="info" class="view view-loader" data-method="info" data-id="<?php echo $id ?>">
                <?php embedView($action,'info'); ?>
            </div>

        </aside>
    </div>

</div>


<?php /* Modal dialog */ ?>
<div id="dialog" class="is-<?php echo empty($dialogAction)?'closed':'open' ?>">
    <div class="view" class="">
        <?php // Shows directly a modal dialog (if present)
              if(!empty($dialogAction))
                  embedView($dialogAction,$dialogMethod);
        ?>
    </div>

    <div id="filler"><?php /* empty element, this is only for styling the background. */ ?>
        <span class="icon">X</span>
    </div>
</div>


<div id="noticebar">
    <?php /* Inline Notices */if(is_array($notices)) foreach( $notices as $notice ) { ?>
        <div class="notice <?php echo $notice['status'] ?>"><div class="text"><?php echo $notice['text'] ?></div></div>'
    <?php } ?>
</div>

<footer class="initial-hidden" id="footer">

</footer>

<noscript><div class="noscript"><em>Javascript is required to view this site</em></div></noscript>

</body>
</html>
<?php
function embedView( $action, $method ) {
        if (DEVELOPMENT)
            echo "<!-- $action - $method -->";
        echo cms_ui\UI::executeEmbedded($action,$method);
}
?>