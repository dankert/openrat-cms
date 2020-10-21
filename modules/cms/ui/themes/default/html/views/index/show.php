<?php
 defined('APP_STARTED') || die('Forbidden');
 use cms\base\Configuration as C;
 use cms\base\Language as L;
 use cms\base\Startup;
 use util\Html;
 if (!headers_sent()) header('Content-Type: text/html; charset=UTF-8')
?><!DOCTYPE html>
<html class="or-theme-<?php echo strtolower($style) ?> nojs" lang="<?php $language ?>">
<head>
  <title data-default="<?php echo htmlentities($defaultTitle,ENT_QUOTES|ENT_HTML5) ?>"><?php echo htmlentities($defaultTitle,ENT_COMPAT|ENT_HTML5) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="<?php echo $charset ?>">
  <meta name="robots" content="noindex,nofollow" >
  <script src="<?php echo $scriptLink ?>" defer></script>
  <link rel="stylesheet" type="text/css" href="<?php echo $styleLink ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo $themeStyleLink ?>" />
  <meta id="theme-color" name="theme-color" content="<?php echo $themeColor ?>" />
  <link rel="manifest" href="<?php echo Html::url('index','manifest',0) ?>" />
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $favicon_url ?>">
</head>

<body>


<div id="workbench" class="or-workbench or--initial-hidden">

    <header id="title" class="or-workbench-title or-view or-act-view-static" data-action="title" data-method="show">
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
                <section class="or-collapsible or-collapsible--is-<?php echo $method ['open']?'open':'closed' ?>">

                    <header class="or-view-header or-collapsible-act-switch or-collapsible-title">
                        <span class="or-view-icon or-image-icon or-image-icon--method-<?php echo $method['name'] ?>" ></span>
						<?php echo L::lang('METHOD_'.$method['name'] ) ?>
						<i class="or-collapsible--on-open or-image-icon or-image-icon--node-open"></i>
						<i class="or-collapsible--on-closed or-image-icon or-image-icon--node-closed"></i>
                    </header>

                    <div class="or-collapsible-value or-view or-act-view-loader or-closable" data-method="<?php echo $method['name'] ?>"></div>
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