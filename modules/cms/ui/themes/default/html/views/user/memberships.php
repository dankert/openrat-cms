<?php /* THIS FILE IS GENERATED from memberships.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('memberships') ?>" data-action="<?php echo O::escapeHtml('user') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-user') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?></div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('user') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('memberships') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
          <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input or-table-filter-input') ?>" /><?php echo O::escapeHtml('') ?>
        </div>
        <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
          <table class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
            <tr class="<?php echo O::escapeHtml('or-table-header') ?>"><?php echo O::escapeHtml('') ?>
              <th><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-group') ?>"><?php echo O::escapeHtml('') ?></i>
                <span><?php echo O::escapeHtml(''.@O::lang('group').'') ?></span>
              </th>
            </tr>
            <?php foreach((array)@$memberships as $list_key=>$list_value) { extract($list_value); ?>
              <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
                <td><?php echo O::escapeHtml('') ?>
                  <label><?php echo O::escapeHtml('') ?>
                    <input type="<?php echo O::escapeHtml('checkbox') ?>" data-name="<?php echo O::escapeHtml(''.@$var.'') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$$var){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
                    <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml(''.@$var.'') ?>" <?php if(@$$var){ ?>value="<?php echo O::escapeHtml('1') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                    <span class="<?php echo O::escapeHtml('or-form-label') ?>"><?php echo O::escapeHtml(''.@$name.'') ?></span>
                  </label>
                </td>
              </tr>
             <?php } ?>
          </table>
        </div>
      </div>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--control or-btn--secondary or-act-form-cancel') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-cancel') ?>"><?php echo O::escapeHtml('') ?></i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?></span>
      </div>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--control or-btn--primary or-act-form-save') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-ok') ?>"><?php echo O::escapeHtml('') ?></i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('button_ok').'') ?></span>
      </div>
    </div>
  </form>