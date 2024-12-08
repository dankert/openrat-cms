<?php /* THIS FILE IS GENERATED from show.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <span class="<?php echo O::escapeHtml('or-name') ?>"><?php echo O::escapeHtml(''.@$fullname.'') ?></span>
  <span class="<?php echo O::escapeHtml('or-addition') ?>"><?php echo O::escapeHtml(''.@$desc.'') ?></span>
  <div class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
    <a data-after-success="<?php echo O::escapeHtml('reloadAll') ?>" title="<?php echo O::escapeHtml(''.@O::lang('USER_LOGOUT_DESC').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('post') ?>" data-action="<?php echo O::escapeHtml('login') ?>" data-method="<?php echo O::escapeHtml('logout') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" data-data="<?php echo O::escapeHtml('{"action":"login","subaction":"logout","id":"","token":"'.@$_token.'","none":0}') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-logout') ?>"><?php echo O::escapeHtml('') ?></i>
      <span class="<?php echo O::escapeHtml('or-dropdown-text') ?>"><?php echo O::escapeHtml(''.@O::lang('USER_LOGOUT').'') ?></span>
    </a>
  </div>
  <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
    <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--empty') ?>"><?php echo O::escapeHtml('') ?></i>
      <span><?php echo O::escapeHtml(''.@O::lang('MENU_PROFILE_MAIL').'') ?></span>
    </h2>
    <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
      <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
        <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_mail').'') ?></h3>
        <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@$mail.'') ?></span>
          <div class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
            <a target="<?php echo O::escapeHtml('_self') ?>" data-name="<?php echo O::escapeHtml(''.@O::lang('user_mail').'') ?>" name="<?php echo O::escapeHtml(''.@O::lang('user_mail').'') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('profile') ?>" data-method="<?php echo O::escapeHtml('mail') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/profile') ?>" class="<?php echo O::escapeHtml('or-link or-btn') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('edit').'') ?></span>
            </a>
          </div>
        </div>
      </section>
    </div>
  </section>
  <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
    <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--empty') ?>"><?php echo O::escapeHtml('') ?></i>
      <span><?php echo O::escapeHtml(''.@O::lang('USER_STYLE').'') ?></span>
    </h2>
    <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
      <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
        <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('USER_STYLE').'') ?></h3>
        <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@$style.'') ?></span>
          <div class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
            <a target="<?php echo O::escapeHtml('_self') ?>" data-name="<?php echo O::escapeHtml(''.@O::lang('user_style').'') ?>" name="<?php echo O::escapeHtml(''.@O::lang('user_style').'') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('profile') ?>" data-method="<?php echo O::escapeHtml('theme') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/profile') ?>" class="<?php echo O::escapeHtml('or-link or-btn') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('edit').'') ?></span>
            </a>
          </div>
        </div>
      </section>
    </div>
  </section>
  <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible') ?>"><?php echo O::escapeHtml('') ?>
    <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--empty') ?>"><?php echo O::escapeHtml('') ?></i>
      <span><?php echo O::escapeHtml(''.@O::lang('PROP').'') ?></span>
    </h2>
    <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
      <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
        <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_name').'') ?></h3>
        <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@$name.'') ?></span>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
        <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_tel').'') ?></h3>
        <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@$tel.'') ?></span>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
        <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('user_desc').'') ?></h3>
        <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@$desc.'') ?></span>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
        <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('timezone').'') ?></h3>
        <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@$timezone.'') ?></span>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
        <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('language').'') ?></h3>
        <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@$language.'') ?></span>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
        <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('USER_LOGIN_DATE').'') ?></h3>
        <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
          <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($loginDate); ?>
           <?php } ?>
        </div>
      </section>
      <div class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
        <a target="<?php echo O::escapeHtml('_self') ?>" data-name="<?php echo O::escapeHtml(''.@O::lang('profile').'') ?>" name="<?php echo O::escapeHtml(''.@O::lang('profile').'') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('profile') ?>" data-method="<?php echo O::escapeHtml('edit') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/profile') ?>" class="<?php echo O::escapeHtml('or-link or-btn') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('edit').'') ?></span>
        </a>
      </div>
    </div>
  </section>