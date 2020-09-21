<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('info') ?>" data-action="<?php echo escapeHtml('user') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form user') ?>"><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('user') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('info') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
    <div><?php echo escapeHtml('') ?>
      <span class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml(''.@$fullname.'') ?>
      </span>
      <?php $if1=!(($image)==FALSE); if($if1) {  ?>
        <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
            <img src="<?php echo escapeHtml(''.@$image.'') ?>" /><?php echo escapeHtml('') ?>
          </div>
        </div>
       <?php } ?>
      <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('user_username').'') ?>
          </span>
        </div>
        <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
          <span class="<?php echo escapeHtml('name') ?>"><?php echo escapeHtml(''.@$name.'') ?>
          </span>
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
              <span><?php echo escapeHtml(''.@lang('user_fullname').'') ?>
              </span>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@$fullname.'') ?>
              </span>
            </div>
          </div>
          <?php $if1=(config('security','user','show_admin_mail')); if($if1) {  ?>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('user_mail').'') ?>
                </label>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <a target="<?php echo escapeHtml('_self') ?>" data-url="<?php echo escapeHtml('mailto:'.@$mail.'') ?>" data-type="<?php echo escapeHtml('external') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('mailto:'.@$mail.'') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@$mail.'') ?>
                  </span>
                </a>
                <i data-qrcode="<?php echo escapeHtml('mailto:'.@$mail.'') ?>" title="<?php echo escapeHtml(''.@lang('QRCODE_SHOW').'') ?>" class="<?php echo escapeHtml('image-icon image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo escapeHtml('') ?>
                </i>
              </div>
            </div>
           <?php } ?>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('description').'') ?>
              </span>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@$desc.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('user_tel').'') ?>
              </label>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@$tel.'') ?>
              </span>
              <i data-qrcode="<?php echo escapeHtml('tel:'.@$tel.'') ?>" title="<?php echo escapeHtml(''.@lang('QRCODE_SHOW').'') ?>" class="<?php echo escapeHtml('image-icon image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo escapeHtml('') ?>
              </i>
            </div>
          </div>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('timezone').'') ?>
              </span>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@$timezone.'') ?>
              </span>
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
              <span><?php echo escapeHtml(''.@$language.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('input clickable') ?>"><?php echo escapeHtml('') ?>
              <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('prop') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'prop\'}') ?>" href="<?php echo escapeHtml('/#//') ?>" class="<?php echo escapeHtml('or-link-btn') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('edit').'') ?>
                </span>
              </a>
            </div>
          </div>
        </div>
      </fieldset>
      <fieldset class="<?php echo escapeHtml('or-group toggle-open-close closed show') ?>"><?php echo escapeHtml('') ?>
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
              <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('is_admin') ?>" disabled="<?php echo escapeHtml('disabled') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$is_admin){ ?>checked="<?php echo escapeHtml('checked') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('user_admin').'') ?>
              </label>
            </div>
          </div>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang(':user_ldapdn').'') ?>
              </span>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@$ldap_dn.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('user_style').'') ?>
              </span>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@$style.'') ?>
              </span>
            </div>
          </div>
        </div>
      </fieldset>
      <fieldset class="<?php echo escapeHtml('or-group toggle-open-close closed show') ?>"><?php echo escapeHtml('') ?>
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
              <span><?php echo escapeHtml(''.@lang('user_password_expires').'') ?>
              </span>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($passwordExpires); ?>
               <?php } ?>
            </div>
          </div>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('input clickable') ?>"><?php echo escapeHtml('') ?>
              <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('user') ?>" data-method="<?php echo escapeHtml('pw') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':\'user\',\'dialogMethod\':\'pw\'}') ?>" href="<?php echo escapeHtml('/#/user/') ?>" class="<?php echo escapeHtml('or-link-btn') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('edit_password').'') ?>
                </span>
              </a>
            </div>
          </div>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('user_last_login').'') ?>
              </span>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastLogin); ?>
               <?php } ?>
            </div>
          </div>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('token').'') ?>
              </span>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@$totpToken.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('user_totp').'') ?>
              </label>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('totp') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$totp){ ?>checked="<?php echo escapeHtml('checked') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml(''.@lang('user_totp').'') ?>
              </label>
              <i data-qrcode="<?php echo escapeHtml(''.@$totpSecretUrl.'') ?>" title="<?php echo escapeHtml(''.@lang('QRCODE_SHOW').'') ?>" class="<?php echo escapeHtml('image-icon image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo escapeHtml('') ?>
              </i>
            </div>
          </div>
        </div>
      </fieldset>
    </div>
    <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
    </div>
  </form>