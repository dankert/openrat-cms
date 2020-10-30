<?php /* THIS FILE IS GENERATED from show.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
        <tr class="<?php echo O::escapeHtml('or-headline') ?>"><?php echo O::escapeHtml('') ?>
          <th><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('TYPE').'') ?>
            </span>
          </th>
          <th><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('NAME').'') ?>
            </span>
          </th>
          <th><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('LASTCHANGE').'') ?>
            </span>
          </th>
        </tr>
        <?php $if3=(isset($up_url)); if($if3) {  ?>
          <tr class="<?php echo O::escapeHtml('or-data or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
            <td><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-folder') ?>"><?php echo O::escapeHtml('') ?>
              </i>
            </td>
            <td><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml('..') ?>
              </span>
            </td>
            <td><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml('') ?>
              </span>
            </td>
          </tr>
         <?php } ?>
        <?php foreach((array)$object as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
            <td title="<?php echo O::escapeHtml(''.@$desc.'') ?>" data-name="<?php echo O::escapeHtml(''.@$name.'') ?>" data-action="<?php echo O::escapeHtml(''.@$type.'') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" class="<?php echo O::escapeHtml('or-clickable or-'.@$class.'') ?>"><?php echo O::escapeHtml('') ?>
              <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon_'.@$icon.'.png') ?>" /><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$name.'') ?>
              </span>
              <span><?php echo O::escapeHtml(' ') ?>
              </span>
            </td>
            <td><?php echo O::escapeHtml('') ?>
              <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($date); ?>
               <?php } ?>
            </td>
          </tr>
         <?php } ?>
        <?php $if3=(($object)==FALSE); if($if3) {  ?>
          <tr><?php echo O::escapeHtml('') ?>
            <td colspan="<?php echo O::escapeHtml('2') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('NOT_FOUND').'') ?>
              </span>
            </td>
          </tr>
         <?php } ?>
      </table>
    </div>
  </div>
  <div class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
    <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('view') ?>" data-action="<?php echo O::escapeHtml('folder') ?>" data-method="<?php echo O::escapeHtml('create') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/folder') ?>" class="<?php echo O::escapeHtml('or-link or-btn') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-new') ?>"><?php echo O::escapeHtml('') ?>
      </i>
      <span><?php echo O::escapeHtml(''.@O::lang('new').'') ?>
      </span>
    </a>
  </div>