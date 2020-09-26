<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo \template_engine\Output::escapeHtml('') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-target="<?php echo \template_engine\Output::escapeHtml('view') ?>" action="<?php echo \template_engine\Output::escapeHtml('./') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('info') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('language') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" method="<?php echo \template_engine\Output::escapeHtml('POST') ?>" enctype="<?php echo \template_engine\Output::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo \template_engine\Output::escapeHtml('') ?>" data-autosave="<?php echo \template_engine\Output::escapeHtml('') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form language') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('token') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_token.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('action') ?>" value="<?php echo \template_engine\Output::escapeHtml('language') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('subaction') ?>" value="<?php echo \template_engine\Output::escapeHtml('info') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('id') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <div><?php echo \template_engine\Output::escapeHtml('') ?>
      <span class="<?php echo \template_engine\Output::escapeHtml('headline') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>
      </span>
      <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('NAME').'') ?>
          </span>
        </div>
        <div class="<?php echo \template_engine\Output::escapeHtml('input clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <span class="<?php echo \template_engine\Output::escapeHtml('name') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>
          </span>
        </div>
      </div>
      <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('LANGUAGE_ISOCODE').'') ?>
          </span>
        </div>
        <div class="<?php echo \template_engine\Output::escapeHtml('input clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <span><?php echo \template_engine\Output::escapeHtml(''.@$isocode.'') ?>
          </span>
        </div>
      </div>
      <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        </div>
        <div class="<?php echo \template_engine\Output::escapeHtml('input clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('edit') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('language') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('prop') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/language/') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-link-btn') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('edit').'') ?>
            </span>
          </a>
        </div>
      </div>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-form-actionbar') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
  </form>