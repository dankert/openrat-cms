<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('form') ?>" data-action="<?php echo O::escapeHtml('page') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-page') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('page') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('form') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
          <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
        </div>
        <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
          <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
            <?php $if1=(($el)==FALSE); if($if1) {  ?>
              <tr><?php echo O::escapeHtml('') ?>
                <td colspan="<?php echo O::escapeHtml('4') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('NOT_FOUND').'') ?>
                  </span>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=!(($el)==FALSE); if($if1) {  ?>
              <tr><?php echo O::escapeHtml('') ?>
                <td class="<?php echo O::escapeHtml('or-help') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('PAGE_ELEMENT_NAME').'') ?>
                  </span>
                </td>
                <td class="<?php echo O::escapeHtml('or-help') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('CHANGE').'') ?>
                  </span>
                </td>
                <td class="<?php echo O::escapeHtml('or-help') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('VALUE').'') ?>
                  </span>
                </td>
              </tr>
              <?php foreach((array)$el as $list_key=>$list_value) { extract($list_value); ?>
                <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
                  <td><?php echo O::escapeHtml('') ?>
                    <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-el_'.@$type.'') ?>"><?php echo O::escapeHtml('') ?>
                      </i>
                      <span><?php echo O::escapeHtml(''.@$name.'') ?>
                      </span>
                    </label>
                  </td>
                  <td><?php echo O::escapeHtml('') ?>
                    <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml(''.@$saveid.'') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$$saveid){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                  </td>
                  <td><?php echo O::escapeHtml('') ?>
                    <?php $if1=(in_array($type,explode(",",text,date,number)); if($if1) {  ?>
                      <input name="<?php echo O::escapeHtml(''.@$id.'') ?>" type="<?php echo O::escapeHtml('text') ?>" maxlength="<?php echo O::escapeHtml('255') ?>" value="<?php echo O::escapeHtml(''.@$value.'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                     <?php } ?>
                    <?php $if1=($type=='longtext'); if($if1) {  ?>
                      <textarea name="<?php echo O::escapeHtml(''.@$id.'') ?>" class="<?php echo O::escapeHtml('or-input or-inputarea') ?>"><?php echo O::escapeHtml(''.@$value.'') ?>
                      </textarea>
                     <?php } ?>
                    <?php $if1=(in_array($type,explode(",",select,link,list)); if($if1) {  ?>
                      <select name="<?php echo O::escapeHtml(''.@$id.'') ?>" size="<?php echo O::escapeHtml('1') ?>" class="<?php echo O::escapeHtml('or-input') ?>"><?php echo O::escapeHtml('') ?>
                        <?php foreach($list as $_key=>$_value) {  ?>
                          <option value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==$value){ ?>selected="<?php echo O::escapeHtml('selected') ?>"<?php } ?>><?php echo O::escapeHtml(''.@$_value.'') ?>
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
      <fieldset class="<?php echo O::escapeHtml('or-group or-toggle-open-close or--is-open or-show') ?>"><?php echo O::escapeHtml('') ?>
        <legend class="<?php echo O::escapeHtml('or-act-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('options').'') ?>
          <img /><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-group--on-closed') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-group--on-open') ?>"><?php echo O::escapeHtml('') ?>
          </i>
        </legend>
        <div class="<?php echo O::escapeHtml('or-closable') ?>"><?php echo O::escapeHtml('') ?>
          <?php $if1=(isset($release)); if($if1) {  ?>
            <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
              <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('release') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$release){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(' ') ?>
                </span>
                <span><?php echo O::escapeHtml(''.@O::lang('RELEASE').'') ?>
                </span>
              </label>
            </div>
           <?php } ?>
          <?php $if1=(isset($publish)); if($if1) {  ?>
            <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
              <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('publish') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$publish){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(' ') ?>
                </span>
                <span><?php echo O::escapeHtml(''.@O::lang('PAGE_PUBLISH_AFTER_SAVE').'') ?>
                </span>
              </label>
            </div>
           <?php } ?>
        </div>
      </fieldset>
      
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--secondary or-act-form-cancel') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-cancel') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?>
        </span>
      </div>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--primary or-act-form-save') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-ok') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('button_ok').'') ?>
        </span>
      </div>
    </div>
  </form>