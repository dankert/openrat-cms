<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
        <tr class="<?php echo O::escapeHtml('headline') ?>"><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('name').'') ?>
            </span>
          </td>
        </tr>
        <tr class="<?php echo O::escapeHtml('data') ?>"><?php echo O::escapeHtml('') ?>
          <td data-name="<?php echo O::escapeHtml(''.@$name.'') ?>" data-action="<?php echo O::escapeHtml('userlist') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" class="<?php echo O::escapeHtml('clickable clickable') ?>"><?php echo O::escapeHtml('') ?>
            <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml('userlist') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('/#/userlist/') ?>"><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('image-icon image-icon--action-user') ?>"><?php echo O::escapeHtml('') ?>
              </i>
              <span><?php echo O::escapeHtml(''.@O::lang('users').'') ?>
              </span>
            </a>
          </td>
        </tr>
        <tr class="<?php echo O::escapeHtml('data') ?>"><?php echo O::escapeHtml('') ?>
          <td data-name="<?php echo O::escapeHtml(''.@$name.'') ?>" data-action="<?php echo O::escapeHtml('grouplist') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" class="<?php echo O::escapeHtml('clickable clickable') ?>"><?php echo O::escapeHtml('') ?>
            <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml('grouplist') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('/#/grouplist/') ?>"><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('image-icon image-icon--action-group') ?>"><?php echo O::escapeHtml('') ?>
              </i>
              <span><?php echo O::escapeHtml(''.@O::lang('groups').'') ?>
              </span>
            </a>
          </td>
        </tr>
      </table>
    </div>
  </div>