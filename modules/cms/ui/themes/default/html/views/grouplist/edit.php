<?php /* THIS FILE IS GENERATED from edit.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input or-table-filter-input') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
        <tr class="<?php echo O::escapeHtml('or-table-header') ?>"><?php echo O::escapeHtml('') ?>
          <th><?php echo O::escapeHtml('') ?>
            <span class="<?php echo O::escapeHtml('or-table-column-auto') ?>"><?php echo O::escapeHtml(''.@O::lang('name').'') ?></span>
          </th>
          <th class="<?php echo O::escapeHtml('or-table-column-action') ?>"><?php echo O::escapeHtml('') ?></th>
        </tr>
        <?php foreach((array)@$el as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
            <td class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a target="<?php echo O::escapeHtml('_self') ?>" data-name="<?php echo O::escapeHtml(''.@$name.'') ?>" name="<?php echo O::escapeHtml(''.@$name.'') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml('group') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/group/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-group') ?>"><?php echo O::escapeHtml('') ?></i>
                <span><?php echo O::escapeHtml(''.@$name.'') ?></span>
              </a>
            </td>
            <td><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-button or-button--active-on-hover or-toolbar-icon or-row--on-hover') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--menu-more or-menu-icon') ?>"><?php echo O::escapeHtml('') ?></i>
                <div class="<?php echo O::escapeHtml('or-dropdown or-button-value') ?>"><?php echo O::escapeHtml('') ?>
                  <div class="<?php echo O::escapeHtml('or-dropdown-entry or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                    <a title="<?php echo O::escapeHtml(''.@O::lang('menu_open').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml('group') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/group/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-switch') ?>"><?php echo O::escapeHtml('') ?></i>
                      <span class="<?php echo O::escapeHtml('or-dropdown-text') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_open').'') ?></span>
                    </a>
                  </div>
                  <div class="<?php echo O::escapeHtml('or-dropdown-entry or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                    <a title="<?php echo O::escapeHtml(''.@O::lang('menu_info_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('group') ?>" data-method="<?php echo O::escapeHtml('info') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('group') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('info') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':\'group\',\'dialogMethod\':\'info\'}') ?>" href="<?php echo O::escapeHtml('#/group/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-info') ?>"><?php echo O::escapeHtml('') ?></i>
                      <span class="<?php echo O::escapeHtml('or-dropdown-text') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_info').'') ?></span>
                    </a>
                  </div>
                  <div class="<?php echo O::escapeHtml('or-dropdown-entry or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                    <a title="<?php echo O::escapeHtml(''.@O::lang('menu_prop_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('group') ?>" data-method="<?php echo O::escapeHtml('prop') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('group') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('prop') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':\'group\',\'dialogMethod\':\'prop\'}') ?>" href="<?php echo O::escapeHtml('#/group/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-prop') ?>"><?php echo O::escapeHtml('') ?></i>
                      <span class="<?php echo O::escapeHtml('or-dropdown-text') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_prop').'') ?></span>
                    </a>
                  </div>
                  <div class="<?php echo O::escapeHtml('or-dropdown-entry or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                    <a title="<?php echo O::escapeHtml(''.@O::lang('menu_memberships_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('group') ?>" data-method="<?php echo O::escapeHtml('memberships') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('group') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('memberships') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':\'group\',\'dialogMethod\':\'memberships\'}') ?>" href="<?php echo O::escapeHtml('#/group/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-memberships') ?>"><?php echo O::escapeHtml('') ?></i>
                      <span class="<?php echo O::escapeHtml('or-dropdown-text') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_memberships').'') ?></span>
                    </a>
                  </div>
                </div>
              </div>
            </td>
          </tr>
         <?php } ?>
        <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
          <td class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
            <a target="<?php echo O::escapeHtml('_self') ?>" data-name="<?php echo O::escapeHtml(''.@O::lang('menu_add').'') ?>" name="<?php echo O::escapeHtml(''.@O::lang('menu_add').'') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('add') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('add') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'add\'}') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-add') ?>"><?php echo O::escapeHtml('') ?></i>
              <span><?php echo O::escapeHtml(''.@O::lang('add').'') ?></span>
            </a>
          </td>
          <td><?php echo O::escapeHtml('') ?></td>
        </tr>
      </table>
    </div>
  </div>