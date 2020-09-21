<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('result') ?>" data-action="<?php echo escapeHtml('search') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('GET') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form search') ?>"><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('search') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('result') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
    <div><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
          <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('value').'') ?>
            </span>
          </label>
          <br /><?php echo escapeHtml('') ?>
        </div>
        <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
            <input name="<?php echo escapeHtml('text') ?>" placeholder="<?php echo escapeHtml(''.@lang('search').'') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$text.'') ?>" /><?php echo escapeHtml('') ?>
          </div>
        </div>
      </div>
      <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
          <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('filter').'') ?>
            </span>
          </label>
          <br /><?php echo escapeHtml('') ?>
        </div>
        <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
          <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(config('search','quicksearch','flag','id')){ ?>checked="<?php echo escapeHtml('checked') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
          <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('id').'') ?>
            </span>
          </label>
          <br /><?php echo escapeHtml('') ?>
          <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('name') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(config('search','quicksearch','flag','name')){ ?>checked="<?php echo escapeHtml('checked') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
          <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('name').'') ?>
            </span>
          </label>
          <br /><?php echo escapeHtml('') ?>
          <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('filename') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(config('search','quicksearch','flag','filename')){ ?>checked="<?php echo escapeHtml('checked') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
          <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('filename').'') ?>
            </span>
          </label>
          <br /><?php echo escapeHtml('') ?>
          <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('description') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(config('search','quicksearch','flag','description')){ ?>checked="<?php echo escapeHtml('checked') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
          <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('description').'') ?>
            </span>
          </label>
          <br /><?php echo escapeHtml('') ?>
          <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('content') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(config('search','quicksearch','flag','content')){ ?>checked="<?php echo escapeHtml('checked') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
          <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('content').'') ?>
            </span>
          </label>
        </div>
      </div>
    </div>
    <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
    </div>
  </form>