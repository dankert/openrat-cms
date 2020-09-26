<?php if (!defined('OR_TITLE')) exit(); ?>
  <?php $if1=(config('security','nopublish')); if($if1) {  ?>
    <div class="<?php echo \template_engine\Output::escapeHtml('message warn') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <span class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('NOPUBLISH_DESC').'') ?>
      </span>
    </div>
   <?php } ?>
  <form name="<?php echo \template_engine\Output::escapeHtml('') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-target="<?php echo \template_engine\Output::escapeHtml('view') ?>" action="<?php echo \template_engine\Output::escapeHtml('./') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('pub') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('folder') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" method="<?php echo \template_engine\Output::escapeHtml('POST') ?>" enctype="<?php echo \template_engine\Output::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo \template_engine\Output::escapeHtml('1') ?>" data-autosave="<?php echo \template_engine\Output::escapeHtml('') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form folder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('token') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_token.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('action') ?>" value="<?php echo \template_engine\Output::escapeHtml('folder') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('subaction') ?>" value="<?php echo \template_engine\Output::escapeHtml('pub') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('id') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <div><?php echo \template_engine\Output::escapeHtml('') ?>
      <?php $if1=($pages); if($if1) {  ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('pages') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$pages){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
            <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(' ') ?>
              </span>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('pages').'') ?>
              </span>
            </label>
          </div>
        </div>
       <?php } ?>
      <?php $if1=($files); if($if1) {  ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('files') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$files){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
            <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(' ') ?>
              </span>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('files').'') ?>
              </span>
            </label>
          </div>
        </div>
       <?php } ?>
      <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('options').'') ?>
          <img /><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <?php $if1=(isset($subdirs)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('subdirs') ?>" disabled="<?php echo \template_engine\Output::escapeHtml('disabled') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$subdirs){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(' ') ?>
                  </span>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('PUBLISH_WITH_SUBDIRS').'') ?>
                  </span>
                </label>
              </div>
            </div>
           <?php } ?>
          <?php $if1=(isset($clean)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('clean') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$clean){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(' ') ?>
                  </span>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('CLEAN_AFTER_PUBLISH').'') ?>
                  </span>
                </label>
              </div>
            </div>
           <?php } ?>
        </div>
      </fieldset>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-form-actionbar') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('submit') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('publish').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
  </form>