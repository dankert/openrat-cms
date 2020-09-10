<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('import') ?>" data-action="<?php echo escapeHtml('pageelement') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form pageelement') ?>"><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('pageelement') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('import') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
    <div><?php echo escapeHtml('') ?>
      <tr><?php echo escapeHtml('') ?>
        <td><?php echo escapeHtml('') ?>
          <select name="<?php echo escapeHtml('type') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
            <?php foreach($types as $_key=>$_value) {  ?>
              <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$type){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
              </option>
             <?php } ?>
          </select>
        </td>
      </tr>
      <tr><?php echo escapeHtml('') ?>
        <td><?php echo escapeHtml('') ?>
          <input type="<?php echo escapeHtml('file') ?>" id="<?php echo escapeHtml('req0_file') ?>" name="<?php echo escapeHtml('file') ?>" size="<?php echo escapeHtml('40') ?>" class="<?php echo escapeHtml('upload') ?>" /><?php echo escapeHtml('') ?>
        </td>
      </tr>
      <tr><?php echo escapeHtml('') ?>
        <td><?php echo escapeHtml('') ?>
          
        </td>
      </tr>
    </div>
    <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
    </div>
  </form>