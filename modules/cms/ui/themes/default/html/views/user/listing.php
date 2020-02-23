<?php if (defined('OR_TITLE')) {  ?>
  
    
      
        <div class="or-table-wrapper">
          <div class="or-table-filter">
            <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
          </div>
          <div class="or-table-area">
            <table width="100%">
              <tr class="headline">
                <td>
                  <img src="./modules/cms/ui/themes/default/images/icon_user.png" />
                  <span><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
                  </span>
                </td>
                <td>
                  <span>
                  </span>
                </td>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('LOGIN'))) ?>
                  </span>
                </td>
              </tr>
              <?php foreach($el as $list_key=>$list_value) { extract($list_value); ?>
                <tr class="data">
                  <td>
                    <img src="./modules/cms/ui/themes/default/images/icon_user.png" />
                    <span><?php echo encodeHtml(htmlentities(@$name)) ?>
                    </span>
                  </td>
                  <td>
                    <span><?php echo encodeHtml(htmlentities(@$fullname)) ?>
                    </span>
                    <?php $if1=($isAdmin); if($if1) {  ?>
                      <span> (
                      </span>
                      <span><?php echo encodeHtml(htmlentities(@lang('USER_ADMIN'))) ?>
                      </span>
                      <span>)
                      </span>
                     <?php } ?>
                  </td>
                  <td>
                    <a target="_self" data-action="index" data-method="switchuser" data-id="<?php echo encodeHtml(htmlentities(@$userid)) ?>" data-extra="[]" href="/#/index/<?php echo encodeHtml(htmlentities(@$userid)) ?>">
                      <span><?php echo encodeHtml(htmlentities(@lang('LOGIN'))) ?>
                      </span>
                    </a>
                  </td>
                </tr>
               <?php } ?>
            </table>
          </div>
        </div>
 <?php } ?>