<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
        <tr class="<?php echo O::escapeHtml('headline') ?>"><?php echo O::escapeHtml('') ?>
          <td class="<?php echo O::escapeHtml('help') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('NAME').'') ?>
            </span>
          </td>
          <td class="<?php echo O::escapeHtml('help') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('VALUE').'') ?>
            </span>
          </td>
        </tr>
        <?php foreach((array)$config as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo O::escapeHtml('data') ?>"><?php echo O::escapeHtml('') ?>
            <td><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$key.'') ?>
              </span>
            </td>
            <td class="<?php echo O::escapeHtml(''.@$class.'') ?>"><?php echo O::escapeHtml('') ?>
              <span class="<?php echo O::escapeHtml(''.@$class.'') ?>"><?php echo O::escapeHtml(''.@$value.'') ?>
              </span>
            </td>
          </tr>
         <?php } ?>
      </table>
    </div>
  </div>