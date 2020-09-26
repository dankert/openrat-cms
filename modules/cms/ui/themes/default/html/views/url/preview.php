<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo \template_engine\Output::escapeHtml('toolbar-icon') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--menu-refresh') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    </i>
  </div>
  <iframe name="<?php echo \template_engine\Output::escapeHtml('preview') ?>" src="<?php echo \template_engine\Output::escapeHtml(''.@$preview_url.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
  </iframe>