<?php /* THIS FILE IS GENERATED from show.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <tr><?php echo O::escapeHtml('') ?>
    <td colspan="<?php echo O::escapeHtml('2') ?>"><?php echo O::escapeHtml('') ?>
      <iframe src="<?php echo O::escapeHtml(''.@$preview_url.'') ?>"><?php echo O::escapeHtml('') ?>
      </iframe>
      <a target="<?php echo O::escapeHtml('_self') ?>" data-action="<?php echo O::escapeHtml('file') ?>" data-method="<?php echo O::escapeHtml('edit') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/file') ?>" class="<?php echo O::escapeHtml('or-link or-action') ?>"><?php echo O::escapeHtml('') ?>
        <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon/icon/edit.png') ?>" /><?php echo O::escapeHtml('') ?>
        <span><?php echo O::escapeHtml(''.@O::lang('menu_file_edit').'') ?>
        </span>
      </a>
      <a target="<?php echo O::escapeHtml('_self') ?>" data-action="<?php echo O::escapeHtml('file') ?>" data-method="<?php echo O::escapeHtml('editvalue') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/file') ?>" class="<?php echo O::escapeHtml('or-link or-action') ?>"><?php echo O::escapeHtml('') ?>
        <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon/icon/editvalue.png') ?>" /><?php echo O::escapeHtml('') ?>
        <span><?php echo O::escapeHtml(''.@O::lang('menu_file_editvalue').'') ?>
        </span>
      </a>
    </td>
  </tr>