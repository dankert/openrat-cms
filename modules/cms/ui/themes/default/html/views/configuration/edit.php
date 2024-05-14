<?php /* THIS FILE IS GENERATED from edit.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input or-table-filter-input') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
        <tr class="<?php echo O::escapeHtml('or-table-header') ?>"><?php echo O::escapeHtml('') ?>
          <th><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('NAME').'') ?></span>
          </th>
          <th><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('VALUE').'') ?></span>
          </th>
        </tr>
        <?php  { $flatconfig= O::map('flat',$config); ?>
         <?php } ?>
        <?php foreach((array)@$flatconfig as $list_key=>$entry) {  ?>
          <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
            <td title="<?php echo O::escapeHtml(''.@$entry['key'].'') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$entry['label'].'') ?></span>
              <span class="<?php echo O::escapeHtml('or-table-sort-value') ?>"><?php echo O::escapeHtml(''.@$entry['key'].'') ?></span>
            </td>
            <td class="<?php echo O::escapeHtml('or-'.@$class.'') ?>"><?php echo O::escapeHtml('') ?>
              <span class="<?php echo O::escapeHtml('or-'.@$class.'') ?>"><?php echo O::escapeHtml(''.@$entry['value'].'') ?></span>
            </td>
          </tr>
         <?php } ?>
      </table>
    </div>
  </div>