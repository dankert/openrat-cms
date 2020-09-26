<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('size') ?>" data-action="<?php echo O::escapeHtml('image') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form image') ?>"><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('image') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('size') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
    <div><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('IMAGE_OLD_SIZE').'') ?>
          </span>
        </div>
        <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@$width.'') ?>
          </span>
          <span><?php echo O::escapeHtml(' * ') ?>
          </span>
          <span><?php echo O::escapeHtml(''.@$height.'') ?>
          </span>
        </div>
      </div>
      <?php $if1=!(($formats)==FALSE); if($if1) {  ?>
        <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
          <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('IMAGE_NEW_SIZE').'') ?>
            <img /><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('arrow arrow-down on-open') ?>"><?php echo O::escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              </div>
              <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('radio') ?>" name="<?php echo O::escapeHtml('type') ?>" value="<?php echo O::escapeHtml('factor') ?>" <?php if(@$type=='factor'){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('FILE_IMAGE_SIZE_FACTOR').'') ?>
                  </span>
                </label>
                <select name="<?php echo O::escapeHtml('factor') ?>" size="<?php echo O::escapeHtml('1') ?>"><?php echo O::escapeHtml('') ?>
                  <?php foreach($factors as $_key=>$_value) {  ?>
                    <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$factor){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
                <?php  { $factor= 1; ?>
                 <?php } ?>
              </div>
            </div>
            <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              </div>
              <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('radio') ?>" name="<?php echo O::escapeHtml('type') ?>" value="<?php echo O::escapeHtml('input') ?>" <?php if(@$type=='input'){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('FILE_IMAGE_NEW_WIDTH_HEIGHT').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              </div>
              <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
                <div class="<?php echo O::escapeHtml('inputholder') ?>"><?php echo O::escapeHtml('') ?>
                  <input name="<?php echo O::escapeHtml('width') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$width.'') ?>" /><?php echo O::escapeHtml('') ?>
                </div>
                <span><?php echo O::escapeHtml(' * ') ?>
                </span>
                <div class="<?php echo O::escapeHtml('inputholder') ?>"><?php echo O::escapeHtml('') ?>
                  <input name="<?php echo O::escapeHtml('height') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('256') ?>" value="<?php echo O::escapeHtml(''.@$height.'') ?>" /><?php echo O::escapeHtml('') ?>
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
          <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('options').'') ?>
            <img /><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('arrow arrow-down on-open') ?>"><?php echo O::escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('FILE_IMAGE_FORMAT').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
                <select name="<?php echo O::escapeHtml('format') ?>" size="<?php echo O::escapeHtml('1') ?>"><?php echo O::escapeHtml('') ?>
                  <?php foreach($formats as $_key=>$_value) {  ?>
                    <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$format){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
            <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('FILE_IMAGE_JPEG_COMPRESSION').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
                <?php  { $jpeg_compression= 70; ?>
                 <?php } ?>
                <select name="<?php echo O::escapeHtml('jpeg_compression') ?>" size="<?php echo O::escapeHtml('1') ?>"><?php echo O::escapeHtml('') ?>
                  <?php foreach($jpeglist as $_key=>$_value) {  ?>
                    <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$jpeg_compression){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
              </div>
            </div>
            <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              </div>
              <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('copy') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$copy){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('copy').'') ?>
                  </span>
                </label>
              </div>
            </div>
          </div>
        </fieldset>
       <?php } ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('button') ?>" value="<?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?>" class="<?php echo O::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('submit') ?>" value="<?php echo O::escapeHtml(''.@O::lang('button_ok').'') ?>" class="<?php echo O::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
  </form>