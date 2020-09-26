<?php defined('APP_STARTED') || die('Forbidden'); ?>
  <form name="<?php echo \template_engine\Output::escapeHtml('') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-target="<?php echo \template_engine\Output::escapeHtml('view') ?>" action="<?php echo \template_engine\Output::escapeHtml('./') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('remove') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('folder') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" method="<?php echo \template_engine\Output::escapeHtml('POST') ?>" enctype="<?php echo \template_engine\Output::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo \template_engine\Output::escapeHtml('') ?>" data-autosave="<?php echo \template_engine\Output::escapeHtml('') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form folder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('token') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_token.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('action') ?>" value="<?php echo \template_engine\Output::escapeHtml('folder') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('subaction') ?>" value="<?php echo \template_engine\Output::escapeHtml('remove') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('id') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <div><?php echo \template_engine\Output::escapeHtml('') ?>
      <label class="<?php echo \template_engine\Output::escapeHtml('or-form-row') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <span class="<?php echo \template_engine\Output::escapeHtml('or-form-input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        </span>
        <span class="<?php echo \template_engine\Output::escapeHtml('or-form-label') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('NAME').'') ?>
        </span>
      </label>
      <label class="<?php echo \template_engine\Output::escapeHtml('or-form-row or-form-checkbox') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <span class="<?php echo \template_engine\Output::escapeHtml('or-form-label') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('DELETE').'') ?>
        </span>
        <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('delete') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$delete){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
      </label>
      <label class="<?php echo \template_engine\Output::escapeHtml('or-form-row or-form-checkbox') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <span class="<?php echo \template_engine\Output::escapeHtml('or-form-label') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('DELETE_WITH_CHILDREN').'') ?>
        </span>
        <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('withChildren') ?>" disabled="<?php echo \template_engine\Output::escapeHtml('disabled') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$withChildren){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
      </label>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-form-actionbar') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('button') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('CANCEL').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('submit') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('button_ok').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
  </form>