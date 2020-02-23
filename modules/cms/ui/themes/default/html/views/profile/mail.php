<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="mail" data-action="profile" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form profile">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="profile" />
      <input type="hidden" name="subaction" value="mail" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="line logo">
          <div class="label">
            <img src="themes/default/images/logo_changemail.png" border="0" />
          </div>
          <div class="input">
            <h2><?php echo encodeHtml(htmlentities(@lang('logo_changemail'))) ?>
            </h2>
            <p><?php echo encodeHtml(htmlentities(@lang('logo_changemail_text'))) ?>
            </p>
          </div>
        </div>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('user_mail'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <div class="line">
              <div class="label">
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('user_new_mail'))) ?>
                  </span>
                </label>
              </div>
              <div class="input">
                <div class="inputholder">
                  <input name="mail" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$mail)) ?>" />
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <div class="clickable">
          <a target="_self" data-type="dialog" data-action="profile" data-method="confirmmail" data-id="" data-extra="{'dialogAction':'profile','dialogMethod':'confirmmail'}" href="/#/profile/">
            <span><?php echo encodeHtml(htmlentities(@lang('mail_code'))) ?>
            </span>
          </a>
        </div>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>