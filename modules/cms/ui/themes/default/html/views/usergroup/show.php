<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
    <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
    </div>
    <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
      <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
        <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('name').'') ?>
            </span>
          </td>
        </tr>
        <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
          <td data-name="<?php echo escapeHtml(''.@$name.'') ?>" data-action="<?php echo escapeHtml('userlist') ?>" data-id="<?php echo escapeHtml(''.@$id.'') ?>" class="<?php echo escapeHtml('clickable clickable') ?>"><?php echo escapeHtml('') ?>
            <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('open') ?>" data-action="<?php echo escapeHtml('userlist') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/userlist/') ?>"><?php echo escapeHtml('') ?>
              <i class="<?php echo escapeHtml('image-icon image-icon--action-user') ?>"><?php echo escapeHtml('') ?>
              </i>
              <span><?php echo escapeHtml(''.@lang('users').'') ?>
              </span>
            </a>
          </td>
        </tr>
        <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
          <td data-name="<?php echo escapeHtml(''.@$name.'') ?>" data-action="<?php echo escapeHtml('grouplist') ?>" data-id="<?php echo escapeHtml(''.@$id.'') ?>" class="<?php echo escapeHtml('clickable clickable') ?>"><?php echo escapeHtml('') ?>
            <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('open') ?>" data-action="<?php echo escapeHtml('grouplist') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/grouplist/') ?>"><?php echo escapeHtml('') ?>
              <i class="<?php echo escapeHtml('image-icon image-icon--action-group') ?>"><?php echo escapeHtml('') ?>
              </i>
              <span><?php echo escapeHtml(''.@lang('groups').'') ?>
              </span>
            </a>
          </td>
        </tr>
      </table>
    </div>
  </div>