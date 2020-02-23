<?php if (defined('OR_TITLE')) {  ?>
  
    
    <form name="" target="_self" data-target="view" action="./" data-method="edit" data-action="profile" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form profile">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="profile" />
      <input type="hidden" name="subaction" value="edit" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <div class="line">
              <div class="label">
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_username'))) ?>
                </label>
              </div>
              <div class="input">
                <span class="name"><?php echo encodeHtml(htmlentities(@$name)) ?>
                </span>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('MENU_PROFILE_MAIL'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <div class="line">
              <div class="label">
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_mail'))) ?>
                </label>
              </div>
              <div class="input">
                <span><?php echo encodeHtml(htmlentities(@$mail)) ?>
                </span>
                <br />
                <br />
                <div class="clickable">
                  <a target="_self" date-name="<?php echo encodeHtml(htmlentities(@lang('mail'))) ?>" name="<?php echo encodeHtml(htmlentities(@lang('mail'))) ?>" data-type="dialog" data-action="profile" data-method="mail" data-id="" data-extra="{'dialogAction':'profile','dialogMethod':'mail'}" href="/#/profile/" class="action">
                    <span><?php echo encodeHtml(htmlentities(@lang('edit'))) ?>
                    </span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('GLOBAL_PROP'))) ?>
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
            <div class="line">
              <div class="label">
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_tel'))) ?>
                </label>
              </div>
              <div class="input">
                <div class="inputholder">
                  <input name="tel" type="text" maxlength="128" value="<?php echo encodeHtml(htmlentities(@$tel)) ?>" />
                </div>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_desc'))) ?>
                </label>
              </div>
              <div class="input">
                <div class="inputholder">
                  <input name="desc" type="text" maxlength="128" value="<?php echo encodeHtml(htmlentities(@$desc)) ?>" />
                </div>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_style'))) ?>
                </label>
              </div>
              <div class="input">
                <select name="style" size="1" class="or-theme-chooser">
                  <?php foreach($allstyles as $_key=>$_value) {  ?>
                    <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$style){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                    </option>
                   <?php } ?>
                </select>
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
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('global_save'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>