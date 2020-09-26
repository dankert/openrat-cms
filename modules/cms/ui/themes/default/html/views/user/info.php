<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('info') ?>" data-action="<?php echo O::escapeHtml('user') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form user') ?>"><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('user') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('info') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
    <div><?php echo O::escapeHtml('') ?>
      <span class="<?php echo O::escapeHtml('headline') ?>"><?php echo O::escapeHtml(''.@$fullname.'') ?>
      </span>
      <?php $if1=!(($image)==FALSE); if($if1) {  ?>
        <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
            <img src="<?php echo O::escapeHtml(''.@$image.'') ?>" /><?php echo O::escapeHtml('') ?>
          </div>
        </div>
       <?php } ?>
      <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('user_username').'') ?>
          </span>
        </div>
        <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
          <span class="<?php echo O::escapeHtml('name') ?>"><?php echo O::escapeHtml(''.@$name.'') ?>
          </span>
        </div>
      </div>
      <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
        <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('ADDITIONAL_INFO').'') ?>
          <img /><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo O::escapeHtml('') ?>
          </div>
          <div class="<?php echo O::escapeHtml('arrow arrow-down on-open') ?>"><?php echo O::escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('user_fullname').'') ?>
              </span>
            </div>
            <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$fullname.'') ?>
              </span>
            </div>
          </div>
          <?php $if1=(\cms\base\Configuration::config('security','user','show_admin_mail')); if($if1) {  ?>
            <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_mail').'') ?>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
                <a target="<?php echo O::escapeHtml('_self') ?>" data-url="<?php echo O::escapeHtml('mailto:'.@$mail.'') ?>" data-type="<?php echo O::escapeHtml('external') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('mailto:'.@$mail.'') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@$mail.'') ?>
                  </span>
                </a>
                <i data-qrcode="<?php echo O::escapeHtml('mailto:'.@$mail.'') ?>" title="<?php echo O::escapeHtml(''.@O::lang('QRCODE_SHOW').'') ?>" class="<?php echo O::escapeHtml('image-icon image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo O::escapeHtml('') ?>
                </i>
              </div>
            </div>
           <?php } ?>
          <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('description').'') ?>
              </span>
            </div>
            <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$desc.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_tel').'') ?>
              </label>
            </div>
            <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$tel.'') ?>
              </span>
              <i data-qrcode="<?php echo O::escapeHtml('tel:'.@$tel.'') ?>" title="<?php echo O::escapeHtml(''.@O::lang('QRCODE_SHOW').'') ?>" class="<?php echo O::escapeHtml('image-icon image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo O::escapeHtml('') ?>
              </i>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('timezone').'') ?>
              </span>
            </div>
            <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$timezone.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('language').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$language.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('input clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('prop') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'prop\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>" class="<?php echo O::escapeHtml('or-link-btn') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('edit').'') ?>
                </span>
              </a>
            </div>
          </div>
        </div>
      </fieldset>
      <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close closed show') ?>"><?php echo O::escapeHtml('') ?>
        <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('options').'') ?>
          <img /><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo O::escapeHtml('') ?>
          </div>
          <div class="<?php echo O::escapeHtml('arrow arrow-down on-open') ?>"><?php echo O::escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
              <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('is_admin') ?>" disabled="<?php echo O::escapeHtml('disabled') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$is_admin){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_admin').'') ?>
              </label>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang(':user_ldapdn').'') ?>
              </span>
            </div>
            <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$ldap_dn.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('user_style').'') ?>
              </span>
            </div>
            <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$style.'') ?>
              </span>
            </div>
          </div>
        </div>
      </fieldset>
      <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close closed show') ?>"><?php echo O::escapeHtml('') ?>
        <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('security').'') ?>
          <img /><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo O::escapeHtml('') ?>
          </div>
          <div class="<?php echo O::escapeHtml('arrow arrow-down on-open') ?>"><?php echo O::escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('user_password_expires').'') ?>
              </span>
            </div>
            <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
              <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($passwordExpires); ?>
               <?php } ?>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('input clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('user') ?>" data-method="<?php echo O::escapeHtml('pw') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':\'user\',\'dialogMethod\':\'pw\'}') ?>" href="<?php echo O::escapeHtml('/#/user/') ?>" class="<?php echo O::escapeHtml('or-link-btn') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('edit_password').'') ?>
                </span>
              </a>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('user_last_login').'') ?>
              </span>
            </div>
            <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
              <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastLogin); ?>
               <?php } ?>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('token').'') ?>
              </span>
            </div>
            <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$totpToken.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_totp').'') ?>
              </label>
            </div>
            <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
              <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('totp') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$totp){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_totp').'') ?>
              </label>
              <i data-qrcode="<?php echo O::escapeHtml(''.@$totpSecretUrl.'') ?>" title="<?php echo O::escapeHtml(''.@O::lang('QRCODE_SHOW').'') ?>" class="<?php echo O::escapeHtml('image-icon image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo O::escapeHtml('') ?>
              </i>
            </div>
          </div>
        </div>
      </fieldset>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
    </div>
  </form>