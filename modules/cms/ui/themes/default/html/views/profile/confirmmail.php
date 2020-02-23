<?php if (defined('OR_TITLE')) {  ?>
  
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
    <form name="" target="_self" data-target="view" action="./" data-method="confirmmail" data-action="profile" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form profile">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="profile" />
      <input type="hidden" name="subaction" value="confirmmail" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="line">
          <div class="label">
            <label class="label"><?php echo encodeHtml(htmlentities(@lang('mail_code'))) ?>
            </label>
          </div>
          <div class="input">
            <div class="inputholder">
              <input name="code" required="required" autofocus="autofocus" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$code)) ?>" />
            </div>
          </div>
        </div>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>