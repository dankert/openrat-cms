<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('info') ?>" data-action="<?php echo escapeHtml('language') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form language') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('language') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('info') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
      <div><?php echo escapeHtml('') ?>
        <span class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml(''.@$name.'') ?>
        </span>
        <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('GLOBAL_NAME').'') ?>
            </span>
          </div>
          <div class="<?php echo escapeHtml('input clickable') ?>"><?php echo escapeHtml('') ?>
            <span class="<?php echo escapeHtml('name') ?>"><?php echo escapeHtml(''.@$name.'') ?>
            </span>
          </div>
        </div>
        <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('LANGUAGE_ISOCODE').'') ?>
            </span>
          </div>
          <div class="<?php echo escapeHtml('input clickable') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@$isocode.'') ?>
            </span>
          </div>
        </div>
        <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
          </div>
          <div class="<?php echo escapeHtml('input clickable') ?>"><?php echo escapeHtml('') ?>
            <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('edit') ?>" data-action="<?php echo escapeHtml('language') ?>" data-method="<?php echo escapeHtml('prop') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/language/') ?>" class="<?php echo escapeHtml('or-link-btn') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('edit').'') ?>
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
      </div>
    </form>
 <?php } ?>