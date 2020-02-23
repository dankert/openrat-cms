<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="order" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form folder">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="folder" />
      <input type="hidden" name="subaction" value="order" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="or-table-wrapper">
          <div class="or-table-filter">
            <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
          </div>
          <div class="or-table-area">
            <table width="100%" class="or-table--sortable">
              <tr class="headline">
                <td class="help">
                  <span><?php echo encodeHtml(htmlentities(@lang('FOLDER_ORDER'))) ?>
                  </span>
                </td>
                <td class="help">
                  <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_TYPE'))) ?>
                  </span>
                </td>
                <td class="help">
                  <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
                  </span>
                </td>
                <td class="help">
                  <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_FILENAME'))) ?>
                  </span>
                </td>
                <td class="help">
                  <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_LASTCHANGE'))) ?>
                  </span>
                </td>
              </tr>
              <?php foreach($object as $list_key=>$list_value) { extract($list_value); ?>
                <tr data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" class="data">
                  <td>
                    <span> 
                    </span>
                  </td>
                  <td>
                    <span class="sort-value"><?php echo encodeHtml(htmlentities(@$icon)) ?>
                    </span>
                    <i class="image-icon image-icon--action-<?php echo encodeHtml(htmlentities(@$icon)) ?>">
                    </i>
                  </td>
                  <td>
                    <span><?php echo encodeHtml(htmlentities(@$name)) ?>
                    </span>
                  </td>
                  <td>
                    <span><?php echo encodeHtml(htmlentities(@$filename)) ?>
                    </span>
                  </td>
                  <td>
                    <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($date); ?>
                     <?php } ?>
                  </td>
                </tr>
               <?php } ?>
            </table>
          </div>
        </div>
        <input type="hidden" name="order" value="<?php echo encodeHtml(htmlentities(@$order)) ?>" />
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>