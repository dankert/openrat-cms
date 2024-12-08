<?php /* THIS FILE IS GENERATED from register.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
    <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--empty') ?>"><?php echo O::escapeHtml('') ?></i>
      <span><?php echo O::escapeHtml(''.@O::lang('logo_register').'') ?></span>
    </h2>
    <p class="<?php echo O::escapeHtml('or-group-description or-collapsible-value') ?>"><?php echo O::escapeHtml(''.@O::lang('logo_register_text').'') ?></p>
    <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
      <?php $if3=(O::config(['login','register'])); if($if3) {  ?>
        <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-forward-to="<?php echo O::escapeHtml('registercode') ?>" data-method="<?php echo O::escapeHtml('register') ?>" data-action="<?php echo O::escapeHtml('login') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" data-after-success="<?php echo O::escapeHtml('forward') ?>" class="<?php echo O::escapeHtml('or-form or-login') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?></div>
          <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
            <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
            <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('login') ?>" /><?php echo O::escapeHtml('') ?>
            <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('register') ?>" /><?php echo O::escapeHtml('') ?>
            <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('USER_MAIL').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <input name="<?php echo O::escapeHtml('mail') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-focus or-input') ?>" /><?php echo O::escapeHtml('') ?>
              </div>
            </section>
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
      <?php if(!$if3) {  ?>
        <div class="<?php echo O::escapeHtml('or-message or-error') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('REGISTER_NOT_ENABLED').'') ?></span>
        </div>
       <?php } ?>
    </div>
  </section>