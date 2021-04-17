<?php /* THIS FILE IS GENERATED from preview.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('self') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('preview') ?>" data-action="<?php echo O::escapeHtml('template') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('GET') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-form or-template') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?></div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('template') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('preview') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <select name="<?php echo O::escapeHtml('modelid') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
        <?php foreach($models as $_key=>$_value) {  ?>
          <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$modelid){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?></option>
         <?php } ?>
      </select>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--control or-btn--primary or-act-form-save') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-ok') ?>"><?php echo O::escapeHtml('') ?></i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('button_ok').'') ?></span>
      </div>
    </div>
  </form>
  <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
    <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
      <span><?php echo O::escapeHtml(''.@O::lang('preview').'') ?></span>
    </h2>
    <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
      <iframe src="<?php echo O::escapeHtml(''.@$preview_url.'') ?>"><?php echo O::escapeHtml('') ?></iframe>
      <a target="<?php echo O::escapeHtml('_self') ?>" data-action="<?php echo O::escapeHtml('file') ?>" data-method="<?php echo O::escapeHtml('edit') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/file') ?>" class="<?php echo O::escapeHtml('or-link or-action') ?>"><?php echo O::escapeHtml('') ?>
        <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon/icon/edit.png') ?>" /><?php echo O::escapeHtml('') ?>
        <span><?php echo O::escapeHtml(''.@O::lang('menu_file_edit').'') ?></span>
      </a>
      <a target="<?php echo O::escapeHtml('_self') ?>" data-action="<?php echo O::escapeHtml('file') ?>" data-method="<?php echo O::escapeHtml('editvalue') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/file') ?>" class="<?php echo O::escapeHtml('or-link or-action') ?>"><?php echo O::escapeHtml('') ?>
        <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon/icon/editvalue.png') ?>" /><?php echo O::escapeHtml('') ?>
        <span><?php echo O::escapeHtml(''.@O::lang('menu_file_editvalue').'') ?></span>
      </a>
    </div>
  </section>