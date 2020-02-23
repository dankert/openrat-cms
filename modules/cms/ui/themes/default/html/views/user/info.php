<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="info" data-action="user" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form user">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="user" />
      <input type="hidden" name="subaction" value="info" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <span class="headline"><?php echo encodeHtml(htmlentities(@$fullname)) ?>
        </span>
        <?php $if1=!(($image)==FALSE); if($if1) {  ?>
          <div class="line">
            <div class="input">
              <img src="<?php echo encodeHtml(htmlentities(@$image)) ?>" />
            </div>
          </div>
         <?php } ?>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('user_username'))) ?>
            </span>
          </div>
          <div class="input">
            <span class="name"><?php echo encodeHtml(htmlentities(@$name)) ?>
            </span>
          </div>
        </div>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('ADDITIONAL_INFO'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('user_fullname'))) ?>
                </span>
              </div>
              <div class="input">
                <span><?php echo encodeHtml(htmlentities(@$fullname)) ?>
                </span>
              </div>
            </div>
            <?php $if1=(config('security','user','show_admin_mail')); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_mail'))) ?>
                  </label>
                </div>
                <div class="input">
                  <a target="_self" data-url="mailto:<?php echo encodeHtml(htmlentities(@$mail)) ?>" data-type="external" data-action="" data-method="" data-id="" data-extra="[]" href="mailto:<?php echo encodeHtml(htmlentities(@$mail)) ?>">
                    <span><?php echo encodeHtml(htmlentities(@$mail)) ?>
                    </span>
                  </a>
                  <i data-qrcode="mailto:<?php echo encodeHtml(htmlentities(@$mail)) ?>" title="<?php echo encodeHtml(htmlentities(@lang('QRCODE_SHOW'))) ?>" class="image-icon image-icon--menu-qrcode or-qrcode or-info">
                  </i>
                </div>
              </div>
             <?php } ?>
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('description'))) ?>
                </span>
              </div>
              <div class="input">
                <span><?php echo encodeHtml(htmlentities(@$desc)) ?>
                </span>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_tel'))) ?>
                </label>
              </div>
              <div class="input">
                <span><?php echo encodeHtml(htmlentities(@$tel)) ?>
                </span>
                <i data-qrcode="tel:<?php echo encodeHtml(htmlentities(@$tel)) ?>" title="<?php echo encodeHtml(htmlentities(@lang('QRCODE_SHOW'))) ?>" class="image-icon image-icon--menu-qrcode or-qrcode or-info">
                </i>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('timezone'))) ?>
                </span>
              </div>
              <div class="input">
                <span><?php echo encodeHtml(htmlentities(@$timezone)) ?>
                </span>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('language'))) ?>
                  </span>
                </label>
              </div>
              <div class="input">
                <span><?php echo encodeHtml(htmlentities(@$language)) ?>
                </span>
              </div>
            </div>
            <div class="line">
              <div class="label">
              </div>
              <div class="input clickable">
                <a target="_self" data-type="dialog" data-action="" data-method="prop" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'prop'}" href="/#//" class="or-link-btn">
                  <span><?php echo encodeHtml(htmlentities(@lang('edit'))) ?>
                  </span>
                </a>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="or-group toggle-open-close closed show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('options'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <div class="line">
              <div class="label">
              </div>
              <div class="input">
                <input type="checkbox" name="is_admin" disabled="disabled" value="1" <?php if(@$is_admin){ ?>checked="1"<?php } ?> />
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_admin'))) ?>
                </label>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang(':user_ldapdn'))) ?>
                </span>
              </div>
              <div class="input">
                <span><?php echo encodeHtml(htmlentities(@$ldap_dn)) ?>
                </span>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('user_style'))) ?>
                </span>
              </div>
              <div class="input">
                <span><?php echo encodeHtml(htmlentities(@$style)) ?>
                </span>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="or-group toggle-open-close closed show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('security'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('user_password_expires'))) ?>
                </span>
              </div>
              <div class="input">
                <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($passwordExpires); ?>
                 <?php } ?>
              </div>
            </div>
            <div class="line">
              <div class="label">
              </div>
              <div class="input clickable">
                <a target="_self" data-type="dialog" data-action="user" data-method="pw" data-id="" data-extra="{'dialogAction':'user','dialogMethod':'pw'}" href="/#/user/" class="or-link-btn">
                  <span><?php echo encodeHtml(htmlentities(@lang('edit_password'))) ?>
                  </span>
                </a>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('user_last_login'))) ?>
                </span>
              </div>
              <div class="input">
                <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastLogin); ?>
                 <?php } ?>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('token'))) ?>
                </span>
              </div>
              <div class="input">
                <span><?php echo encodeHtml(htmlentities(@$totpToken)) ?>
                </span>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_totp'))) ?>
                </label>
              </div>
              <div class="input">
                <input type="checkbox" name="totp" value="1" <?php if(@$totp){ ?>checked="1"<?php } ?> />
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_totp'))) ?>
                </label>
                <i data-qrcode="<?php echo encodeHtml(htmlentities(@$totpSecretUrl)) ?>" title="<?php echo encodeHtml(htmlentities(@lang('QRCODE_SHOW'))) ?>" class="image-icon image-icon--menu-qrcode or-qrcode or-info">
                </i>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
      <div class="or-form-actionbar">
      </div>
    </form>
 <?php } ?>