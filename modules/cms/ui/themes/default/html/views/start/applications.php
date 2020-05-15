<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
      </div>
      <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
        <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td colspan="<?php echo escapeHtml('2') ?>"><?php echo escapeHtml('') ?>
              <a target="<?php echo escapeHtml('_self') ?>" data-action="<?php echo escapeHtml('index') ?>" data-method="<?php echo escapeHtml('projectmenu') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/index/') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml('OpenRat') ?>
                </span>
              </a>
            </td>
          </tr>
          <?php foreach((array)$applications as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
              <td><?php echo escapeHtml('') ?>
                <a target="<?php echo escapeHtml('_self') ?>" data-url="<?php echo escapeHtml(''.@$url.'') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@$name.'') ?>
                  </span>
                </a>
              </td>
              <td><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@$description.'') ?>
                </span>
              </td>
            </tr>
           <?php } ?>
        </table>
      </div>
    </div>
 <?php } ?>