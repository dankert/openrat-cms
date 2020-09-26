<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('self') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('src') ?>" data-action="<?php echo O::escapeHtml('page') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('GET') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-form page') ?>"><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('page') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('src') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
    <div><?php echo O::escapeHtml('') ?>
      <select name="<?php echo O::escapeHtml('languageid') ?>" size="<?php echo O::escapeHtml('1') ?>"><?php echo O::escapeHtml('') ?>
        <?php foreach($languages as $_key=>$_value) {  ?>
          <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$languageid){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
          </option>
         <?php } ?>
      </select>
      <select name="<?php echo O::escapeHtml('modelid') ?>" size="<?php echo O::escapeHtml('1') ?>"><?php echo O::escapeHtml('') ?>
        <?php foreach($models as $_key=>$_value) {  ?>
          <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$modelid){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
          </option>
         <?php } ?>
      </select>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('submit') ?>" value="<?php echo O::escapeHtml(''.@O::lang('button_ok').'') ?>" class="<?php echo O::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
  </form>
  <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
    <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('SOURCE').'') ?>
      <img /><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo O::escapeHtml('') ?>
      </div>
      <div class="<?php echo O::escapeHtml('arrow arrow-down on-open') ?>"><?php echo O::escapeHtml('') ?>
      </div>
    </legend>
    <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
      <textarea name="<?php echo O::escapeHtml('src') ?>" data-extension="<?php echo O::escapeHtml('') ?>" data-mimetype="<?php echo O::escapeHtml('') ?>" data-mode="<?php echo O::escapeHtml('html') ?>" class="<?php echo O::escapeHtml('editor code-editor') ?>"><?php echo O::escapeHtml(''.@$src.'') ?>
      </textarea>
    </div>
  </fieldset>