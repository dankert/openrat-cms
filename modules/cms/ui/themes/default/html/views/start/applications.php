<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="or-table-wrapper">
      <div class="or-table-filter">
        <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
      </div>
      <div class="or-table-area">
        <table width="100%">
          <tr class="data">
            <td colspan="2">
              <a target="_self" data-action="index" data-method="projectmenu" data-id="" data-extra="[]" href="/#/index/">
                <span>OpenRat
                </span>
              </a>
            </td>
          </tr>
          <?php foreach($applications as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="data">
              <td>
                <a target="_self" data-url="<?php echo encodeHtml(htmlentities(@$url)) ?>" data-action="" data-method="" data-id="" data-extra="[]" href="/#//">
                  <span><?php echo encodeHtml(htmlentities(@$name)) ?>
                  </span>
                </a>
              </td>
              <td>
                <span><?php echo encodeHtml(htmlentities(@$description)) ?>
                </span>
              </td>
            </tr>
           <?php } ?>
        </table>
      </div>
    </div>
 <?php } ?>