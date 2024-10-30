<?php /* THIS FILE IS GENERATED from search.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-dialog-title') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-toolbar-icon or-search-input') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-search') ?>"><?php echo O::escapeHtml('') ?></i>
      <input name="<?php echo O::escapeHtml('text') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('search').'') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$text.'') ?>" class="<?php echo O::escapeHtml('or-title-input or-input') ?>" /><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-delete or-act-search-delete or-search--on-active') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--dropdown or-menu-dropdown-icon or-search--on-active') ?>"><?php echo O::escapeHtml('') ?></i>
    </div>
  </div>
  <div class="<?php echo O::escapeHtml('or-search-results') ?>"><?php echo O::escapeHtml('') ?></div>