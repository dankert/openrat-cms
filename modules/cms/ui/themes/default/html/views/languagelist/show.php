<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="or-table-wrapper">
      <div class="or-table-filter">
        <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
      </div>
      <div class="or-table-area">
        <table width="100%">
          <tr class="headline">
            <td>
              <span><?php echo encodeHtml(htmlentities(@lang('NAME'))) ?>
              </span>
            </td>
            <td>
              <span><?php echo encodeHtml(htmlentities(@lang('LANGUAGE_ISOCODE'))) ?>
              </span>
            </td>
            <td>
              <span>
              </span>
            </td>
          </tr>
          <?php foreach($el as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="data">
              <td class="clickable">
                <i class="image-icon image-icon--action-language">
                </i>
                <a target="_self" date-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-type="open" data-action="language" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" data-extra="[]" href="/#/language/<?php echo encodeHtml(htmlentities(@$id)) ?>">
                  <span><?php echo encodeHtml(htmlentities(@$name)) ?>
                  </span>
                </a>
              </td>
              <td>
                <span><?php echo encodeHtml(htmlentities(@$isocode)) ?>
                </span>
              </td>
              <?php $if1=(!$is_default); if($if1) {  ?>
                <td class="clickable">
                  <?php $if1=(isset($id)); if($if1) {  ?>
                    <a target="_self" data-type="post" data-action="language" data-method="setdefault" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" data-extra="[]" data-data="{"action":"language","subaction":"setdefault","id":"<?php echo encodeHtml(htmlentities(@$id)) ?>",\"token":"<?php echo token() ?>","none":"0"}"">
                      <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_make_default'))) ?>
                      </span>
                    </a>
                   <?php } ?>
                  <?php if(!$if1) {  ?>
                   <?php } ?>
                </td>
               <?php } ?>
              <?php if(!$if1) {  ?>
                <td>
                  <em><?php echo encodeHtml(htmlentities(@lang('GLOBAL_is_default'))) ?>
                  </em>
                </td>
               <?php } ?>
            </tr>
            <?php  { unset($select_url) ?>
             <?php } ?>
            <?php  { unset($default_url) ?>
             <?php } ?>
           <?php } ?>
          <tr class="data">
            <td colspan="3" class="clickable">
              <a target="_self" data-type="dialog" data-action="" data-method="add" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'add'}" href="/#//">
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