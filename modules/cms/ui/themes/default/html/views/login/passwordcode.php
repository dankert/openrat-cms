<?php if (defined('OR_TITLE')) {  ?>
  
    
      <form name="" target="_self" data-target="_top" action="./" data-method="passwordcode" data-action="login" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form login">
        <input type="hidden" name="token" value="<?php echo token();?>" />
        <input type="hidden" name="action" value="login" />
        <input type="hidden" name="subaction" value="passwordcode" />
        <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
        <div>
          
            <tr>
              <td colspan="2" class="logo">
                <div class="line logo">
                  <div class="label">
                    <img src="themes/default/images/logo_password.png" border="0" />
                  </div>
                  <div class="input">
                    <h2><?php echo encodeHtml(htmlentities(@lang('logo_password'))) ?>
                    </h2>
                    <p><?php echo encodeHtml(htmlentities(@lang('logo_password_text'))) ?>
                    </p>
                  </div>
                </div>
              </td>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('mail_code'))) ?>
                  </span>
                </td>
                <td>
                  <div class="inputholder">
                    <input name="code" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$code)) ?>" />
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2" class="act">
                  
                </td>
              </tr>
            </tr>
        </div>
        <div class="or-form-actionbar">
          <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
          <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
        </div>
      </form>
      
 <?php } ?>