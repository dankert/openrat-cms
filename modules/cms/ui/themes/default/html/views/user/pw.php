<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="pw" data-action="user" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form user">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="user" />
      <input type="hidden" name="subaction" value="pw" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="line">
          <div class="label">
          </div>
          <div class="input">
            <input type="radio" name="type" disabled="" value="proposal" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
            <label class="label"><?php echo encodeHtml(htmlentities(@$password_proposal)) ?>
              <span><?php echo encodeHtml(htmlentities(@lang('USER_new_password'))) ?>
              </span>
              <span> 
              </span>
              <span><?php echo encodeHtml(htmlentities(@$password_proposal)) ?>
              </span>
            </label>
            <input type="hidden" name="password_proposal" value="<?php echo encodeHtml(htmlentities(@$password_proposal)) ?>" />
          </div>
        </div>
        <?php $if1=(config('mail','enabled')); if($if1) {  ?>
          <div class="line">
            <div class="label">
            </div>
            <div class="input">
              <input type="radio" name="type" disabled="" value="random" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
              <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_random_password'))) ?>
              </label>
            </div>
          </div>
         <?php } ?>
        <div class="line">
          <div class="label">
          </div>
          <div class="input">
            <input type="radio" name="type" disabled="" value="input" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
            <label class="label"><?php echo encodeHtml(htmlentities(@lang('USER_NEW_PASSWORD_INPUT'))) ?>
            </label>
          </div>
        </div>
        <div class="line">
          <div class="label">
            <label class="label"><?php echo encodeHtml(htmlentities(@lang('USER_new_password'))) ?>
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
            <label class="label"><?php echo encodeHtml(htmlentities(@lang('USER_new_password_repeat'))) ?>
            </label>
          </div>
          <div class="input">
            <div class="inputholder">
              <input type="password" name="password2" size="40" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$password2)) ?>" class="" />
            </div>
          </div>
        </div>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('options'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
          </div>
        </fieldset>
        <?php $if1=(config('mail','enabled')); if($if1) {  ?>
          <?php $if1=(isset($mail)); if($if1) {  ?>
            <div class="line">
              <div class="label">
              </div>
              <div class="input">
                <input type="checkbox" name="email" value="1" <?php if(@$email){ ?>checked="1"<?php } ?> />
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_mail_new_password'))) ?>
                </label>
              </div>
            </div>
            <div class="line">
              <div class="label">
              </div>
              <div class="input">
                <input type="checkbox" name="timeout" value="1" <?php if(@$timeout){ ?>checked="1"<?php } ?> />
                <label class="label"><?php echo encodeHtml(htmlentities(@lang('user_password_timeout'))) ?>
                </label>
              </div>
            </div>
           <?php } ?>
         <?php } ?>
        
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>