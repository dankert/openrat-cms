<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('_top') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('login') ?>" data-action="<?php echo escapeHtml('login') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form login') ?>"><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('login') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('login') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
    <div><?php echo escapeHtml('') ?>
      <?php $if1=(config('security','openid','enable')); if($if1) {  ?>
        <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
          <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('OPENID').'') ?>
            <img /><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('openid_user').'') ?>
                </span>
                <?php $if1=!((config('security','openid','logo_url'))==FALSE); if($if1) {  ?>
                  <img src="<?php echo escapeHtml(''.config('security','openid','logo_url').'') ?>" /><?php echo escapeHtml('') ?>
                 <?php } ?>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <?php foreach( $openid_providers as $_key=>$_value) {  ?>
                  <label><?php echo escapeHtml('') ?>
                    <input type="<?php echo escapeHtml('radio') ?>" name="<?php echo escapeHtml('openid_provider') ?>" value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$openid_provider){ ?>checked="<?php echo escapeHtml('checked') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(''.@$_value.'') ?>
                    </span>
                  </label>
                  <br /><?php echo escapeHtml('') ?>
                 <?php } ?>
                <?php $if1=($openid_user_identity); if($if1) {  ?>
                  <input type="<?php echo escapeHtml('radio') ?>" name="<?php echo escapeHtml('openid_provider') ?>" value="<?php echo escapeHtml('identity') ?>" checked="<?php echo escapeHtml(''.@$openid_provider.'') ?>" /><?php echo escapeHtml('') ?>
                  <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                    <input name="<?php echo escapeHtml('openid_url') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$openid_url.'') ?>" class="<?php echo escapeHtml('name') ?>" /><?php echo escapeHtml('') ?>
                  </div>
                 <?php } ?>
              </div>
            </div>
          </div>
        </fieldset>
        <?php $if1=(intval(1)<count(size:dbids)); if($if1) {  ?>
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
                      <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$actdbid){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                      </option>
                     <?php } ?>
                  </select>
                  <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('screenwidth') ?>" value="<?php echo escapeHtml('9999') ?>" /><?php echo escapeHtml('') ?>
                </div>
              </div>
            </div>
          </fieldset>
         <?php } ?>
        <?php if(!$if1) {  ?>
          <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('dbid') ?>" value="<?php echo escapeHtml(''.@$actdbid.'') ?>" /><?php echo escapeHtml('') ?>
         <?php } ?>
        <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('objectid') ?>" value="<?php echo escapeHtml(''.@$objectid.'') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('modelid') ?>" value="<?php echo escapeHtml(''.@$modelid.'') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('projectid') ?>" value="<?php echo escapeHtml(''.@$projectid.'') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('languageid') ?>" value="<?php echo escapeHtml(''.@$languageid.'') ?>" /><?php echo escapeHtml('') ?>
       <?php } ?>
      <?php if(!$if1) {  ?>
        <div class="<?php echo escapeHtml('message error') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('OPENID_NOT_ENABLED').'') ?>
          </span>
        </div>
       <?php } ?>
    </div>
    <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
    </div>
  </form>