<?php /* THIS FILE IS GENERATED from edit.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
    <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--empty') ?>"><?php echo O::escapeHtml('') ?></i>
      <span><?php echo O::escapeHtml(''.@O::lang('LANGUAGES').'') ?></span>
    </h2>
    <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
          <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input or-table-filter-input') ?>" /><?php echo O::escapeHtml('') ?>
        </div>
        <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
          <table class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
            <tr class="<?php echo O::escapeHtml('or-table-header') ?>"><?php echo O::escapeHtml('') ?>
              <th><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('LANGUAGE').'') ?></span>
              </th>
            </tr>
            <?php foreach((array)@$languages as $id=>$name) {  ?>
              <tr class="<?php echo O::escapeHtml('or-data or-act-clickable or-table-column-auto') ?>"><?php echo O::escapeHtml('') ?>
                <td><?php echo O::escapeHtml('') ?>
                  <a title="<?php echo O::escapeHtml(''.@$desc.'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-name="<?php echo O::escapeHtml(''.@$name.'') ?>" name="<?php echo O::escapeHtml(''.@$name.'') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('all') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-languageid="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('{&quot;languageid&quot;:&quot;'.@$id.'&quot;}') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                    <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-pageelement') ?>"><?php echo O::escapeHtml('') ?></i>
                    <span><?php echo O::escapeHtml(''.@$name.'') ?></span>
                  </a>
                </td>
              </tr>
             <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </section>
  <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
    <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--empty') ?>"><?php echo O::escapeHtml('') ?></i>
      <span><?php echo O::escapeHtml(''.@O::lang('PAGE_PAGEELEMENTS').'') ?></span>
    </h2>
    <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
          <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input or-table-filter-input') ?>" /><?php echo O::escapeHtml('') ?>
        </div>
        <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
          <table class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
            <tr class="<?php echo O::escapeHtml('or-table-header') ?>"><?php echo O::escapeHtml('') ?>
              <th class="<?php echo O::escapeHtml('or-table-column-auto') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('NAME').'') ?></span>
              </th>
              <th class="<?php echo O::escapeHtml('or--visible-on-desktop or-table-column-auto') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('DESCRIPTION').'') ?></span>
              </th>
              <th class="<?php echo O::escapeHtml('or-table-column-auto') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('TYPE').'') ?></span>
              </th>
              <th class="<?php echo O::escapeHtml('or-table-column-action') ?>"><?php echo O::escapeHtml('') ?></th>
            </tr>
            <?php $if4=(($elements)==FALSE); if($if4) {  ?>
              <tr><?php echo O::escapeHtml('') ?>
                <td><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('NOT_FOUND').'') ?></span>
                </td>
              </tr>
             <?php } ?>
            <?php foreach((array)@$elements as $list_key=>$list_value) { extract($list_value); ?>
              <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
                <td class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                  <a title="<?php echo O::escapeHtml(''.@$desc.'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-name="<?php echo O::escapeHtml(''.@$name.'') ?>" name="<?php echo O::escapeHtml(''.@$name.'') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('pageelement') ?>" data-method="<?php echo O::escapeHtml('all') ?>" data-id="<?php echo O::escapeHtml(''.@$pageelementid.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/pageelement/'.@$pageelementid.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                    <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-pageelement') ?>"><?php echo O::escapeHtml('') ?></i>
                    <span><?php echo O::escapeHtml(''.@$label.'') ?></span>
                  </a>
                </td>
                <td title="<?php echo O::escapeHtml(''.@$desc.'') ?>" class="<?php echo O::escapeHtml('or--visible-on-desktop') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@$desc.'') ?></span>
                </td>
                <td><?php echo O::escapeHtml('') ?>
                  <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-el_'.@$typename.'') ?>"><?php echo O::escapeHtml('') ?></i>
                  <span><?php echo O::escapeHtml(''.@O::lang('el_'.@$typename.'').'') ?></span>
                </td>
                <td><?php echo O::escapeHtml('') ?>
                  <div class="<?php echo O::escapeHtml('or-button or-button--active-on-hover or-toolbar-icon or-row--on-hover') ?>"><?php echo O::escapeHtml('') ?>
                    <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--menu-more or-menu-icon') ?>"><?php echo O::escapeHtml('') ?></i>
                    <div class="<?php echo O::escapeHtml('or-dropdown or-button-value') ?>"><?php echo O::escapeHtml('') ?>
                      <div class="<?php echo O::escapeHtml('or-dropdown-entry or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                        <a title="<?php echo O::escapeHtml(''.@O::lang('menu_open').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml('pageelement') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$pageelementid.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/pageelement/'.@$pageelementid.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-switch') ?>"><?php echo O::escapeHtml('') ?></i>
                          <span class="<?php echo O::escapeHtml('or-dropdown-text') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_open').'') ?></span>
                        </a>
                      </div>
                      <div class="<?php echo O::escapeHtml('or-dropdown-entry or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                        <a title="<?php echo O::escapeHtml(''.@O::lang('menu_info_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('pageelement') ?>" data-method="<?php echo O::escapeHtml('info') ?>" data-id="<?php echo O::escapeHtml(''.@$pageelementid.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/pageelement/'.@$pageelementid.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-info') ?>"><?php echo O::escapeHtml('') ?></i>
                          <span class="<?php echo O::escapeHtml('or-dropdown-text') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_info').'') ?></span>
                        </a>
                      </div>
                      <div class="<?php echo O::escapeHtml('or-dropdown-entry or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                        <a title="<?php echo O::escapeHtml(''.@O::lang('menu_history_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('pageelement') ?>" data-method="<?php echo O::escapeHtml('history') ?>" data-id="<?php echo O::escapeHtml(''.@$pageelementid.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/pageelement/'.@$pageelementid.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-history') ?>"><?php echo O::escapeHtml('') ?></i>
                          <span class="<?php echo O::escapeHtml('or-dropdown-text') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_history').'') ?></span>
                        </a>
                      </div>
                      <div class="<?php echo O::escapeHtml('or-dropdown-entry or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                        <a title="<?php echo O::escapeHtml(''.@O::lang('menu_advanced_desc').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('pageelement') ?>" data-method="<?php echo O::escapeHtml('advanced') ?>" data-id="<?php echo O::escapeHtml(''.@$pageelementid.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/pageelement/'.@$pageelementid.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-advanced') ?>"><?php echo O::escapeHtml('') ?></i>
                          <span class="<?php echo O::escapeHtml('or-dropdown-text') ?>"><?php echo O::escapeHtml(''.@O::lang('menu_advanced').'') ?></span>
                        </a>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
             <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </section>