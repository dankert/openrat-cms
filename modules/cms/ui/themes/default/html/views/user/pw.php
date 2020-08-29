<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('pw') ?>" data-action="<?php echo escapeHtml('user') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form user') ?>"><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('user') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('pw') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
    <div><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
        </div>
        <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
          <input type="<?php echo escapeHtml('radio') ?>" name="<?php echo escapeHtml('type') ?>" value="<?php echo escapeHtml('proposal') ?>" checked="<?php echo escapeHtml(''.@$type.'') ?>" /><?php echo escapeHtml('') ?>
          <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@$password_proposal.'') ?>
            <span><?php echo escapeHtml(''.@lang('USER_new_password').'') ?>
            </span>
            <span><?php echo escapeHtml(' ') ?>
            </span>
            <span><?php echo escapeHtml(''.@$password_proposal.'') ?>
            </span>
          </label>
          <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('password_proposal') ?>" value="<?php echo escapeHtml(''.@$password_proposal.'') ?>" /><?php echo escapeHtml('') ?>
        </div>
      </div>
      <?php $if1=(config('mail','enabled')); if($if1) {  ?>
        <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
          </div>
          <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
            <input type="<?php echo escapeHtml('radio') ?>" name="<?php echo escapeHtml('type') ?>" value="<?php echo escapeHtml('random') ?>" checked="<?php echo escapeHtml(''.@$type.'') ?>" /><?php echo escapeHtml('') ?>
            <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('user_random_password').'') ?>
            </label>
          </div>
        </div>
       <?php } ?>
      <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
        </div>
        <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
          <input type="<?php echo escapeHtml('radio') ?>" name="<?php echo escapeHtml('type') ?>" value="<?php echo escapeHtml('input') ?>" checked="<?php echo escapeHtml(''.@$type.'') ?>" /><?php echo escapeHtml('') ?>
          <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('USER_NEW_PASSWORD_INPUT').'') ?>
          </label>
        </div>
      </div>
      <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
          <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('USER_new_password').'') ?>
          </label>
        </div>
        <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
            <input type="<?php echo escapeHtml('password') ?>" name="<?php echo escapeHtml('password1') ?>" size="<?php echo escapeHtml('40') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$password1.'') ?>" class="<?php echo escapeHtml('') ?>" /><?php echo escapeHtml('') ?>
          </div>
        </div>
      </div>
      <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
          <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('USER_new_password_repeat').'') ?>
          </label>
        </div>
        <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
            <input type="<?php echo escapeHtml('password') ?>" name="<?php echo escapeHtml('password2') ?>" size="<?php echo escapeHtml('40') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$password2.'') ?>" class="<?php echo escapeHtml('') ?>" /><?php echo escapeHtml('') ?>
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
        </div>
      </fieldset>
      <?php $if1=(config('mail','enabled')); if($if1) {  ?>
        <?php $if1=(isset($mail)); if($if1) {  ?>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('email') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$email){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('user_mail_new_password').'') ?>
              </label>
            </div>
          </div>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('timeout') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$timeout){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('user_password_timeout').'') ?>
              </label>
            </div>
          </div>
         <?php } ?>
       <?php } ?>
    </div>
    <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
    </div>
  </form>