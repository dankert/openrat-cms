<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('toolbar-icon') ?>"><?php echo O::escapeHtml('') ?>
    <i class="<?php echo O::escapeHtml('image-icon image-icon--menu-refresh') ?>"><?php echo O::escapeHtml('') ?>
    </i>
  </div>
  <iframe name="<?php echo O::escapeHtml('preview') ?>" src="<?php echo O::escapeHtml(''.@$preview_url.'') ?>"><?php echo O::escapeHtml('') ?>
  </iframe>