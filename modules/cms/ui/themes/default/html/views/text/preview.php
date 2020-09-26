<?php defined('APP_STARTED') || die('Forbidden'); ?>
  <iframe src="<?php echo \template_engine\Output::escapeHtml(''.@$preview_url.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
  </iframe>