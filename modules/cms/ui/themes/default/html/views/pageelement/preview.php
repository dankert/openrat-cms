<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('preview') ?>"><?php echo O::escapeHtml('') ?>
    <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
      <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('page_preview').'') ?>
        <img /><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo O::escapeHtml('') ?>
        </div>
        <div class="<?php echo O::escapeHtml('arrow arrow-down on-open') ?>"><?php echo O::escapeHtml('') ?>
        </div>
      </legend>
      <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
        <span><?php echo ''.@$preview.'' ?>
        </span>
      </div>
    </fieldset>
  </div>