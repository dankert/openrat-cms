<?php if (!defined('OR_TITLE')) exit(); ?>
  <?php $if1=(\cms\base\Configuration::config('login','register')); if($if1) {  ?>
    <form name="<?php echo \template_engine\Output::escapeHtml('') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-target="<?php echo \template_engine\Output::escapeHtml('view') ?>" action="<?php echo \template_engine\Output::escapeHtml('./') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('register') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('login') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" method="<?php echo \template_engine\Output::escapeHtml('POST') ?>" enctype="<?php echo \template_engine\Output::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo \template_engine\Output::escapeHtml('') ?>" data-autosave="<?php echo \template_engine\Output::escapeHtml('') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form login') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('token') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_token.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('action') ?>" value="<?php echo \template_engine\Output::escapeHtml('login') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('subaction') ?>" value="<?php echo \template_engine\Output::escapeHtml('register') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('id') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      <div><?php echo \template_engine\Output::escapeHtml('') ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('line logo') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <img src="<?php echo \template_engine\Output::escapeHtml('themes/default/images/logo_register.png') ?>" border="<?php echo \template_engine\Output::escapeHtml('') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <h2><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('logo_register').'') ?>
            </h2>
            <p><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('logo_register_text').'') ?>
            </p>
          </div>
        </div>
        <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('USER_MAIL').'') ?>
              </span>
            </label>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('inputholder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <input name="<?php echo \template_engine\Output::escapeHtml('mail') ?>" type="<?php echo \template_engine\Output::escapeHtml('text') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('256') ?>" value="<?php echo \template_engine\Output::escapeHtml('') ?>" class="<?php echo \template_engine\Output::escapeHtml('focus') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
          </div>
        </div>
        <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
        </div>
      </div>
      <div class="<?php echo \template_engine\Output::escapeHtml('or-form-actionbar') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <input type="<?php echo \template_engine\Output::escapeHtml('button') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('CANCEL').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
        <input type="<?php echo \template_engine\Output::escapeHtml('submit') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('button_ok').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      </div>
    </form>
   <?php } ?>
  <?php if(!$if1) {  ?>
    <div class="<?php echo \template_engine\Output::escapeHtml('message error') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('REGISTER_NOT_ENABLED').'') ?>
      </span>
    </div>
   <?php } ?>