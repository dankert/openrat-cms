<?php /* THIS FILE IS GENERATED from prop.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('prop') ?>" data-action="<?php echo O::escapeHtml('user') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-user') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('user') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('prop') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
        <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
        </h3>
        <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
            <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_username').'') ?>
            </label>
          </div>
          <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
            <input name="<?php echo O::escapeHtml('name') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('128') ?>" value="<?php echo O::escapeHtml(''.@$name.'') ?>" class="<?php echo O::escapeHtml('or-name or-focus or-input') ?>" /><?php echo O::escapeHtml('') ?>
          </div>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml(''.@O::lang('ADDITIONAL_INFO').'') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?>
          </i>
        </h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_fullname').'') ?>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <input name="<?php echo O::escapeHtml('fullname') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('128') ?>" value="<?php echo O::escapeHtml(''.@$fullname.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
              </div>
            </div>
          </section>
          <?php $if1=(O::config('security','user','show_admin_mail')); if($if1) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
              </h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                  <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_mail').'') ?>
                  </label>
                </div>
                <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                  <input name="<?php echo O::escapeHtml('mail') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('255') ?>" value="<?php echo O::escapeHtml(''.@$mail.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                  <i data-qrcode="<?php echo O::escapeHtml('mailto:'.@$mail.'') ?>" title="<?php echo O::escapeHtml(''.@O::lang('QRCODE_SHOW').'') ?>" class="<?php echo O::escapeHtml('or-image-icon or-image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo O::escapeHtml('') ?>
                  </i>
                </div>
              </div>
            </section>
           <?php } ?>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_desc').'') ?>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <input name="<?php echo O::escapeHtml('desc') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('255') ?>" value="<?php echo O::escapeHtml(''.@$desc.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
              </div>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_tel').'') ?>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <input name="<?php echo O::escapeHtml('tel') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('128') ?>" value="<?php echo O::escapeHtml(''.@$tel.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                <i data-qrcode="<?php echo O::escapeHtml('tel:'.@$tel.'') ?>" title="<?php echo O::escapeHtml(''.@O::lang('QRCODE_SHOW').'') ?>" class="<?php echo O::escapeHtml('or-image-icon or-image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo O::escapeHtml('') ?>
                </i>
              </div>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('timezone').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <select name="<?php echo O::escapeHtml('timezone') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                  <option value="<?php echo O::escapeHtml('') ?>"><?php echo O::escapeHtml(''.@O::lang('LIST_ENTRY_EMPTY').'') ?>
                  </option>
                  <?php foreach($timezone_list as $_key=>$_value) {  ?>
                    <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$timezone){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('language').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <select name="<?php echo O::escapeHtml('language') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                  <option value="<?php echo O::escapeHtml('') ?>"><?php echo O::escapeHtml(''.@O::lang('LIST_ENTRY_EMPTY').'') ?>
                  </option>
                  <?php foreach($language_list as $_key=>$_value) {  ?>
                    <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$language){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
          </section>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml(''.@O::lang('options').'') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?>
          </i>
        </h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('is_admin') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$is_admin){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_admin').'') ?>
                </label>
              </div>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_ldapdn').'') ?>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <input name="<?php echo O::escapeHtml('ldap_dn') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$ldap_dn.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
              </div>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_style').'') ?>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <select name="<?php echo O::escapeHtml('style') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                  <?php foreach($allstyles as $_key=>$_value) {  ?>
                    <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$style){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
          </section>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml(''.@O::lang('security').'') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?>
          </i>
        </h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('totp') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$totp){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_totp').'') ?>
                </label>
                <i data-qrcode="<?php echo O::escapeHtml(''.@$totpSecretUrl.'') ?>" title="<?php echo O::escapeHtml(''.@O::lang('QRCODE_SHOW').'') ?>" class="<?php echo O::escapeHtml('or-image-icon or-image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo O::escapeHtml('') ?>
                </i>
              </div>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('hotp') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$hotp){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_hotp').'') ?>
                </label>
                <i data-qrcode="<?php echo O::escapeHtml(''.@$hotpSecretUrl.'') ?>" title="<?php echo O::escapeHtml(''.@O::lang('QRCODE_SHOW').'') ?>" class="<?php echo O::escapeHtml('or-image-icon or-image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo O::escapeHtml('') ?>
                </i>
              </div>
            </div>
          </section>
        </div>
      </section>
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