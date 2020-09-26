<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('clickable') ?>"><?php echo O::escapeHtml('') ?>
    <a target="<?php echo O::escapeHtml('_self') ?>" data-url="<?php echo O::escapeHtml(''.@$preview_url.'') ?>" data-type="<?php echo O::escapeHtml('popup') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('/#//') ?>" class="<?php echo O::escapeHtml('action') ?>"><?php echo O::escapeHtml('') ?>
      <span><?php echo O::escapeHtml(''.@O::lang('LINK_OPEN_IN_NEW_WINDOW').'') ?>
      </span>
    </a>
  </div>