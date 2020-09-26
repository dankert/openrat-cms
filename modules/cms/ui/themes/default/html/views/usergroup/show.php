<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo \template_engine\Output::escapeHtml('or-table-wrapper') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-filter') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('search') ?>" name="<?php echo \template_engine\Output::escapeHtml('filter') ?>" placeholder="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('SEARCH_FILTER').'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-area') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <table width="<?php echo \template_engine\Output::escapeHtml('100%') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <tr class="<?php echo \template_engine\Output::escapeHtml('headline') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('name').'') ?>
            </span>
          </td>
        </tr>
        <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td data-name="<?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('userlist') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$id.'') ?>" class="<?php echo \template_engine\Output::escapeHtml('clickable clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('open') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('userlist') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/userlist/') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-user') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </i>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('users').'') ?>
              </span>
            </a>
          </td>
        </tr>
        <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td data-name="<?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('grouplist') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$id.'') ?>" class="<?php echo \template_engine\Output::escapeHtml('clickable clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('open') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('grouplist') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/grouplist/') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-group') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </i>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('groups').'') ?>
              </span>
            </a>
          </td>
        </tr>
      </table>
    </div>
  </div>