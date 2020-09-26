<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo \template_engine\Output::escapeHtml('') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-target="<?php echo \template_engine\Output::escapeHtml('view') ?>" action="<?php echo \template_engine\Output::escapeHtml('./') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('info') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('user') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" method="<?php echo \template_engine\Output::escapeHtml('POST') ?>" enctype="<?php echo \template_engine\Output::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo \template_engine\Output::escapeHtml('') ?>" data-autosave="<?php echo \template_engine\Output::escapeHtml('') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form user') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('token') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_token.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('action') ?>" value="<?php echo \template_engine\Output::escapeHtml('user') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('subaction') ?>" value="<?php echo \template_engine\Output::escapeHtml('info') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('id') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <div><?php echo \template_engine\Output::escapeHtml('') ?>
      <span class="<?php echo \template_engine\Output::escapeHtml('headline') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$fullname.'') ?>
      </span>
      <?php $if1=!(($image)==FALSE); if($if1) {  ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <img src="<?php echo \template_engine\Output::escapeHtml(''.@$image.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
        </div>
       <?php } ?>
      <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('user_username').'') ?>
          </span>
        </div>
        <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <span class="<?php echo \template_engine\Output::escapeHtml('name') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>
          </span>
        </div>
      </div>
      <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('ADDITIONAL_INFO').'') ?>
          <img /><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('user_fullname').'') ?>
              </span>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@$fullname.'') ?>
              </span>
            </div>
          </div>
          <?php $if1=(\cms\base\Configuration::config('security','user','show_admin_mail')); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('user_mail').'') ?>
                </label>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-url="<?php echo \template_engine\Output::escapeHtml('mailto:'.@$mail.'') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('external') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('mailto:'.@$mail.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@$mail.'') ?>
                  </span>
                </a>
                <i data-qrcode="<?php echo \template_engine\Output::escapeHtml('mailto:'.@$mail.'') ?>" title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('QRCODE_SHOW').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
              </div>
            </div>
           <?php } ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('description').'') ?>
              </span>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@$desc.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('user_tel').'') ?>
              </label>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@$tel.'') ?>
              </span>
              <i data-qrcode="<?php echo \template_engine\Output::escapeHtml('tel:'.@$tel.'') ?>" title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('QRCODE_SHOW').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </i>
            </div>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('timezone').'') ?>
              </span>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@$timezone.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('language').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@$language.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('prop') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'prop\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-link-btn') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('edit').'') ?>
                </span>
              </a>
            </div>
          </div>
        </div>
      </fieldset>
      <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close closed show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('options').'') ?>
          <img /><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('is_admin') ?>" disabled="<?php echo \template_engine\Output::escapeHtml('disabled') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$is_admin){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
              <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('user_admin').'') ?>
              </label>
            </div>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang(':user_ldapdn').'') ?>
              </span>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@$ldap_dn.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('user_style').'') ?>
              </span>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@$style.'') ?>
              </span>
            </div>
          </div>
        </div>
      </fieldset>
      <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close closed show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('security').'') ?>
          <img /><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('user_password_expires').'') ?>
              </span>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($passwordExpires); ?>
               <?php } ?>
            </div>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('user') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('pw') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':\'user\',\'dialogMethod\':\'pw\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/user/') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-link-btn') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('edit_password').'') ?>
                </span>
              </a>
            </div>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('user_last_login').'') ?>
              </span>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastLogin); ?>
               <?php } ?>
            </div>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('token').'') ?>
              </span>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@$totpToken.'') ?>
              </span>
            </div>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('user_totp').'') ?>
              </label>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('totp') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$totp){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
              <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('user_totp').'') ?>
              </label>
              <i data-qrcode="<?php echo \template_engine\Output::escapeHtml(''.@$totpSecretUrl.'') ?>" title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('QRCODE_SHOW').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--menu-qrcode or-qrcode or-info') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </i>
            </div>
          </div>
        </div>
      </fieldset>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-form-actionbar') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
  </form>