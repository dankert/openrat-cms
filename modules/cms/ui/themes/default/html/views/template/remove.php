<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('remove') ?>" data-action="<?php echo escapeHtml('template') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form template') ?>"><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('template') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('remove') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
    <div><?php echo escapeHtml('') ?>
      <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('NAME').'') ?>
              </span>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <span class="<?php echo escapeHtml('name') ?>"><?php echo escapeHtml(''.@$name.'') ?>
              </span>
            </div>
          </div>
        </div>
      </fieldset>
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
              <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('delete') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$delete){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> required="<?php echo escapeHtml('required') ?>" /><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('CONFIRM_DELETE').'') ?>
                </span>
              </label>
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