<?php /* THIS FILE IS GENERATED from branch.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <?php foreach((array)$branch as $list_key=>$list_value) { extract($list_value); ?>
    <li class="<?php echo O::escapeHtml('or-navtree-node or-navtree-node--is-closed or-or-draggable or-or-draggable--type-'.@$type.'') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-navtree-tree or-navtree-node-control') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-navtree-tree-icon') ?>"><?php echo O::escapeHtml('') ?>
        </i>
      </div>
      <div class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
        <a title="<?php echo O::escapeHtml(''.@$description.'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml(''.@$action.'') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra-type="<?php echo O::escapeHtml(''.@$type.'') ?>" data-extra="<?php echo O::escapeHtml('{\'type\':\''.@$type.'\'}') ?>" href="<?php echo O::escapeHtml('#/'.@$action.'/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link or-entry') ?>"><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-'.@$icon.'') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <span class="<?php echo O::escapeHtml('or-navtree-text') ?>"><?php echo O::escapeHtml(''.@$text.'') ?>
          </span>
        </a>
      </div>
    </li>
   <?php } ?>