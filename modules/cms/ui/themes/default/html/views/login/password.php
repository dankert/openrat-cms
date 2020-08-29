<?php if (!defined('OR_TITLE')) exit(); ?>
  <?php $if1=(config('login','send_password')); if($if1) {  ?>
    <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('password') ?>" data-action="<?php echo escapeHtml('login') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form login') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('login') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('password') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
      <div><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('line logo') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <img src="<?php echo escapeHtml('themes/default/images/logo_password.png') ?>" border="<?php echo escapeHtml('') ?>" /><?php echo escapeHtml('') ?>
          </div>
          <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
            <h2><?php echo escapeHtml(''.@lang('logo_password').'') ?>
            </h2>
            <p><?php echo escapeHtml(''.@lang('logo_password_text').'') ?>
            </p>
          </div>
        </div>
        <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('USER_USERNAME').'') ?>
            </span>
          </div>
          <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
              <input name="<?php echo escapeHtml('username') ?>" autofocus="<?php echo escapeHtml('autofocus') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('128') ?>" value="<?php echo escapeHtml(''.@$username.'') ?>" /><?php echo escapeHtml('') ?>
            </div>
          </div>
        </div>
        <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('DATABASE').'') ?>
            </span>
          </div>
          <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
            <select name="<?php echo escapeHtml('dbid') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
              <?php foreach($dbids as $_key=>$_value) {  ?>
                <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==actdbid){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                </option>
               <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
      </div>
    </form>
   <?php } ?>
  <?php if(!$if1) {  ?>
    <div class="<?php echo escapeHtml('message error') ?>"><?php echo escapeHtml('') ?>
      <span><?php echo escapeHtml(''.@lang('PASSWORD_NOT_ENABLED').'') ?>
      </span>
    </div>
   <?php } ?>