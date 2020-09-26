<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo \template_engine\Output::escapeHtml('') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-target="<?php echo \template_engine\Output::escapeHtml('view') ?>" action="<?php echo \template_engine\Output::escapeHtml('./') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('mail') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('profile') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" method="<?php echo \template_engine\Output::escapeHtml('post') ?>" enctype="<?php echo \template_engine\Output::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo \template_engine\Output::escapeHtml('') ?>" data-autosave="<?php echo \template_engine\Output::escapeHtml('') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form profile') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('token') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_token.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('action') ?>" value="<?php echo \template_engine\Output::escapeHtml('profile') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('subaction') ?>" value="<?php echo \template_engine\Output::escapeHtml('mail') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('id') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <div><?php echo \template_engine\Output::escapeHtml('') ?>
      <div class="<?php echo \template_engine\Output::escapeHtml('line logo') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <img src="<?php echo \template_engine\Output::escapeHtml('themes/default/images/logo_changemail.png') ?>" border="<?php echo \template_engine\Output::escapeHtml('') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
        </div>
        <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <h2><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('logo_changemail').'') ?>
          </h2>
          <p><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('logo_changemail_text').'') ?>
          </p>
        </div>
      </div>
      <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('user_mail').'') ?>
          <img /><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('user_new_mail').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('inputholder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <input name="<?php echo \template_engine\Output::escapeHtml('mail') ?>" type="<?php echo \template_engine\Output::escapeHtml('text') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('256') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$mail.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
            </div>
          </div>
        </div>
      </fieldset>
      <div class="<?php echo \template_engine\Output::escapeHtml('clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('profile') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('confirmmail') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':\'profile\',\'dialogMethod\':\'confirmmail\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/profile/') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <span><?php echo \template_engine\Output::escapeHtml(''.@$mail_code.'') ?>
          </span>
        </a>
      </div>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-form-actionbar') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('button') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('CANCEL').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('submit') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('button_ok').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
  </form>