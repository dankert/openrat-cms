<?php if (!defined('OR_TITLE')) exit(); ?>
  <tr><?php echo \template_engine\Output::escapeHtml('') ?>
    <td colspan="<?php echo \template_engine\Output::escapeHtml('2') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <iframe src="<?php echo \template_engine\Output::escapeHtml(''.@$preview_url.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      </iframe>
      <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('file') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('edit') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/file/') ?>" class="<?php echo \template_engine\Output::escapeHtml('action') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon/icon/edit.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
        <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_file_edit').'') ?>
        </span>
      </a>
      <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('file') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('editvalue') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/file/') ?>" class="<?php echo \template_engine\Output::escapeHtml('action') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon/icon/editvalue.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
        <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_file_editvalue').'') ?>
        </span>
      </a>
    </td>
  </tr>