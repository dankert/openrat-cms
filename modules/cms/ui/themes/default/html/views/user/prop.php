<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('prop') ?>" data-action="<?php echo escapeHtml('user') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form user') ?>"><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('user') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('prop') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
    <div><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
          <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('user_username').'') ?>
          </label>
        </div>
        <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
            <input name="<?php echo escapeHtml('name') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('128') ?>" value="<?php echo escapeHtml(''.@$name.'') ?>" class="<?php echo escapeHtml('name,focus') ?>" /><?php echo escapeHtml('') ?>
          </div>
        </div>
      </div>
      <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
        <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('ADDITIONAL_INFO').'') ?>
          <img /><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
          </div>
          <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('user_fullname').'') ?>
              </label>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                <input name="<?php echo escapeHtml('fullname') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('128') ?>" value="<?php echo escapeHtml(''.@$fullname.'') ?>" /><?php echo escapeHtml('') ?>
              </div>
            </div>
          </div>
          <?php $if1=(config('security','user','show_admin_mail')); if($if1) {  ?>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('user_mail').'') ?>
                </label>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                  <input name="<?php echo escapeHtml('mail') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('255') ?>" value="<?php echo escapeHtml(''.@$mail.'') ?>" /><?php echo escapeHtml('') ?>
                </div>
                <i data-qrcode="<?php echo escapeHtml('mailto:'.@$mail.'') ?>" title="<?php echo escapeHtml(''.@lang('QRCODE_SHOW').'') ?>" class="<?php echo escapeHtml('image-icon image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo escapeHtml('') ?>
                </i>
              </div>
            </div>
           <?php } ?>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('user_desc').'') ?>
              </label>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                <input name="<?php echo escapeHtml('desc') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('255') ?>" value="<?php echo escapeHtml(''.@$desc.'') ?>" /><?php echo escapeHtml('') ?>
              </div>
            </div>
          </div>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('user_tel').'') ?>
              </label>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                <input name="<?php echo escapeHtml('tel') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('128') ?>" value="<?php echo escapeHtml(''.@$tel.'') ?>" /><?php echo escapeHtml('') ?>
              </div>
              <i data-qrcode="<?php echo escapeHtml('tel:'.@$tel.'') ?>" title="<?php echo escapeHtml(''.@lang('QRCODE_SHOW').'') ?>" class="<?php echo escapeHtml('image-icon image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo escapeHtml('') ?>
              </i>
            </div>
          </div>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('timezone').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <select name="<?php echo escapeHtml('timezone') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
                <option value="<?php echo escapeHtml('') ?>"><?php echo escapeHtml(''.@lang('LIST_ENTRY_EMPTY').'') ?>
                </option>
                <?php foreach($timezone_list as $_key=>$_value) {  ?>
                  <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$timezone){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                  </option>
                 <?php } ?>
              </select>
            </div>
          </div>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('language').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <select name="<?php echo escapeHtml('language') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
                <option value="<?php echo escapeHtml('') ?>"><?php echo escapeHtml(''.@lang('LIST_ENTRY_EMPTY').'') ?>
                </option>
                <?php foreach($language_list as $_key=>$_value) {  ?>
                  <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$language){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                  </option>
                 <?php } ?>
              </select>
            </div>
          </div>
        </div>
      </fieldset>
      <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
        <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('options').'') ?>
          <img /><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
          </div>
          <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('is_admin') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$is_admin){ ?>checked="<?php echo escapeHtml('checked') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('user_admin').'') ?>
              </label>
            </div>
          </div>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('user_ldapdn').'') ?>
              </label>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                <input name="<?php echo escapeHtml('ldap_dn') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$ldap_dn.'') ?>" /><?php echo escapeHtml('') ?>
              </div>
            </div>
          </div>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('user_style').'') ?>
              </label>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <select name="<?php echo escapeHtml('style') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
                <?php foreach($allstyles as $_key=>$_value) {  ?>
                  <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$style){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                  </option>
                 <?php } ?>
              </select>
            </div>
          </div>
        </div>
      </fieldset>
      <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
        <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('security').'') ?>
          <img /><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
          </div>
          <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('totp') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$totp){ ?>checked="<?php echo escapeHtml('checked') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('user_totp').'') ?>
              </label>
              <i data-qrcode="<?php echo escapeHtml(''.@$totpSecretUrl.'') ?>" title="<?php echo escapeHtml(''.@lang('QRCODE_SHOW').'') ?>" class="<?php echo escapeHtml('image-icon image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo escapeHtml('') ?>
              </i>
            </div>
          </div>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('hotp') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$hotp){ ?>checked="<?php echo escapeHtml('checked') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('user_hotp').'') ?>
              </label>
              <i data-qrcode="<?php echo escapeHtml(''.@$hotpSecretUrl.'') ?>" title="<?php echo escapeHtml(''.@lang('QRCODE_SHOW').'') ?>" class="<?php echo escapeHtml('image-icon image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo escapeHtml('') ?>
              </i>
            </div>
          </div>
        </div>
      </fieldset>
    </div>
    <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
    </div>
  </form>