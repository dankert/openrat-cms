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
      <div class="<?php echo O::escapeHtml('or-workbench-navigation') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-workbench-screen or-workbench-navigation-content') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-workbench-title or-workbench-search') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-menu') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-menu-group') ?>"><?php echo O::escapeHtml('') ?>
                <div class="<?php echo O::escapeHtml('or-toolbar-icon or-act-nav-small or--visible-on-desktop') ?>"><?php echo O::escapeHtml('') ?>
                  <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--menu-close') ?>"><?php echo O::escapeHtml('') ?></i>
                </div>
                <div class="<?php echo O::escapeHtml('or-toolbar-icon or-act-navigation-close or--visible-on-mobile') ?>"><?php echo O::escapeHtml('') ?>
                  <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--menu-close') ?>"><?php echo O::escapeHtml('') ?></i>
                </div>
                <div class="<?php echo O::escapeHtml('or-toolbar-icon or-search') ?>"><?php echo O::escapeHtml('') ?>
                  <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-search') ?>"><?php echo O::escapeHtml('') ?></i>
                  <input name="<?php echo O::escapeHtml('text') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('search').'') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$text.'') ?>" class="<?php echo O::escapeHtml('or-title-input or-input') ?>" /><?php echo O::escapeHtml('') ?>
                  <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-delete or-act-search-delete') ?>"><?php echo O::escapeHtml('') ?></i>
                  <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--dropdown or-menu-dropdown-icon') ?>"><?php echo O::escapeHtml('') ?></i>
                </div>
              </div>
            </div>
          </div>
          <nav class="<?php echo O::escapeHtml('or-workbench-navigation-container or-navigation or-workbench-content') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-view or-act-view-static or-navigation-content') ?>" data-action="<?php echo O::escapeHtml('tree') ?>" data-method="<?php echo O::escapeHtml('show') ?>"><?php echo O::escapeHtml('') ?></div>
            <div class="<?php echo O::escapeHtml('or-search-result or-act-search-result') ?>"><?php echo O::escapeHtml('') ?></div>
          </nav>
        </div>
        <div class="<?php echo O::escapeHtml('or-workbench-navigation-filler or-act-navigation-close') ?>"><?php echo O::escapeHtml('') ?></div>
      </div>
      <div class="<?php echo O::escapeHtml('or-workbench-main or-workbench-screen') ?>"><?php echo O::escapeHtml('') ?>
        <header id="<?php echo O::escapeHtml('title') ?>" class="<?php echo O::escapeHtml('or-workbench-title or-view or-act-view-static') ?>" data-action="<?php echo O::escapeHtml('title') ?>" data-method="<?php echo O::escapeHtml('show') ?>"><?php echo O::escapeHtml('') ?></header>
        <main class="<?php echo O::escapeHtml('or-workbench-workplace or-workbench-content') ?>"><?php echo O::escapeHtml('') ?>
          <?php  { $mainMethodName= 'edit'; ?>
           <?php } ?>
          <section class="<?php echo O::escapeHtml('or-workbench-section') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-collapsible-value or-view or-act-view-loader') ?>" data-method="<?php echo O::escapeHtml(''.@$mainMethodName.'') ?>"><?php echo O::escapeHtml('') ?></div>
          </section>
        </main>
        <div id="<?php echo O::escapeHtml('dialog') ?>" class="<?php echo O::escapeHtml('or-dialog or-dialog--is-closed') ?>" data-action="<?php echo O::escapeHtml(''.@$dialogAction.'') ?>" data-method="<?php echo O::escapeHtml(''.@$dialogMethod.'') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-dialog-filler') ?>"><?php echo O::escapeHtml('') ?>
            <span class="<?php echo O::escapeHtml('or-dialog-filler-icon or-btn or-image-icon or-image-icon--menu-close') ?>"><?php echo O::escapeHtml('') ?></span>
          </div>
          <div class="<?php echo O::escapeHtml('or-dialog-content or-workbench-screen') ?>"><?php echo O::escapeHtml('') ?>
            <header class="<?php echo O::escapeHtml('or-workbench-title or-dialog-title') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-menu') ?>"><?php echo O::escapeHtml('') ?>
                <div class="<?php echo O::escapeHtml('or-menu-group') ?>"><?php echo O::escapeHtml('') ?>
                  <div class="<?php echo O::escapeHtml('or-toolbar-icon or-workbench--visible-on-wide or-act-nav-small or-act-dialog-close') ?>"><?php echo O::escapeHtml('') ?>
                    <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--menu-back') ?>"><?php echo O::escapeHtml('') ?></i>
                  </div>
                  <div class="<?php echo O::escapeHtml('or-act-dialog-name') ?>"><?php echo O::escapeHtml('') ?></div>
                </div>
                <div class="<?php echo O::escapeHtml('or-menu-group') ?>"><?php echo O::escapeHtml('') ?>
                  <div class="<?php echo O::escapeHtml('or-toolbar-icon or--visible-on-desktop or-act-clickable or-act-dialog-close') ?>"><?php echo O::escapeHtml('') ?>
                    <a title="<?php echo O::escapeHtml(''.@O::lang('menu_pub_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('pub') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('pub') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'pub\'}') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--menu-close') ?>"><?php echo O::escapeHtml('') ?></i>
                    </a>
                  </div>
                </div>
              </div>
            </header>
            <div class="<?php echo O::escapeHtml('or-workbench-content') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-view') ?>"><?php echo O::escapeHtml('') ?></div>
            </div>
          </div>
        </div>
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