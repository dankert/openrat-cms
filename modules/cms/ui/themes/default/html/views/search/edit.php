<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo \template_engine\Output::escapeHtml('') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-target="<?php echo \template_engine\Output::escapeHtml('view') ?>" action="<?php echo \template_engine\Output::escapeHtml('./') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('result') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('search') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" method="<?php echo \template_engine\Output::escapeHtml('GET') ?>" enctype="<?php echo \template_engine\Output::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo \template_engine\Output::escapeHtml('') ?>" data-autosave="<?php echo \template_engine\Output::escapeHtml('') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form search') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('token') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_token.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('action') ?>" value="<?php echo \template_engine\Output::escapeHtml('search') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('subaction') ?>" value="<?php echo \template_engine\Output::escapeHtml('result') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('id') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <div><?php echo \template_engine\Output::escapeHtml('') ?>
      <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('value').'') ?>
            </span>
          </label>
          <br /><?php echo \template_engine\Output::escapeHtml('') ?>
        </div>
        <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('inputholder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <input name="<?php echo \template_engine\Output::escapeHtml('text') ?>" placeholder="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('search').'') ?>" type="<?php echo \template_engine\Output::escapeHtml('text') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('256') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$text.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
        </div>
      </div>
      <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('filter').'') ?>
            </span>
          </label>
          <br /><?php echo \template_engine\Output::escapeHtml('') ?>
        </div>
        <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('id') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(\cms\base\Configuration::config('search','quicksearch','flag','id')){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
          <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('id').'') ?>
            </span>
          </label>
          <br /><?php echo \template_engine\Output::escapeHtml('') ?>
          <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('name') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(\cms\base\Configuration::config('search','quicksearch','flag','name')){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
          <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('name').'') ?>
            </span>
          </label>
          <br /><?php echo \template_engine\Output::escapeHtml('') ?>
          <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('filename') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(\cms\base\Configuration::config('search','quicksearch','flag','filename')){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
          <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('filename').'') ?>
            </span>
          </label>
          <br /><?php echo \template_engine\Output::escapeHtml('') ?>
          <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('description') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(\cms\base\Configuration::config('search','quicksearch','flag','description')){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
          <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('description').'') ?>
            </span>
          </label>
          <br /><?php echo \template_engine\Output::escapeHtml('') ?>
          <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('content') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(\cms\base\Configuration::config('search','quicksearch','flag','content')){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
          <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('content').'') ?>
            </span>
          </label>
        </div>
      </div>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-form-actionbar') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('button') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('CANCEL').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('submit') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('button_ok').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
  </form>