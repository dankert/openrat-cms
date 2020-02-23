<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="pw" data-action="profile" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form profile">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="profile" />
      <input type="hidden" name="subaction" value="pw" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <?php $if1=($pwchange_enabled); if($if1) {  ?>
          <div class="line logo">
            <div class="label">
              <img src="themes/default/images/logo_changepassword.png" border="0" />
            </div>
            <div class="input">
              <h2><?php echo encodeHtml(htmlentities(@lang('logo_changepassword'))) ?>
              </h2>
              <p><?php echo encodeHtml(htmlentities(@lang('logo_changepassword_text'))) ?>
              </p>
            </div>
          </div>
          <fieldset class="or-group toggle-open-close open show">
            <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('user_act_password'))) ?>
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
                    <span><?php echo encodeHtml(htmlentities(@lang('user_password'))) ?>
                    </span>
                  </label>
                </div>
                <div class="input">
                  <div class="inputholder">
                    <input type="password" name="act_password" size="40" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$act_password)) ?>" class="focus" />
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
          <fieldset class="or-group toggle-open-close open show">
            <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('user_new_password'))) ?>
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
                    <span><?php echo encodeHtml(htmlentities(@lang('user_new_password'))) ?>
                    </span>
                  </label>
                </div>
                <div class="input">
                  <div class="inputholder">
                    <input type="password" name="password1" size="40" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$password1)) ?>" class="" />
                  </div>
                </div>
              </div>
              <div class="line">
                <div class="label">
                  <label class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('user_new_password_repeat'))) ?>
                    </span>
                  </label>
                </div>
                <div class="input">
                  <div class="inputholder">
                    <input type="password" name="password2" size="40" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$password2)) ?>" class="" />
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
         <?php } ?>
        <?php if(!$if1) {  ?>
          <div class="message warn">
            <span><?php echo encodeHtml(htmlentities(@lang('pwchange_not_allowed'))) ?>
            </span>
          </div>
         <?php } ?>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>