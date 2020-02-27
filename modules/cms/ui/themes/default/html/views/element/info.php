<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="or-table-wrapper">
      <div class="or-table-filter">
        <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
      </div>
      <div class="or-table-area">
        <table width="100%">
          <tr class="data">
            <td colspan="1">
              <span><?php echo encodeHtml(htmlentities(@lang('type'))) ?>
              </span>
            </td>
            <td>
              <i class="image-icon image-icon--action-el_<?php echo encodeHtml(htmlentities(@$type)) ?>">
              </i>
              <span><?php echo encodeHtml(htmlentities(@lang(''.@$type.''))) ?>
              </span>
            </td>
          </tr>
          <tr class="data">
            <td colspan="1">
              <span><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
              </span>
            </td>
            <td class="clickable">
              <a target="_self" data-type="edit" data-action="element" data-method="prop" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" data-extra="[]" href="/#/element/<?php echo encodeHtml(htmlentities(@$id)) ?>">
                <span><?php echo encodeHtml(htmlentities(@$name)) ?>
                </span>
              </a>
            </td>
          </tr>
          <tr class="data">
            <td colspan="1">
              <span><?php echo encodeHtml(htmlentities(@lang('id'))) ?>
              </span>
            </td>
            <td>
              <span><?php echo encodeHtml(htmlentities(@$id)) ?>
              </span>
            </td>
          </tr>
        </table>
      </div>
    </div>
 <?php } ?>