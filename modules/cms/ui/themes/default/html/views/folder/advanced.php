<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('edit') ?>" data-action="<?php echo O::escapeHtml('folder') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form folder') ?>"><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('folder') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('edit') ?>" /><?php echo O::escapeHtml('') ?>
    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
          <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" /><?php echo O::escapeHtml('') ?>
        </div>
        <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
          <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
            <tr class="<?php echo O::escapeHtml('headline') ?>"><?php echo O::escapeHtml('') ?>
              <td class="<?php echo O::escapeHtml('help') ?>"><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('checkall') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$checkall){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
              </td>
              <td class="<?php echo O::escapeHtml('help') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('TYPE').'') ?>
                </span>
                <span><?php echo O::escapeHtml(' / ') ?>
                </span>
                <span><?php echo O::escapeHtml(''.@O::lang('NAME').'') ?>
                </span>
              </td>
            </tr>
            <?php foreach((array)$object as $list_key=>$list_value) { extract($list_value); ?>
              <tr class="<?php echo O::escapeHtml('data') ?>"><?php echo O::escapeHtml('') ?>
                <td width="<?php echo O::escapeHtml('1%') ?>"><?php echo O::escapeHtml('') ?>
                  <?php $if1=($writable); if($if1) {  ?>
                    <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml(''.@$id.'') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$$id){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                   <?php } ?>
                  <?php $if1=(!writable); if($if1) {  ?>
                    <span><?php echo O::escapeHtml(' ') ?>
                    </span>
                   <?php } ?>
                </td>
                <td class="<?php echo O::escapeHtml('clickable') ?>"><?php echo O::escapeHtml('') ?>
                  <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                    <a target="<?php echo O::escapeHtml('_self') ?>" date-name="<?php echo O::escapeHtml(''.@$name.'') ?>" name="<?php echo O::escapeHtml(''.@$name.'') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml(''.@$type.'') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$objectid.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('/#/'.@$type.'/'.@$objectid.'') ?>"><?php echo O::escapeHtml('') ?>
                      <i class="<?php echo O::escapeHtml('image-icon image-icon--action-'.@$icon.'') ?>"><?php echo O::escapeHtml('') ?>
                      </i>
                      <span><?php echo O::escapeHtml(''.@$name.'') ?>
                      </span>
                      <span><?php echo O::escapeHtml(' ') ?>
                      </span>
                    </a>
                  </label>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(($object)==FALSE); if($if1) {  ?>
              <tr><?php echo O::escapeHtml('') ?>
                <td colspan="<?php echo O::escapeHtml('2') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('NOT_FOUND').'') ?>
                  </span>
                </td>
              </tr>
             <?php } ?>
            <tr class="<?php echo O::escapeHtml('data') ?>"><?php echo O::escapeHtml('') ?>
              <td><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(' ') ?>
                </span>
              </td>
              <td colspan="<?php echo O::escapeHtml('2') ?>" class="<?php echo O::escapeHtml('clickable') ?>"><?php echo O::escapeHtml('') ?>
                <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('folder') ?>" data-method="<?php echo O::escapeHtml('create') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':\'folder\',\'dialogMethod\':\'create\'}') ?>" href="<?php echo O::escapeHtml('/#/folder/') ?>"><?php echo O::escapeHtml('') ?>
                  <i class="<?php echo O::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo O::escapeHtml('') ?>
                  </i>
                  <span><?php echo O::escapeHtml(''.@O::lang('menu_folder_create').'') ?>
                  </span>
                </a>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
        <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@O::lang('options').'') ?>
          <img /><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo O::escapeHtml('') ?>
          </div>
          <div class="<?php echo O::escapeHtml('arrow arrow-down on-open') ?>"><?php echo O::escapeHtml('') ?>
          </div>
        </legend>
        <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
          <?php  { $type= $defaulttype; ?>
           <?php } ?>
          <?php foreach((array)$actionlist as $list_key=>$actiontype) {  ?>
            <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              </div>
              <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
                <input type="<?php echo O::escapeHtml('radio') ?>" name="<?php echo O::escapeHtml('type') ?>" value="<?php echo O::escapeHtml(''.@$actiontype.'') ?>" <?php if(@$type=='${actiontype}'){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(' ') ?>
                  </span>
                  <span><?php echo O::escapeHtml(''.@O::lang('FOLDER_SELECT_'.@$actiontype.'').'') ?>
                  </span>
                </label>
              </div>
            </div>
           <?php } ?>
          <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml('    ') ?>
              </span>
              <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml('confirm') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$confirm){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> required="<?php echo O::escapeHtml('required') ?>" /><?php echo O::escapeHtml('') ?>
              <label class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('CONFIRM_DELETE').'') ?>
                </span>
              </label>
            </div>
          </div>
          <div class="<?php echo O::escapeHtml('line') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('FOLDER_SELECT_TARGET_FOLDER').'') ?>
              </span>
            </div>
            <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
              <?php echo O::escapeHtml('') ?>
            </div>
          </div>
        </div>
      </fieldset>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('button') ?>" value="<?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?>" class="<?php echo O::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('submit') ?>" value="<?php echo O::escapeHtml(''.@O::lang('button_ok').'') ?>" class="<?php echo O::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
  </form>