<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo \template_engine\Output::escapeHtml('') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-target="<?php echo \template_engine\Output::escapeHtml('view') ?>" action="<?php echo \template_engine\Output::escapeHtml('./') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('name') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('object') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" method="<?php echo \template_engine\Output::escapeHtml('POST') ?>" enctype="<?php echo \template_engine\Output::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo \template_engine\Output::escapeHtml('') ?>" data-autosave="<?php echo \template_engine\Output::escapeHtml('') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form object') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('token') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_token.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('action') ?>" value="<?php echo \template_engine\Output::escapeHtml('object') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('subaction') ?>" value="<?php echo \template_engine\Output::escapeHtml('name') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('id') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <div><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('languageid') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$languageid.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('alias').'') ?>
          <img /><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <label class="<?php echo \template_engine\Output::escapeHtml('or-form-row or-form-input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <span class="<?php echo \template_engine\Output::escapeHtml('or-form-label') ?>"><?php echo \template_engine\Output::escapeHtml('name') ?>
            </span>
            <input name="<?php echo \template_engine\Output::escapeHtml('name') ?>" required="<?php echo \template_engine\Output::escapeHtml('required') ?>" type="<?php echo \template_engine\Output::escapeHtml('text') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('255') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
          </label>
          <label class="<?php echo \template_engine\Output::escapeHtml('or-form-row or-form-checkbox') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <span class="<?php echo \template_engine\Output::escapeHtml('or-form-label') ?>"><?php echo \template_engine\Output::escapeHtml('description') ?>
            </span>
            <textarea name="<?php echo \template_engine\Output::escapeHtml('description') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('255') ?>" class="<?php echo \template_engine\Output::escapeHtml('description') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$description.'') ?>
            </textarea>
          </label>
        </div>
      </fieldset>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-form-actionbar') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('button') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('CANCEL').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('submit') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('save').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
  </form>