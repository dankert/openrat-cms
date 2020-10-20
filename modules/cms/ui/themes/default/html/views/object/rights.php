<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
        <tr class="<?php echo O::escapeHtml('or-table-header') ?>"><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('NAME').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('LANGUAGE').'') ?>
            </span>
          </td>
          <?php foreach((array)$show as $list_key=>$t) {  ?>
            <td><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('acl_'.@$t.'_abbrev').'') ?>
              </span>
            </td>
           <?php } ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('options').'') ?>
            </span>
          </td>
        </tr>
        <?php $if1=(($acls)==FALSE); if($if1) {  ?>
          <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
            <td colspan="<?php echo O::escapeHtml('99') ?>"><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@O::lang('NOT_FOUND').'') ?>
              </span>
            </td>
          </tr>
         <?php } ?>
        <?php $if1=!(($acls)==FALSE); if($if1) {  ?>
         <?php } ?>
        <?php foreach((array)$acls as $aclid=>$acl) { extract($acl); ?>
          <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
            <td><?php echo O::escapeHtml('') ?>
              <?php $if1=(isset($username)); if($if1) {  ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-user') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@$username.'') ?>
                </span>
               <?php } ?>
              <?php $if1=(isset($groupname)); if($if1) {  ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-group') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <span><?php echo O::escapeHtml(''.@$groupname.'') ?>
                </span>
               <?php } ?>
              <?php $if1=!(isset($username)); if($if1) {  ?>
                <?php $if1=!(isset($groupname)); if($if1) {  ?>
                  <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-group') ?>"><?php echo O::escapeHtml('') ?>
                  </i>
                  <span><?php echo O::escapeHtml(''.@O::lang('all').'') ?>
                  </span>
                 <?php } ?>
               <?php } ?>
            </td>
            <td><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$languagename.'') ?>
              </span>
            </td>
            <?php foreach((array)$show as $list_key=>$t) {  ?>
              <td><?php echo O::escapeHtml('') ?>
                <?php  { $bit= $acl[''.@$t.'']; ?>
                 <?php } ?>
                <?php $if1=($bit); if($if1) {  ?>
                  <span><?php echo '&check;' ?>
                  </span>
                 <?php } ?>
              </td>
             <?php } ?>
            <td class="<?php echo O::escapeHtml('or-clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('post') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('delacl') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-aclid="<?php echo O::escapeHtml(''.@$aclid.'') ?>" data-extra="<?php echo O::escapeHtml('{\'aclid\':\''.@$aclid.'\'}') ?>" data-data="<?php echo O::escapeHtml('{"action":"object","subaction":"delacl","id":"","token":"'.@$_token.'","aclid":"'.@$aclid.'","none":"0"}') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('DELETE').'') ?>
                </span>
              </a>
            </td>
          </tr>
         <?php } ?>
        <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
          <td colspan="<?php echo O::escapeHtml('99') ?>" class="<?php echo O::escapeHtml('or-clickable') ?>"><?php echo O::escapeHtml('') ?>
            <a target="<?php echo O::escapeHtml('_self') ?>" date-name="<?php echo O::escapeHtml(''.@O::lang('menu_aclform').'') ?>" name="<?php echo O::escapeHtml(''.@O::lang('menu_aclform').'') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('aclform') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('aclform') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'aclform\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
              <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-add') ?>"><?php echo O::escapeHtml('') ?>
              </i>
              <span><?php echo O::escapeHtml(''.@O::lang('new').'') ?>
              </span>
            </a>
          </td>
        </tr>
      </table>
    </div>
  </div>