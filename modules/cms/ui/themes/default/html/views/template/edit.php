<?php /* THIS FILE IS GENERATED from edit.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
    <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
      <span><?php echo O::escapeHtml(''.@O::lang('page_pageelements').'') ?></span>
    </h2>
    <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
          <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input or-table-filter-input') ?>" /><?php echo O::escapeHtml('') ?>
        </div>
        <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
          <table class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
            <tr class="<?php echo O::escapeHtml('or-table-header') ?>"><?php echo O::escapeHtml('') ?>
              <td><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('name').'') ?></span>
              </td>
              <td><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('type').'') ?></span>
              </td>
              <td><?php echo O::escapeHtml('') ?></td>
            </tr>
            <?php foreach((array)@$elements as $list_key=>$list_value) { extract($list_value); ?>
              <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
                <td class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                  <a target="<?php echo O::escapeHtml('_self') ?>" data-name="<?php echo O::escapeHtml(''.@$name.'') ?>" name="<?php echo O::escapeHtml(''.@$name.'') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml('element') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/element/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                    <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-el_'.@$type.'') ?>"><?php echo O::escapeHtml('') ?></i>
                    <span title="<?php echo O::escapeHtml(''.@$description.'') ?>"><?php echo O::escapeHtml(''.@$name.'') ?></span>
                  </a>
                </td>
                <td><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('el_'.@$type.'').'') ?></span>
                </td>
                <td><?php echo O::escapeHtml('') ?>
                  <div class="<?php echo O::escapeHtml('or-button or-button--active-on-hover or-toolbar-icon or-row--on-hover') ?>"><?php echo O::escapeHtml('') ?>
                    <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--menu-more or-menu-icon') ?>"><?php echo O::escapeHtml('') ?></i>
                    <div class="<?php echo O::escapeHtml('or-dropdown or-button-value') ?>"><?php echo O::escapeHtml('') ?>
                      <div class="<?php echo O::escapeHtml('or-dropdown-entry or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                        <a title="<?php echo O::escapeHtml(''.@O::lang('menu_open').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml('element') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/element/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-switch') ?>"><?php echo O::escapeHtml('') ?></i>
                          <span class="<?php echo O::escapeHtml('or-dropdown-text') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_open').'') ?></span>
                        </a>
                      </div>
                      <div class="<?php echo O::escapeHtml('or-dropdown-entry or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                        <a title="<?php echo O::escapeHtml(''.@O::lang('menu_prop_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('element') ?>" data-method="<?php echo O::escapeHtml('prop') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/element/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-prop') ?>"><?php echo O::escapeHtml('') ?></i>
                          <span class="<?php echo O::escapeHtml('or-dropdown-text') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_prop').'') ?></span>
                        </a>
                      </div>
                      <div class="<?php echo O::escapeHtml('or-dropdown-entry or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                        <a title="<?php echo O::escapeHtml(''.@O::lang('menu_advanced_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('element') ?>" data-method="<?php echo O::escapeHtml('advanced') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/element/'.@$id.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-advanced') ?>"><?php echo O::escapeHtml('') ?></i>
                          <span class="<?php echo O::escapeHtml('or-dropdown-text') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_advanced').'') ?></span>
                        </a>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
             <?php } ?>
            <?php $if4=(($elements)==FALSE); if($if4) {  ?>
              <tr><?php echo O::escapeHtml('') ?>
                <td colspan="<?php echo O::escapeHtml('2') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('NOT_FOUND').'') ?></span>
                </td>
                <td><?php echo O::escapeHtml('') ?></td>
              </tr>
             <?php } ?>
            <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
              <td colspan="<?php echo O::escapeHtml('2') ?>" class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('template') ?>" data-method="<?php echo O::escapeHtml('addel') ?>" data-id="<?php echo O::escapeHtml(''.@$templateid.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/template/'.@$templateid.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                  <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-add') ?>"><?php echo O::escapeHtml('') ?></i>
                  <span><?php echo O::escapeHtml(''.@O::lang('menu_template_addel').'') ?></span>
                </a>
              </td>
              <td><?php echo O::escapeHtml('') ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </section>
  <?php foreach((array)@$models as $list_key=>$list_value) { extract($list_value); ?>
    <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
      <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
        <span><?php echo O::escapeHtml(''.@O::lang('model').' '.@$name.'') ?></span>
      </h2>
      <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
          <code><?php echo O::escapeHtml(''.@$source.'') ?></code>
          <br /><?php echo O::escapeHtml('') ?>
          <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('edit') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('src') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-modelid="<?php echo O::escapeHtml(''.@$modelid.'') ?>" data-extra="<?php echo O::escapeHtml('{&quot;modelid&quot;:&quot;'.@$modelid.'&quot;}') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link or-form-button') ?>"><?php echo O::escapeHtml('') ?>
            <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-template') ?>"><?php echo O::escapeHtml('') ?></i>
            <span><?php echo O::escapeHtml(''.@O::lang('edit').'') ?></span>
          </a>
        </div>
      </div>
    </section>
   <?php } ?>