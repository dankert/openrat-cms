<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
      <a target="<?php echo escapeHtml('_self') ?>" data-url="<?php echo escapeHtml(''.@$preview_url.'') ?>" data-type="<?php echo escapeHtml('popup') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#//') ?>" class="<?php echo escapeHtml('action') ?>"><?php echo escapeHtml('') ?>
        <span><?php echo escapeHtml(''.@lang('LINK_OPEN_IN_NEW_WINDOW').'') ?>
        </span>
      </a>
    </div>
 <?php } ?>