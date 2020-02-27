<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="or-table-wrapper">
      <div class="or-table-filter">
        <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
      </div>
      <div class="or-table-area">
        <table width="100%">
          <tr class="headline">
            <td>
              <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_TYPE'))) ?>
              </span>
              <span> / 
              </span>
              <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
              </span>
            </td>
          </tr>
          <?php $if1=(isset($up_url)); if($if1) {  ?>
            <tr class="data">
              <td>
                <img src="./modules/cms/ui/themes/default/images/icon_folder_up.png" />
                <span>..
                </span>
              </td>
            </tr>
           <?php } ?>
          <?php foreach($content as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="data">
              <td class="clickable">
                <a target="_self" date-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-type="open" data-action="<?php echo encodeHtml(htmlentities(@$type)) ?>" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" data-extra="[]" href="/#/<?php echo encodeHtml(htmlentities(@$type)) ?>/<?php echo encodeHtml(htmlentities(@$id)) ?>">
                  <i class="image-icon image-icon--action-<?php echo encodeHtml(htmlentities(@$type)) ?>">
                  </i>
                  <span><?php echo encodeHtml(htmlentities(@lang(''.@$name.''))) ?>
                  </span>
                  <span> 
                  </span>
                </a>
              </td>
            </tr>
           <?php } ?>
        </table>
      </div>
    </div>
 <?php } ?>