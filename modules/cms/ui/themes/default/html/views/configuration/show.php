<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
      </div>
      <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
        <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
          <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
            <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('GLOBAL_NAME').'') ?>
              </span>
            </td>
            <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('GLOBAL_VALUE').'') ?>
              </span>
            </td>
          </tr>
          <?php foreach((array)$config as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
              <td><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@$key.'') ?>
                </span>
              </td>
              <td class="<?php echo escapeHtml(''.@$class.'') ?>"><?php echo escapeHtml('') ?>
                <span class="<?php echo escapeHtml(''.@$class.'') ?>"><?php echo escapeHtml(''.@$value.'') ?>
                </span>
              </td>
            </tr>
           <?php } ?>
        </table>
      </div>
    </div>
 <?php } ?>