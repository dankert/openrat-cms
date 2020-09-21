<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('memberships') ?>" data-action="<?php echo escapeHtml('user') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form user') ?>"><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('user') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('memberships') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
    <div><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
          <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
        </div>
        <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
          <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
            <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
              <td colspan="<?php echo escapeHtml('2') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('group').'') ?>
                </span>
              </td>
            </tr>
            <?php foreach((array)$memberships as $list_key=>$list_value) { extract($list_value); ?>
              <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
                <td width="<?php echo escapeHtml('10%') ?>"><?php echo escapeHtml('') ?>
                  <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml(''.@$var.'') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$$var){ ?>checked="<?php echo escapeHtml('checked') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                </td>
                <td><?php echo escapeHtml('') ?>
                  <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                    <i class="<?php echo escapeHtml('image-icon image-icon--action-group') ?>"><?php echo escapeHtml('') ?>
                    </i>
                    <span><?php echo escapeHtml(''.@$name.'') ?>
                    </span>
                  </label>
                </td>
              </tr>
             <?php } ?>
          </table>
        </div>
      </div>
    </div>
    <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
    </div>
  </form>