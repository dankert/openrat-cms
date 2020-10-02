<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
        <tr class="<?php echo O::escapeHtml('headline') ?>"><?php echo O::escapeHtml('') ?>
          <th><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('NAME').'') ?>
            </span>
          </th>
          <th><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('DESCRIPTION').'') ?>
            </span>
          </th>
          <th><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('TYPE').'') ?>
            </span>
          </th>
        </tr>
        <?php $if1=(($elements)==FALSE); if($if1) {  ?>
          <tr><?php echo O::escapeHtml('') ?>
            <td><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('NOT_FOUND').'') ?>
              </span>
            </td>
          </tr>
         <?php } ?>
        <?php foreach((array)$elements as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo O::escapeHtml('data clickable') ?>"><?php echo O::escapeHtml('') ?>
            <td><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@$desc.'') ?>" target="<?php echo O::escapeHtml('_self') ?>" date-name="<?php echo O::escapeHtml(''.@$name.'') ?>" name="<?php echo O::escapeHtml(''.@$name.'') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml('pageelement') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$pageelementid.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('/#/pageelement/'.@$pageelementid.'') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('image-icon image-icon--action-pageelement') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@$label.'') ?>
                </span>
              </a>
            </td>
            <td title="<?php echo O::escapeHtml(''.@$desc.'') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$desc.'') ?>
              </span>
            </td>
            <td><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('image-icon image-icon--action-el_'.@$typename.'') ?>"><?php echo O::escapeHtml('') ?>
              </i>
              <span><?php echo O::escapeHtml(''.@O::lang('el_'.@$typename.'').'') ?>
              </span>
            </td>
          </tr>
         <?php } ?>
      </table>
    </div>
  </div>