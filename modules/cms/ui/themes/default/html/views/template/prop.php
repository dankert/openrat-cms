<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('prop') ?>" data-action="<?php echo escapeHtml('template') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form template') ?>"><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('template') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('prop') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
    <div><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('TEMPLATE_NAME').'') ?>
          </span>
        </div>
        <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
            <input name="<?php echo escapeHtml('name') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('50') ?>" value="<?php echo escapeHtml(''.@$name.'') ?>" /><?php echo escapeHtml('') ?>
          </div>
        </div>
      </div>
      <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
        </div>
      </fieldset>
      <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('file_extension').'') ?>
          </span>
        </div>
        <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
          <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('view') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('extension') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@$extension.'') ?>
              </span>
            </div>
          </a>
          <div class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
            <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('view') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('extension') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#//') ?>" class="<?php echo escapeHtml('action') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('edit').'') ?>
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
          <span><?php echo escapeHtml(''.@lang('file_mimetype').'') ?>
          </span>
        </div>
        <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
          <a target="<?php echo escapeHtml('_self') ?>" data-action="<?php echo escapeHtml('template') ?>" data-method="<?php echo escapeHtml('extension') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/template/') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@$mime_type.'') ?>
              </span>
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
    </div>
  </form>