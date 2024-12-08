<?php /* THIS FILE IS GENERATED from advanced.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
    <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--empty') ?>"><?php echo O::escapeHtml('') ?></i>
      <span><?php echo O::escapeHtml(''.@O::lang('token').'') ?></span>
    </h2>
    <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
          <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input or-table-filter-input') ?>" /><?php echo O::escapeHtml('') ?>
        </div>
        <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
          <table class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
            <tr><?php echo O::escapeHtml('') ?>
              <th><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('created').'') ?></span>
              </th>
              <th><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('until').'') ?></span>
              </th>
              <th><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('name').'') ?></span>
              </th>
              <th><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('OPERATING_SYSTEM').'') ?></span>
              </th>
            </tr>
            <?php foreach((array)@$token as $list_key=>$list_value) { extract($list_value); ?>
              <tr><?php echo O::escapeHtml('') ?>
                <td><?php echo O::escapeHtml('') ?>
                  <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($create_date); ?>
                   <?php } ?>
                </td>
                <td><?php echo O::escapeHtml('') ?>
                  <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($expires); ?>
                   <?php } ?>
                </td>
                <td><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@$name.'') ?></span>
                </td>
                <td><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@$platform.'') ?></span>
                </td>
              </tr>
             <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </section>
  <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
    <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--empty') ?>"><?php echo O::escapeHtml('') ?></i>
      <span><?php echo O::escapeHtml(''.@O::lang('menu_switch').'') ?></span>
    </h2>
    <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
        <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('edit') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('switch') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link or-btn') ?>"><?php echo O::escapeHtml('') ?>
          <span><?php echo O::escapeHtml(''.@O::lang('user_switch').'') ?></span>
        </a>
      </div>
    </div>
  </section>