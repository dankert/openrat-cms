<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="<?php echo escapeHtml('preview') ?>"><?php echo escapeHtml('') ?>
      <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
        <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('page_preview').'') ?>
          <img /><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
          </div>
          <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo ''.@$preview.'' ?>
          </span>
        </div>
      </fieldset>
    </div>
 <?php } ?>