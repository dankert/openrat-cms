<?php /* THIS FILE IS GENERATED from edit.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input or-table-filter-input') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
        <tr class="<?php echo O::escapeHtml('or-table-header') ?>"><?php echo O::escapeHtml('') ?>
          <th class="<?php echo O::escapeHtml('or-table-column-action') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('TYPE').'') ?></span>
          </th>
          <th class="<?php echo O::escapeHtml('or-table-column-auto') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('NAME').'') ?></span>
          </th>
          <th class="<?php echo O::escapeHtml('or--visible-on-desktop or-table-column-date') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('LASTCHANGE').'') ?></span>
          </th>
          <th class="<?php echo O::escapeHtml('or-table-column-action') ?>"><?php echo O::escapeHtml('') ?></th>
        </tr>
        <?php foreach((array)@$objects as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
            <td><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-'.@$type.'') ?>"><?php echo O::escapeHtml('') ?></i>
            </td>
            <td class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@$desc.'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-name="<?php echo O::escapeHtml(''.@$name.'') ?>" name="<?php echo O::escapeHtml(''.@$name.'') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml(''.@$type.'') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/'.@$type.'/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@$name.'') ?></span>
              </a>
            </td>
            <td class="<?php echo O::escapeHtml('or--visible-on-desktop') ?>"><?php echo O::escapeHtml('') ?>
              <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($lastchange_date); ?>
               <?php } ?>
            </td>
            <td><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-button or-button--active-on-hover or-toolbar-icon or-row--on-hover') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--menu-more or-menu-icon') ?>"><?php echo O::escapeHtml('') ?></i>
                <div class="<?php echo O::escapeHtml('or-dropdown or-button-value') ?>"><?php echo O::escapeHtml('') ?>
                  <div class="<?php echo O::escapeHtml('or-dropdown-entry or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                    <a title="<?php echo O::escapeHtml(''.@O::lang('menu_open').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml(''.@$type.'') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/'.@$type.'/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-switch') ?>"><?php echo O::escapeHtml('') ?></i>
                      <span class="<?php echo O::escapeHtml('or-dropdown-text') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_open').'') ?></span>
                    </a>
                  </div>
                  <div class="<?php echo O::escapeHtml('or-dropdown-entry or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                    <a title="<?php echo O::escapeHtml(''.@O::lang('menu_info_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml(''.@$type.'') ?>" data-method="<?php echo O::escapeHtml('info') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/'.@$type.'/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-info') ?>"><?php echo O::escapeHtml('') ?></i>
                      <span class="<?php echo O::escapeHtml('or-dropdown-text') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_info').'') ?></span>
                    </a>
                  </div>
                  <div class="<?php echo O::escapeHtml('or-dropdown-entry or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                    <a title="<?php echo O::escapeHtml(''.@O::lang('menu_prop_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml(''.@$type.'') ?>" data-method="<?php echo O::escapeHtml('prop') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/'.@$type.'/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-prop') ?>"><?php echo O::escapeHtml('') ?></i>
                      <span class="<?php echo O::escapeHtml('or-dropdown-text') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_prop').'') ?></span>
                    </a>
                  </div>
                  <div class="<?php echo O::escapeHtml('or-dropdown-entry or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                    <a title="<?php echo O::escapeHtml(''.@O::lang('menu_preview_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml(''.@$type.'') ?>" data-method="<?php echo O::escapeHtml('preview') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/'.@$type.'/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-preview') ?>"><?php echo O::escapeHtml('') ?></i>
                      <span class="<?php echo O::escapeHtml('or-dropdown-text') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_preview').'') ?></span>
                    </a>
                  </div>
                  <div class="<?php echo O::escapeHtml('or-dropdown-entry or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                    <a title="<?php echo O::escapeHtml(''.@O::lang('menu_pub_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml(''.@$type.'') ?>" data-method="<?php echo O::escapeHtml('pub') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/'.@$type.'/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-pub') ?>"><?php echo O::escapeHtml('') ?></i>
                      <span class="<?php echo O::escapeHtml('or-dropdown-text') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_pub').'') ?></span>
                    </a>
                  </div>
                </div>
              </div>
            </td>
          </tr>
         <?php } ?>
        <?php $if3=(($objects)==FALSE); if($if3) {  ?>
          <tr><?php echo O::escapeHtml('') ?>
            <td colspan="<?php echo O::escapeHtml('3') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('NOT_FOUND').'') ?></span>
            </td>
          </tr>
         <?php } ?>
      </table>
    </div>
  </div>
  <?php $if2=($add); if($if2) {  ?>
    <div class="<?php echo O::escapeHtml('or-act-clickable or-button-knob') ?>"><?php echo O::escapeHtml('') ?>
      <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('folder') ?>" data-method="<?php echo O::escapeHtml('add') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/folder') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-new') ?>"><?php echo O::escapeHtml('') ?></i>
        <span><?php echo O::escapeHtml(''.@O::lang('add').'') ?></span>
      </a>
    </div>
   <?php } ?>