<?php if (defined('OR_TITLE')) {  ?>
  
    
    <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('inherit') ?>" data-action="<?php echo escapeHtml('folder') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form folder') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('folder') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('inherit') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
      <div><?php echo escapeHtml('') ?>
        <?php $if1=($type==folder); if($if1) {  ?>
          <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
            <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('options').'') ?>
              <img /><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
              </div>
            </legend>
            <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                </div>
                <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                  <?php  { $inherit= 1; ?>
                   <?php } ?>
                  <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                    <input name="<?php echo escapeHtml('inherit') ?>" type="<?php echo escapeHtml('checkbox') ?>" maxlength="<?php echo escapeHtml('256') ?>" value="<?php echo escapeHtml(''.@$inherit.'') ?>" /><?php echo escapeHtml('') ?>
                  </div>
                  <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(''.@lang('inherit_rights').'') ?>
                    </span>
                  </label>
                </div>
              </div>
            </div>
          </fieldset>
         <?php } ?>
      </div>
      <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
      </div>
    </form>
 <?php } ?>