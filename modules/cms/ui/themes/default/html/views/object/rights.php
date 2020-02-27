<?php if (defined('OR_TITLE')) {  ?>
  
    <?php $if1=($type=='folder'); if($if1) {  ?>
      
     <?php } ?>
    <?php if(!$if1) {  ?>
      
     <?php } ?>
    <div class="or-table-wrapper">
      <div class="or-table-filter">
        <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
      </div>
      <div class="or-table-area">
        <table width="100%">
          <tr class="headline">
            <td class="help">
              <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
              </span>
            </td>
            <td class="help">
              <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_LANGUAGE'))) ?>
              </span>
            </td>
            <?php foreach($show as $list_key=>$t) {  ?>
              <td class="help">
                <span><?php echo encodeHtml(htmlentities(@lang(''.@$t.''))) ?>
                </span>
              </td>
             <?php } ?>
            <td class="help">
              <span><?php echo encodeHtml(htmlentities(@lang('global_delete'))) ?>
              </span>
            </td>
          </tr>
          <?php $if1=(($acls)==FALSE); if($if1) {  ?>
            <tr class="data">
              <td colspan="99">
                <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOT_FOUND'))) ?>
                </span>
              </td>
            </tr>
           <?php } ?>
          <?php $if1=!(($acls)==FALSE); if($if1) {  ?>
           <?php } ?>
          <?php foreach($acls as $aclid=>$acl) { extract($acl); ?>
            <tr class="data">
              <td>
                <?php $if1=(isset($username)); if($if1) {  ?>
                  <i class="image-icon image-icon--action-user">
                  </i>
                  <span><?php echo encodeHtml(htmlentities(@$username)) ?>
                  </span>
                 <?php } ?>
                <?php $if1=(isset($groupname)); if($if1) {  ?>
                  <i class="image-icon image-icon--action-group">
                  </i>
                  <span><?php echo encodeHtml(htmlentities(@$groupname)) ?>
                  </span>
                 <?php } ?>
                <?php $if1=!(isset($username)); if($if1) {  ?>
                  <?php $if1=!(isset($groupname)); if($if1) {  ?>
                    <i class="image-icon image-icon--action-group">
                    </i>
                    <span><?php echo encodeHtml(htmlentities(@lang('global_all'))) ?>
                    </span>
                   <?php } ?>
                 <?php } ?>
              </td>
              <td>
                <span><?php echo encodeHtml(htmlentities(@$languagename)) ?>
                </span>
              </td>
              <?php foreach($show as $list_key=>$t) {  ?>
                <td>
                  <?php $if1=('var:$t'); if($if1) {  ?>
                    <span>&check;
                    </span>
                   <?php } ?>
                </td>
               <?php } ?>
              <td class="clickable">
                <a target="_self" data-type="post" data-action="" data-method="delacl" data-id="" data-extra="{'aclid':'<?php echo encodeHtml(htmlentities(@$aclid)) ?>'}" data-data="{"action":"object","subaction":"delacl","id":"",\"token":"<?php echo token() ?>","aclid":"<?php echo encodeHtml(htmlentities(@$aclid)) ?>","none":"0"}"">
                  <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_DELETE'))) ?>
                  </span>
                </a>
              </td>
            </tr>
           <?php } ?>
          <tr class="data">
            <td colspan="99" class="clickable">
              <a target="_self" date-name="<?php echo encodeHtml(htmlentities(@lang('menu_aclform'))) ?>" name="<?php echo encodeHtml(htmlentities(@lang('menu_aclform'))) ?>" data-type="dialog" data-action="" data-method="aclform" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'aclform'}" href="/#//">
                <i class="image-icon image-icon--method-add">
                </i>
                <span><?php echo encodeHtml(htmlentities(@lang('new'))) ?>
                </span>
              </a>
            </td>
          </tr>
        </table>
      </div>
    </div>
 <?php } ?>