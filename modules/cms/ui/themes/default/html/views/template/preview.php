<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('self') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('preview') ?>" data-action="<?php echo escapeHtml('template') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('GET') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('1') ?>" class="<?php echo escapeHtml('or-form template') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('template') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('preview') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
      <div><?php echo escapeHtml('') ?>
        <select name="<?php echo escapeHtml('modelid') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
          <?php foreach($models as $_key=>$_value) {  ?>
            <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$modelid){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
            </option>
           <?php } ?>
        </select>
      </div>
      <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
      </div>
    </form>
    <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
      <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('preview').'') ?>
        <img /><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
        </div>
        <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
        </div>
      </legend>
      <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
        <iframe src="<?php echo escapeHtml(''.@$preview_url.'') ?>"><?php echo escapeHtml('') ?>
        </iframe>
        <a target="<?php echo escapeHtml('_self') ?>" data-action="<?php echo escapeHtml('file') ?>" data-method="<?php echo escapeHtml('edit') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/file/') ?>" class="<?php echo escapeHtml('action') ?>"><?php echo escapeHtml('') ?>
          <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/icon/edit.png') ?>" /><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('menu_file_edit').'') ?>
          </span>
        </a>
        <a target="<?php echo escapeHtml('_self') ?>" data-action="<?php echo escapeHtml('file') ?>" data-method="<?php echo escapeHtml('editvalue') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/file/') ?>" class="<?php echo escapeHtml('action') ?>"><?php echo escapeHtml('') ?>
          <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/icon/editvalue.png') ?>" /><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('menu_file_editvalue').'') ?>
          </span>
        </a>
      </div>
    </fieldset>
 <?php } ?>