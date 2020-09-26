<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
        <tr class="<?php echo O::escapeHtml('headline') ?>"><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('name').'') ?>
            </span>
          </td>
        </tr>
        <?php foreach((array)$templates as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo O::escapeHtml('data') ?>"><?php echo O::escapeHtml('') ?>
            <td><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$name.'') ?>
              </span>
            </td>
          </tr>
         <?php } ?>
      </table>
    </div>
  </div>
  <?php $if1=(($templates)==FALSE); if($if1) {  ?>
    <span><?php echo O::escapeHtml(''.@O::lang('NO_TEMPLATES_AVAILABLE_DESC').'') ?>
    </span>
   <?php } ?>
  <a target="<?php echo O::escapeHtml('_self') ?>" data-action="<?php echo O::escapeHtml('template') ?>" data-method="<?php echo O::escapeHtml('add') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('/#/template/') ?>" class="<?php echo O::escapeHtml('action') ?>"><?php echo O::escapeHtml('') ?>
    <span><?php echo O::escapeHtml(''.@O::lang('menu_template_add').'') ?>
    </span>
  </a>