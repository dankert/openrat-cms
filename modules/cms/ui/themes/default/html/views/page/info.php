<?php if (defined('OR_TITLE')) {  ?>
  
    
    <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('info') ?>" data-action="<?php echo escapeHtml('page') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form page') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('page') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('info') ?>" /><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
      <div><?php echo escapeHtml('') ?>
        <span class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml(''.@$name.'') ?>
        </span>
        <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
          <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('type').'') ?>
                </span>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang(''.@$type.'').'') ?>
                </span>
              </div>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('global_filename').'') ?>
                </span>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@$filename.'') ?>
                </span>
              </div>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('global_description').'') ?>
                </span>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <span class="<?php echo escapeHtml('description') ?>"><?php echo escapeHtml(''.@$description.'') ?>
                </span>
              </div>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('input clickable') ?>"><?php echo escapeHtml('') ?>
                <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('prop') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'prop\'}') ?>" href="<?php echo escapeHtml('/#//') ?>" class="<?php echo escapeHtml('or-link-btn') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('edit').'') ?>
                  </span>
                </a>
              </div>
            </div>
          </div>
        </fieldset>
        <?php foreach((array)$languages as $list_key=>$list_value) { extract($list_value); ?>
          <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
            <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@$languagename.'') ?>
              <img /><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
              </div>
            </legend>
            <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
              <label class="<?php echo escapeHtml('or-form-row') ?>"><?php echo escapeHtml('') ?>
                <span class="<?php echo escapeHtml('or-form-input') ?>"><?php echo escapeHtml('') ?>
                </span>
                <span class="<?php echo escapeHtml('or-form-label') ?>"><?php echo escapeHtml(''.@lang('name').'') ?>
                </span>
              </label>
              <label class="<?php echo escapeHtml('or-form-row') ?>"><?php echo escapeHtml('') ?>
                <span class="<?php echo escapeHtml('or-form-input') ?>"><?php echo escapeHtml('') ?>
                </span>
                <span class="<?php echo escapeHtml('or-form-label') ?>"><?php echo escapeHtml(''.@lang('description').'') ?>
                </span>
              </label>
              <label class="<?php echo escapeHtml('or-form-row') ?>"><?php echo escapeHtml('') ?>
                <span class="<?php echo escapeHtml('or-form-input') ?>"><?php echo escapeHtml('') ?>
                </span>
                <span class="<?php echo escapeHtml('or-form-label') ?>"><?php echo escapeHtml(''.@lang('alias').'') ?>
                </span>
              </label>
              <div class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
                <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('edit') ?>" data-action="<?php echo escapeHtml('page') ?>" data-method="<?php echo escapeHtml('name') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'languageid\':\''.@$languageid.'\'}') ?>" href="<?php echo escapeHtml('/#/page/') ?>" class="<?php echo escapeHtml('or-link-btn') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('edit').'') ?>
                  </span>
                </a>
              </div>
            </div>
          </fieldset>
         <?php } ?>
        <fieldset class="<?php echo escapeHtml('or-group toggle-open-close closed show') ?>"><?php echo escapeHtml('') ?>
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
                <span class="<?php echo escapeHtml('filename') ?>"><?php echo escapeHtml(''.@$full_filename.'') ?>
                </span>
              </div>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('global_full_filename').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <span class="<?php echo escapeHtml('filename') ?>"><?php echo escapeHtml(''.@$tmp_filename.'') ?>
                </span>
              </div>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('global_template').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <?php $if1=(isset($templateid)); if($if1) {  ?>
                  <div class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
                    <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('open') ?>" data-action="<?php echo escapeHtml('template') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml(''.@$templateid.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/template/'.@$templateid.'') ?>"><?php echo escapeHtml('') ?>
                      <i class="<?php echo escapeHtml('image-icon image-icon--action-template') ?>"><?php echo escapeHtml('') ?>
                      </i>
                      <span><?php echo escapeHtml(''.@$template_name.'') ?>
                      </span>
                    </a>
                  </div>
                 <?php } ?>
                <?php if(!$if1) {  ?>
                  <i class="<?php echo escapeHtml('image-icon image-icon--action-template') ?>"><?php echo escapeHtml('') ?>
                  </i>
                  <span><?php echo escapeHtml(''.@$template_name.'') ?>
                  </span>
                 <?php } ?>
              </div>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('FILE_MIMETYPE').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <span class="<?php echo escapeHtml('filename') ?>"><?php echo escapeHtml(''.@$mime_type.'') ?>
                </span>
              </div>
            </div>
            <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('id').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@$objectid.'') ?>
                </span>
              </div>
            </div>
          </div>
        </fieldset>
        
          <fieldset class="<?php echo escapeHtml('or-group toggle-open-close closed show') ?>"><?php echo escapeHtml('') ?>
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
                  <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(''.@lang('global_created').'') ?>
                    </span>
                  </label>
                </div>
                <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                  <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/el_date.png') ?>" /><?php echo escapeHtml('') ?>
                  <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($create_date); ?>
                   <?php } ?>
                  <br /><?php echo escapeHtml('') ?>
                  <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/user.png') ?>" /><?php echo escapeHtml('') ?>
                  <?php include_once( 'modules/template_engine/components/html/user/component-user.php'); { component_user($create_user); ?>
                   <?php } ?>
                </div>
              </div>
              <div class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                  <label class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(''.@lang('global_lastchange').'') ?>
                    </span>
                  </label>
                </div>
                <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                  <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/el_date.png') ?>" /><?php echo escapeHtml('') ?>
                  <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastchange_date); ?>
                   <?php } ?>
                  <br /><?php echo escapeHtml('') ?>
                  <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/user.png') ?>" /><?php echo escapeHtml('') ?>
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
                  <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/el_date.png') ?>" /><?php echo escapeHtml('') ?>
                  <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($published_date); ?>
                   <?php } ?>
                  <br /><?php echo escapeHtml('') ?>
                  <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/user.png') ?>" /><?php echo escapeHtml('') ?>
                  <?php include_once( 'modules/template_engine/components/html/user/component-user.php'); { component_user($published_user); ?>
                   <?php } ?>
                </div>
              </div>
            </div>
          </fieldset>
      </div>
      <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
      </div>
    </form>
 <?php } ?>