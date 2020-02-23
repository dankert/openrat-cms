<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="or-table-wrapper">
      <div class="or-table-filter">
        <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
      </div>
      <div class="or-table-area">
        <table width="100%">
          <tr class="headline">
            <td>
              <span><?php echo encodeHtml(htmlentities(@lang('project'))) ?>
              </span>
            </td>
            <td>
              <span><?php echo encodeHtml(htmlentities(@lang('filename'))) ?>
              </span>
            </td>
            <td>
              <span><?php echo encodeHtml(htmlentities(@lang('user_username'))) ?>
              </span>
            </td>
            <td>
              <span><?php echo encodeHtml(htmlentities(@lang('lastchange'))) ?>
              </span>
            </td>
          </tr>
          <?php foreach($timeline as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="data">
              <td class="clickable">
                <a target="_self" data-type="post" data-action="start" data-method="projectmenu" data-id="<?php echo encodeHtml(htmlentities(@$projectid)) ?>" data-extra="[]" data-data="{"action":"start","subaction":"projectmenu","id":"<?php echo encodeHtml(htmlentities(@$projectid)) ?>",\"token":"<?php echo token() ?>","none":"0"}"">
                  <span><?php echo encodeHtml(htmlentities(@$projectname)) ?>
                  </span>
                </a>
              </td>
              <td>
                <span><?php echo encodeHtml(htmlentities(@$filename)) ?>
                </span>
              </td>
              <td>
                <span><?php echo encodeHtml(htmlentities(@$username)) ?>
                </span>
              </td>
              <td>
                <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastchange_date); ?>
                 <?php } ?>
              </td>
            </tr>
           <?php } ?>
        </table>
      </div>
    </div>
 <?php } ?>