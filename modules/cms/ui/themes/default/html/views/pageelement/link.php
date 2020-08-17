<?php if (defined('OR_TITLE')) {  ?>
  
    
      <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('link') ?>" data-action="<?php echo escapeHtml('pageelement') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form pageelement') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('pageelement') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('link') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
        <div><?php echo escapeHtml('') ?>
          
            <tr><?php echo escapeHtml('') ?>
              <td colspan="<?php echo escapeHtml('2') ?>" class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@$desc.'') ?>
                </span>
              </td>
            </tr>
            <tr><?php echo escapeHtml('') ?>
              <td colspan="<?php echo escapeHtml('2') ?>"><?php echo escapeHtml('') ?>
                <select name="<?php echo escapeHtml('linkobjectid') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
                  <?php foreach($objects as $_key=>$_value) {  ?>
                    <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$linkobjectid){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                    </option>
                   <?php } ?>
                </select>
              </td>
            </tr>
            <?php $if1=(isset($release)); if($if1) {  ?>
              <?php $if1=(isset($publish)); if($if1) {  ?>
                <tr><?php echo escapeHtml('') ?>
                  <td colspan="<?php echo escapeHtml('2') ?>"><?php echo escapeHtml('') ?>
                    <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
                      <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('options').'') ?>
                        <img /><?php echo escapeHtml('') ?>
                        <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
                        </div>
                        <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
                        </div>
                      </legend>
                      <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
                      </div>
                    </fieldset>
                  </td>
                </tr>
               <?php } ?>
             <?php } ?>
            <?php $if1=(isset($release)); if($if1) {  ?>
              <tr><?php echo escapeHtml('') ?>
                <td colspan="<?php echo escapeHtml('2') ?>"><?php echo escapeHtml('') ?>
                  <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('release') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$release){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                  <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(' ') ?>
                    </span>
                    <span><?php echo escapeHtml(''.@lang('RELEASE').'') ?>
                    </span>
                  </label>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($publish)); if($if1) {  ?>
              <tr><?php echo escapeHtml('') ?>
                <td colspan="<?php echo escapeHtml('2') ?>"><?php echo escapeHtml('') ?>
                  <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('publish') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$publish){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                  <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(' ') ?>
                    </span>
                    <span><?php echo escapeHtml(''.@lang('PAGE_PUBLISH_AFTER_SAVE').'') ?>
                    </span>
                  </label>
                </td>
              </tr>
             <?php } ?>
            <tr><?php echo escapeHtml('') ?>
              <td colspan="<?php echo escapeHtml('2') ?>" class="<?php echo escapeHtml('act') ?>"><?php echo escapeHtml('') ?>
                
              </td>
            </tr>
        </div>
        <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
          <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
          <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
        </div>
      </form>
      
 <?php } ?>