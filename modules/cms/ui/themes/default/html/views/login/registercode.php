<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="registercode" data-action="login" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form login">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="login" />
      <input type="hidden" name="subaction" value="registercode" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="line logo">
          <div class="label">
            <img src="themes/default/images/logo_register.png" border="0" />
          </div>
          <div class="input">
            <h2><?php echo encodeHtml(htmlentities(@lang('logo_register'))) ?>
            </h2>
            <p><?php echo encodeHtml(htmlentities(@lang('logo_register_text'))) ?>
            </p>
          </div>
        </div>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('USER_REGISTER_CODE'))) ?>
            </span>
          </div>
          <div class="input">
            <div class="inputholder">
              <input name="code" type="text" maxlength="256" value="" class="focus" />
            </div>
          </div>
        </div>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('USER_USERNAME'))) ?>
            </span>
          </div>
          <div class="input">
            <div class="inputholder">
              <input name="username" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$username)) ?>" />
            </div>
          </div>
        </div>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('USER_PASSWORD'))) ?>
            </span>
          </div>
          <div class="input">
            <div class="inputholder">
              <input type="password" name="password" size="25" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$password)) ?>" class="" />
            </div>
          </div>
        </div>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_DATABASE'))) ?>
            </span>
          </div>
          <div class="input">
            <select name="dbid" size="1">
              <?php foreach($dbids as $_key=>$_value) {  ?>
                <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key=='actdbid'){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                </option>
               <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>