<?php if (defined('OR_TITLE')) {  ?>
  
    
      
        <tr><?php echo escapeHtml('') ?>
          <td colspan="<?php echo escapeHtml('2') ?>"><?php echo escapeHtml('') ?>
            <iframe src="<?php echo escapeHtml(''.@$preview_url.'') ?>"><?php echo escapeHtml('') ?>
            </iframe>
            <a target="<?php echo escapeHtml('_self') ?>" data-action="<?php echo escapeHtml('file') ?>" data-method="<?php echo escapeHtml('edit') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/file/') ?>" class="<?php echo escapeHtml('action') ?>"><?php echo escapeHtml('') ?>
              <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/icon/edit.png') ?>" /><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('menu_file_edit').'') ?>
              </span>
            </a>
            <a target="<?php echo escapeHtml('_self') ?>" data-action="<?php echo escapeHtml('file') ?>" data-method="<?php echo escapeHtml('editvalue') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/file/') ?>" class="<?php echo escapeHtml('action') ?>"><?php echo escapeHtml('') ?>
              <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/icon/editvalue.png') ?>" /><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('menu_file_editvalue').'') ?>
              </span>
            </a>
          </td>
        </tr>
 <?php } ?>