<?php /* THIS FILE IS GENERATED from rights.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
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
          <th class="<?php echo O::escapeHtml('or-table-column-auto') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('LANGUAGE').'') ?></span>
          </th>
          <th class="<?php echo O::escapeHtml('or-table-column-auto') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('acl').'') ?></span>
          </th>
          <th class="<?php echo O::escapeHtml('or-table-column-action') ?>"><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('options').'') ?></span>
          </th>
        </tr>
        <?php $if3=(($acls)==FALSE); if($if3) {  ?>
          <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
            <td colspan="<?php echo O::escapeHtml('99') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('NOT_FOUND').'') ?></span>
            </td>
          </tr>
         <?php } ?>
        <?php $if3=!(($acls)==FALSE); if($if3) {  ?>
         <?php } ?>
        <?php foreach((array)@$acls as $aclid=>$acl) { extract($acl); ?>
          <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
            <td><?php echo O::escapeHtml('') ?>
              <?php $if6=($type=='user'); if($if6) {  ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-user') ?>"><?php echo O::escapeHtml('') ?></i>
               <?php } ?>
              <?php $if6=($type=='group'); if($if6) {  ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-group') ?>"><?php echo O::escapeHtml('') ?></i>
               <?php } ?>
              <?php $if6=($type=='auth'); if($if6) {  ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--status-authenticated') ?>"><?php echo O::escapeHtml('') ?></i>
               <?php } ?>
              <?php $if6=($type=='guest'); if($if6) {  ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--status-guest') ?>"><?php echo O::escapeHtml('') ?></i>
               <?php } ?>
              <span><?php echo O::escapeHtml(''.@$name.'') ?></span>
            </td>
            <td><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$languagename.'') ?></span>
            </td>
            <td><?php echo O::escapeHtml('') ?>
              <?php foreach((array)@$show as $list_key=>$t) {  ?>
                <?php  { $bit= $acl[''.@$t.'']; ?>
                 <?php } ?>
                <?php $if7=($bit); if($if7) {  ?>
                  <i title="<?php echo O::escapeHtml(''.@O::lang('acl_'.@$t.'').'') ?>" class="<?php echo O::escapeHtml('or-image-icon or-image-icon--permission-'.@$t.'') ?>"><?php echo O::escapeHtml('') ?></i>
                 <?php } ?>
                <?php if(!$if7) {  ?>
                  <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--blank') ?>"><?php echo O::escapeHtml('') ?></i>
                 <?php } ?>
               <?php } ?>
            </td>
            <td class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('post') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('delacl') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-aclid="<?php echo O::escapeHtml(''.@$aclid.'') ?>" data-extra="<?php echo O::escapeHtml('{&quot;aclid&quot;:&quot;'.@$aclid.'&quot;}') ?>" data-data="<?php echo O::escapeHtml('{"action":"object","subaction":"delacl","id":"","token":"'.@$_token.'","aclid":"'.@$aclid.'","none":0}') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                <i title="<?php echo O::escapeHtml(''.@O::lang('DELETE').'') ?>" class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-delete') ?>"><?php echo O::escapeHtml('') ?></i>
              </a>
            </td>
          </tr>
         <?php } ?>
        <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
          <td colspan="<?php echo O::escapeHtml('4') ?>" class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
            <a target="<?php echo O::escapeHtml('_self') ?>" data-name="<?php echo O::escapeHtml(''.@O::lang('menu_aclform').'') ?>" name="<?php echo O::escapeHtml(''.@O::lang('menu_aclform').'') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('aclform') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-add') ?>"><?php echo O::escapeHtml('') ?></i>
              <span><?php echo O::escapeHtml(''.@O::lang('add').'') ?></span>
            </a>
          </td>
        </tr>
      </table>
    </div>
  </div>
  <div class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
    <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('inherit') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-link or-btn') ?>"><?php echo O::escapeHtml('') ?>
      <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-rights') ?>"><?php echo O::escapeHtml('') ?></i>
      <span><?php echo O::escapeHtml(''.@O::lang('ACL_TRANSMIT').'') ?></span>
    </a>
  </div>