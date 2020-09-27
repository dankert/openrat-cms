<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <?php foreach((array)$branch as $list_key=>$list_value) { extract($list_value); ?>
    <li class="<?php echo O::escapeHtml('or-navtree-node or-navtree-node--is-closed or-draggable or-draggable--type-'.@$type.'') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('tree or-navtree-node-control') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('image-icon image-icon--node-closed tree-icon') ?>"><?php echo O::escapeHtml('') ?>
        </i>
      </div>
      <div class="<?php echo O::escapeHtml('clickable') ?>"><?php echo O::escapeHtml('') ?>
        <a title="<?php echo O::escapeHtml(''.@$description.'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml(''.@$action.'') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra-type="<?php echo O::escapeHtml(''.@$type.'') ?>" data-extra="<?php echo O::escapeHtml('{\'type\':\''.@$type.'\'}') ?>" href="<?php echo O::escapeHtml('/#/'.@$action.'/'.@$id.'') ?>" class="<?php echo O::escapeHtml('entry') ?>"><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('image-icon image-icon--action-'.@$icon.'') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <span><?php echo O::escapeHtml(''.@$text.'') ?>
          </span>
        </a>
      </div>
    </li>
   <?php } ?>