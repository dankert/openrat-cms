<?php /* THIS FILE IS GENERATED from show.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?><!DOCTYPE html><html class="<?php echo O::escapeHtml('or-theme-'.@$style.' nojs') ?>" lang="<?php echo O::escapeHtml(''.@$language.'') ?>"><?php echo '' ?>
  <head><?php echo '' ?>
    <title data-default="<?php echo O::escapeHtml(''.@$defaultTitle.'') ?>"><?php echo '' ?>
      <?php echo O::escapeHtml(''.@$defaultTitle.'') ?>
    </title>
    <meta name="<?php echo O::escapeHtml('viewport') ?>" content="<?php echo O::escapeHtml('width=device-width, initial-scale=1.0') ?>" /><?php echo '' ?>
    <meta charset="<?php echo O::escapeHtml(''.@$charset.'') ?>" /><?php echo '' ?>
    <meta name="<?php echo O::escapeHtml('robots') ?>" content="<?php echo O::escapeHtml('noindex,nofollow') ?>" /><?php echo '' ?>
    <script src="<?php echo O::escapeHtml(''.@$scriptLink.'') ?>" defer="<?php echo O::escapeHtml('defer') ?>"><?php echo '' ?>
    </script>
    <link rel="<?php echo O::escapeHtml('stylesheet') ?>" type="<?php echo O::escapeHtml('text/css') ?>" href="<?php echo O::escapeHtml(''.@$styleLink.'') ?>" /><?php echo '' ?>
    <link rel="<?php echo O::escapeHtml('stylesheet') ?>" type="<?php echo O::escapeHtml('text/css') ?>" href="<?php echo O::escapeHtml(''.@$themeStyleLink.'') ?>" /><?php echo '' ?>
    <meta id="<?php echo O::escapeHtml('theme-color') ?>" name="<?php echo O::escapeHtml('theme-color') ?>" content="<?php echo O::escapeHtml(''.@$themeColor.'') ?>" /><?php echo '' ?>
    <link rel="<?php echo O::escapeHtml('manifest') ?>" href="<?php echo O::escapeHtml(''.@$manifestLink.'') ?>" /><?php echo '' ?>
    <link rel="<?php echo O::escapeHtml('shortcut icon') ?>" type="<?php echo O::escapeHtml('image/x-icon') ?>" href="<?php echo O::escapeHtml(''.@$favicon_url.'') ?>" /><?php echo '' ?>
  </head>
  <body><?php echo '' ?>
    <div id="<?php echo O::escapeHtml('workbench') ?>" class="<?php echo O::escapeHtml('or-workbench or--initial-hidden') ?>"><?php echo '' ?>
      <header id="<?php echo O::escapeHtml('title') ?>" class="<?php echo O::escapeHtml('or-workbench-title or-view or-act-view-static') ?>" data-action="<?php echo O::escapeHtml('title') ?>" data-method="<?php echo O::escapeHtml('show') ?>"><?php echo '' ?>
      </header>
      <div class="<?php echo O::escapeHtml('or-main-area') ?>"><?php echo '' ?>
        <nav class="<?php echo O::escapeHtml('or-navigation') ?>"><?php echo '' ?>
          <div class="<?php echo O::escapeHtml('or-view or-act-view-static') ?>" data-action="<?php echo O::escapeHtml('tree') ?>" data-method="<?php echo O::escapeHtml('show') ?>"><?php echo '' ?>
          </div>
        </nav>
        <div class="<?php echo O::escapeHtml('or-workplace') ?>"><?php echo '' ?>
          <main id="<?php echo O::escapeHtml('editor') ?>"><?php echo '' ?>
            <header><?php echo '' ?>
              <div class="<?php echo O::escapeHtml('or-breadcrumb') ?>"><?php echo '' ?>
              </div>
            </header>
            <?php foreach((array)$methodList as $list_key=>$method) {  ?>
              <section class="<?php echo O::escapeHtml('or-collapsible or-collapsible--is-open') ?>"><?php echo '' ?>
                <header class="<?php echo O::escapeHtml('or-view-header or-collapsible-act-switch or-collapsible-title') ?>"><?php echo '' ?>
                  <span class="<?php echo O::escapeHtml('or-view-icon or-image-icon or-image-icon--method-'.@$method['name'].'') ?>"><?php echo '' ?>
                  </span>
                  <span><?php echo O::escapeHtml(''.@O::lang('METHOD_'.@$method['name'].'').'') ?>
                  </span>
                  <i class="<?php echo O::escapeHtml('or-collapsible--on-open or-image-icon or-image-icon--node-open') ?>"><?php echo '' ?>
                  </i>
                  <i class="<?php echo O::escapeHtml('or-collapsible--on-closed or-image-icon or-image-icon--node-closed') ?>"><?php echo '' ?>
                  </i>
                </header>
                <div class="<?php echo O::escapeHtml('or-collapsible-value or-view or-act-view-loader or-closable') ?>" data-method="<?php echo O::escapeHtml(''.@$method['name'].'') ?>"><?php echo '' ?>
                </div>
              </section>
             <?php } ?>
          </main>
        </div>
      </div>
    </div>
    <div id="<?php echo O::escapeHtml('dialog') ?>" class="<?php echo O::escapeHtml('or-dialog or-dialog--is-closed') ?>" data-action="<?php echo O::escapeHtml(''.@$dialogAction.'') ?>" data-method="<?php echo O::escapeHtml(''.@$dialogMethod.'') ?>"><?php echo '' ?>
      <div class="<?php echo O::escapeHtml('or-view or-round-corners') ?>"><?php echo '' ?>
      </div>
      <div class="<?php echo O::escapeHtml('or-dialog-filler') ?>"><?php echo '' ?>
        <span class="<?php echo O::escapeHtml('or-dialog-filler-icon or-btn or-image-icon or-image-icon--menu-close') ?>"><?php echo '' ?>
        </span>
      </div>
    </div>
    <div id="<?php echo O::escapeHtml('noticebar') ?>" class="<?php echo O::escapeHtml('or-notices') ?>"><?php echo '' ?>
    </div>
    <?php foreach((array)$notices as $list_key=>$notice) {  ?>
      <div class="<?php echo O::escapeHtml('or--invisible or-act-initial-notice') ?>"><?php echo '' ?>
        <span><?php echo O::escapeHtml(''.@$notice['text'].'') ?>
        </span>
      </div>
     <?php } ?>
    <footer class="<?php echo O::escapeHtml('or--initial-hidden') ?>" id="<?php echo O::escapeHtml('footer') ?>"><?php echo '' ?>
    </footer>
    <noscript><?php echo '' ?>
      <div class="<?php echo O::escapeHtml('noscript') ?>"><?php echo '' ?>
        <em><?php echo '' ?>
        </em>
      </div>
    </noscript>
  </body>
</html>