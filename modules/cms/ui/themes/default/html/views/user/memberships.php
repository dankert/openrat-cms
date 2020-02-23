<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="memberships" data-action="user" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form user">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="user" />
      <input type="hidden" name="subaction" value="memberships" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="or-table-wrapper">
          <div class="or-table-filter">
            <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
          </div>
          <div class="or-table-area">
            <table width="100%">
              <tr class="headline">
                <td colspan="2">
                  <span><?php echo encodeHtml(htmlentities(@lang('group'))) ?>
                  </span>
                </td>
              </tr>
              <?php foreach($memberships as $list_key=>$list_value) { extract($list_value); ?>
                <tr class="data">
                  <td width="10%">
                    <input type="checkbox" name="group<?php echo encodeHtml(htmlentities(@$id)) ?>" value="1" checked="<?php echo encodeHtml(htmlentities(@$member)) ?>" />
                  </td>
                  <td>
                    <label class="label">
                      <i class="image-icon image-icon--action-group">
                      </i>
                      <span><?php echo encodeHtml(htmlentities(@$name)) ?>
                      </span>
                    </label>
                  </td>
                </tr>
               <?php } ?>
            </table>
          </div>
        </div>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>