<?php if (defined('OR_TITLE')) {  ?>
  
    
      <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('form') ?>" data-action="<?php echo escapeHtml('page') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form page') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('page') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('form') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
        <div><?php echo escapeHtml('') ?>
          
            <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
                <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
                <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
                  <?php $if1=(($el)==FALSE); if($if1) {  ?>
                    <tr><?php echo escapeHtml('') ?>
                      <td colspan="<?php echo escapeHtml('4') ?>"><?php echo escapeHtml('') ?>
                        <span><?php echo escapeHtml(''.@lang('NOT_FOUND').'') ?>
                        </span>
                      </td>
                    </tr>
                   <?php } ?>
                  <?php $if1=!(($el)==FALSE); if($if1) {  ?>
                    <tr><?php echo escapeHtml('') ?>
                      <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                        <span><?php echo escapeHtml(''.@lang('PAGE_ELEMENT_NAME').'') ?>
                        </span>
                      </td>
                      <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                        <span><?php echo escapeHtml(''.@lang('CHANGE').'') ?>
                        </span>
                      </td>
                      <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                        <span><?php echo escapeHtml(''.@lang('VALUE').'') ?>
                        </span>
                      </td>
                    </tr>
                    <?php foreach((array)$el as $list_key=>$list_value) { extract($list_value); ?>
                      <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
                        <td><?php echo escapeHtml('') ?>
                          <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                            <i class="<?php echo escapeHtml('image-icon image-icon--action-el_'.@$type.'') ?>"><?php echo escapeHtml('') ?>
                            </i>
                            <span><?php echo escapeHtml(''.@$name.'') ?>
                            </span>
                          </label>
                        </td>
                        <td><?php echo escapeHtml('') ?>
                          <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml(''.@$saveid.'') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$$saveid){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                        </td>
                        <td><?php echo escapeHtml('') ?>
                          <?php $if1=(in_array($type,explode(",",text,date,number)); if($if1) {  ?>
                            <div class="<?php echo escapeHtml('inputholder') ?>"><?php echo escapeHtml('') ?>
                              <input name="<?php echo escapeHtml(''.@$id.'') ?>" type="<?php echo escapeHtml('text') ?>" maxlength="<?php echo escapeHtml('255') ?>" value="<?php echo escapeHtml(''.@$value.'') ?>" /><?php echo escapeHtml('') ?>
                            </div>
                           <?php } ?>
                          <?php $if1=($type=='longtext'); if($if1) {  ?>
                            <textarea name="<?php echo escapeHtml(''.@$id.'') ?>" class="<?php echo escapeHtml('inputarea') ?>"><?php echo escapeHtml(''.@$value.'') ?>
                            </textarea>
                           <?php } ?>
                          <?php $if1=(in_array($type,explode(",",select,link,list)); if($if1) {  ?>
                            <select name="<?php echo escapeHtml(''.@$id.'') ?>" size="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
                              <?php foreach($list as $_key=>$_value) {  ?>
                                <option value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==$value){ ?>selected="<?php echo escapeHtml('selected') ?>"<?php } ?>><?php echo escapeHtml(''.@$_value.'') ?>
                                </option>
                               <?php } ?>
                            </select>
                           <?php } ?>
                        </td>
                      </tr>
                     <?php } ?>
                   <?php } ?>
                </table>
              </div>
            </div>
            <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
              <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('options').'') ?>
                <img /><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
                </div>
                <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
                </div>
              </legend>
              <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
                <?php $if1=(isset($release)); if($if1) {  ?>
                  <div class="<?php echo escapeHtml('') ?>"><?php echo escapeHtml('') ?>
                    <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('release') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$release){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                    <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                      <span><?php echo escapeHtml(' ') ?>
                      </span>
                      <span><?php echo escapeHtml(''.@lang('RELEASE').'') ?>
                      </span>
                    </label>
                  </div>
                 <?php } ?>
                <?php $if1=(isset($publish)); if($if1) {  ?>
                  <div class="<?php echo escapeHtml('') ?>"><?php echo escapeHtml('') ?>
                    <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('publish') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$publish){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                    <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                      <span><?php echo escapeHtml(' ') ?>
                      </span>
                      <span><?php echo escapeHtml(''.@lang('PAGE_PUBLISH_AFTER_SAVE').'') ?>
                      </span>
                    </label>
                  </div>
                 <?php } ?>
              </div>
            </fieldset>
            
        </div>
        <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
          <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
          <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
        </div>
      </form>
 <?php } ?>