<?php /* THIS FILE IS GENERATED from show.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?><!DOCTYPE html><html class="<?php echo O::escapeHtml('or-theme-'.@$style.' or-nojs') ?>" lang="<?php echo O::escapeHtml(''.@$language.'') ?>"><?php echo O::escapeHtml('') ?>
  <head><?php echo O::escapeHtml('') ?>
    <title data-default="<?php echo O::escapeHtml(''.@$defaultTitle.'') ?>"><?php echo O::escapeHtml('') ?>
      <?php echo O::escapeHtml(''.@$defaultTitle.'') ?>
    </title>
    <meta name="<?php echo O::escapeHtml('viewport') ?>" content="<?php echo O::escapeHtml('width=device-width, initial-scale=1.0') ?>" /><?php echo O::escapeHtml('') ?>
    <meta charset="<?php echo O::escapeHtml(''.@$charset.'') ?>" /><?php echo O::escapeHtml('') ?>
    <meta name="<?php echo O::escapeHtml('robots') ?>" content="<?php echo O::escapeHtml('noindex,nofollow') ?>" /><?php echo O::escapeHtml('') ?>
    <script src="<?php echo O::escapeHtml(''.@$scriptLink.'') ?>" defer="<?php echo O::escapeHtml('defer') ?>"><?php echo O::escapeHtml('') ?></script>
    <link rel="<?php echo O::escapeHtml('stylesheet') ?>" type="<?php echo O::escapeHtml('text/css') ?>" href="<?php echo O::escapeHtml(''.@$styleLink.'') ?>" /><?php echo O::escapeHtml('') ?>
    <link rel="<?php echo O::escapeHtml('stylesheet') ?>" type="<?php echo O::escapeHtml('text/css') ?>" href="<?php echo O::escapeHtml(''.@$themeStyleLink.'') ?>" /><?php echo O::escapeHtml('') ?>
    <meta id="<?php echo O::escapeHtml('theme-color') ?>" name="<?php echo O::escapeHtml('theme-color') ?>" content="<?php echo O::escapeHtml(''.@$themeColor.'') ?>" /><?php echo O::escapeHtml('') ?>
    <link rel="<?php echo O::escapeHtml('manifest') ?>" href="<?php echo O::escapeHtml(''.@$manifestLink.'') ?>" /><?php echo O::escapeHtml('') ?>
    <link rel="<?php echo O::escapeHtml('shortcut icon') ?>" type="<?php echo O::escapeHtml('image/x-icon') ?>" href="<?php echo O::escapeHtml(''.@$favicon_url.'') ?>" /><?php echo O::escapeHtml('') ?>
  </head>
  <body><?php echo O::escapeHtml('') ?>
    <div id="<?php echo O::escapeHtml('workbench') ?>" class="<?php echo O::escapeHtml('or-workbench or--initial-hidden') ?>"><?php echo O::escapeHtml('') ?>
      <nav class="<?php echo O::escapeHtml('or-workbench-navigation') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-workbench-navigation-container') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-view or-act-view-static') ?>" data-action="<?php echo O::escapeHtml('tree') ?>" data-method="<?php echo O::escapeHtml('show') ?>"><?php echo O::escapeHtml('') ?></div>
        </div>
      </nav>
      <div class="<?php echo O::escapeHtml('or-workbench-main') ?>"><?php echo O::escapeHtml('') ?>
        <header id="<?php echo O::escapeHtml('title') ?>" class="<?php echo O::escapeHtml('or-workbench-title or-view or-act-view-static') ?>" data-action="<?php echo O::escapeHtml('title') ?>" data-method="<?php echo O::escapeHtml('show') ?>"><?php echo O::escapeHtml('') ?></header>
        <main class="<?php echo O::escapeHtml('or-workbench-workplace') ?>"><?php echo O::escapeHtml('') ?>
          <header><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-breadcrumb') ?>"><?php echo O::escapeHtml('') ?></div>
          </header>
          <?php foreach((array)$methodList as $list_key=>$method) {  ?>
            <section class="<?php echo O::escapeHtml('or-workbench-section or-collapsible or-collapsible--is-open') ?>"><?php echo O::escapeHtml('') ?>
              <header class="<?php echo O::escapeHtml('or-view-header or-collapsible-act-switch or-collapsible-title') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('or-collapsible--on-open or-image-icon or-image-icon--node-open') ?>"><?php echo O::escapeHtml('') ?></i>
                <i class="<?php echo O::escapeHtml('or-collapsible--on-closed or-image-icon or-image-icon--node-closed') ?>"><?php echo O::escapeHtml('') ?></i>
                <span class="<?php echo O::escapeHtml('or-view-icon or-image-icon or-image-icon--method-'.@$method['name'].'') ?>"><?php echo O::escapeHtml('') ?></span>
                <span><?php echo O::escapeHtml(''.@O::lang('METHOD_'.@$method['name'].'').'') ?></span>
              </header>
              <div class="<?php echo O::escapeHtml('or-collapsible-value or-view or-act-view-loader or-closable') ?>" data-method="<?php echo O::escapeHtml(''.@$method['name'].'') ?>"><?php echo O::escapeHtml('') ?></div>
            </section>
           <?php } ?>
        </main>
      </div>
    </div>
    <div id="<?php echo O::escapeHtml('dialog') ?>" class="<?php echo O::escapeHtml('or-dialog or-dialog--is-closed') ?>" data-action="<?php echo O::escapeHtml(''.@$dialogAction.'') ?>" data-method="<?php echo O::escapeHtml(''.@$dialogMethod.'') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-view or-round-corners') ?>"><?php echo O::escapeHtml('') ?></div>
      <div class="<?php echo O::escapeHtml('or-dialog-filler') ?>"><?php echo O::escapeHtml('') ?>
        <span class="<?php echo O::escapeHtml('or-dialog-filler-icon or-btn or-image-icon or-image-icon--menu-close') ?>"><?php echo O::escapeHtml('') ?></span>
      </div>
    </div>
    <div id="<?php echo O::escapeHtml('noticebar') ?>" class="<?php echo O::escapeHtml('or-notices') ?>"><?php echo O::escapeHtml('') ?>
      <?php foreach((array)$notices as $list_key=>$notice) {  ?>
        <div class="<?php echo O::escapeHtml('or--invisible or-act-initial-notice') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@$notice['text'].'') ?></span>
        </div>
       <?php } ?>
    </div>
    <noscript><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-nojs-text') ?>"><?php echo O::escapeHtml('') ?></div>
    </noscript>
  </body>
</html>