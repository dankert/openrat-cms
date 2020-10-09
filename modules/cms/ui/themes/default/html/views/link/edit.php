<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('edit') ?>" data-action="<?php echo O::escapeHtml('link') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-link') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('link') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('edit') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <fieldset class="<?php echo O::escapeHtml('or-group or-toggle-open-close or--is-open or-show') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-closable') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('link_target').'') ?>
              </span>
            </div>
            <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-selector') ?>"><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('targetobjectid') ?>" value="<?php echo O::escapeHtml(''.@$targetobjectid.'') ?>" class="<?php echo O::escapeHtml('or-selector-link-value') ?>" /><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('text') ?>" name="<?php echo O::escapeHtml('targetobjectid_text') ?>" placeholder="<?php echo O::escapeHtml(''.@$targetobjectname.'') ?>" value="<?php echo O::escapeHtml(''.@$targetobjectname.'') ?>" class="<?php echo O::escapeHtml('or-selector-link-name') ?>" /><?php echo O::escapeHtml('') ?>
                <div class="<?php echo O::escapeHtml('or-dropdown or-act-selector-search-results') ?>"><?php echo O::escapeHtml('') ?>
                </div>
                <div type="<?php echo O::escapeHtml('hidden') ?>" data-types="<?php echo O::escapeHtml('page,file') ?>" data-init-id="<?php echo O::escapeHtml(''.@$targetobjectid.'') ?>" data-init-folderid="<?php echo O::escapeHtml('parentid') ?>" class="<?php echo O::escapeHtml('or-navtree or-act-load-selector-tree') ?>"><?php echo O::escapeHtml('') ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </fieldset>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--secondary or-act-form-cancel') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-cancel') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?>
        </span>
      </div>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--primary or-act-form-save') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-ok') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('button_ok').'') ?>
        </span>
      </div>
    </div>
  </form>