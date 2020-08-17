<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('mail') ?>" data-action="<?php echo escapeHtml('profile') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('post') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form profile') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('profile') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('mail') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
      <div><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('line logo') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <img src="<?php echo escapeHtml('themes/default/images/logo_changemail.png') ?>" border="<?php echo escapeHtml('') ?>" /><?php echo escapeHtml('') ?>
          </div>
          <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
            <h2><?php echo escapeHtml(''.@lang('logo_changemail').'') ?>
            </h2>
            <p><?php echo escapeHtml(''.@lang('logo_changemail_text').'') ?>
            </p>
          </div>
        </div>
        <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
          <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('user_mail').'') ?>
            <img /><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('user_new_mail').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                  <input name="<?php echo escapeHtml('mail') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$mail.'') ?>" /><?php echo escapeHtml('') ?>
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <div class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
          <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('profile') ?>" data-method="<?php echo escapeHtml('confirmmail') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':\'profile\',\'dialogMethod\':\'confirmmail\'}') ?>" href="<?php echo escapeHtml('/#/profile/') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@$mail_code.'') ?>
            </span>
          </a>
        </div>
      </div>
      <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
      </div>
    </form>
 <?php } ?>