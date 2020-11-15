<?php /* THIS FILE IS GENERATED from login.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('login') ?>" data-action="<?php echo O::escapeHtml('login') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" data-after-success="<?php echo O::escapeHtml('reloadAll') ?>" class="<?php echo O::escapeHtml('or-form or-login') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?></div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('login') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('login') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <?php $if3=(O::config(['login','logo','enabled'])); if($if3) {  ?>
        <?php $if4=!((O::config(['login','logo','url']))==FALSE); if($if4) {  ?>
          <a target="<?php echo O::escapeHtml('_self') ?>" data-url="<?php echo O::escapeHtml(''.O::config(['login','logo','url']).'') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
            <img src="<?php echo O::escapeHtml(''.O::config(['login','logo','image']).'') ?>" /><?php echo O::escapeHtml('') ?>
          </a>
         <?php } ?>
        <?php if(!$if4) {  ?>
          <img src="<?php echo O::escapeHtml(''.O::config(['login','logo','image']).'') ?>" /><?php echo O::escapeHtml('') ?>
         <?php } ?>
       <?php } ?>
      <?php $if3=!((O::config(['login','motd']))==FALSE); if($if3) {  ?>
        <div class="<?php echo O::escapeHtml('or-message info') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.O::config(['login','motd']).'') ?></span>
        </div>
       <?php } ?>
      <?php $if3=(O::config(['security','readonly'])); if($if3) {  ?>
        <div class="<?php echo O::escapeHtml('or-message warn') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('READONLY_DESC').'') ?></span>
        </div>
       <?php } ?>
      <?php $if3=(!O::config(['login','nologin'])); if($if3) {  ?>
        <?php $if4=($enableOpenIdConnect); if($if4) {  ?>
          <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
            <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
              <span><?php echo O::escapeHtml(''.@O::lang('login').'') ?></span>
            </h2>
            <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
              <?php foreach((array)$provider as $name=>$label) {  ?>
                <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('window') ?>" data-action="<?php echo O::escapeHtml('login') ?>" data-method="<?php echo O::escapeHtml('oidc') ?>" data-id="<?php echo O::escapeHtml(''.@$name.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/login/'.@$name.'') ?>" class="<?php echo O::escapeHtml('or-link or-btn or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@$label.'') ?></span>
                </a>
               <?php } ?>
            </div>
          </section>
         <?php } ?>
        <?php $if4=($enableUserPasswordLogin); if($if4) {  ?>
          <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
            <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
              <span><?php echo O::escapeHtml(''.@O::lang('USER_USERNAME').'') ?></span>
            </h2>
            <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
              <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('USER_USERNAME').'') ?></h3>
                <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                  <?php $if7=!(isset($force_username)); if($if7) {  ?>
                    <input name="<?php echo O::escapeHtml('login_name') ?>" required="<?php echo O::escapeHtml('required') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('USER_USERNAME').'') ?>" autofocus="<?php echo O::escapeHtml('autofocus') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('128') ?>" value="<?php echo O::escapeHtml(''.@$login_name.'') ?>" class="<?php echo O::escapeHtml('or-name or-input') ?>" /><?php echo O::escapeHtml('') ?>
                   <?php } ?>
                  <?php if(!$if7) {  ?>
                    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('login_name') ?>" value="<?php echo O::escapeHtml(''.@$login_name.'') ?>" /><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@$force_username.'') ?></span>
                   <?php } ?>
                </div>
              </section>
              <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('USER_PASSWORD').'') ?></h3>
                <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                  <input type="<?php echo O::escapeHtml('password') ?>" name="<?php echo O::escapeHtml('login_password') ?>" size="<?php echo O::escapeHtml('20') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" required="<?php echo O::escapeHtml('required') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('USER_PASSWORD').'') ?>" value="<?php echo O::escapeHtml(''.@$login_password.'') ?>" class="<?php echo O::escapeHtml('or-name or-input') ?>" /><?php echo O::escapeHtml('') ?>
                  <label><?php echo O::escapeHtml('') ?>
                    <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('remember') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$remember){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
                    <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('REMEMBER_ME').'') ?></span>
                  </label>
                </div>
              </section>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-closed') ?>"><?php echo O::escapeHtml('') ?>
            <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
              <span><?php echo O::escapeHtml(''.@O::lang('USER_NEW_PASSWORD').'') ?></span>
            </h2>
            <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
              <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('USER_NEW_PASSWORD').'') ?></h3>
                <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                  <input type="<?php echo O::escapeHtml('password') ?>" name="<?php echo O::escapeHtml('password1') ?>" size="<?php echo O::escapeHtml('25') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('USER_NEW_PASSWORD').'') ?>" minlength="<?php echo O::escapeHtml(''.O::config(['security','password','min_length']).'') ?>" value="<?php echo O::escapeHtml(''.@$password1.'') ?>" class="<?php echo O::escapeHtml('or- or-input') ?>" /><?php echo O::escapeHtml('') ?>
                  <input type="<?php echo O::escapeHtml('password') ?>" name="<?php echo O::escapeHtml('password2') ?>" size="<?php echo O::escapeHtml('25') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('USER_NEW_PASSWORD_REPEAT').'') ?>" minlength="<?php echo O::escapeHtml(''.O::config(['security','password','min_length']).'') ?>" value="<?php echo O::escapeHtml(''.@$password2.'') ?>" class="<?php echo O::escapeHtml('or- or-input') ?>" /><?php echo O::escapeHtml('') ?>
                </div>
              </section>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-closed') ?>"><?php echo O::escapeHtml('') ?>
            <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
              <span><?php echo O::escapeHtml(''.@O::lang('USER_TOKEN').'') ?></span>
            </h2>
            <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
              <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('USER_TOKEN').'') ?></h3>
                <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                  <input name="<?php echo O::escapeHtml('user_token') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('30') ?>" value="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                </div>
              </section>
            </div>
          </section>
          <?php $if5=(intval(1)<count($dbids)); if($if5) {  ?>
            <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
              <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--database') ?>"><?php echo O::escapeHtml('') ?></i>
                <span><?php echo O::escapeHtml(''.@O::lang('DATABASE').'') ?></span>
              </h2>
              <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
                <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                  <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('DATABASE').'') ?></h3>
                  <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                    <select name="<?php echo O::escapeHtml('dbid') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                      <?php foreach($dbids as $_key=>$_value) {  ?>
                        <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$dbid){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?></option>
                       <?php } ?>
                    </select>
                  </div>
                </section>
              </div>
            </section>
           <?php } ?>
          <?php if(!$if5) {  ?>
            <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('dbid') ?>" value="<?php echo O::escapeHtml(''.@$dbid.'') ?>" /><?php echo O::escapeHtml('') ?>
           <?php } ?>
         <?php } ?>
       <?php } ?>
      <?php if(!$if3) {  ?>
        <div class="<?php echo O::escapeHtml('or-message error') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('LOGIN_NOLOGIN_DESC').'') ?></span>
        </div>
       <?php } ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--primary or-act-form-save') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-ok') ?>"><?php echo O::escapeHtml('') ?></i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_login').'') ?></span>
      </div>
    </div>
  </form>