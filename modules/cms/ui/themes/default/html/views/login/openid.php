<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('_top') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('login') ?>" data-action="<?php echo O::escapeHtml('login') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-login') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('login') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('login') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <?php $if1=(O::config('security','openid','enable')); if($if1) {  ?>
        <fieldset class="<?php echo O::escapeHtml('or-group or-toggle-open-close or--is-open or-show') ?>"><?php echo O::escapeHtml('') ?>
          <legend class="<?php echo O::escapeHtml('or-act-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('OPENID').'') ?>
            <img /><?php echo O::escapeHtml('') ?>
            <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-group--on-closed') ?>"><?php echo O::escapeHtml('') ?>
            </i>
            <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-group--on-open') ?>"><?php echo O::escapeHtml('') ?>
            </i>
          </legend>
          <div class="<?php echo O::escapeHtml('or-closable') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('openid_user').'') ?>
                </span>
                <?php $if1=!((O::config('security','openid','logo_url'))==FALSE); if($if1) {  ?>
                  <img src="<?php echo O::escapeHtml(''.O::config('security','openid','logo_url').'') ?>" /><?php echo O::escapeHtml('') ?>
                 <?php } ?>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <?php foreach( $openid_providers as $_key=>$_value) {  ?>
                  <label><?php echo O::escapeHtml('') ?>
                    <input type="<?php echo O::escapeHtml('radio') ?>" name="<?php echo O::escapeHtml('openid_provider') ?>" value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$openid_provider){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@$_value.'') ?>
                    </span>
                  </label>
                  <br /><?php echo O::escapeHtml('') ?>
                 <?php } ?>
                <?php $if1=($openid_user_identity); if($if1) {  ?>
                  <input type="<?php echo O::escapeHtml('radio') ?>" name="<?php echo O::escapeHtml('openid_provider') ?>" value="<?php echo O::escapeHtml('identity') ?>" <?php if(@$openid_provider=='identity'){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                  <input name="<?php echo O::escapeHtml('openid_url') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$openid_url.'') ?>" class="<?php echo O::escapeHtml('or-name or-input') ?>" /><?php echo O::escapeHtml('') ?>
                 <?php } ?>
              </div>
            </div>
          </div>
        </fieldset>
        <?php $if1=(intval(1)<count(size:dbids)); if($if1) {  ?>
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
                      <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$actdbid){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
                      </option>
                     <?php } ?>
                  </select>
                  <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('screenwidth') ?>" value="<?php echo O::escapeHtml('9999') ?>" /><?php echo O::escapeHtml('') ?>
                </div>
              </div>
            </div>
          </fieldset>
         <?php } ?>
        <?php if(!$if1) {  ?>
          <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('dbid') ?>" value="<?php echo O::escapeHtml(''.@$actdbid.'') ?>" /><?php echo O::escapeHtml('') ?>
         <?php } ?>
        <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('objectid') ?>" value="<?php echo O::escapeHtml(''.@$objectid.'') ?>" /><?php echo O::escapeHtml('') ?>
        <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('modelid') ?>" value="<?php echo O::escapeHtml(''.@$modelid.'') ?>" /><?php echo O::escapeHtml('') ?>
        <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('projectid') ?>" value="<?php echo O::escapeHtml(''.@$projectid.'') ?>" /><?php echo O::escapeHtml('') ?>
        <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('languageid') ?>" value="<?php echo O::escapeHtml(''.@$languageid.'') ?>" /><?php echo O::escapeHtml('') ?>
       <?php } ?>
      <?php if(!$if1) {  ?>
        <div class="<?php echo O::escapeHtml('or-message error') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('OPENID_NOT_ENABLED').'') ?>
          </span>
        </div>
       <?php } ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--secondary or-act-form-cancel') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-cancel') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?>
        </span>
      </div>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--primary or-act-form-save') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-ok') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('button_ok').'') ?>
        </span>
      </div>
    </div>
  </form>