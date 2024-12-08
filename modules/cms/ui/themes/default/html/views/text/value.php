<?php /* THIS FILE IS GENERATED from value.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('value') ?>" data-action="<?php echo O::escapeHtml('text') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-text') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?></div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('text') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('value') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--empty') ?>"><?php echo O::escapeHtml('') ?></i>
          <span><?php echo O::escapeHtml(''.@O::lang('edit').'') ?></span>
        </h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml(''.@O::lang('VALUE').'') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div><?php echo O::escapeHtml('') ?>
                <textarea name="<?php echo O::escapeHtml('text') ?>" data-extension="<?php echo O::escapeHtml(''.@$extension.'') ?>" data-mimetype="<?php echo O::escapeHtml(''.@$mimetype.'') ?>" data-mode="<?php echo O::escapeHtml('htmlmixed') ?>" class="<?php echo O::escapeHtml('or-input or-editor or-code-editor') ?>"><?php echo O::escapeHtml(''.@$text.'') ?></textarea>
                <trix-editor input="<?php echo O::escapeHtml('text') ?>"><?php echo O::escapeHtml('') ?></trix-editor>
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
          <span><?php echo O::escapeHtml(''.@O::lang('options').'') ?></span>
        </h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?></h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
                <label><?php echo O::escapeHtml('') ?>
                  <input type="<?php echo O::escapeHtml('checkbox') ?>" data-name="<?php echo O::escapeHtml('release') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$release){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox or-remember') ?>" /><?php echo O::escapeHtml('') ?>
                  <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('release') ?>" <?php if(@$release){ ?>value="<?php echo O::escapeHtml('1') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                  <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@O::lang('RELEASE').'') ?></span>
                </label>
              </div>
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
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('button_ok').'') ?></span>
      </div>
    </div>
  </form>