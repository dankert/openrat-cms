<?php /* THIS FILE IS GENERATED from pw.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <?php $if2=($enabled); if($if2) {  ?>
    <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('pw') ?>" data-action="<?php echo O::escapeHtml('user') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-user') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?></div>
      <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
        <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
        <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('user') ?>" /><?php echo O::escapeHtml('') ?>
        <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('pw') ?>" /><?php echo O::escapeHtml('') ?>
        <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
        <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
          <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('USER_new_password').'') ?></h3>
          <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml('') ?>
              <input type="<?php echo O::escapeHtml('password') ?>" name="<?php echo O::escapeHtml('password') ?>" size="<?php echo O::escapeHtml('40') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" placeholder="<?php echo O::escapeHtml(''.@$password_proposal.'') ?>" value="<?php echo O::escapeHtml(''.@$password.'') ?>" class="<?php echo O::escapeHtml('or- or-input or-input--password') ?>" /><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--visible or-act-make-visible or-btn') ?>"><?php echo O::escapeHtml('') ?></i>
            </span>
            <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('password_proposal') ?>" value="<?php echo O::escapeHtml(''.@$password_proposal.'') ?>" /><?php echo O::escapeHtml('') ?>
          </div>
        </section>
        <?php $if4=(O::config(['mail','enabled'])); if($if4) {  ?>
          <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
            <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
              <span><?php echo O::escapeHtml(''.@O::lang('options').'') ?></span>
            </h2>
            <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
              <?php $if6=(isset($mail)); if($if6) {  ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <label><?php echo O::escapeHtml('') ?>
                      <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('email') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$email){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
                      <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_mail_new_password').'') ?></span>
                    </label>
                  </div>
                </section>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <label><?php echo O::escapeHtml('') ?>
                      <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('timeout') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$timeout){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
                      <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_password_timeout').'') ?></span>
                    </label>
                  </div>
                </section>
               <?php } ?>
            </div>
          </section>
         <?php } ?>
      </div>
      <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-btn or-btn--control or-btn--secondary or-act-form-cancel') ?>"><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-cancel') ?>"><?php echo O::escapeHtml('') ?></i>
          <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?></span>
        </div>
        <div class="<?php echo O::escapeHtml('or-btn or-btn--control or-btn--primary or-act-form-save') ?>"><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-ok') ?>"><?php echo O::escapeHtml('') ?></i>
          <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('button_ok').'') ?></span>
        </div>
      </div>
    </form>
   <?php } ?>
  <?php if(!$if2) {  ?>
    <span class="<?php echo O::escapeHtml('or-message') ?>"><?php echo O::escapeHtml(''.@O::lang('PWCHANGE_NOT_ALLOWED').'') ?></span>
   <?php } ?>