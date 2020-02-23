<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="or-table-wrapper">
      <div class="or-table-filter">
        <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
      </div>
      <div class="or-table-area">
        <table width="100%">
          <tr class="headline">
            <td class="help">
              <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_TYPE'))) ?>
              </span>
              <span> / 
              </span>
              <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
              </span>
            </td>
            <td class="help">
              <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_LASTCHANGE'))) ?>
              </span>
            </td>
          </tr>
          <?php $if1=(isset($up_url)); if($if1) {  ?>
            <tr class="data">
              <td>
                <img src="./modules/cms/ui/themes/default/images/icon_folder.png" />
                <span>..
                </span>
              </td>
              <td>
                <span>
                </span>
              </td>
            </tr>
           <?php } ?>
          <?php foreach($object as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="data">
              <td title="<?php echo encodeHtml(htmlentities(@$desc)) ?>" data-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-action="<?php echo encodeHtml(htmlentities(@$type)) ?>" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" class="clickable <?php echo encodeHtml(htmlentities(@$class)) ?>">
                <img src="./modules/cms/ui/themes/default/images/icon_<?php echo encodeHtml(htmlentities(@$icon)) ?>.png" />
                <span><?php echo encodeHtml(htmlentities(@$name)) ?>
                </span>
                <span> 
                </span>
              </td>
              <td>
                <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($date); ?>
                 <?php } ?>
              </td>
            </tr>
           <?php } ?>
          <?php $if1=(($object)==FALSE); if($if1) {  ?>
            <tr>
              <td colspan="2">
                <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOT_FOUND'))) ?>
                </span>
              </td>
            </tr>
           <?php } ?>
          <tr class="data">
            <td colspan="2">
              <a target="_self" data-type="view" data-action="folder" data-method="createfolder" data-id="" data-extra="[]" href="/#/folder/">
                <img src="./modules/cms/ui/themes/default/images/icon/icon/create.png" />
                <span><?php echo encodeHtml(htmlentities(@lang('menu_folder_createfolder'))) ?>
                </span>
              </a>
            </td>
          </tr>
          <tr class="data">
            <td colspan="2">
              <a target="_self" data-type="view" data-action="folder" data-method="createpage" data-id="" data-extra="[]" href="/#/folder/">
                <img src="./modules/cms/ui/themes/default/images/icon/icon/create.png" />
                <span><?php echo encodeHtml(htmlentities(@lang('menu_folder_createpage'))) ?>
                </span>
              </a>
            </td>
          </tr>
          <tr class="data">
            <td colspan="2">
              <a target="_self" data-type="view" data-action="folder" data-method="createfile" data-id="" data-extra="[]" href="/#/folder/">
                <img src="./modules/cms/ui/themes/default/images/icon/icon/create.png" />
                <span><?php echo encodeHtml(htmlentities(@lang('menu_folder_createfile'))) ?>
                </span>
              </a>
            </td>
          </tr>
          <tr class="data">
            <td colspan="2">
              <a target="_self" data-type="modal" data-action="folder" data-method="createlink" data-id="" data-extra="[]" href="/#/folder/">
                <img src="./modules/cms/ui/themes/default/images/icon/icon/create.png" />
                <span><?php echo encodeHtml(htmlentities(@lang('menu_folder_createlink'))) ?>
                </span>
              </a>
            </td>
          </tr>
        </table>
      </div>
    </div>
 <?php } ?>