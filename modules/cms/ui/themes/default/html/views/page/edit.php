<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
    <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
    </div>
    <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
      <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
        <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
          <th><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('NAME').'') ?>
            </span>
          </th>
          <th><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('DESCRIPTION').'') ?>
            </span>
          </th>
          <th><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('TYPE').'') ?>
            </span>
          </th>
        </tr>
        <?php $if1=(($elements)==FALSE); if($if1) {  ?>
          <tr><?php echo escapeHtml('') ?>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('NOT_FOUND').'') ?>
              </span>
            </td>
          </tr>
         <?php } ?>
        <?php foreach((array)$elements as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo escapeHtml('data clickable') ?>"><?php echo escapeHtml('') ?>
            <td><?php echo escapeHtml('') ?>
              <a title="<?php echo escapeHtml(''.@$desc.'') ?>" target="<?php echo escapeHtml('_self') ?>" date-name="<?php echo escapeHtml(''.@$name.'') ?>" name="<?php echo escapeHtml(''.@$name.'') ?>" data-type="<?php echo escapeHtml('open') ?>" data-action="<?php echo escapeHtml('pageelement') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml(''.@$pageelementid.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/pageelement/'.@$pageelementid.'') ?>"><?php echo escapeHtml('') ?>
                <i class="<?php echo escapeHtml('image-icon image-icon--action-pageelement') ?>"><?php echo escapeHtml('') ?>
                </i>
                <span><?php echo escapeHtml(''.@$label.'') ?>
                </span>
              </a>
            </td>
            <td title="<?php echo escapeHtml(''.@$desc.'') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@$desc.'') ?>
              </span>
            </td>
            <td><?php echo escapeHtml('') ?>
              <i class="<?php echo escapeHtml('image-icon image-icon--action-el_'.@$typename.'') ?>"><?php echo escapeHtml('') ?>
              </i>
              <span><?php echo escapeHtml(''.@lang('el_'.@$typename.'').'') ?>
              </span>
            </td>
          </tr>
         <?php } ?>
      </table>
    </div>
  </div>