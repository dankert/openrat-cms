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
                  <span>
                  </span>
                </td>
                <td>
                  <span>
                  </span>
                </td>
              </tr>
              <?php foreach($el as $list_key=>$list_value) { extract($list_value); ?>
                <tr class="data">
                  <td>
                    <a target="_self" data-action="" data-method="" data-id="" data-extra="[]" href="/#//">
                      <img src="./modules/cms/ui/themes/default/images/icon/icon_model.png" />
                      <span><?php echo encodeHtml(htmlentities(@$name)) ?>
                      </span>
                    </a>
                  </td>
                  <td>
                    <?php $if1=(isset($default_url)); if($if1) {  ?>
                      <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_make_default'))) ?>
                      </span>
                     <?php } ?>
                    <?php if(!$if1) {  ?>
                      <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_is_default'))) ?>
                      </span>
                     <?php } ?>
                  </td>
                  <td>
                    <?php $if1=(isset($select_url)); if($if1) {  ?>
                      <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_select'))) ?>
                      </span>
                     <?php } ?>
                    <?php if(!$if1) {  ?>
                      <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_selected'))) ?>
                      </span>
                     <?php } ?>
                  </td>
                </tr>
                <?php  { unset($select_url) ?>
                 <?php } ?>
                <?php  { unset($default_url) ?>
                 <?php } ?>
               <?php } ?>
            </table>
          </div>
        </div>
 <?php } ?>