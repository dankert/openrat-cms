<?php defined('APP_STARTED') || die('Forbidden'); ?>
  <form name="<?php echo \template_engine\Output::escapeHtml('') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-target="<?php echo \template_engine\Output::escapeHtml('self') ?>" action="<?php echo \template_engine\Output::escapeHtml('./') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('preview') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('page') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" method="<?php echo \template_engine\Output::escapeHtml('GET') ?>" enctype="<?php echo \template_engine\Output::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo \template_engine\Output::escapeHtml('') ?>" data-autosave="<?php echo \template_engine\Output::escapeHtml('1') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form page') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('token') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_token.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('action') ?>" value="<?php echo \template_engine\Output::escapeHtml('page') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('subaction') ?>" value="<?php echo \template_engine\Output::escapeHtml('preview') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('id') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <div><?php echo \template_engine\Output::escapeHtml('') ?>
      <select name="<?php echo \template_engine\Output::escapeHtml('languageid') ?>" size="<?php echo \template_engine\Output::escapeHtml('1') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <?php foreach($languages as $_key=>$_value) {  ?>
          <option value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$languageid){ ?>selected="<?php echo \template_engine\Output::escapeHtml('selected') ?>"<?php } ?>><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
          </option>
         <?php } ?>
      </select>
      <select name="<?php echo \template_engine\Output::escapeHtml('modelid') ?>" size="<?php echo \template_engine\Output::escapeHtml('1') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <?php foreach($models as $_key=>$_value) {  ?>
          <option value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$modelid){ ?>selected="<?php echo \template_engine\Output::escapeHtml('selected') ?>"<?php } ?>><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
          </option>
         <?php } ?>
      </select>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-form-actionbar') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('submit') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('button_ok').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
  </form>
  <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('PREVIEW').'') ?>
      <img /><?php echo \template_engine\Output::escapeHtml('') ?>
      <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      </div>
      <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      </div>
    </legend>
    <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <div class="<?php echo \template_engine\Output::escapeHtml('toolbar-icon clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-url="<?php echo \template_engine\Output::escapeHtml(''.@$preview_url.'') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('popup') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>" class="<?php echo \template_engine\Output::escapeHtml('action') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--menu-open_in_new') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </i>
          <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('link_open_in_new_window').'') ?>
          </span>
        </a>
      </div>
      <iframe name="<?php echo \template_engine\Output::escapeHtml('preview') ?>" src="<?php echo \template_engine\Output::escapeHtml(''.@$preview_url.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      </iframe>
    </div>
  </fieldset>