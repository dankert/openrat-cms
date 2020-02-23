<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="or-table-wrapper">
      <div class="or-table-filter">
        <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
      </div>
      <div class="or-table-area">
        <table width="100%">
          <tr>
            <td>
            </td>
            <td>
              <em><?php echo encodeHtml(htmlentities(@lang('GLOBAL_COMPARE'))) ?>
              </em>
              <span> 
              </span>
              <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($date_left); ?>
               <?php } ?>
            </td>
            <td>
            </td>
            <td>
              <em><?php echo encodeHtml(htmlentities(@lang('GLOBAL_WITH'))) ?>
              </em>
              <span> 
              </span>
              <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($date_right); ?>
               <?php } ?>
            </td>
          </tr>
          <tr>
            <td colspan="4">
            </td>
          </tr>
          <?php foreach($diff as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="diff">
              <?php $if1=(isset($left)); if($if1) {  ?>
                <td width="5%" class="line">
                  <tt><?php echo encodeHtml(htmlentities(@$left['line'])) ?>
                  </tt>
                </td>
                <td width="45%" class="<?php echo encodeHtml(htmlentities(@$left['type'])) ?>">
                  <span><?php echo encodeHtml(htmlentities(@$left['text'])) ?>
                  </span>
                </td>
               <?php } ?>
              <?php if(!$if1) {  ?>
                <td width="50%" colspan="2" class="help">
                  <span> 
                  </span>
                </td>
               <?php } ?>
              <?php $if1=(isset($right)); if($if1) {  ?>
                <td width="5%" class="line">
                  <tt><?php echo encodeHtml(htmlentities(@$right['line'])) ?>
                  </tt>
                </td>
                <td width="45%" class="<?php echo encodeHtml(htmlentities(@$right['type'])) ?>">
                  <span><?php echo encodeHtml(htmlentities(@$right['text'])) ?>
                  </span>
                </td>
               <?php } ?>
              <?php if(!$if1) {  ?>
                <td width="50%" colspan="2" class="help">
                  <span> 
                  </span>
                </td>
               <?php } ?>
            </tr>
            <?php  { unset($left) ?>
             <?php } ?>
            <?php  { unset($right) ?>
             <?php } ?>
           <?php } ?>
        </table>
      </div>
    </div>
    
 <?php } ?>