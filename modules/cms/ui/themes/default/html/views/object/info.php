<?php /* THIS FILE IS GENERATED from info.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('info') ?>" data-action="<?php echo O::escapeHtml('object') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-object') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('object') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('info') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml('') ?>
        </h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('name').'') ?>
                </span>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <span class="<?php echo O::escapeHtml('or-name') ?>"><?php echo O::escapeHtml(''.@$name.'') ?>
                </span>
              </div>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('filename').'') ?>
                </span>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <span class="<?php echo O::escapeHtml('or-filename') ?>"><?php echo O::escapeHtml(''.@$filename.'') ?>
                </span>
              </div>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('file_extension').'') ?>
                </span>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <span class="<?php echo O::escapeHtml('or-extension') ?>"><?php echo O::escapeHtml(''.@$extension.'') ?>
                </span>
              </div>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('description').'') ?>
                </span>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@$description.'') ?>
                </span>
              </div>
            </div>
          </section>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml(''.@O::lang('additional_info').'') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?>
          </i>
        </h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('full_filename').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@$full_filename.'') ?>
                </span>
              </div>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('FILE_SIZE').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
              </div>
              <span><?php echo O::escapeHtml(''.@$size.'') ?>
              </span>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('FILE_mimetype').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@$mimetype.'') ?>
                </span>
              </div>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
              </div>
              <div class="<?php echo O::escapeHtml('or-value or-clickable') ?>"><?php echo O::escapeHtml('') ?>
                <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('size') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('size') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'size\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>" class="<?php echo O::escapeHtml('or-action') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('menu_file_size').'') ?>
                  </span>
                </a>
              </div>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang(''.@O::lang('id').'').'') ?>
                </span>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@$objectid.'') ?>
                </span>
              </div>
            </div>
          </section>
          <?php $if1=(isset($cache_filename)); if($if1) {  ?>
            <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
              <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
              </h3>
              <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                  <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@O::lang('CACHE_FILENAME').'') ?>
                    </span>
                  </label>
                </div>
                <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@$cache_filename.'') ?>
                  </span>
                  <br /><?php echo O::escapeHtml('') ?>
                  <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon/el_date.png') ?>" /><?php echo O::escapeHtml('') ?>
                  <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($cache_filemtime); ?>
                   <?php } ?>
                </div>
              </div>
            </section>
           <?php } ?>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('FILE_PAGES').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
                  <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
                    <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                  </div>
                  <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
                    <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
                      <?php foreach((array)$pages as $list_key=>$list_value) { extract($list_value); ?>
                        <tr><?php echo O::escapeHtml('') ?>
                          <td><?php echo O::escapeHtml('') ?>
                            <a target="<?php echo O::escapeHtml('_self') ?>" data-url="<?php echo O::escapeHtml(''.@$url.'') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                              <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon_page.png') ?>" /><?php echo O::escapeHtml('') ?>
                              <span><?php echo O::escapeHtml(''.@$name.'') ?>
                              </span>
                            </a>
                          </td>
                        </tr>
                       <?php } ?>
                    </table>
                  </div>
                </div>
                <?php $if1=(($pages)==FALSE); if($if1) {  ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('NOT_FOUND').'') ?>
                  </span>
                 <?php } ?>
              </div>
            </div>
          </section>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml(''.@O::lang('validity').'') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?>
          </i>
        </h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-clickable') ?>"><?php echo O::escapeHtml('') ?>
            <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('settings') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('settings') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'settings\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
              <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
                </h3>
                <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                  <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@O::lang('state').'') ?>
                    </span>
                  </div>
                  <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                    <?php $if1=($is_valid); if($if1) {  ?>
                      <span><?php echo O::escapeHtml(''.@O::lang('is_yes').'') ?>
                      </span>
                     <?php } ?>
                    <?php if(!$if1) {  ?>
                      <span><?php echo O::escapeHtml(''.@O::lang('is_no').'') ?>
                      </span>
                     <?php } ?>
                  </div>
                </div>
              </section>
              <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
                </h3>
                <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                  <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@O::lang('from').'') ?>
                    </span>
                  </div>
                  <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                    <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($valid_from_date); ?>
                     <?php } ?>
                  </div>
                </div>
              </section>
              <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
                <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
                </h3>
                <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
                  <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@O::lang('until').'') ?>
                    </span>
                  </div>
                  <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                    <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($valid_to_date); ?>
                     <?php } ?>
                  </div>
                </div>
              </section>
            </a>
          </div>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml(''.@O::lang('prop_userinfo').'') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?>
          </i>
        </h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('created').'') ?>
                </span>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-el_date') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($create_date); ?>
                 <?php } ?>
                <br /><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-user') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <?php include_once( 'modules/template_engine/components/html/component_user/component-user.php'); { component_user($create_user); ?>
                 <?php } ?>
              </div>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('lastchange').'') ?>
                </span>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-el_date') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($lastchange_date); ?>
                 <?php } ?>
                <br /><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-user') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <?php include_once( 'modules/template_engine/components/html/component_user/component-user.php'); { component_user($lastchange_user); ?>
                 <?php } ?>
              </div>
            </div>
          </section>
          <section class="<?php echo O::escapeHtml('or-fieldset') ?>"><?php echo O::escapeHtml('') ?>
            <h3 class="<?php echo O::escapeHtml('or-fieldset-label') ?>"><?php echo O::escapeHtml('') ?>
            </h3>
            <div class="<?php echo O::escapeHtml('or-fieldset-value') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                <label class="<?php echo O::escapeHtml('or-label') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('published').'') ?>
                  </span>
                </label>
              </div>
              <div class="<?php echo O::escapeHtml('or-value') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-el_date') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($published_date); ?>
                 <?php } ?>
                <br /><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--action-user') ?>"><?php echo O::escapeHtml('') ?>
                </i>
                <?php include_once( 'modules/template_engine/components/html/component_user/component-user.php'); { component_user($published_user); ?>
                 <?php } ?>
              </div>
            </div>
          </section>
        </div>
      </section>
      <section class="<?php echo O::escapeHtml('or-group or-collapsible or-collapsible--is-open or-collapsible--show') ?>"><?php echo O::escapeHtml('') ?>
        <h2 class="<?php echo O::escapeHtml('or-collapsible-title or-group-title or-collapsible-act-switch') ?>"><?php echo O::escapeHtml(''.@O::lang('settings').'') ?>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-closed or-collapsible--on-closed') ?>"><?php echo O::escapeHtml('') ?>
          </i>
          <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--node-open or-collapsible--on-open') ?>"><?php echo O::escapeHtml('') ?>
          </i>
        </h2>
        <div class="<?php echo O::escapeHtml('or-collapsible-value or-group-value') ?>"><?php echo O::escapeHtml('') ?>
          <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
              <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
            </div>
            <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
              <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
                <?php foreach((array)$settings as $name=>$value) {  ?>
                  <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
                    <td><?php echo O::escapeHtml('') ?>
                      <span><?php echo O::escapeHtml(''.@$name.'') ?>
                      </span>
                    </td>
                    <td class="<?php echo O::escapeHtml('or-clickable') ?>"><?php echo O::escapeHtml('') ?>
                      <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('dialog') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('settings') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-dialogAction="<?php echo O::escapeHtml('') ?>" data-extra-dialogMethod="<?php echo O::escapeHtml('settings') ?>" data-extra="<?php echo O::escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'settings\'}') ?>" href="<?php echo O::escapeHtml('/#//') ?>"><?php echo O::escapeHtml('') ?>
                        <span><?php echo O::escapeHtml(''.@$value.'') ?>
                        </span>
                      </a>
                    </td>
                  </tr>
                 <?php } ?>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--secondary or-act-form-cancel') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-cancel') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?>
        </span>
      </div>
    </div>
  </form>