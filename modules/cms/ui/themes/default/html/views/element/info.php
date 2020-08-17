<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
      </div>
      <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
        <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td colspan="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('type').'') ?>
              </span>
            </td>
            <td><?php echo escapeHtml('') ?>
              <i class="<?php echo escapeHtml('image-icon image-icon--action-el_'.@$type.'') ?>"><?php echo escapeHtml('') ?>
              </i>
              <span><?php echo escapeHtml(''.@lang('el_'.@$type.'').'') ?>
              </span>
            </td>
          </tr>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td colspan="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('name').'') ?>
              </span>
            </td>
            <td class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
              <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('edit') ?>" data-action="<?php echo escapeHtml('element') ?>" data-method="<?php echo escapeHtml('prop') ?>" data-id="<?php echo escapeHtml(''.@$id.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/element/'.@$id.'') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@$name.'') ?>
                </span>
              </a>
            </td>
          </tr>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td colspan="<?php echo escapeHtml('1') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('id').'') ?>
              </span>
            </td>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@$id.'') ?>
              </span>
            </td>
          </tr>
        </table>
      </div>
    </div>
 <?php } ?>