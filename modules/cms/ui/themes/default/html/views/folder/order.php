<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('order') ?>" data-action="<?php echo escapeHtml('folder') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form folder') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('folder') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('order') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
      <div><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
            <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
          </div>
          <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
            <table width="<?php echo escapeHtml('100%') ?>" class="<?php echo escapeHtml('or-table--sortable') ?>"><?php echo escapeHtml('') ?>
              <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
                <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('FOLDER_ORDER').'') ?>
                  </span>
                </td>
                <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('TYPE').'') ?>
                  </span>
                </td>
                <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('NAME').'') ?>
                  </span>
                </td>
                <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('FILENAME').'') ?>
                  </span>
                </td>
                <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('LASTCHANGE').'') ?>
                  </span>
                </td>
              </tr>
              <?php foreach((array)$object as $list_key=>$list_value) { extract($list_value); ?>
                <tr data-id="<?php echo escapeHtml(''.@$id.'') ?>" class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
                  <td><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(' ') ?>
                    </span>
                  </td>
                  <td><?php echo escapeHtml('') ?>
                    <span class="<?php echo escapeHtml('sort-value') ?>"><?php echo escapeHtml(''.@$icon.'') ?>
                    </span>
                    <i class="<?php echo escapeHtml('image-icon image-icon--action-'.@$icon.'') ?>"><?php echo escapeHtml('') ?>
                    </i>
                  </td>
                  <td><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(''.@$name.'') ?>
                    </span>
                  </td>
                  <td><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(''.@$filename.'') ?>
                    </span>
                  </td>
                  <td><?php echo escapeHtml('') ?>
                    <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($date); ?>
                     <?php } ?>
                  </td>
                </tr>
               <?php } ?>
            </table>
          </div>
        </div>
        <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('order') ?>" value="<?php echo escapeHtml(''.@$order.'') ?>" /><?php echo escapeHtml('') ?>
      </div>
      <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
      </div>
    </form>
 <?php } ?>