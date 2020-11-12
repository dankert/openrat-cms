<?php /* THIS FILE IS GENERATED from preview.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <img src="<?php echo O::escapeHtml(''.@$url.'') ?>" class="<?php echo O::escapeHtml('or-image--preview') ?>" /><?php echo O::escapeHtml('') ?>
  <br /><?php echo O::escapeHtml('') ?>
  <br /><?php echo O::escapeHtml('') ?>
  <a target="<?php echo O::escapeHtml('_self') ?>" data-url="<?php echo O::escapeHtml(''.@$preview_url.'') ?>" data-type="<?php echo O::escapeHtml('popup') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link or-action or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
    <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--menu-open_in_new') ?>"><?php echo O::escapeHtml('') ?>
    </i>
    <span><?php echo O::escapeHtml(''.@O::lang('link_open_in_new_window').'') ?>
    </span>
  </a>