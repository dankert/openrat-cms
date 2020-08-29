<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('edit') ?>" data-action="<?php echo escapeHtml('file') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form file') ?>"><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('languageid') ?>" value="<?php echo escapeHtml(''.@$languageid.'') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('file') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('edit') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
    <div><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
        </div>
        <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
          <br /><?php echo escapeHtml('') ?>
          <input id="<?php echo escapeHtml('req0_file') ?>" name="<?php echo escapeHtml('file') ?>" size="<?php echo escapeHtml('40') ?>" class="<?php echo escapeHtml('upload') ?>" /><?php echo escapeHtml('') ?>
          <br /><?php echo escapeHtml('') ?>
          <br /><?php echo escapeHtml('') ?>
        </div>
      </div>
      <div class="<?php echo escapeHtml('line or-dropzone-upload') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
        </div>
        <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
        </div>
      </div>
    </div>
    <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
    </div>
  </form>