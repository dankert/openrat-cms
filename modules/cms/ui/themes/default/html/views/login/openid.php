<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo \template_engine\Output::escapeHtml('') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-target="<?php echo \template_engine\Output::escapeHtml('_top') ?>" action="<?php echo \template_engine\Output::escapeHtml('./') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('login') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('login') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" method="<?php echo \template_engine\Output::escapeHtml('POST') ?>" enctype="<?php echo \template_engine\Output::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo \template_engine\Output::escapeHtml('') ?>" data-autosave="<?php echo \template_engine\Output::escapeHtml('') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form login') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('token') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_token.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('action') ?>" value="<?php echo \template_engine\Output::escapeHtml('login') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('subaction') ?>" value="<?php echo \template_engine\Output::escapeHtml('login') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('id') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <div><?php echo \template_engine\Output::escapeHtml('') ?>
      <?php $if1=(config('security','openid','enable')); if($if1) {  ?>
        <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('OPENID').'') ?>
            <img /><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('openid_user').'') ?>
                </span>
                <?php $if1=!((config('security','openid','logo_url'))==FALSE); if($if1) {  ?>
                  <img src="<?php echo \template_engine\Output::escapeHtml(''.config('security','openid','logo_url').'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                 <?php } ?>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php foreach( $openid_providers as $_key=>$_value) {  ?>
                  <label><?php echo \template_engine\Output::escapeHtml('') ?>
                    <input type="<?php echo \template_engine\Output::escapeHtml('radio') ?>" name="<?php echo \template_engine\Output::escapeHtml('openid_provider') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$openid_provider){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                    <span><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
                    </span>
                  </label>
                  <br /><?php echo \template_engine\Output::escapeHtml('') ?>
                 <?php } ?>
                <?php $if1=($openid_user_identity); if($if1) {  ?>
                  <input type="<?php echo \template_engine\Output::escapeHtml('radio') ?>" name="<?php echo \template_engine\Output::escapeHtml('openid_provider') ?>" value="<?php echo \template_engine\Output::escapeHtml('identity') ?>" <?php if(@$openid_provider=='identity'){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                  <div class="<?php echo \template_engine\Output::escapeHtml('inputholder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    <input name="<?php echo \template_engine\Output::escapeHtml('openid_url') ?>" type="<?php echo \template_engine\Output::escapeHtml('text') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('256') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$openid_url.'') ?>" class="<?php echo \template_engine\Output::escapeHtml('name') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                  </div>
                 <?php } ?>
              </div>
            </div>
          </div>
        </fieldset>
        <?php $if1=(intval(1)<count(size:dbids)); if($if1) {  ?>
          <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('DATABASE').'') ?>
              <img src="<?php echo \template_engine\Output::escapeHtml('themes/default/images/icon/method/database.svg" />') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
            </legend>
            <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('DATABASE').'') ?>
                    </span>
                  </label>
                </div>
                <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <select name="<?php echo \template_engine\Output::escapeHtml('dbid') ?>" size="<?php echo \template_engine\Output::escapeHtml('1') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    <?php foreach($dbids as $_key=>$_value) {  ?>
                      <option value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$actdbid){ ?>selected="<?php echo \template_engine\Output::escapeHtml('selected') ?>"<?php } ?>><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
                      </option>
                     <?php } ?>
                  </select>
                  <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('screenwidth') ?>" value="<?php echo \template_engine\Output::escapeHtml('9999') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                </div>
              </div>
            </div>
          </fieldset>
         <?php } ?>
        <?php if(!$if1) {  ?>
          <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('dbid') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$actdbid.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
         <?php } ?>
        <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('objectid') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$objectid.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
        <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('modelid') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$modelid.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
        <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('projectid') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$projectid.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
        <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('languageid') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$languageid.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
       <?php } ?>
      <?php if(!$if1) {  ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('message error') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('OPENID_NOT_ENABLED').'') ?>
          </span>
        </div>
       <?php } ?>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-form-actionbar') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('button') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('CANCEL').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('submit') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('button_ok').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
  </form>