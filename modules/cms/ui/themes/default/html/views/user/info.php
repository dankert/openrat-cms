<?php /* THIS FILE IS GENERATED from info.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('info') ?>" data-action="<?php echo O::escapeHtml('user') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-user') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?></div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('user') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('info') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <span class="<?php echo O::escapeHtml('or-headline') ?>"><?php echo O::escapeHtml(''.@$fullname.'') ?></span>
      <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
        <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_username').'') ?></h3>
        <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
          <span class="<?php echo O::escapeHtml('or-name') ?>"><?php echo O::escapeHtml(''.@$name.'') ?></span>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--empty') ?>"><?php echo O::escapeHtml('') ?></i>
          <span><?php echo O::escapeHtml(''.@O::lang('ADDITIONAL_INFO').'') ?></span>
        </h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_fullname').'') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$fullname.'') ?></span>
            </div>
          </section>
          <?php $if4=(O::config(['security','user','show_admin_mail'])); if($if4) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_mail').'') ?></h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <span class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
                  <a target="<?php echo O::escapeHtml('_self') ?>" data-url="<?php echo O::escapeHtml('mailto:'.@$mail.'') ?>" data-type="<?php echo O::escapeHtml('external') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('mailto:'.@$mail.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@$mail.'') ?></span>
                  </a>
                  <i data-qrcode="<?php echo O::escapeHtml('mailto:'.@$mail.'') ?>" title="<?php echo O::escapeHtml(''.@O::lang('QRCODE_SHOW').'') ?>" class="<?php echo O::escapeHtml('or-btn or-image-icon or-image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo O::escapeHtml('') ?></i>
                </span>
              </div>
            </section>
           <?php } ?>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('description').'') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$desc.'') ?></span>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_tel').'') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <span class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@$tel.'') ?></span>
                <i data-qrcode="<?php echo O::escapeHtml('tel:'.@$tel.'') ?>" title="<?php echo O::escapeHtml(''.@O::lang('QRCODE_SHOW').'') ?>" class="<?php echo O::escapeHtml('or-btn or-image-icon or-image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo O::escapeHtml('') ?></i>
              </span>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('timezone').'') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$timezone.'') ?></span>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('language').'') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$language.'') ?></span>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
                <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('user') ?>" data-method="<?php echo O::escapeHtml('prop') ?>" data-id="<?php echo O::escapeHtml(''.@$userid.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/user/'.@$userid.'') ?>" class="<?php echo O::escapeHtml('or-link or-btn or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('edit').'') ?></span>
                </a>
              </div>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('groups').'') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <?php foreach((array)@$groups as $list_key=>$name) {  ?>
                <span><?php echo O::escapeHtml(''.@$name.'') ?></span>
                <br /><?php echo O::escapeHtml('') ?>
               <?php } ?>
            </div>
          </section>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--empty') ?>"><?php echo O::escapeHtml('') ?></i>
          <span><?php echo O::escapeHtml(''.@O::lang('options').'') ?></span>
        </h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <label><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('checkbox') ?>" data-name="<?php echo O::escapeHtml('is_admin') ?>" disabled="<?php echo O::escapeHtml('disabled') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$is_admin){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('is_admin') ?>" <?php if(@$is_admin){ ?>value="<?php echo O::escapeHtml('1') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_admin').'') ?></span>
              </label>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_style').'') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$style.'') ?></span>
            </div>
          </section>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--empty') ?>"><?php echo O::escapeHtml('') ?></i>
          <span><?php echo O::escapeHtml(''.@O::lang('security').'') ?></span>
        </h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_password_expires').'') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($passwordExpires); ?>
               <?php } ?>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
                <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('user') ?>" data-method="<?php echo O::escapeHtml('pw') ?>" data-id="<?php echo O::escapeHtml(''.@$userid.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/user/'.@$userid.'') ?>" class="<?php echo O::escapeHtml('or-link or-btn or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('edit_password').'') ?></span>
                </a>
              </div>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_last_login').'') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($lastLogin); ?>
               <?php } ?>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('token').'') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$totpToken.'') ?></span>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_totp').'') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <label><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('checkbox') ?>" data-name="<?php echo O::escapeHtml('totp') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$totp){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('totp') ?>" <?php if(@$totp){ ?>value="<?php echo O::escapeHtml('1') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_totp').'') ?></span>
              </label>
              <i data-qrcode="<?php echo O::escapeHtml(''.@$totpSecretUrl.'') ?>" title="<?php echo O::escapeHtml(''.@O::lang('QRCODE_SHOW').'') ?>" class="<?php echo O::escapeHtml('or-btn or-image-icon or-image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo O::escapeHtml('') ?></i>
            </div>
          </section>
        </div>
      </section>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?></div>
  </form>