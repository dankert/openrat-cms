<?php /* THIS FILE IS GENERATED from projectmenu.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td colspan="<?php echo O::escapeHtml('2') ?>" class="<?php echo O::escapeHtml('or-logo') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('or-logo') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('or-logo-icon') ?>"><?php echo O::escapeHtml('') ?>
                <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--method-projectmenu') ?>"><?php echo O::escapeHtml('') ?>
                </i>
              </div>
              <div class="<?php echo O::escapeHtml('or-logo-description') ?>"><?php echo O::escapeHtml('') ?>
                <h2 class="<?php echo O::escapeHtml('or-logo-headline') ?>"><?php echo O::escapeHtml(''.@O::lang('logo_projectmenu').'') ?>
                </h2>
                <p class="<?php echo O::escapeHtml('or-logo-text') ?>"><?php echo O::escapeHtml(''.@O::lang('logo_projectmenu_text').'') ?>
                </p>
              </div>
            </div>
          </td>
        </tr>
        <tr class="<?php echo O::escapeHtml('or-headline') ?>"><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('project').'') ?>
            </span>
          </td>
        </tr>
        <?php foreach((array)$projects as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
            <td class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('TREE_CHOOSE_PROJECT').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('post') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" data-data="<?php echo O::escapeHtml('{"action":"start","subaction":"projectmenu","id":"'.@$id.'","token":"'.@$_token.'","none":"0"}') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                <?php  { $project= project; ?>
                 <?php } ?>
                <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon_project.png') ?>" /><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@$name.'') ?>
                </span>
              </a>
              <div class="<?php echo O::escapeHtml('or-onrowvisible') ?>"><?php echo O::escapeHtml('') ?>
                <div class="<?php echo O::escapeHtml('or-arrow-down') ?>"><?php echo O::escapeHtml('') ?>
                </div>
                <div class="<?php echo O::escapeHtml('or-dropdown') ?>"><?php echo O::escapeHtml('') ?>
                  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('project') ?>" data-action="<?php echo O::escapeHtml('index') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-index') ?>"><?php echo O::escapeHtml('') ?>
                    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?>
                    </div>
                    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
                      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
                      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('index') ?>" /><?php echo O::escapeHtml('') ?>
                      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('project') ?>" /><?php echo O::escapeHtml('') ?>
                      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$id.'') ?>" /><?php echo O::escapeHtml('') ?>
                      <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
                        <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
                          <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                        </div>
                        <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
                          <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
                            <tr><?php echo O::escapeHtml('') ?>
                              <td><?php echo O::escapeHtml('') ?>
                                <?php foreach( $models as $_key=>$_value) {  ?>
                                  <label><?php echo O::escapeHtml('') ?>
                                    <input type="<?php echo O::escapeHtml('radio') ?>" name="<?php echo O::escapeHtml('modelid') ?>" value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==${defaultmodelid}){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                                    <span><?php echo O::escapeHtml(''.@$_value.'') ?>
                                    </span>
                                  </label>
                                  <br /><?php echo O::escapeHtml('') ?>
                                 <?php } ?>
                              </td>
                              <td><?php echo O::escapeHtml('') ?>
                                <?php foreach( $languages as $_key=>$_value) {  ?>
                                  <label><?php echo O::escapeHtml('') ?>
                                    <input type="<?php echo O::escapeHtml('radio') ?>" name="<?php echo O::escapeHtml('languageid') ?>" value="<?php echo O::escapeHtml(''.@$_key.'') ?>" <?php if($_key==${defaultlanguageid}){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
                                    <span><?php echo O::escapeHtml(''.@$_value.'') ?>
                                    </span>
                                  </label>
                                  <br /><?php echo O::escapeHtml('') ?>
                                 <?php } ?>
                              </td>
                              <td><?php echo O::escapeHtml('') ?>
                                
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
                      <div class="<?php echo O::escapeHtml('or-btn or-btn--secondary or-act-form-cancel') ?>"><?php echo O::escapeHtml('') ?>
                        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-cancel') ?>"><?php echo O::escapeHtml('') ?>
                        </i>
                        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?>
                        </span>
                      </div>
                      <div class="<?php echo O::escapeHtml('or-btn or-btn--primary or-act-form-save') ?>"><?php echo O::escapeHtml('') ?>
                        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-ok') ?>"><?php echo O::escapeHtml('') ?>
                        </i>
                        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('button_ok').'') ?>
                        </span>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </td>
          </tr>
         <?php } ?>
      </table>
    </div>
  </div>