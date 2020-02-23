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
            <?php $if1=($typeid=='1'); if($if1) {  ?>
              <?php  { $type= 'folder'; ?>
               <?php } ?>
             <?php } ?>
            <?php $if1=($typeid=='2'); if($if1) {  ?>
              <?php  { $type= 'file'; ?>
               <?php } ?>
             <?php } ?>
            <?php $if1=($typeid=='4'); if($if1) {  ?>
              <?php  { $type= 'link'; ?>
               <?php } ?>
             <?php } ?>
            <?php $if1=($typeid=='3'); if($if1) {  ?>
              <?php  { $type= 'page'; ?>
               <?php } ?>
             <?php } ?>
            <tr class="data">
              <td class="clickable">
                <a target="_self" date-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-type="open" data-action="<?php echo encodeHtml(htmlentities(@$type)) ?>" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$objectid)) ?>" data-extra="[]" href="/#/<?php echo encodeHtml(htmlentities(@$type)) ?>/<?php echo encodeHtml(htmlentities(@$objectid)) ?>">
                  <span><?php echo encodeHtml(htmlentities(@$name)) ?>
                  </span>
                </a>
              </td>
              <td>
                <span><?php echo encodeHtml(htmlentities(@$filename)) ?>
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