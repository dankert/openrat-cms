<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="user" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form user">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="user" />
      <input type="hidden" name="subaction" value="prop" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="line">
          <div class="label">
            <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_username'))) ?>
            </label>
          </div>
          <div class="input">
            <div class="inputholder">
              <input name="name" type="text" maxlength="128" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="name,focus" />
            </div>
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
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_fullname'))) ?>
                </label>
              </div>
              <div class="input">
                <div class="inputholder">
                  <input name="fullname" type="text" maxlength="128" value="<?php echo encodeHtml(htmlentities(@$fullname)) ?>" />
                </div>
              </div>
            </div>
            <?php $if1=(config('security','user','show_admin_mail')); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_mail'))) ?>
                  </label>
                </div>
                <div class="input">
                  <div class="inputholder">
                    <input name="mail" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$mail)) ?>" />
                  </div>
                  <i data-qrcode="mailto:<?php echo encodeHtml(htmlentities(@$mail)) ?>" title="<?php echo encodeHtml(htmlentities(@lang('QRCODE_SHOW'))) ?>" class="image-icon image-icon--menu-qrcode or-qrcode or-info">
                  </i>
                </div>
              </div>
             <?php } ?>
            <div class="line">
              <div class="label">
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_desc'))) ?>
                </label>
              </div>
              <div class="input">
                <div class="inputholder">
                  <input name="desc" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$desc)) ?>" />
                </div>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_tel'))) ?>
                </label>
              </div>
              <div class="input">
                <div class="inputholder">
                  <input name="tel" type="text" maxlength="128" value="<?php echo encodeHtml(htmlentities(@$tel)) ?>" />
                </div>
                <i data-qrcode="tel:<?php echo encodeHtml(htmlentities(@$tel)) ?>" title="<?php echo encodeHtml(htmlentities(@lang('QRCODE_SHOW'))) ?>" class="image-icon image-icon--menu-qrcode or-qrcode or-info">
                </i>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('timezone'))) ?>
                  </span>
                </label>
              </div>
              <div class="input">
                <select name="timezone" size="1">
                  <option value=""><?php echo encodeHtml(htmlentities(@lang('LIST_ENTRY_EMPTY'))) ?>
                  </option>
                  <?php foreach($timezone_list as $_key=>$_value) {  ?>
                    <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$timezone){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                    </option>
                   <?php } ?>
                </select>
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
                <select name="language" size="1">
                  <option value=""><?php echo encodeHtml(htmlentities(@lang('LIST_ENTRY_EMPTY'))) ?>
                  </option>
                  <?php foreach($language_list as $_key=>$_value) {  ?>
                    <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$language){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="or-group toggle-open-close open show">
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
                <input type="checkbox" name="is_admin" value="1" <?php if(@$is_admin){ ?>checked="1"<?php } ?> />
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_admin'))) ?>
                </label>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_ldapdn'))) ?>
                </label>
              </div>
              <div class="input">
                <div class="inputholder">
                  <input name="ldap_dn" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$ldap_dn)) ?>" />
                </div>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_style'))) ?>
                </label>
              </div>
              <div class="input">
                <select name="style" size="1">
                  <?php foreach($allstyles as $_key=>$_value) {  ?>
                    <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$style){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="or-group toggle-open-close open show">
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
              </div>
              <div class="input">
                <input type="checkbox" name="totp" value="1" <?php if(@$totp){ ?>checked="1"<?php } ?> />
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_totp'))) ?>
                </label>
                <i data-qrcode="<?php echo encodeHtml(htmlentities(@$totpSecretUrl)) ?>" title="<?php echo encodeHtml(htmlentities(@lang('QRCODE_SHOW'))) ?>" class="image-icon image-icon--menu-qrcode or-qrcode or-info">
                </i>
              </div>
            </div>
            <div class="line">
              <div class="label">
              </div>
              <div class="input">
                <input type="checkbox" name="hotp" value="1" <?php if(@$hotp){ ?>checked="1"<?php } ?> />
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_hotp'))) ?>
                </label>
                <i data-qrcode="<?php echo encodeHtml(htmlentities(@$hotpSecretUrl)) ?>" title="<?php echo encodeHtml(htmlentities(@lang('QRCODE_SHOW'))) ?>" class="image-icon image-icon--menu-qrcode or-qrcode or-info">
                </i>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>