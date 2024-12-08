<?php /* THIS FILE IS GENERATED from preview.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
    <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--empty') ?>"><?php echo O::escapeHtml('') ?></i>
      <span><?php echo O::escapeHtml(''.@O::lang('PREVIEW').'') ?></span>
    </h2>
    <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
      <span><?php echo ''.@$preview.'' ?></span>
    </div>
  </section>