<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('add') ?>" data-action="<?php echo escapeHtml('projectlist') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form projectlist') ?>"><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('projectlist') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('add') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
    <div><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('name').'') ?>
          </span>
        </div>
        <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
            <input name="<?php echo escapeHtml('name') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('128') ?>" value="<?php echo escapeHtml(''.@$name.'') ?>" class="<?php echo escapeHtml('focus') ?>" /><?php echo escapeHtml('') ?>
          </div>
        </div>
      </div>
      <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
        <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('options').'') ?>
          <img /><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
          </div>
          <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <input type="<?php echo escapeHtml('radio') ?>" name="<?php echo escapeHtml('type') ?>" value="<?php echo escapeHtml('empty') ?>" checked="<?php echo escapeHtml(''.@$type.'') ?>" /><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('empty').'') ?>
                </span>
              </label>
              <br /><?php echo escapeHtml('') ?>
              <input type="<?php echo escapeHtml('radio') ?>" name="<?php echo escapeHtml('type') ?>" value="<?php echo escapeHtml('copy') ?>" checked="<?php echo escapeHtml(''.@$type.'') ?>" /><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('copy').'') ?>
                </span>
              </label>
              <select name="<?php echo escapeHtml('projectid') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
                <?php foreach($projects as $_key=>$_value) {  ?>
                  <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==''){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                  </option>
                 <?php } ?>
              </select>
            </div>
          </div>
        </div>
      </fieldset>
    </div>
    <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
    </div>
  </form>