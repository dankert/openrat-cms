<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo \template_engine\Output::escapeHtml('') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-target="<?php echo \template_engine\Output::escapeHtml('view') ?>" action="<?php echo \template_engine\Output::escapeHtml('./') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('size') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('text') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" method="<?php echo \template_engine\Output::escapeHtml('POST') ?>" enctype="<?php echo \template_engine\Output::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo \template_engine\Output::escapeHtml('') ?>" data-autosave="<?php echo \template_engine\Output::escapeHtml('') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form text') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('token') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_token.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('action') ?>" value="<?php echo \template_engine\Output::escapeHtml('text') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('subaction') ?>" value="<?php echo \template_engine\Output::escapeHtml('size') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('id') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <div><?php echo \template_engine\Output::escapeHtml('') ?>
      <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('IMAGE_OLD_SIZE').'') ?>
          </span>
        </div>
        <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <span><?php echo \template_engine\Output::escapeHtml(''.@$width.'') ?>
          </span>
          <span><?php echo \template_engine\Output::escapeHtml(' * ') ?>
          </span>
          <span><?php echo \template_engine\Output::escapeHtml(''.@$height.'') ?>
          </span>
        </div>
      </div>
      <?php $if1=!(($formats)==FALSE); if($if1) {  ?>
        <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('IMAGE_NEW_SIZE').'') ?>
            <img /><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <input type="<?php echo \template_engine\Output::escapeHtml('radio') ?>" name="<?php echo \template_engine\Output::escapeHtml('type') ?>" value="<?php echo \template_engine\Output::escapeHtml('factor') ?>" <?php if(@$type=='factor'){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('FILE_IMAGE_SIZE_FACTOR').'') ?>
                  </span>
                </label>
                <select name="<?php echo \template_engine\Output::escapeHtml('factor') ?>" size="<?php echo \template_engine\Output::escapeHtml('1') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <?php foreach($factors as $_key=>$_value) {  ?>
                    <option value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$factor){ ?>selected="<?php echo \template_engine\Output::escapeHtml('selected') ?>"<?php } ?>><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
                <?php  { $factor= 1; ?>
                 <?php } ?>
              </div>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <input type="<?php echo \template_engine\Output::escapeHtml('radio') ?>" name="<?php echo \template_engine\Output::escapeHtml('type') ?>" value="<?php echo \template_engine\Output::escapeHtml('input') ?>" <?php if(@$type=='input'){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('FILE_IMAGE_NEW_WIDTH_HEIGHT').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <div class="<?php echo \template_engine\Output::escapeHtml('inputholder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <input name="<?php echo \template_engine\Output::escapeHtml('width') ?>" type="<?php echo \template_engine\Output::escapeHtml('text') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('256') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$width.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                </div>
                <span><?php echo \template_engine\Output::escapeHtml(' * ') ?>
                </span>
                <div class="<?php echo \template_engine\Output::escapeHtml('inputholder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <input name="<?php echo \template_engine\Output::escapeHtml('height') ?>" type="<?php echo \template_engine\Output::escapeHtml('text') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('256') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$height.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('options').'') ?>
            <img /><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('FILE_IMAGE_FORMAT').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <select name="<?php echo \template_engine\Output::escapeHtml('format') ?>" size="<?php echo \template_engine\Output::escapeHtml('1') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <?php foreach($formats as $_key=>$_value) {  ?>
                    <option value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$format){ ?>selected="<?php echo \template_engine\Output::escapeHtml('selected') ?>"<?php } ?>><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('FILE_IMAGE_JPEG_COMPRESSION').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php  { $jpeg_compression= 70; ?>
                 <?php } ?>
                <select name="<?php echo \template_engine\Output::escapeHtml('jpeg_compression') ?>" size="<?php echo \template_engine\Output::escapeHtml('1') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <?php foreach($jpeglist as $_key=>$_value) {  ?>
                    <option value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$jpeg_compression){ ?>selected="<?php echo \template_engine\Output::escapeHtml('selected') ?>"<?php } ?>><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('copy') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$copy){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('copy').'') ?>
                  </span>
                </label>
              </div>
            </div>
          </div>
        </fieldset>
       <?php } ?>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-form-actionbar') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('button') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('CANCEL').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('submit') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('button_ok').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
  </form>