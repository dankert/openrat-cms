<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('edit') ?>" data-action="<?php echo escapeHtml('folder') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form folder') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('folder') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('edit') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
      <div><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
            <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
          </div>
          <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
            <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
              <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
                <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                  <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('checkall') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$checkall){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                </td>
                <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('GLOBAL_TYPE').'') ?>
                  </span>
                  <span><?php echo escapeHtml(' / ') ?>
                  </span>
                  <span><?php echo escapeHtml(''.@lang('GLOBAL_NAME').'') ?>
                  </span>
                </td>
              </tr>
              <?php foreach((array)$object as $list_key=>$list_value) { extract($list_value); ?>
                <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
                  <td width="<?php echo escapeHtml('1%') ?>"><?php echo escapeHtml('') ?>
                    <?php $if1=($writable); if($if1) {  ?>
                      <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml(''.@$id.'') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$$id){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                     <?php } ?>
                    <?php $if1=(!writable); if($if1) {  ?>
                      <span><?php echo escapeHtml(' ') ?>
                      </span>
                     <?php } ?>
                  </td>
                  <td class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
                    <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                      <a target="<?php echo escapeHtml('_self') ?>" date-name="<?php echo escapeHtml(''.@$name.'') ?>" name="<?php echo escapeHtml(''.@$name.'') ?>" data-type="<?php echo escapeHtml('open') ?>" data-action="<?php echo escapeHtml(''.@$type.'') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml(''.@$objectid.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/'.@$type.'/'.@$objectid.'') ?>"><?php echo escapeHtml('') ?>
                        <i class="<?php echo escapeHtml('image-icon image-icon--action-'.@$icon.'') ?>"><?php echo escapeHtml('') ?>
                        </i>
                        <span><?php echo escapeHtml(''.@$name.'') ?>
                        </span>
                        <span><?php echo escapeHtml(' ') ?>
                        </span>
                      </a>
                    </label>
                  </td>
                </tr>
               <?php } ?>
              <?php $if1=(($object)==FALSE); if($if1) {  ?>
                <tr><?php echo escapeHtml('') ?>
                  <td colspan="<?php echo escapeHtml('2') ?>"><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(''.@lang('GLOBAL_NOT_FOUND').'') ?>
                    </span>
                  </td>
                </tr>
               <?php } ?>
              <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
                <td><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(' ') ?>
                  </span>
                </td>
                <td colspan="<?php echo escapeHtml('2') ?>" class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
                  <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('folder') ?>" data-method="<?php echo escapeHtml('create') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':\'folder\',\'dialogMethod\':\'create\'}') ?>" href="<?php echo escapeHtml('/#/folder/') ?>"><?php echo escapeHtml('') ?>
                    <i class="<?php echo escapeHtml('image-icon image-icon--method-add') ?>"><?php echo escapeHtml('') ?>
                    </i>
                    <span><?php echo escapeHtml(''.@lang('menu_folder_create').'') ?>
                    </span>
                  </a>
                </td>
              </tr>
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
            <?php  { $type= $defaulttype; ?>
             <?php } ?>
            <?php foreach((array)$actionlist as $list_key=>$actiontype) {  ?>
              <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                </div>
                <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                  <input type="<?php echo escapeHtml('radio') ?>" name="<?php echo escapeHtml('type') ?>" value="<?php echo escapeHtml(''.@$actiontype.'') ?>" checked="<?php echo escapeHtml(''.@$type.'') ?>" /><?php echo escapeHtml('') ?>
                  <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(' ') ?>
                    </span>
                    <span><?php echo escapeHtml(''.@lang(''.@$actiontype.'').'') ?>
                    </span>
                  </label>
                </div>
              </div>
             <?php } ?>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml('    ') ?>
                </span>
                <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml('confirm') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$confirm){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> required="<?php echo escapeHtml('required') ?>" /><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('CONFIRM_DELETE').'') ?>
                  </span>
                </label>
              </div>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('FOLDER_SELECT_TARGET_FOLDER').'') ?>
                </span>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <?php echo escapeHtml('') ?>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
      <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
      </div>
    </form>
 <?php } ?>