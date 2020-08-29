<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('prop') ?>" data-action="<?php echo escapeHtml('language') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('post') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form language') ?>"><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('language') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('prop') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
    <div><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('NAME').'') ?>
          </span>
        </div>
        <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
            <input name="<?php echo escapeHtml('name') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('50') ?>" value="<?php echo escapeHtml(''.@$name.'') ?>" class="<?php echo escapeHtml('focus') ?>" /><?php echo escapeHtml('') ?>
          </div>
        </div>
      </div>
      <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('LANGUAGE_ISOCODE').'') ?>
          </span>
        </div>
        <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
            <input name="<?php echo escapeHtml('isocode') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$isocode.'') ?>" /><?php echo escapeHtml('') ?>
          </div>
        </div>
      </div>
      <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
        </div>
        <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
          <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('is_default') ?>" disabled="<?php echo escapeHtml('disabled') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$is_default){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
          <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('is_default').'') ?>
          </label>
        </div>
      </div>
    </div>
    <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
    </div>
  </form>