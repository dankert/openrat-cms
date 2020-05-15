<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('info') ?>" data-action="<?php echo escapeHtml('file') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form file') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('file') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('info') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
      <div><?php echo escapeHtml('') ?>
        <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('global_name').'') ?>
                </span>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <span class="<?php echo escapeHtml('name') ?>"><?php echo escapeHtml(''.@$name.'') ?>
                </span>
              </div>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('global_filename').'') ?>
                </span>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <span class="<?php echo escapeHtml('filename') ?>"><?php echo escapeHtml(''.@$filename.'') ?>
                </span>
              </div>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('file_extension').'') ?>
                </span>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <span class="<?php echo escapeHtml('extension') ?>"><?php echo escapeHtml(''.@$extension.'') ?>
                </span>
              </div>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('global_description').'') ?>
                </span>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@$description.'') ?>
                </span>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
          <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('additional_info').'') ?>
            <img /><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('global_full_filename').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@$full_filename.'') ?>
                </span>
              </div>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('FILE_SIZE').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
              </div>
              <span><?php echo escapeHtml(''.@$size.'') ?>
              </span>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('FILE_mimetype').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@$mimetype.'') ?>
                </span>
                <br /><?php echo escapeHtml('') ?>
                <a target="<?php echo escapeHtml('_self') ?>" data-action="<?php echo escapeHtml('file') ?>" data-method="<?php echo escapeHtml('size') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/file/') ?>" class="<?php echo escapeHtml('action') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('menu_file_size').'') ?>
                  </span>
                </a>
              </div>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang(''.@lang('id').'').'') ?>
                </span>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@$objectid.'') ?>
                </span>
              </div>
            </div>
            <?php $if1=(isset($cache_filename)); if($if1) {  ?>
              <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(''.@lang('CACHE_FILENAME').'') ?>
                    </span>
                  </label>
                </div>
                <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@$cache_filename.'') ?>
                  </span>
                  <br /><?php echo escapeHtml('') ?>
                  <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/el_date.png') ?>" /><?php echo escapeHtml('') ?>
                  <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($cache_filemtime); ?>
                   <?php } ?>
                </div>
              </div>
             <?php } ?>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('FILE_PAGES').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
                  <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
                    <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
                  </div>
                  <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
                    <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
                      <?php foreach((array)$pages as $list_key=>$list_value) { extract($list_value); ?>
                        <tr><?php echo escapeHtml('') ?>
                          <td><?php echo escapeHtml('') ?>
                            <a target="<?php echo escapeHtml('_self') ?>" data-url="<?php echo escapeHtml(''.@$url.'') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                              <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon_page.png') ?>" /><?php echo escapeHtml('') ?>
                              <span><?php echo escapeHtml(''.@$name.'') ?>
                              </span>
                            </a>
                          </td>
                        </tr>
                       <?php } ?>
                    </table>
                  </div>
                </div>
                <?php $if1=(($pages)==FALSE); if($if1) {  ?>
                  <span><?php echo escapeHtml(''.@lang('GLOBAL_NOT_FOUND').'') ?>
                  </span>
                 <?php } ?>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
          <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@lang('prop_userinfo').'') ?>
            <img /><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
            </div>
            <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
            </div>
          </legend>
          <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('global_created').'') ?>
                </span>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <i class="<?php echo escapeHtml('image-icon image-icon--action-el_date') ?>"><?php echo escapeHtml('') ?>
                </i>
                <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($create_date); ?>
                 <?php } ?>
                <br /><?php echo escapeHtml('') ?>
                <i class="<?php echo escapeHtml('image-icon image-icon--action-user') ?>"><?php echo escapeHtml('') ?>
                </i>
                <?php include_once( 'modules/template_engine/components/html/user/component-user.php'); { component_user($create_user); ?>
                 <?php } ?>
              </div>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('global_lastchange').'') ?>
                </span>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <i class="<?php echo escapeHtml('image-icon image-icon--action-el_date') ?>"><?php echo escapeHtml('') ?>
                </i>
                <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastchange_date); ?>
                 <?php } ?>
                <br /><?php echo escapeHtml('') ?>
                <i class="<?php echo escapeHtml('image-icon image-icon--action-user') ?>"><?php echo escapeHtml('') ?>
                </i>
                <?php include_once( 'modules/template_engine/components/html/user/component-user.php'); { component_user($lastchange_user); ?>
                 <?php } ?>
              </div>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('global_published').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <i class="<?php echo escapeHtml('image-icon image-icon--action-el_date') ?>"><?php echo escapeHtml('') ?>
                </i>
                <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($published_date); ?>
                 <?php } ?>
                <br /><?php echo escapeHtml('') ?>
                <i class="<?php echo escapeHtml('image-icon image-icon--action-user') ?>"><?php echo escapeHtml('') ?>
                </i>
                <?php include_once( 'modules/template_engine/components/html/user/component-user.php'); { component_user($published_user); ?>
                 <?php } ?>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
      <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
      </div>
    </form>
 <?php } ?>