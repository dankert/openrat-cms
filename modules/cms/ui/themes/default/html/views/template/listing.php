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
              <?php foreach($templates as $list_key=>$list_value) { extract($list_value); ?>
                <tr class="data">
                  <td>
                    <span><?php echo encodeHtml(htmlentities(@$name)) ?>
                    </span>
                  </td>
                </tr>
               <?php } ?>
            </table>
          </div>
        </div>
        <?php $if1=(($templates)==FALSE); if($if1) {  ?>
          <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NO_TEMPLATES_AVAILABLE_DESC'))) ?>
          </span>
         <?php } ?>
        <a target="_self" data-action="template" data-method="add" data-id="" data-extra="[]" href="/#/template/" class="action">
          <span><?php echo encodeHtml(htmlentities(@lang('menu_template_add'))) ?>
          </span>
        </a>
 <?php } ?>