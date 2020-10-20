<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('pw') ?>" data-action="<?php echo O::escapeHtml('profile') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-profile') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('profile') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('pw') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <?php $if1=($pwchange_enabled); if($if1) {  ?>
        <div class="<?php echo O::escapeHtml('or-line logo') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
            <img src="<?php echo O::escapeHtml('themes/default/images/logo_changepassword.png') ?>" border="<?php echo O::escapeHtml('') ?>" /><?php echo O::escapeHtml('') ?>
          </div>
          <div class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
            <h2><?php echo O::escapeHtml(''.@O::lang('logo_changepassword').'') ?>
            </h2>
            <p><?php echo O::escapeHtml(''.@O::lang('logo_changepassword_text').'') ?>
            </p>
          </div>
        </div>
        <section class="<?php echo O::escapeHtml('or-group or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
          <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml(''.@O::lang('user_act_password').'') ?>
          </h2>
          <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_password').'') ?>
              </h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('password') ?>" name="<?php echo O::escapeHtml('act_password') ?>" size="<?php echo O::escapeHtml('40') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" required="<?php echo O::escapeHtml('required') ?>" value="<?php echo O::escapeHtml(''.@$act_password.'') ?>" class="<?php echo O::escapeHtml('or-focus or-input') ?>" /><?php echo O::escapeHtml('') ?>
              </div>
            </section>
          </div>
        </section>
        <section class="<?php echo O::escapeHtml('or-group or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
          <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml(''.@O::lang('user_new_password').'') ?>
          </h2>
          <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_new_password').'') ?>
              </h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('password') ?>" name="<?php echo O::escapeHtml('password1') ?>" size="<?php echo O::escapeHtml('40') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" required="<?php echo O::escapeHtml('required') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('USER_NEW_PASSWORD').'') ?>" minlength="<?php echo O::escapeHtml(''.O::config('security','password','min_length').'') ?>" value="<?php echo O::escapeHtml(''.@$password1.'') ?>" class="<?php echo O::escapeHtml('or- or-input') ?>" /><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('password') ?>" name="<?php echo O::escapeHtml('password2') ?>" size="<?php echo O::escapeHtml('40') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" required="<?php echo O::escapeHtml('required') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('USER_NEW_PASSWORD_REPEAT').'') ?>" minlength="<?php echo O::escapeHtml(''.O::config('security','password','min_length').'') ?>" value="<?php echo O::escapeHtml(''.@$password2.'') ?>" class="<?php echo O::escapeHtml('or- or-input') ?>" /><?php echo O::escapeHtml('') ?>
              </div>
            </section>
          </div>
        </section>
       <?php } ?>
      <?php if(!$if1) {  ?>
        <div class="<?php echo O::escapeHtml('or-message message-warn') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('pwchange_not_allowed').'') ?>
          </span>
        </div>
       <?php } ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--secondary or-act-form-cancel') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-cancel') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?>
        </span>
      </div>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--primary or-act-form-save') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-ok') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('button_ok').'') ?>
        </span>
      </div>
    </div>
  </form>