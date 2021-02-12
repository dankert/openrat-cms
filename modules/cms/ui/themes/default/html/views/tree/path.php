<?php /* THIS FILE IS GENERATED from path.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <?php foreach((array)$path as $list_key=>$list_value) { extract($list_value); ?>
    <div class="<?php echo O::escapeHtml('or-act-clickable or-breadcrumb-item or-breadcrumb-path') ?>"><?php echo O::escapeHtml('') ?>
      <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml(''.@$action.'') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/'.@$action.'/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-'.@$action.'') ?>"><?php echo O::escapeHtml('') ?></i>
      </a>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed') ?>"><?php echo O::escapeHtml('') ?></i>
    </div>
   <?php } ?>
  <div class="<?php echo O::escapeHtml('or-breadcrumb-item or-breadcrumb-actual') ?>"><?php echo O::escapeHtml('') ?>
    <?php $if3=!(($parent)==FALSE); if($if3) {  ?>
      <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml(''.@$parent['action'].'') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$parent['id'].'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/'.@$parent['action'].'/'.@$parent['id'].'') ?>" class="<?php echo O::escapeHtml('or-link or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--menu-up') ?>"><?php echo O::escapeHtml('') ?></i>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-'.@$actual['action'].'') ?>"><?php echo O::escapeHtml('') ?></i>
      </a>
     <?php } ?>
    <?php if(!$if3) {  ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-'.@$actual['action'].'') ?>"><?php echo O::escapeHtml('') ?></i>
     <?php } ?>
    <span class="<?php echo O::escapeHtml('or-breadcrumb-text') ?>"><?php echo O::escapeHtml(''.@$actual['name'].'') ?></span>
  </div>