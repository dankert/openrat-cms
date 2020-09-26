<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('export') ?>" data-action="<?php echo O::escapeHtml('project') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form project') ?>"><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('project') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('export') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
    <div><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('DATABASE').'') ?>
          </span>
        </div>
        <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
          <select name="<?php echo O::escapeHtml('dbid') ?>" size="<?php echo O::escapeHtml('1') ?>"><?php echo O::escapeHtml('') ?>
            <?php foreach($dbids as $_key=>$_value) {  ?>
              <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==actdbid){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
              </option>
             <?php } ?>
          </select>
        </div>
      </div>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('button') ?>" value="<?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?>" class="<?php echo O::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('submit') ?>" value="<?php echo O::escapeHtml(''.@O::lang('button_ok').'') ?>" class="<?php echo O::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
  </form>