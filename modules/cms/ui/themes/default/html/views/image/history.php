<?php /* THIS FILE IS GENERATED from history.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('diff') ?>" data-action="<?php echo O::escapeHtml('image') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('get') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-image') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?></div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('image') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('diff') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--is-visible or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
          <span><?php echo O::escapeHtml(''.@O::lang('language').'') ?></span>
        </h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
              <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input or-table-filter-input') ?>" /><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
              <table class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
                <tr class="<?php echo O::escapeHtml('or-table-header') ?>"><?php echo O::escapeHtml('') ?>
                  <td class="<?php echo O::escapeHtml('or-table-column-auto') ?>"><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@O::lang('VALUE').'') ?></span>
                  </td>
                  <td class="<?php echo O::escapeHtml('or--visible-on-desktop or-table-column-date') ?>"><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@O::lang('DATE').'') ?></span>
                  </td>
                  <td class="<?php echo O::escapeHtml('or--visible-on-desktop or-table-column-user') ?>"><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@O::lang('USER').'') ?></span>
                  </td>
                  <td class="<?php echo O::escapeHtml('or-table-column-action') ?>"><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@O::lang('STATE').'') ?></span>
                  </td>
                  <td class="<?php echo O::escapeHtml('or-table-column-action') ?>"><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@O::lang('ACTION').'') ?></span>
                  </td>
                </tr>
                <?php $if5=(($values)==FALSE); if($if5) {  ?>
                  <tr><?php echo O::escapeHtml('') ?>
                    <td colspan="<?php echo O::escapeHtml('8') ?>"><?php echo O::escapeHtml('') ?>
                      <span><?php echo O::escapeHtml(''.@O::lang('NOT_FOUND').'') ?></span>
                    </td>
                  </tr>
                 <?php } ?>
                <?php foreach((array)@$values as $list_key=>$list_value) { extract($list_value); ?>
                  <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
                    <td><?php echo O::escapeHtml('') ?>
                      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-image') ?>"><?php echo O::escapeHtml('') ?></i>
                    </td>
                    <td class="<?php echo O::escapeHtml('or--visible-on-desktop') ?>"><?php echo O::escapeHtml('') ?>
                      <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($date); ?>
                       <?php } ?>
                    </td>
                    <td class="<?php echo O::escapeHtml('or--visible-on-desktop') ?>"><?php echo O::escapeHtml('') ?>
                      <span><?php echo O::escapeHtml(''.@$user.'') ?></span>
                    </td>
                    <td><?php echo O::escapeHtml('') ?>
                      <?php $if8=($publish); if($if8) {  ?>
                        <i title="<?php echo O::escapeHtml(''.@O::lang('PAGEELEMENT_RELEASED').'') ?>" class="<?php echo O::escapeHtml('or-image-icon or-image-icon--status-released') ?>"><?php echo O::escapeHtml('') ?></i>
                       <?php } ?>
                      <?php $if8=($active); if($if8) {  ?>
                        <i title="<?php echo O::escapeHtml(''.@O::lang('active').'') ?>" class="<?php echo O::escapeHtml('or-image-icon or-image-icon--status-active') ?>"><?php echo O::escapeHtml('') ?></i>
                       <?php } ?>
                    </td>
                    <td><?php echo O::escapeHtml('') ?>
                      <?php $if8=($releasable); if($if8) {  ?>
                        <a title="<?php echo O::escapeHtml(''.@O::lang('RELEASE_DESC').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('post') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('release') ?>" data-id="<?php echo O::escapeHtml(''.@$objectid.'') ?>" data-extra-valueid="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('{&quot;valueid&quot;:&quot;'.@$id.'&quot;}') ?>" data-data="<?php echo O::escapeHtml('{"action":"image","subaction":"release","id":"'.@$objectid.'","token":"'.@$_token.'","valueid":"'.@$id.'","none":0}') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-release') ?>"><?php echo O::escapeHtml('') ?></i>
                        </a>
                       <?php } ?>
                      <?php $if8=($usable); if($if8) {  ?>
                        <a title="<?php echo O::escapeHtml(''.@O::lang('RESTORE_DESC').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('post') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('restore') ?>" data-id="<?php echo O::escapeHtml(''.@$objectid.'') ?>" data-extra-valueid="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('{&quot;valueid&quot;:&quot;'.@$id.'&quot;}') ?>" data-data="<?php echo O::escapeHtml('{"action":"image","subaction":"restore","id":"'.@$objectid.'","token":"'.@$_token.'","valueid":"'.@$id.'","none":0}') ?>" class="<?php echo O::escapeHtml('or-link or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-restore') ?>"><?php echo O::escapeHtml('') ?></i>
                        </a>
                        <a title="<?php echo O::escapeHtml(''.@O::lang('edit').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('value') ?>" data-id="<?php echo O::escapeHtml(''.@$objectid.'') ?>" data-extra-valueid="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('{&quot;valueid&quot;:&quot;'.@$id.'&quot;}') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-edit') ?>"><?php echo O::escapeHtml('') ?></i>
                        </a>
                       <?php } ?>
                    </td>
                  </tr>
                 <?php } ?>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--control or-btn--primary or-act-form-save') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-ok') ?>"><?php echo O::escapeHtml('') ?></i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('compare').'') ?></span>
      </div>
    </div>
  </form>