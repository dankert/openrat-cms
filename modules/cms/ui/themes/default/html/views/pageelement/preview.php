<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('preview') ?>"><?php echo O::escapeHtml('') ?>
    <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
      <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('page_preview').'') ?>
        <img /><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('image-icon image-icon--node-closed on-closed') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <i class="<?php echo O::escapeHtml('image-icon image-icon--node-open on-open') ?>"><?php echo O::escapeHtml('') ?>
        </i>
      </legend>
      <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
        <span><?php echo ''.@$preview.'' ?>
        </span>
      </div>
    </fieldset>
  </div>