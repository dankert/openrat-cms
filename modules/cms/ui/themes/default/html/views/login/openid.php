<?php if (defined('OR_TITLE')) {  ?>
  
    
    <form name="" target="_self" data-target="_top" action="./" data-method="login" data-action="login" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form login">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="login" />
      <input type="hidden" name="subaction" value="login" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <?php $if1=(config('security','openid','enable')); if($if1) {  ?>
          <fieldset class="or-group toggle-open-close open show">
            <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('OPENID'))) ?>
              <img />
              <div class="arrow arrow-right on-closed">
              </div>
              <div class="arrow arrow-down on-open">
              </div>
            </legend>
            <div class="closable">
              <div class="line">
                <div class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('openid_user'))) ?>
                  </span>
                  <?php $if1=!((config('security','openid','logo_url'))==FALSE); if($if1) {  ?>
                    <img src="<?php echo encodeHtml(htmlentities(config('security','openid','logo_url'))) ?>" />
                   <?php } ?>
                </div>
                <div class="input">
                  <?php foreach( $openid_providers as $_key=>$_value) {  ?>
                    <label>
                      <input type="radio" name="openid_provider" value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$openid_provider){ ?>checked="checked"<?php } ?> />
                      <span><?php echo encodeHtml(htmlentities(@$_value)) ?>
                      </span>
                    </label>
                    <br />
                   <?php } ?>
                  <?php $if1=($openid_user_identity); if($if1) {  ?>
                    <input type="radio" name="openid_provider" disabled="" value="identity" checked="<?php echo encodeHtml(htmlentities(@$openid_provider)) ?>" />
                    <div class="inputholder">
                      <input name="openid_url" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$openid_url)) ?>" class="name" />
                    </div>
                   <?php } ?>
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
                        <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==''.@$actdbid.''){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                        </option>
                       <?php } ?>
                    </select>
                    <input type="hidden" name="screenwidth" value="9999" />
                  </div>
                </div>
              </div>
            </fieldset>
           <?php } ?>
          <?php if(!$if1) {  ?>
            <input type="hidden" name="dbid" value="<?php echo encodeHtml(htmlentities(@$actdbid)) ?>" />
           <?php } ?>
          <input type="hidden" name="objectid" value="<?php echo encodeHtml(htmlentities(@$objectid)) ?>" />
          <input type="hidden" name="modelid" value="<?php echo encodeHtml(htmlentities(@$modelid)) ?>" />
          <input type="hidden" name="projectid" value="<?php echo encodeHtml(htmlentities(@$projectid)) ?>" />
          <input type="hidden" name="languageid" value="<?php echo encodeHtml(htmlentities(@$languageid)) ?>" />
         <?php } ?>
        <?php if(!$if1) {  ?>
          <div class="message error">
            <span><?php echo encodeHtml(htmlentities(@lang('OPENID_NOT_ENABLED'))) ?>
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