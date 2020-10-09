<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('login') ?>" data-action="<?php echo O::escapeHtml('login') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" data-after-success="<?php echo O::escapeHtml('reloadAll') ?>" class="<?php echo O::escapeHtml('or-form or-login') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('login') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('login') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <?php $if1=(O::config('login','logo','enabled')); if($if1) {  ?>
        <?php $if1=!((O::config('login','logo','url'))==FALSE); if($if1) {  ?>
          <a target="<?php echo O::escapeHtml('_self') ?>" data-url="<?php echo O::escapeHtml(''.O::config('login','logo','url').'') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
            <img src="<?php echo O::escapeHtml(''.O::config('login','logo','image').'') ?>" /><?php echo O::escapeHtml('') ?>
          </a>
         <?php } ?>
        <?php if(!$if1) {  ?>
          <img src="<?php echo O::escapeHtml(''.O::config('login','logo','image').'') ?>" /><?php echo O::escapeHtml('') ?>
         <?php } ?>
       <?php } ?>
      <?php $if1=!((O::config('login','motd'))==FALSE); if($if1) {  ?>
        <div class="<?php echo O::escapeHtml('or-message info') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.O::config('login','motd').'') ?>
          </span>
        </div>
       <?php } ?>
      <?php $if1=(O::config('login','nologin')); if($if1) {  ?>
        <div class="<?php echo O::escapeHtml('or-message error') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('LOGIN_NOLOGIN_DESC').'') ?>
          </span>
        </div>
       <?php } ?>
      <?php $if1=(O::config('security','readonly')); if($if1) {  ?>
        <div class="<?php echo O::escapeHtml('or-message warn') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('READONLY_DESC').'') ?>
          </span>
        </div>
       <?php } ?>
      <?php $if1=(!O::config('login','nologin')); if($if1) {  ?>
        <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
            <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('USER_USERNAME').'') ?>
              </span>
            </label>
          </div>
          <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
            <?php $if1=!(isset($force_username)); if($if1) {  ?>
              <input name="<?php echo O::escapeHtml('login_name') ?>" required="<?php echo O::escapeHtml('required') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('USER_USERNAME').'') ?>" autofocus="<?php echo O::escapeHtml('autofocus') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('128') ?>" value="<?php echo O::escapeHtml(''.@$login_name.'') ?>" class="<?php echo O::escapeHtml('or-name or-input') ?>" /><?php echo O::escapeHtml('') ?>
             <?php } ?>
            <?php if(!$if1) {  ?>
              <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('login_name') ?>" value="<?php echo O::escapeHtml(''.@$login_name.'') ?>" /><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$force_username.'') ?>
              </span>
             <?php } ?>
          </div>
        </div>
        <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
            <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('USER_PASSWORD').'') ?>
              </span>
            </label>
          </div>
          <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
            <input type="<?php echo O::escapeHtml('password') ?>" name="<?php echo O::escapeHtml('login_password') ?>" size="<?php echo O::escapeHtml('20') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$login_password.'') ?>" class="<?php echo O::escapeHtml('or-name or-input') ?>" /><?php echo O::escapeHtml('') ?>
          </div>
        </div>
        <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
          </div>
          <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
            <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('remember') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$remember){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
            <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('REMEMBER_ME').'') ?>
              </span>
            </label>
          </div>
        </div>
       <?php } ?>
      <fieldset class="<?php echo O::escapeHtml('or-group or-toggle-open-close or--is-closed') ?>"><?php echo O::escapeHtml('') ?>
        <legend class="<?php echo O::escapeHtml('or-act-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('USER_NEW_PASSWORD').'') ?>
          <img /><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-group--on-closed') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-group--on-open') ?>"><?php echo O::escapeHtml('') ?>
          </i>
        </legend>
        <div class="<?php echo O::escapeHtml('or-closable') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('USER_NEW_PASSWORD').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
              <input type="<?php echo O::escapeHtml('password') ?>" name="<?php echo O::escapeHtml('password1') ?>" size="<?php echo O::escapeHtml('25') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$password1.'') ?>" class="<?php echo O::escapeHtml('or- or-input') ?>" /><?php echo O::escapeHtml('') ?>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('USER_NEW_PASSWORD_REPEAT').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
              <input type="<?php echo O::escapeHtml('password') ?>" name="<?php echo O::escapeHtml('password2') ?>" size="<?php echo O::escapeHtml('25') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$password2.'') ?>" class="<?php echo O::escapeHtml('or- or-input') ?>" /><?php echo O::escapeHtml('') ?>
            </div>
          </div>
        </div>
      </fieldset>
      <fieldset class="<?php echo O::escapeHtml('or-group or-toggle-open-close or--is-closed') ?>"><?php echo O::escapeHtml('') ?>
        <legend class="<?php echo O::escapeHtml('or-act-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('USER_TOKEN').'') ?>
          <img /><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-group--on-closed') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-group--on-open') ?>"><?php echo O::escapeHtml('') ?>
          </i>
        </legend>
        <div class="<?php echo O::escapeHtml('or-closable') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('USER_TOKEN').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
              <input name="<?php echo O::escapeHtml('user_token') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('30') ?>" value="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
            </div>
          </div>
        </div>
      </fieldset>
      <?php $if1=(intval(1)<count($dbids)); if($if1) {  ?>
        <fieldset class="<?php echo O::escapeHtml('or-group or-toggle-open-close or--is-open or-show') ?>"><?php echo O::escapeHtml('') ?>
          <legend class="<?php echo O::escapeHtml('or-act-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('DATABASE').'') ?>
            <img src="<?php echo O::escapeHtml('themes/default/images/icon/method/database.svg" />') ?>" /><?php echo O::escapeHtml('') ?>
            <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-group--on-closed') ?>"><?php echo O::escapeHtml('') ?>
            </i>
            <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-group--on-open') ?>"><?php echo O::escapeHtml('') ?>
            </i>
          </legend>
          <div class="<?php echo O::escapeHtml('or-closable') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('DATABASE').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <select name="<?php echo O::escapeHtml('dbid') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                  <?php foreach($dbids as $_key=>$_value) {  ?>
                    <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$dbid){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </fieldset>
       <?php } ?>
      <?php if(!$if1) {  ?>
        <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('dbid') ?>" value="<?php echo O::escapeHtml(''.@$dbid.'') ?>" /><?php echo O::escapeHtml('') ?>
       <?php } ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('objectid') ?>" value="<?php echo O::escapeHtml(''.@$objectid.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('modelid') ?>" value="<?php echo O::escapeHtml(''.@$modelid.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('projectid') ?>" value="<?php echo O::escapeHtml(''.@$projectid.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('languageid') ?>" value="<?php echo O::escapeHtml(''.@$languageid.'') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--primary or-act-form-save') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-ok') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_login').'') ?>
        </span>
      </div>
    </div>
  </form>