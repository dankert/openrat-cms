<?php /* THIS FILE IS GENERATED from name.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('name') ?>" data-action="<?php echo O::escapeHtml('page') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-page') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?></div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('page') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('name') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('languageid') ?>" value="<?php echo O::escapeHtml(''.@$languageid.'') ?>" /><?php echo O::escapeHtml('') ?>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
          <span><?php echo O::escapeHtml(''.@O::lang('name').'') ?></span>
        </h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('name').'') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <input name="<?php echo O::escapeHtml('name') ?>" required="<?php echo O::escapeHtml('required') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('255') ?>" value="<?php echo O::escapeHtml(''.@$name.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('description').'') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <textarea name="<?php echo O::escapeHtml('description') ?>" maxlength="<?php echo O::escapeHtml('255') ?>" class="<?php echo O::escapeHtml('or-input or-description') ?>"><?php echo O::escapeHtml(''.@$description.'') ?></textarea>
            </div>
          </section>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
          <span><?php echo O::escapeHtml(''.@O::lang('alias').'') ?></span>
        </h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('alias').'') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <input name="<?php echo O::escapeHtml('alias_filename') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('150') ?>" value="<?php echo O::escapeHtml(''.@$alias_filename.'') ?>" class="<?php echo O::escapeHtml('or-filename or-input') ?>" /><?php echo O::escapeHtml('') ?>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('folder').'') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <select name="<?php echo O::escapeHtml('alias_folderid') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                <?php foreach($folders as $_key=>$_value) {  ?>
                  <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$alias_folderid){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?></option>
                 <?php } ?>
              </select>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('leave_link').'') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <label><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('checkbox') ?>" data-name="<?php echo O::escapeHtml('leave_link') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$leave_link){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('leave_link') ?>" <?php if(@$leave_link){ ?>value="<?php echo O::escapeHtml('1') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('leave_link').'') ?></span>
              </label>
            </div>
          </section>
        </div>
      </section>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--control or-btn--secondary or-act-form-cancel') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-cancel') ?>"><?php echo O::escapeHtml('') ?></i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?></span>
      </div>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--control or-btn--primary or-act-form-save') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-ok') ?>"><?php echo O::escapeHtml('') ?></i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('save').'') ?></span>
      </div>
    </div>
  </form>