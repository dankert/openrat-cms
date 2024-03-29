<?php /* THIS FILE IS GENERATED from edit.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input or-table-filter-input') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
        <tr class="<?php echo O::escapeHtml('or-table-header') ?>"><?php echo O::escapeHtml('') ?>
          <th><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml('') ?></span>
          </th>
          <th><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('value').'') ?></span>
          </th>
        </tr>
        <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
          <td colspan="<?php echo O::escapeHtml('1') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('type').'') ?></span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-el_'.@$type.'') ?>"><?php echo O::escapeHtml('') ?></i>
            <span><?php echo O::escapeHtml(''.@O::lang('el_'.@$type.'').'') ?></span>
          </td>
        </tr>
        <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
          <td colspan="<?php echo O::escapeHtml('1') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('name').'') ?></span>
          </td>
          <td class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
            <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('edit') ?>" data-action="<?php echo O::escapeHtml('element') ?>" data-method="<?php echo O::escapeHtml('prop') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/element/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$name.'') ?></span>
            </a>
          </td>
        </tr>
        <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
          <td colspan="<?php echo O::escapeHtml('1') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('id').'') ?></span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@$id.'') ?></span>
          </td>
        </tr>
      </table>
    </div>
  </div>