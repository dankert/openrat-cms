<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo \template_engine\Output::escapeHtml('or-table-wrapper') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-filter') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('search') ?>" name="<?php echo \template_engine\Output::escapeHtml('filter') ?>" placeholder="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('SEARCH_FILTER').'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-area') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <table width="<?php echo \template_engine\Output::escapeHtml('100%') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <tr class="<?php echo \template_engine\Output::escapeHtml('headline') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <th><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('NAME').'') ?>
            </span>
          </th>
          <th><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('DESCRIPTION').'') ?>
            </span>
          </th>
          <th><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('TYPE').'') ?>
            </span>
          </th>
        </tr>
        <?php $if1=(($elements)==FALSE); if($if1) {  ?>
          <tr><?php echo \template_engine\Output::escapeHtml('') ?>
            <td><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('NOT_FOUND').'') ?>
              </span>
            </td>
          </tr>
         <?php } ?>
        <?php foreach((array)$elements as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo \template_engine\Output::escapeHtml('data clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <td><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@$desc.'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" date-name="<?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>" name="<?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('open') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('pageelement') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$pageelementid.'') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/pageelement/'.@$pageelementid.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-pageelement') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@$label.'') ?>
                </span>
              </a>
            </td>
            <td title="<?php echo \template_engine\Output::escapeHtml(''.@$desc.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@$desc.'') ?>
              </span>
            </td>
            <td><?php echo \template_engine\Output::escapeHtml('') ?>
              <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-el_'.@$typename.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </i>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('el_'.@$typename.'').'') ?>
              </span>
            </td>
          </tr>
         <?php } ?>
      </table>
    </div>
  </div>