<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="pageelement" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form pageelement">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="pageelement" />
      <input type="hidden" name="subaction" value="prop" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="or-table-wrapper">
          <div class="or-table-filter">
            <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
          </div>
          <div class="or-table-area">
            <table width="100%">
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
                  </span>
                </td>
                <td class="name">
                  <span><?php echo encodeHtml(htmlentities(@$name)) ?>
                  </span>
                </td>
              </tr>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('description'))) ?>
                  </span>
                </td>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@$description)) ?>
                  </span>
                </td>
              </tr>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('type'))) ?>
                  </span>
                </td>
                <td class="filename">
                  <i class="image-icon image-icon--action-el_<?php echo encodeHtml(htmlentities(@$element_type)) ?>">
                  </i>
                  <span><?php echo encodeHtml(htmlentities(@lang('el_${element_type'))) ?>}
                  </span>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <fieldset class="or-group toggle-open-close open show">
                    <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('additional_info'))) ?>
                      <img />
                      <div class="arrow arrow-right on-closed">
                      </div>
                      <div class="arrow arrow-down on-open">
                      </div>
                    </legend>
                    <div class="closable">
                    </div>
                  </fieldset>
                </td>
              </tr>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('template'))) ?>
                  </span>
                </td>
                <td>
                  <?php $if1=(isset($template_url)); if($if1) {  ?>
                    <a target="_self" data-url="<?php echo encodeHtml(htmlentities(@$template_url)) ?>" data-action="" data-method="" data-id="" data-extra="[]" href="/#//">
                      <img src="./modules/cms/ui/themes/default/images/icon/icon_template.png" />
                      <span><?php echo encodeHtml(htmlentities(@$template_name)) ?>
                      </span>
                    </a>
                   <?php } ?>
                  <?php $if1=(($template_url)==FALSE); if($if1) {  ?>
                    <img src="./modules/cms/ui/themes/default/images/icon/icon_template.png" />
                    <span><?php echo encodeHtml(htmlentities(@$template_name)) ?>
                    </span>
                   <?php } ?>
                </td>
              </tr>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('element'))) ?>
                  </span>
                </td>
                <td>
                  <?php $if1=(isset($element_url)); if($if1) {  ?>
                    <a target="_self" data-url="<?php echo encodeHtml(htmlentities(@$element_url)) ?>" data-action="" data-method="" data-id="" data-extra="[]" href="/#//">
                      <i class="image-icon image-icon--action-el_<?php echo encodeHtml(htmlentities(@$element_type)) ?>">
                      </i>
                      <span><?php echo encodeHtml(htmlentities(@$element_name)) ?>
                      </span>
                    </a>
                   <?php } ?>
                  <?php $if1=(($element_url)==FALSE); if($if1) {  ?>
                    <img src="./modules/cms/ui/themes/default/images/icon/element.png" />
                    <span><?php echo encodeHtml(htmlentities(@$element_name)) ?>
                    </span>
                   <?php } ?>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <fieldset class="or-group toggle-open-close open show">
                    <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('prop_userinfo'))) ?>
                      <img />
                      <div class="arrow arrow-right on-closed">
                      </div>
                      <div class="arrow arrow-down on-open">
                      </div>
                    </legend>
                    <div class="closable">
                    </div>
                  </fieldset>
                </td>
              </tr>
              <tr>
                <td>
                  <span><?php echo encodeHtml(htmlentities(@lang('lastchange'))) ?>
                  </span>
                </td>
                <td>
                  <div class="or-table-wrapper">
                    <div class="or-table-filter">
                      <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
                    </div>
                    <div class="or-table-area">
                      <table width="100%">
                        <tr>
                          <td>
                            <img src="./modules/cms/ui/themes/default/images/icon/el_date.png" />
                            <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastchange_date); ?>
                             <?php } ?>
                          </td>
                          <td>
                            <img src="./modules/cms/ui/themes/default/images/icon/user.png" />
                            <?php include_once( 'modules/template_engine/components/html/user/component-user.php'); { component_user($lastchange_user); ?>
                             <?php } ?>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>