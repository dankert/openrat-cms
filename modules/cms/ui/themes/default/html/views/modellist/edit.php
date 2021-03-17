<?php /* THIS FILE IS GENERATED from edit.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input or-table-filter-input') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
        <tr class="<?php echo O::escapeHtml('or-table-header') ?>"><?php echo O::escapeHtml('') ?>
          <th><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('name').'') ?></span>
          </th>
          <th><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml('') ?></span>
          </th>
          <td><?php echo O::escapeHtml('') ?></td>
        </tr>
        <?php foreach((array)@$el as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
            <td class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a target="<?php echo O::escapeHtml('_self') ?>" data-name="<?php echo O::escapeHtml(''.@$name.'') ?>" name="<?php echo O::escapeHtml(''.@$name.'') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml('model') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/model/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-model') ?>"><?php echo O::escapeHtml('') ?></i>
                <span><?php echo O::escapeHtml(''.@$name.'') ?></span>
              </a>
            </td>
            <?php $if5=(!$is_default); if($if5) {  ?>
              <td class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                <?php $if7=(isset($id)); if($if7) {  ?>
                  <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('post') ?>" data-action="<?php echo O::escapeHtml('model') ?>" data-method="<?php echo O::escapeHtml('setdefault') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" data-data="<?php echo O::escapeHtml('{"action":"model","subaction":"setdefault","id":"'.@$id.'","token":"'.@$_token.'","none":0}') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@O::lang('make_default').'') ?></span>
                  </a>
                 <?php } ?>
              </td>
             <?php } ?>
            <?php if(!$if5) {  ?>
              <td><?php echo O::escapeHtml('') ?>
                <em><?php echo O::escapeHtml(''.@O::lang('is_default').'') ?></em>
              </td>
             <?php } ?>
            <td><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-button or-button--active-on-hover or-toolbar-icon or-row--on-hover') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--menu-more or-menu-icon') ?>"><?php echo O::escapeHtml('') ?></i>
                <div class="<?php echo O::escapeHtml('or-dropdown or-button-value') ?>"><?php echo O::escapeHtml('') ?>
                  <div class="<?php echo O::escapeHtml('or-dropdown-entry or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                    <a title="<?php echo O::escapeHtml(''.@O::lang('menu_open').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml('model') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/model/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-switch') ?>"><?php echo O::escapeHtml('') ?></i>
                      <span class="<?php echo O::escapeHtml('or-dropdown-text') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_open').'') ?></span>
                    </a>
                  </div>
                  <div class="<?php echo O::escapeHtml('or-dropdown-entry or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                    <a title="<?php echo O::escapeHtml(''.@O::lang('menu_prop_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('model') ?>" data-method="<?php echo O::escapeHtml('prop') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/model/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-prop') ?>"><?php echo O::escapeHtml('') ?></i>
                      <span class="<?php echo O::escapeHtml('or-dropdown-text') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_prop').'') ?></span>
                    </a>
                  </div>
                  <?php $if8=(!$is_default); if($if8) {  ?>
                    <?php $if9=(isset($id)); if($if9) {  ?>
                      <div class="<?php echo O::escapeHtml('or-dropdown-entry or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                        <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('post') ?>" data-action="<?php echo O::escapeHtml('model') ?>" data-method="<?php echo O::escapeHtml('setdefault') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" data-data="<?php echo O::escapeHtml('{"action":"model","subaction":"setdefault","id":"'.@$id.'","token":"'.@$_token.'","none":0}') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                          <span><?php echo O::escapeHtml(''.@O::lang('make_default').'') ?></span>
                        </a>
                      </div>
                     <?php } ?>
                    <?php if(!$if9) {  ?>
                     <?php } ?>
                   <?php } ?>
                </div>
              </div>
            </td>
          </tr>
          <?php  { unset($select_url) ?>
           <?php } ?>
          <?php  { unset($default_url) ?>
           <?php } ?>
         <?php } ?>
      </table>
    </div>
  </div>
  <div class="<?php echo O::escapeHtml('or-button-knob or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
    <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('add') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-add') ?>"><?php echo O::escapeHtml('') ?></i>
      <span><?php echo O::escapeHtml(''.@O::lang('add').'') ?></span>
    </a>
  </div>