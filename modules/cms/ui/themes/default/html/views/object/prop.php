<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('prop') ?>" data-action="<?php echo escapeHtml('object') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form object') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('object') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('prop') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
      <div><?php echo escapeHtml('') ?>
        <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
          <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('global_prop').'') ?>
            <img /><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
            <label class="<?php echo escapeHtml('or-form-row or-form-input') ?>"><?php echo escapeHtml('') ?>
              <span class="<?php echo escapeHtml('or-form-label') ?>"><?php echo escapeHtml('global_filename') ?>
              </span>
              <input name="<?php echo escapeHtml('filename') ?>" autofocus="<?php echo escapeHtml('autofocus') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('150') ?>" value="<?php echo escapeHtml(''.@$filename.'') ?>" class="<?php echo escapeHtml('filename') ?>" /><?php echo escapeHtml('') ?>
            </label>
            <label class="<?php echo escapeHtml('or-form-row or-form-input') ?>"><?php echo escapeHtml('') ?>
              <span class="<?php echo escapeHtml('or-form-label') ?>"><?php echo escapeHtml('alias') ?>
              </span>
              <input name="<?php echo escapeHtml('alias_filename') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('150') ?>" value="<?php echo escapeHtml(''.@$alias_filename.'') ?>" class="<?php echo escapeHtml('filename') ?>" /><?php echo escapeHtml('') ?>
            </label>
            <label class="<?php echo escapeHtml('or-form-row or-form-input') ?>"><?php echo escapeHtml('') ?>
              <span class="<?php echo escapeHtml('or-form-label') ?>"><?php echo escapeHtml('folder') ?>
              </span>
              <select name="<?php echo escapeHtml('alias_folderid') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
                <?php foreach($folders as $_key=>$_value) {  ?>
                  <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$alias_folderid){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                  </option>
                 <?php } ?>
              </select>
            </label>
          </div>
        </fieldset>
      </div>
      <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('global_save').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
      </div>
    </form>
 <?php } ?>