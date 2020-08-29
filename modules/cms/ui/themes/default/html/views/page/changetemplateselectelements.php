<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('changetemplateselectelements') ?>" data-action="<?php echo escapeHtml('page') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form page') ?>"><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('page') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('changetemplateselectelements') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
    <div><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('newtemplateid') ?>" value="<?php echo escapeHtml(''.@$newtemplateid.'') ?>" /><?php echo escapeHtml('') ?>
      <?php foreach((array)$elements as $list_key=>$list_value) { extract($list_value); ?>
        <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@$name.'') ?>
            </span>
          </div>
          <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
            <select name="<?php echo escapeHtml(''.@$newElementsName.'') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
              <?php foreach($newElementsList as $_key=>$_value) {  ?>
                <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==''){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                </option>
               <?php } ?>
            </select>
          </div>
        </div>
       <?php } ?>
    </div>
    <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('MENU_CHANGETEMPLATE').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
    </div>
  </form>