<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('remove') ?>" data-action="<?php echo O::escapeHtml('element') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form element') ?>"><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('element') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('remove') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
    <div><?php echo O::escapeHtml('') ?>
      <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('ELEMENT_NAME').'') ?>
              </span>
            </div>
            <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
              <span class="<?php echo O::escapeHtml('name') ?>"><?php echo O::escapeHtml(''.@$name.'') ?>
              </span>
            </div>
          </div>
        </div>
      </fieldset>
      <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
        <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('options').'') ?>
          <img /><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo O::escapeHtml('') ?>
          </div>
          <div class="<?php echo O::escapeHtml('arrow arrow-down on-open') ?>"><?php echo O::escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
              <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('confirm') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$confirm){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> required="<?php echo O::escapeHtml('required') ?>" /><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('CONFIRM_DELETE').'') ?>
                </span>
              </label>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml('     ') ?>
              </span>
              <input type="<?php echo O::escapeHtml('radio') ?>" name="<?php echo O::escapeHtml('type') ?>" value="<?php echo O::escapeHtml('value') ?>" <?php if(@$type=='value'){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('ELEMENT_DELETE_VALUES').'') ?>
                </span>
              </label>
              <br /><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml('     ') ?>
              </span>
              <input type="<?php echo O::escapeHtml('radio') ?>" name="<?php echo O::escapeHtml('type') ?>" value="<?php echo O::escapeHtml('all') ?>" <?php if(@$type=='all'){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('DELETE').'') ?>
                </span>
              </label>
            </div>
          </div>
        </div>
      </fieldset>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('button') ?>" value="<?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?>" class="<?php echo O::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('submit') ?>" value="<?php echo O::escapeHtml(''.@O::lang('button_ok').'') ?>" class="<?php echo O::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
  </form>