<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo \template_engine\Output::escapeHtml('or-table-wrapper') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-filter') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('search') ?>" name="<?php echo \template_engine\Output::escapeHtml('filter') ?>" placeholder="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('SEARCH_FILTER').'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-area') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <table width="<?php echo \template_engine\Output::escapeHtml('100%') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <tr class="<?php echo \template_engine\Output::escapeHtml('headline') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('NAME').'') ?>
            </span>
          </td>
          <td class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('LANGUAGE').'') ?>
            </span>
          </td>
          <?php foreach((array)$show as $list_key=>$t) {  ?>
            <td class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('acl_'.@$t.'_abbrev').'') ?>
              </span>
            </td>
           <?php } ?>
          <td class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('delete').'') ?>
            </span>
          </td>
        </tr>
        <?php $if1=(($acls)==FALSE); if($if1) {  ?>
          <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <td colspan="<?php echo \template_engine\Output::escapeHtml('99') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('NOT_FOUND').'') ?>
              </span>
            </td>
          </tr>
         <?php } ?>
        <?php $if1=!(($acls)==FALSE); if($if1) {  ?>
         <?php } ?>
        <?php foreach((array)$acls as $aclid=>$acl) { extract($acl); ?>
          <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <td><?php echo \template_engine\Output::escapeHtml('') ?>
              <?php $if1=(isset($username)); if($if1) {  ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-user') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@$username.'') ?>
                </span>
               <?php } ?>
              <?php $if1=(isset($groupname)); if($if1) {  ?>
                <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-group') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </i>
                <span><?php echo \template_engine\Output::escapeHtml(''.@$groupname.'') ?>
                </span>
               <?php } ?>
              <?php $if1=!(isset($username)); if($if1) {  ?>
                <?php $if1=!(isset($groupname)); if($if1) {  ?>
                  <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-group') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  </i>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('all').'') ?>
                  </span>
                 <?php } ?>
               <?php } ?>
            </td>
            <td><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@$languagename.'') ?>
              </span>
            </td>
            <?php foreach((array)$show as $list_key=>$t) {  ?>
              <td><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php $if1=($t); if($if1) {  ?>
                  <span><?php echo '&check;' ?>
                  </span>
                 <?php } ?>
              </td>
             <?php } ?>
            <td class="<?php echo \template_engine\Output::escapeHtml('clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('post') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('delacl') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'aclid\':\''.@$aclid.'\'}') ?>" data-data="<?php echo \template_engine\Output::escapeHtml('{"action":"object","subaction":"delacl","id":"","token":"'.@$_token.'","aclid":"'.@$aclid.'","none":"0"}') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('DELETE').'') ?>
                </span>
              </a>
            </td>
          </tr>
         <?php } ?>
        <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td colspan="<?php echo \template_engine\Output::escapeHtml('99') ?>" class="<?php echo \template_engine\Output::escapeHtml('clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" date-name="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_aclform').'') ?>" name="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_aclform').'') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('dialog') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('aclform') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'aclform\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#//') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--method-add') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              </i>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('new').'') ?>
              </span>
            </a>
          </td>
        </tr>
      </table>
    </div>
  </div>