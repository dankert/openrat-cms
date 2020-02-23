<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="info" data-action="object" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form object">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="object" />
      <input type="hidden" name="subaction" value="info" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <fieldset class="or-group toggle-open-close open show">
          <div class="closable">
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('global_name'))) ?>
                </span>
              </div>
              <div class="input">
                <span class="name"><?php echo encodeHtml(htmlentities(@$name)) ?>
                </span>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('global_filename'))) ?>
                </span>
              </div>
              <div class="input">
                <span class="filename"><?php echo encodeHtml(htmlentities(@$filename)) ?>
                </span>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('file_extension'))) ?>
                </span>
              </div>
              <div class="input">
                <span class="extension"><?php echo encodeHtml(htmlentities(@$extension)) ?>
                </span>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('global_description'))) ?>
                </span>
              </div>
              <div class="input">
                <span><?php echo encodeHtml(htmlentities(@$description)) ?>
                </span>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('additional_info'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <div class="line">
              <div class="label">
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('global_full_filename'))) ?>
                  </span>
                </label>
              </div>
              <div class="input">
                <span><?php echo encodeHtml(htmlentities(@$full_filename)) ?>
                </span>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('FILE_SIZE'))) ?>
                  </span>
                </label>
              </div>
              <div class="input">
              </div>
              <span><?php echo encodeHtml(htmlentities(@$size)) ?>
              </span>
            </div>
            <div class="line">
              <div class="label">
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('FILE_mimetype'))) ?>
                  </span>
                </label>
              </div>
              <div class="input">
                <span><?php echo encodeHtml(htmlentities(@$mimetype)) ?>
                </span>
              </div>
            </div>
            <div class="line">
              <div class="label">
              </div>
              <div class="input clickable">
                <a target="_self" data-type="dialog" data-action="" data-method="size" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'size'}" href="/#//" class="action">
                  <span><?php echo encodeHtml(htmlentities(@lang('menu_file_size'))) ?>
                  </span>
                </a>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('#{id'))) ?>}
                </span>
              </div>
              <div class="input">
                <span><?php echo encodeHtml(htmlentities(@$objectid)) ?>
                </span>
              </div>
            </div>
            <?php $if1=(isset($cache_filename)); if($if1) {  ?>
              <div class="line">
                <div class="label">
                  <label class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('CACHE_FILENAME'))) ?>
                    </span>
                  </label>
                </div>
                <div class="input">
                  <span><?php echo encodeHtml(htmlentities(@$cache_filename)) ?>
                  </span>
                  <br />
                  <img src="./modules/cms/ui/themes/default/images/icon/el_date.png" />
                  <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($cache_filemtime); ?>
                   <?php } ?>
                </div>
              </div>
             <?php } ?>
            <div class="line">
              <div class="label">
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('FILE_PAGES'))) ?>
                  </span>
                </label>
              </div>
              <div class="input">
                <div class="or-table-wrapper">
                  <div class="or-table-filter">
                    <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
                  </div>
                  <div class="or-table-area">
                    <table width="100%">
                      <?php foreach($pages as $list_key=>$list_value) { extract($list_value); ?>
                        <tr>
                          <td>
                            <a target="_self" data-url="<?php echo encodeHtml(htmlentities(@$url)) ?>" data-action="" data-method="" data-id="" data-extra="[]" href="/#//">
                              <img src="./modules/cms/ui/themes/default/images/icon_page.png" />
                              <span><?php echo encodeHtml(htmlentities(@$name)) ?>
                              </span>
                            </a>
                          </td>
                        </tr>
                       <?php } ?>
                    </table>
                  </div>
                </div>
                <?php $if1=(($pages)==FALSE); if($if1) {  ?>
                  <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOT_FOUND'))) ?>
                  </span>
                 <?php } ?>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('validity'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <div class="clickable">
              <a target="_self" data-type="dialog" data-action="" data-method="settings" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'settings'}" href="/#//">
                <div class="line">
                  <div class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('global_state'))) ?>
                    </span>
                  </div>
                  <div class="input">
                    <?php $if1=($is_valid); if($if1) {  ?>
                      <span><?php echo encodeHtml(htmlentities(@lang('is_yes'))) ?>
                      </span>
                     <?php } ?>
                    <?php if(!$if1) {  ?>
                      <span><?php echo encodeHtml(htmlentities(@lang('is_no'))) ?>
                      </span>
                     <?php } ?>
                  </div>
                </div>
                <div class="line">
                  <div class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('from'))) ?>
                    </span>
                  </div>
                  <div class="input">
                    <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($valid_from_date); ?>
                     <?php } ?>
                  </div>
                </div>
                <div class="line">
                  <div class="label">
                    <span><?php echo encodeHtml(htmlentities(@lang('until'))) ?>
                    </span>
                  </div>
                  <div class="input">
                    <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($valid_to_date); ?>
                     <?php } ?>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </fieldset>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('prop_userinfo'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('global_created'))) ?>
                </span>
              </div>
              <div class="input">
                <i class="image-icon image-icon--action-el_date">
                </i>
                <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($create_date); ?>
                 <?php } ?>
                <br />
                <i class="image-icon image-icon--action-user">
                </i>
                <?php include_once( 'modules/template_engine/components/html/user/component-user.php'); { component_user($create_user); ?>
                 <?php } ?>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('global_lastchange'))) ?>
                </span>
              </div>
              <div class="input">
                <i class="image-icon image-icon--action-el_date">
                </i>
                <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastchange_date); ?>
                 <?php } ?>
                <br />
                <i class="image-icon image-icon--action-user">
                </i>
                <?php include_once( 'modules/template_engine/components/html/user/component-user.php'); { component_user($lastchange_user); ?>
                 <?php } ?>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('global_published'))) ?>
                  </span>
                </label>
              </div>
              <div class="input">
                <i class="image-icon image-icon--action-el_date">
                </i>
                <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($published_date); ?>
                 <?php } ?>
                <br />
                <i class="image-icon image-icon--action-user">
                </i>
                <?php include_once( 'modules/template_engine/components/html/user/component-user.php'); { component_user($published_user); ?>
                 <?php } ?>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('settings'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <div class="or-table-wrapper">
              <div class="or-table-filter">
                <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
              </div>
              <div class="or-table-area">
                <table width="100%">
                  <?php foreach($settings as $name=>$value) {  ?>
                    <tr class="data">
                      <td>
                        <span><?php echo encodeHtml(htmlentities(@$name)) ?>
                        </span>
                      </td>
                      <td class="clickable">
                        <a target="_self" data-type="dialog" data-action="" data-method="settings" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'settings'}" href="/#//">
                          <span><?php echo encodeHtml(htmlentities(@$value)) ?>
                          </span>
                        </a>
                      </td>
                    </tr>
                   <?php } ?>
                </table>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
      </div>
    </form>
 <?php } ?>