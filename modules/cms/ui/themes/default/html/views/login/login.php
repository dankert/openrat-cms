<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('login') ?>" data-action="<?php echo escapeHtml('login') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" data-after-success="<?php echo escapeHtml('reloadAll') ?>" class="<?php echo escapeHtml('or-form login') ?>"><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('login') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('login') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
    <div><?php echo escapeHtml('') ?>
      <?php $if1=(config('login','logo','enabled')); if($if1) {  ?>
        <?php $if1=!((config('login','logo','url'))==FALSE); if($if1) {  ?>
          <a target="<?php echo escapeHtml('_self') ?>" data-url="<?php echo escapeHtml(''.config('login','logo','url').'') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
            <img src="<?php echo escapeHtml(''.config('login','logo','image').'') ?>" /><?php echo escapeHtml('') ?>
          </a>
         <?php } ?>
        <?php if(!$if1) {  ?>
          <img src="<?php echo escapeHtml(''.config('login','logo','image').'') ?>" /><?php echo escapeHtml('') ?>
         <?php } ?>
       <?php } ?>
      <?php $if1=!((config('login','motd'))==FALSE); if($if1) {  ?>
        <div class="<?php echo escapeHtml('message info') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.config('login','motd').'') ?>
          </span>
        </div>
       <?php } ?>
      <?php $if1=(config('login','nologin')); if($if1) {  ?>
        <div class="<?php echo escapeHtml('message error') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('LOGIN_NOLOGIN_DESC').'') ?>
          </span>
        </div>
       <?php } ?>
      <?php $if1=(config('security','readonly')); if($if1) {  ?>
        <div class="<?php echo escapeHtml('message warn') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('READONLY_DESC').'') ?>
          </span>
        </div>
       <?php } ?>
      <?php $if1=(!config('login','nologin')); if($if1) {  ?>
        <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('USER_USERNAME').'') ?>
              </span>
            </label>
          </div>
          <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
            <?php $if1=!(isset($force_username)); if($if1) {  ?>
              <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                <input name="<?php echo escapeHtml('login_name') ?>" required="<?php echo escapeHtml('required') ?>" placeholder="<?php echo escapeHtml(''.@lang('USER_USERNAME').'') ?>" autofocus="<?php echo escapeHtml('autofocus') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('128') ?>" value="<?php echo escapeHtml(''.@$login_name.'') ?>" class="<?php echo escapeHtml('name') ?>" /><?php echo escapeHtml('') ?>
              </div>
             <?php } ?>
            <?php if(!$if1) {  ?>
              <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('login_name') ?>" value="<?php echo escapeHtml(''.@$login_name.'') ?>" /><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@$force_username.'') ?>
              </span>
             <?php } ?>
          </div>
        </div>
        <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('USER_PASSWORD').'') ?>
              </span>
            </label>
          </div>
          <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
              <input type="<?php echo escapeHtml('password') ?>" name="<?php echo escapeHtml('login_password') ?>" size="<?php echo escapeHtml('20') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$login_password.'') ?>" class="<?php echo escapeHtml('name') ?>" /><?php echo escapeHtml('') ?>
            </div>
          </div>
        </div>
        <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
          </div>
          <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
            <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('remember') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$remember){ ?>checked="<?php echo escapeHtml('checked') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
            <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('REMEMBER_ME').'') ?>
              </span>
            </label>
          </div>
        </div>
       <?php } ?>
      <fieldset class="<?php echo escapeHtml('or-group toggle-open-close closed') ?>"><?php echo escapeHtml('') ?>
        <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('USER_NEW_PASSWORD').'') ?>
          <img /><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
          </div>
          <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('USER_NEW_PASSWORD').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                <input type="<?php echo escapeHtml('password') ?>" name="<?php echo escapeHtml('password1') ?>" size="<?php echo escapeHtml('25') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$password1.'') ?>" class="<?php echo escapeHtml('') ?>" /><?php echo escapeHtml('') ?>
              </div>
            </div>
          </div>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('USER_NEW_PASSWORD_REPEAT').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                <input type="<?php echo escapeHtml('password') ?>" name="<?php echo escapeHtml('password2') ?>" size="<?php echo escapeHtml('25') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$password2.'') ?>" class="<?php echo escapeHtml('') ?>" /><?php echo escapeHtml('') ?>
              </div>
            </div>
          </div>
        </div>
      </fieldset>
      <fieldset class="<?php echo escapeHtml('or-group toggle-open-close closed') ?>"><?php echo escapeHtml('') ?>
        <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('USER_TOKEN').'') ?>
          <img /><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
          </div>
          <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('USER_TOKEN').'') ?>
                </span>
              </label>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                <input name="<?php echo escapeHtml('user_token') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('30') ?>" value="<?php echo escapeHtml('') ?>" /><?php echo escapeHtml('') ?>
              </div>
            </div>
          </div>
        </div>
      </fieldset>
      <?php $if1=(intval(1)<count($dbids)); if($if1) {  ?>
        <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
          <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('DATABASE').'') ?>
            <img src="<?php echo escapeHtml('themes/default/images/icon/method/database.svg" />') ?>" /><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('DATABASE').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <select name="<?php echo escapeHtml('dbid') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
                  <?php foreach($dbids as $_key=>$_value) {  ?>
                    <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$dbid){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </fieldset>
       <?php } ?>
      <?php if(!$if1) {  ?>
        <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('dbid') ?>" value="<?php echo escapeHtml(''.@$dbid.'') ?>" /><?php echo escapeHtml('') ?>
       <?php } ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('objectid') ?>" value="<?php echo escapeHtml(''.@$objectid.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('modelid') ?>" value="<?php echo escapeHtml(''.@$modelid.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('projectid') ?>" value="<?php echo escapeHtml(''.@$projectid.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('languageid') ?>" value="<?php echo escapeHtml(''.@$languageid.'') ?>" /><?php echo escapeHtml('') ?>
    </div>
    <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('menu_login').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
    </div>
  </form>