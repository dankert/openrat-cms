<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('advanced') ?>" data-action="<?php echo escapeHtml('file') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form file') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('file') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('advanced') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
      <div><?php echo escapeHtml('') ?>
        <label class="<?php echo escapeHtml('or-form-row or-form-input') ?>"><?php echo escapeHtml('') ?>
          <span class="<?php echo escapeHtml('or-form-label') ?>"><?php echo escapeHtml('file_extension') ?>
          </span>
          <input name="<?php echo escapeHtml('extension') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$extension.'') ?>" class="<?php echo escapeHtml('extension') ?>" /><?php echo escapeHtml('') ?>
        </label>
        <label class="<?php echo escapeHtml('or-form-row or-form-input') ?>"><?php echo escapeHtml('') ?>
          <span class="<?php echo escapeHtml('or-form-label') ?>"><?php echo escapeHtml('type') ?>
          </span>
          <select name="<?php echo escapeHtml('type') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
            <?php foreach($types as $_key=>$_value) {  ?>
              <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$type){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
              </option>
             <?php } ?>
          </select>
        </label>
      </div>
      <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
      </div>
    </form>
 <?php } ?>