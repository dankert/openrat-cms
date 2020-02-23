<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="diff" data-action="pageelement" data-id="<?php echo OR_ID ?>" method="get" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form pageelement">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="pageelement" />
      <input type="hidden" name="subaction" value="diff" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="or-table-wrapper">
          <div class="or-table-filter">
            <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
          </div>
          <div class="or-table-area">
            <table width="100%">
              <tr class="headline">
                <td class="help">
                  <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NR'))) ?>
                  </span>
                </td>
                <td colspan="2" class="help">
                  <?php $if1=(isset($compareid)); if($if1) {  ?>
                    <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_COMPARE'))) ?>
                    </span>
                   <?php } ?>
                  <?php if(!$if1) {  ?>
                    <span> 
                    </span>
                   <?php } ?>
                </td>
                <td class="help">
                  <span><?php echo encodeHtml(htmlentities(@lang('DATE'))) ?>
                  </span>
                </td>
                <td class="help">
                  <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_USER'))) ?>
                  </span>
                </td>
                <td class="help">
                  <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_VALUE'))) ?>
                  </span>
                </td>
                <td class="help">
                  <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_STATE'))) ?>
                  </span>
                </td>
                <td class="help">
                  <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_ACTION'))) ?>
                  </span>
                </td>
              </tr>
              <?php $if1=(($el)==FALSE); if($if1) {  ?>
                <tr>
                  <td colspan="8">
                    <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOT_FOUND'))) ?>
                    </span>
                  </td>
                </tr>
               <?php } ?>
              <?php foreach($el as $list_key=>$list_value) { extract($list_value); ?>
                <tr class="data">
                  <td>
                    <span><?php echo encodeHtml(htmlentities(@$lfd_nr)) ?>
                    </span>
                  </td>
                  <td>
                    <?php $if1=(isset($compareid)); if($if1) {  ?>
                      <input type="radio" name="compareid" disabled="" value="<?php echo encodeHtml(htmlentities(@$id)) ?>" checked="<?php echo encodeHtml(htmlentities(@$compareid)) ?>" />
                     <?php } ?>
                    <?php if(!$if1) {  ?>
                      <span> 
                      </span>
                     <?php } ?>
                  </td>
                  <td>
                    <?php $if1=(isset($compareid)); if($if1) {  ?>
                      <input type="radio" name="withid" disabled="" value="<?php echo encodeHtml(htmlentities(@$id)) ?>" checked="<?php echo encodeHtml(htmlentities(@$withid)) ?>" />
                     <?php } ?>
                    <?php if(!$if1) {  ?>
                      <span> 
                      </span>
                     <?php } ?>
                  </td>
                  <td>
                    <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($date); ?>
                     <?php } ?>
                  </td>
                  <td>
                    <span><?php echo encodeHtml(htmlentities(@$user)) ?>
                    </span>
                  </td>
                  <td>
                    <span><?php echo encodeHtml(htmlentities(@$value)) ?>
                    </span>
                  </td>
                  <?php $if1=($public); if($if1) {  ?>
                    <td>
                      <strong><?php echo encodeHtml(htmlentities(@lang('GLOBAL_PUBLIC'))) ?>
                      </strong>
                    </td>
                   <?php } ?>
                  <?php if(!$if1) {  ?>
                    <?php $if1=(isset($releaseUrl)); if($if1) {  ?>
                      <td class="clickable">
                        <a title="<?php echo encodeHtml(htmlentities(@lang('GLOBAL_RELEASE_DESC'))) ?>" target="_self" data-type="post" data-action="" data-method="release" data-id="<?php echo encodeHtml(htmlentities(@$objectid)) ?>" data-extra="{'valueid':'<?php echo encodeHtml(htmlentities(@$valueid)) ?>'}" data-data="{"action":"pageelement","subaction":"release","id":"<?php echo encodeHtml(htmlentities(@$objectid)) ?>",\"token":"<?php echo token() ?>","valueid":"<?php echo encodeHtml(htmlentities(@$valueid)) ?>","none":"0"}"">
                          <strong><?php echo encodeHtml(htmlentities(@lang('GLOBAL_RELEASE'))) ?>
                          </strong>
                        </a>
                      </td>
                     <?php } ?>
                    <?php if(!$if1) {  ?>
                      <td>
                        <em><?php echo encodeHtml(htmlentities(@lang('GLOBAL_INACTIVE'))) ?>
                        </em>
                      </td>
                     <?php } ?>
                   <?php } ?>
                  <?php $if1=($active); if($if1) {  ?>
                    <td>
                      <em><?php echo encodeHtml(htmlentities(@lang('GLOBAL_ACTIVE'))) ?>
                      </em>
                    </td>
                   <?php } ?>
                  <?php if(!$if1) {  ?>
                    <?php $if1=(isset($useUrl)); if($if1) {  ?>
                      <td class="clickable">
                        <a title="<?php echo encodeHtml(htmlentities(@lang('GLOBAL_USE_DESC'))) ?>" target="_self" data-type="post" data-action="" data-method="use" data-id="<?php echo encodeHtml(htmlentities(@$objectid)) ?>" data-extra="{'valueid':'<?php echo encodeHtml(htmlentities(@$valueid)) ?>'}" data-data="{"action":"pageelement","subaction":"use","id":"<?php echo encodeHtml(htmlentities(@$objectid)) ?>",\"token":"<?php echo token() ?>","valueid":"<?php echo encodeHtml(htmlentities(@$valueid)) ?>","none":"0"}"">
                          <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_USE'))) ?>
                          </span>
                        </a>
                      </td>
                     <?php } ?>
                    <?php if(!$if1) {  ?>
                      <td>
                      </td>
                     <?php } ?>
                   <?php } ?>
                </tr>
               <?php } ?>
            </table>
          </div>
        </div>
      </div>
      <div class="or-form-actionbar">
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('compare'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>