<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="or-table-wrapper">
      <div class="or-table-filter">
        <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
      </div>
      <div class="or-table-area">
        <table width="100%">
          <tr class="headline">
            <th>
              <span><?php echo encodeHtml(htmlentities(@lang('language'))) ?>
              </span>
            </th>
            <th>
              <span><?php echo encodeHtml(htmlentities(@lang('value'))) ?>
              </span>
            </th>
          </tr>
          <?php foreach($languages as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="data clickable">
              <td>
                <span><?php echo encodeHtml(htmlentities(@$languagename)) ?>
                </span>
              </td>
              <td title="<?php echo encodeHtml(htmlentities(@$value)) ?>">
                <a target="_self" data-type="edit" data-action="pageelement" data-method="value" data-id="" data-extra="{'languageid':'<?php echo encodeHtml(htmlentities(@$languageid)) ?>'}" href="/#/pageelement/">
                  <span><?php echo encodeHtml(htmlentities(@$value)) ?>
                  </span>
                </a>
              </td>
            </tr>
           <?php } ?>
        </table>
      </div>
    </div>
 <?php } ?>