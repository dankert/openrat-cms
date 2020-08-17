<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
      </div>
      <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
        <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
          <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
            <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('NAME').'') ?>
              </span>
            </td>
            <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('LANGUAGE').'') ?>
              </span>
            </td>
            <?php foreach((array)$show as $list_key=>$t) {  ?>
              <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('acl_'.@$t.'_abbrev').'') ?>
                </span>
              </td>
             <?php } ?>
            <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('delete').'') ?>
              </span>
            </td>
          </tr>
          <?php $if1=(($acls)==FALSE); if($if1) {  ?>
            <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
              <td colspan="<?php echo escapeHtml('99') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('NOT_FOUND').'') ?>
                </span>
              </td>
            </tr>
           <?php } ?>
          <?php $if1=!(($acls)==FALSE); if($if1) {  ?>
           <?php } ?>
          <?php foreach((array)$acls as $aclid=>$acl) { extract($acl); ?>
            <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
              <td><?php echo escapeHtml('') ?>
                <?php $if1=(isset($username)); if($if1) {  ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--action-user') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@$username.'') ?>
                  </span>
                 <?php } ?>
                <?php $if1=(isset($groupname)); if($if1) {  ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--action-group') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@$groupname.'') ?>
                  </span>
                 <?php } ?>
                <?php $if1=!(isset($username)); if($if1) {  ?>
                  <?php $if1=!(isset($groupname)); if($if1) {  ?>
                    <i class="<?php echo escapeHtml('image-icon image-icon--action-group') ?>"><?php echo escapeHtml('') ?>
                    </i>
                    <span><?php echo escapeHtml(''.@lang('all').'') ?>
                    </span>
                   <?php } ?>
                 <?php } ?>
              </td>
              <td><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@$languagename.'') ?>
                </span>
              </td>
              <?php foreach((array)$show as $list_key=>$t) {  ?>
                <td><?php echo escapeHtml('') ?>
                  <?php $if1=($t); if($if1) {  ?>
                    <span><?php echo '&check;' ?>
                    </span>
                   <?php } ?>
                </td>
               <?php } ?>
              <td class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
                <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('post') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('delacl') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'aclid\':\''.@$aclid.'\'}') ?>" data-data="<?php echo escapeHtml('{"action":"object","subaction":"delacl","id":"","token":"'.@$_token.'","aclid":"'.@$aclid.'","none":"0"}') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('DELETE').'') ?>
                  </span>
                </a>
              </td>
            </tr>
           <?php } ?>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td colspan="<?php echo escapeHtml('99') ?>" class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
              <a target="<?php echo escapeHtml('_self') ?>" date-name="<?php echo escapeHtml(''.@lang('menu_aclform').'') ?>" name="<?php echo escapeHtml(''.@lang('menu_aclform').'') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('aclform') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'aclform\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                <i class="<?php echo escapeHtml('image-icon image-icon--method-add') ?>"><?php echo escapeHtml('') ?>
                </i>
                <span><?php echo escapeHtml(''.@lang('new').'') ?>
                </span>
              </a>
            </td>
          </tr>
        </table>
      </div>
    </div>
 <?php } ?>