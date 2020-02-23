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
              <span><?php echo encodeHtml(htmlentities(@lang('lastchange'))) ?>
              </span>
            </td>
          </tr>
          <?php foreach($timeline as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="data">
              <td class="clickable">
                <a target="_self" data-type="open" data-action="project" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$projectid)) ?>" data-extra="[]" href="/#/project/<?php echo encodeHtml(htmlentities(@$projectid)) ?>">
                  <span><?php echo encodeHtml(htmlentities(@$projectname)) ?>
                  </span>
                </a>
              </td>
              <td title="<?php echo encodeHtml(htmlentities(@$filename)) ?>" class="clickable">
                <a target="_self" data-type="open" data-action="<?php echo encodeHtml(htmlentities(@$type)) ?>" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$objectid)) ?>" data-extra="[]" href="/#/<?php echo encodeHtml(htmlentities(@$type)) ?>/<?php echo encodeHtml(htmlentities(@$objectid)) ?>">
                  <span><?php echo encodeHtml(htmlentities(@$filename)) ?>
                  </span>
                </a>
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