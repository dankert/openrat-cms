<?php /* THIS FILE IS GENERATED from rights.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <?php foreach((array)@$projects as $list_key=>$list_value) { extract($list_value); ?>
    <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
      <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?></i>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?></i>
        <span><?php echo O::escapeHtml(''.@$projectname.'') ?></span>
      </h2>
      <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
        <?php $if4=(($rights)==FALSE); if($if4) {  ?>
          <div class="<?php echo O::escapeHtml('or-') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('NOT_FOUND').'') ?></span>
          </div>
         <?php } ?>
        <?php $if4=!(($rights)==FALSE); if($if4) {  ?>
          <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
              <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input or-table-filter-input') ?>" /><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
              <table class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
                <tr class="<?php echo O::escapeHtml('or-table-header') ?>"><?php echo O::escapeHtml('') ?>
                  <th class="<?php echo O::escapeHtml('or-table-column-user') ?>"><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@O::lang('USER').'') ?></span>
                  </th>
                  <th class="<?php echo O::escapeHtml('or-table-column-auto') ?>"><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@O::lang('NAME').'') ?></span>
                  </th>
                  <th class="<?php echo O::escapeHtml('or-table-column-user') ?>"><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@O::lang('LANGUAGE').'') ?></span>
                  </th>
                  <?php foreach((array)@$show as $list_key=>$t) {  ?>
                    <th class="<?php echo O::escapeHtml('or-table-column-action') ?>"><?php echo O::escapeHtml('') ?>
                      <span title="<?php echo O::escapeHtml(''.@O::lang('acl_'.@$t.'').'') ?>"><?php echo O::escapeHtml(''.@O::lang('acl_'.@$t.'_abbrev').'') ?></span>
                    </th>
                   <?php } ?>
                </tr>
                <?php foreach((array)@$rights as $aclid=>$acl) { extract($acl); ?>
                  <tr class="<?php echo O::escapeHtml('or-data or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                    <td><?php echo O::escapeHtml('') ?>
                      <?php $if9=(isset($username)); if($if9) {  ?>
                        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-user') ?>"><?php echo O::escapeHtml('') ?></i>
                        <span><?php echo O::escapeHtml(''.@$username.'') ?></span>
                       <?php } ?>
                      <?php $if9=(isset($groupname)); if($if9) {  ?>
                        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-group') ?>"><?php echo O::escapeHtml('') ?></i>
                        <span><?php echo O::escapeHtml(''.@$groupname.'') ?></span>
                       <?php } ?>
                      <?php $if9=!(isset($username)); if($if9) {  ?>
                        <?php $if10=!(isset($groupname)); if($if10) {  ?>
                          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-group') ?>"><?php echo O::escapeHtml('') ?></i>
                          <span><?php echo O::escapeHtml(''.@O::lang('all').'') ?></span>
                         <?php } ?>
                       <?php } ?>
                      <?php  { unset($username) ?>
                       <?php } ?>
                      <?php  { unset($groupname) ?>
                       <?php } ?>
                    </td>
                    <td><?php echo O::escapeHtml('') ?>
                      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-'.@$objecttype.'') ?>"><?php echo O::escapeHtml('') ?></i>
                      <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml(''.@$objecttype.'') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$objectid.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('#/'.@$objecttype.'/'.@$objectid.'') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                        <span title="<?php echo O::escapeHtml(''.@O::lang('select').'') ?>"><?php echo O::escapeHtml(''.@$objectname.'') ?></span>
                      </a>
                    </td>
                    <td><?php echo O::escapeHtml('') ?>
                      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-language') ?>"><?php echo O::escapeHtml('') ?></i>
                      <span><?php echo O::escapeHtml(''.@$languagename.'') ?></span>
                    </td>
                    <?php foreach((array)@$show as $list_key=>$list_value) {  ?>
                      <td><?php echo O::escapeHtml('') ?>
                        <?php  { $$list_value= $bits[''.@$list_value.'']; ?>
                         <?php } ?>
                        <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml(''.@$list_value.'') ?>" disabled="<?php echo O::escapeHtml('disabled') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$$list_value){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-checkbox') ?>" /><?php echo O::escapeHtml('') ?>
                      </td>
                     <?php } ?>
                  </tr>
                 <?php } ?>
              </table>
            </div>
          </div>
         <?php } ?>
      </div>
    </section>
   <?php } ?>