<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('_top') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('passwordcode') ?>" data-action="<?php echo escapeHtml('login') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form login') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('login') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('passwordcode') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
      <div><?php echo escapeHtml('') ?>
        <tr><?php echo escapeHtml('') ?>
          <td colspan="<?php echo escapeHtml('2') ?>" class="<?php echo escapeHtml('logo') ?>"><?php echo escapeHtml('') ?>
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
          </td>
          <tr><?php echo escapeHtml('') ?>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('mail_code').'') ?>
              </span>
            </td>
            <td><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                <input name="<?php echo escapeHtml('code') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$code.'') ?>" /><?php echo escapeHtml('') ?>
              </div>
            </td>
          </tr>
          <tr><?php echo escapeHtml('') ?>
            <td colspan="<?php echo escapeHtml('2') ?>" class="<?php echo escapeHtml('act') ?>"><?php echo escapeHtml('') ?>
              
            </td>
          </tr>
        </tr>
      </div>
      <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
      </div>
    </form>
    
 <?php } ?>