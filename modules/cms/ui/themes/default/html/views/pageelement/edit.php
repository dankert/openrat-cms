<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
      </div>
      <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
        <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
          <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
            <th><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('language').'') ?>
              </span>
            </th>
            <th><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('value').'') ?>
              </span>
            </th>
          </tr>
          <?php foreach((array)$languages as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="<?php echo escapeHtml('data clickable') ?>"><?php echo escapeHtml('') ?>
              <td><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@$languagename.'') ?>
                </span>
              </td>
              <td title="<?php echo escapeHtml(''.@$value.'') ?>"><?php echo escapeHtml('') ?>
                <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('edit') ?>" data-action="<?php echo escapeHtml('pageelement') ?>" data-method="<?php echo escapeHtml('value') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'languageid\':\''.@$languageid.'\'}') ?>" href="<?php echo escapeHtml('/#/pageelement/') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@$value.'') ?>
                  </span>
                </a>
              </td>
            </tr>
           <?php } ?>
        </table>
      </div>
    </div>
 <?php } ?>