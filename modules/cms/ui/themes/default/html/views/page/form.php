<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo \template_engine\Output::escapeHtml('') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-target="<?php echo \template_engine\Output::escapeHtml('view') ?>" action="<?php echo \template_engine\Output::escapeHtml('./') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('form') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('page') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" method="<?php echo \template_engine\Output::escapeHtml('POST') ?>" enctype="<?php echo \template_engine\Output::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo \template_engine\Output::escapeHtml('') ?>" data-autosave="<?php echo \template_engine\Output::escapeHtml('') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form page') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('token') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_token.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('action') ?>" value="<?php echo \template_engine\Output::escapeHtml('page') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('subaction') ?>" value="<?php echo \template_engine\Output::escapeHtml('form') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('id') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <div><?php echo \template_engine\Output::escapeHtml('') ?>
      <div class="<?php echo \template_engine\Output::escapeHtml('or-table-wrapper') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('or-table-filter') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <input type="<?php echo \template_engine\Output::escapeHtml('search') ?>" name="<?php echo \template_engine\Output::escapeHtml('filter') ?>" placeholder="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('SEARCH_FILTER').'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
        </div>
        <div class="<?php echo \template_engine\Output::escapeHtml('or-table-area') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <table width="<?php echo \template_engine\Output::escapeHtml('100%') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <?php $if1=(($el)==FALSE); if($if1) {  ?>
              <tr><?php echo \template_engine\Output::escapeHtml('') ?>
                <td colspan="<?php echo \template_engine\Output::escapeHtml('4') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('NOT_FOUND').'') ?>
                  </span>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=!(($el)==FALSE); if($if1) {  ?>
              <tr><?php echo \template_engine\Output::escapeHtml('') ?>
                <td class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('PAGE_ELEMENT_NAME').'') ?>
                  </span>
                </td>
                <td class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('CHANGE').'') ?>
                  </span>
                </td>
                <td class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('VALUE').'') ?>
                  </span>
                </td>
              </tr>
              <?php foreach((array)$el as $list_key=>$list_value) { extract($list_value); ?>
                <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <td><?php echo \template_engine\Output::escapeHtml('') ?>
                    <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                      <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-el_'.@$type.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                      </i>
                      <span><?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>
                      </span>
                    </label>
                  </td>
                  <td><?php echo \template_engine\Output::escapeHtml('') ?>
                    <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml(''.@$saveid.'') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$$saveid){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                  </td>
                  <td><?php echo \template_engine\Output::escapeHtml('') ?>
                    <?php $if1=(in_array($type,explode(",",text,date,number)); if($if1) {  ?>
                      <div class="<?php echo \template_engine\Output::escapeHtml('inputholder') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                        <input name="<?php echo \template_engine\Output::escapeHtml(''.@$id.'') ?>" type="<?php echo \template_engine\Output::escapeHtml('text') ?>" maxlength="<?php echo \template_engine\Output::escapeHtml('255') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$value.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                      </div>
                     <?php } ?>
                    <?php $if1=($type=='longtext'); if($if1) {  ?>
                      <textarea name="<?php echo \template_engine\Output::escapeHtml(''.@$id.'') ?>" class="<?php echo \template_engine\Output::escapeHtml('inputarea') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$value.'') ?>
                      </textarea>
                     <?php } ?>
                    <?php $if1=(in_array($type,explode(",",select,link,list)); if($if1) {  ?>
                      <select name="<?php echo \template_engine\Output::escapeHtml(''.@$id.'') ?>" size="<?php echo \template_engine\Output::escapeHtml('1') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                        <?php foreach($list as $_key=>$_value) {  ?>
                          <option value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$value){ ?>selected="<?php echo \template_engine\Output::escapeHtml('selected') ?>"<?php } ?>><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
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
      <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('options').'') ?>
          <img /><?php echo \template_engine\Output::escapeHtml('') ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
          <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <?php $if1=(isset($release)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('release') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$release){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
              <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(' ') ?>
                </span>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('RELEASE').'') ?>
                </span>
              </label>
            </div>
           <?php } ?>
          <?php $if1=(isset($publish)); if($if1) {  ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml('publish') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$publish){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
              <label class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(' ') ?>
                </span>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('PAGE_PUBLISH_AFTER_SAVE').'') ?>
                </span>
              </label>
            </div>
           <?php } ?>
        </div>
      </fieldset>
      
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-form-actionbar') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('button') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('CANCEL').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('submit') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('button_ok').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
  </form>