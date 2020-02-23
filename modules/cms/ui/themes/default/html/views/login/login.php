<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="login" data-action="login" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" data-after-success="reloadAll" class="or-form login">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="login" />
      <input type="hidden" name="subaction" value="login" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <?php $if1=(config('login','logo','enabled')); if($if1) {  ?>
          <?php $if1=!((config('login','logo','url'))==FALSE); if($if1) {  ?>
            <a target="_self" data-url="<?php echo encodeHtml(htmlentities(config('login','logo','url'))) ?>" data-action="" data-method="" data-id="" data-extra="[]" href="/#//">
              <img src="<?php echo encodeHtml(htmlentities(config('login','logo','image'))) ?>" />
            </a>
           <?php } ?>
          <?php if(!$if1) {  ?>
            <img src="<?php echo encodeHtml(htmlentities(config('login','logo','image'))) ?>" />
           <?php } ?>
         <?php } ?>
        <?php $if1=!((config('login','motd'))==FALSE); if($if1) {  ?>
          <div class="message info">
            <span><?php echo encodeHtml(htmlentities(config('login','motd'))) ?>
            </span>
          </div>
         <?php } ?>
        <?php $if1=(config('login','nologin')); if($if1) {  ?>
          <div class="message error">
            <span><?php echo encodeHtml(htmlentities(@lang('LOGIN_NOLOGIN_DESC'))) ?>
            </span>
          </div>
         <?php } ?>
        <?php $if1=(config('security','readonly')); if($if1) {  ?>
          <div class="message warn">
            <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_READONLY_DESC'))) ?>
            </span>
          </div>
         <?php } ?>
        <?php $if1=(!config('login','nologin')); if($if1) {  ?>
          <div class="line">
            <div class="label">
              <label class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('USER_USERNAME'))) ?>
                </span>
              </label>
            </div>
            <div class="input">
              <?php $if1=!(isset($force_username)); if($if1) {  ?>
                <div class="inputholder">
                  <input name="login_name" required="required" placeholder="<?php echo encodeHtml(htmlentities(@lang('USER_USERNAME'))) ?>" autofocus="autofocus" type="text" maxlength="128" value="<?php echo encodeHtml(htmlentities(@$login_name)) ?>" class="name" />
                </div>
               <?php } ?>
              <?php if(!$if1) {  ?>
                <input type="hidden" name="login_name" value="<?php echo encodeHtml(htmlentities(@$login_name)) ?>" />
                <span><?php echo encodeHtml(htmlentities(@$force_username)) ?>
                </span>
               <?php } ?>
            </div>
          </div>
          <div class="line">
            <div class="label">
              <label class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('USER_PASSWORD'))) ?>
                </span>
              </label>
            </div>
            <div class="input">
              <div class="inputholder">
                <input type="password" name="login_password" size="20" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$login_password)) ?>" class="name" />
              </div>
            </div>
          </div>
          <div class="line">
            <div class="label">
            </div>
            <div class="input">
              <input type="checkbox" name="remember" value="1" <?php if(@$remember){ ?>checked="1"<?php } ?> />
              <label class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('REMEMBER_ME'))) ?>
                </span>
              </label>
            </div>
          </div>
         <?php } ?>
        <fieldset class="or-group toggle-open-close closed">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('USER_NEW_PASSWORD'))) ?>
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
                  <span><?php echo encodeHtml(htmlentities(@lang('USER_NEW_PASSWORD'))) ?>
                  </span>
                </label>
              </div>
              <div class="input">
                <div class="inputholder">
                  <input type="password" name="password1" size="25" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$password1)) ?>" class="" />
                </div>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('USER_NEW_PASSWORD_REPEAT'))) ?>
                  </span>
                </label>
              </div>
              <div class="input">
                <div class="inputholder">
                  <input type="password" name="password2" size="25" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$password2)) ?>" class="" />
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="or-group toggle-open-close closed">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('USER_TOKEN'))) ?>
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
                  <span><?php echo encodeHtml(htmlentities(@lang('USER_TOKEN'))) ?>
                  </span>
                </label>
              </div>
              <div class="input">
                <div class="inputholder">
                  <input name="user_token" type="text" maxlength="30" value="" />
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <?php $if1=(intval('1')<intval('size:dbids')); if($if1) {  ?>
          <fieldset class="or-group toggle-open-close open show">
            <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('DATABASE'))) ?>
              <img src="themes/default/images/icon/method/database.svg" />" />
              <div class="arrow arrow-right on-closed">
              </div>
              <div class="arrow arrow-down on-open">
              </div>
            </legend>
            <div class="closable">
              <div class="line">
                <div class="label">
                  <label class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('DATABASE'))) ?>
                    </span>
                  </label>
                </div>
                <div class="input">
                  <select name="dbid" size="1">
                    <?php foreach($dbids as $_key=>$_value) {  ?>
                      <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$dbid){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                      </option>
                     <?php } ?>
                  </select>
                </div>
              </div>
            </div>
          </fieldset>
         <?php } ?>
        <?php if(!$if1) {  ?>
          <input type="hidden" name="dbid" value="<?php echo encodeHtml(htmlentities(@$dbid)) ?>" />
         <?php } ?>
        <input type="hidden" name="objectid" value="<?php echo encodeHtml(htmlentities(@$objectid)) ?>" />
        <input type="hidden" name="modelid" value="<?php echo encodeHtml(htmlentities(@$modelid)) ?>" />
        <input type="hidden" name="projectid" value="<?php echo encodeHtml(htmlentities(@$projectid)) ?>" />
        <input type="hidden" name="languageid" value="<?php echo encodeHtml(htmlentities(@$languageid)) ?>" />
      </div>
      <div class="or-form-actionbar">
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('menu_login'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>