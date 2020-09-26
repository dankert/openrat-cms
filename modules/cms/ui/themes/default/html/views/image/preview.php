<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <iframe src="<?php echo O::escapeHtml(''.@$preview_url.'') ?>"><?php echo O::escapeHtml('') ?>
  </iframe>