<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="or-table-wrapper">
      <div class="or-table-filter">
        <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
      </div>
      <div class="or-table-area">
        <table width="100%">
          <tr class="headline">
            <td>
              <span><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
              </span>
            </td>
          </tr>
          <tr class="data">
            <td data-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-action="userlist" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" class="clickable clickable">
              <a target="_self" data-type="open" data-action="userlist" data-method="" data-id="" data-extra="[]" href="/#/userlist/">
                <i class="image-icon image-icon--action-user">
                </i>
                <span><?php echo encodeHtml(htmlentities(@lang('users'))) ?>
                </span>
              </a>
            </td>
          </tr>
          <tr class="data">
            <td data-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-action="grouplist" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" class="clickable clickable">
              <a target="_self" data-type="open" data-action="grouplist" data-method="" data-id="" data-extra="[]" href="/#/grouplist/">
                <i class="image-icon image-icon--action-group">
                </i>
                <span><?php echo encodeHtml(htmlentities(@lang('groups'))) ?>
                </span>
              </a>
            </td>
          </tr>
        </table>
      </div>
    </div>
 <?php } ?>