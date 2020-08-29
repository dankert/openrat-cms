<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('changetemplateselectelements') ?>" data-action="<?php echo escapeHtml('page') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('get') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form page') ?>"><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('page') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('changetemplateselectelements') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
    <div><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('templateid') ?>" value="<?php echo escapeHtml(''.@$templateid.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('modelid') ?>" value="<?php echo escapeHtml(''.@$modelid.'') ?>" /><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('page_template_old').'') ?>
          </span>
        </div>
        <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
          <a target="<?php echo escapeHtml('_self') ?>" data-url="<?php echo escapeHtml(''.@$template_url.'') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
            <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon_template.png') ?>" /><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@$template_name.'') ?>
            </span>
          </a>
        </div>
      </div>
      <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('page_template_new').'') ?>
          </span>
        </div>
        <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
          <select name="<?php echo escapeHtml('newtemplateid') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
            <?php foreach($templates as $_key=>$_value) {  ?>
              <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==''){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
              </option>
             <?php } ?>
          </select>
        </div>
      </div>
    </div>
    <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('BUTTON_NEXT').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
    </div>
  </form>