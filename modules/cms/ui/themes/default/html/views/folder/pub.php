<?php if (defined('OR_TITLE')) {  ?>
  
    <?php $if1=(config('security','nopublish')); if($if1) {  ?>
      <div class="<?php echo escapeHtml('message warn') ?>"><?php echo escapeHtml('') ?>
        <span class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml(''.@lang('NOPUBLISH_DESC').'') ?>
        </span>
      </div>
     <?php } ?>
    <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('pub') ?>" data-action="<?php echo escapeHtml('folder') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('1') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form folder') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('folder') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('pub') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
      <div><?php echo escapeHtml('') ?>
        <?php $if1=($pages); if($if1) {  ?>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('pages') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$pages){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(' ') ?>
                </span>
                <span><?php echo escapeHtml(''.@lang('pages').'') ?>
                </span>
              </label>
            </div>
          </div>
         <?php } ?>
        <?php $if1=($files); if($if1) {  ?>
          <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('files') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$files){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(' ') ?>
                </span>
                <span><?php echo escapeHtml(''.@lang('files').'') ?>
                </span>
              </label>
            </div>
          </div>
         <?php } ?>
        <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
          <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('options').'') ?>
            <img /><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
            <?php $if1=(isset($subdirs)); if($if1) {  ?>
              <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                </div>
                <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                  <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('subdirs') ?>" disabled="<?php echo escapeHtml('disabled') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$subdirs){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                  <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(' ') ?>
                    </span>
                    <span><?php echo escapeHtml(''.@lang('PUBLISH_WITH_SUBDIRS').'') ?>
                    </span>
                  </label>
                </div>
              </div>
             <?php } ?>
            <?php $if1=(isset($clean)); if($if1) {  ?>
              <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                </div>
                <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                  <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('clean') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$clean){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                  <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(' ') ?>
                    </span>
                    <span><?php echo escapeHtml(''.@lang('CLEAN_AFTER_PUBLISH').'') ?>
                    </span>
                  </label>
                </div>
              </div>
             <?php } ?>
          </div>
        </fieldset>
      </div>
      <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('publish').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
      </div>
    </form>
 <?php } ?>