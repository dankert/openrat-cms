<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <?php foreach((array)$path as $list_key=>$list_value) { extract($list_value); ?>
    <div class="<?php echo O::escapeHtml('or-clickable or-breadcrumb-item') ?>"><?php echo O::escapeHtml('') ?>
      <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml(''.@$action.'') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('/#/'.@$action.'/'.@$id.'') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-'.@$action.'') ?>"><?php echo O::escapeHtml('') ?>
        </i>
      </a>
    </div>
    <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed') ?>"><?php echo O::escapeHtml('') ?>
    </i>
   <?php } ?>
  <div class="<?php echo O::escapeHtml('or-clickable or-breadcrumb-item') ?>"><?php echo O::escapeHtml('') ?>
    <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml(''.@$actual['action'].'') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$actual['id'].'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('/#/'.@$actual['action'].'/'.@$actual['id'].'') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-'.@$actual['action'].'') ?>"><?php echo O::escapeHtml('') ?>
      </i>
      <span><?php echo O::escapeHtml(''.@$actual['name'].'') ?>
      </span>
    </a>
  </div>