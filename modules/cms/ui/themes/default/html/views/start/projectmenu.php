<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td colspan="<?php echo O::escapeHtml('2') ?>" class="<?php echo O::escapeHtml('logo') ?>"><?php echo O::escapeHtml('') ?>
            <div class="<?php echo O::escapeHtml('line logo') ?>"><?php echo O::escapeHtml('') ?>
              <div class="<?php echo O::escapeHtml('label') ?>"><?php echo O::escapeHtml('') ?>
                <img src="<?php echo O::escapeHtml('themes/default/images/logo_projectmenu.png') ?>" border="<?php echo O::escapeHtml('') ?>" /><?php echo O::escapeHtml('') ?>
              </div>
              <div class="<?php echo O::escapeHtml('input') ?>"><?php echo O::escapeHtml('') ?>
                <h2><?php echo O::escapeHtml(''.@O::lang('logo_projectmenu').'') ?>
                </h2>
                <p><?php echo O::escapeHtml(''.@O::lang('logo_projectmenu_text').'') ?>
                </p>
              </div>
            </div>
          </td>
        </tr>
        <tr class="<?php echo O::escapeHtml('headline') ?>"><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('project').'') ?>
            </span>
          </td>
        </tr>
        <?php foreach((array)$projects as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo O::escapeHtml('data') ?>"><?php echo O::escapeHtml('') ?>
            <td class="<?php echo O::escapeHtml('clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a title="<?php echo O::escapeHtml(''.@O::lang('TREE_CHOOSE_PROJECT').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('post') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" data-data="<?php echo O::escapeHtml('{"action":"start","subaction":"projectmenu","id":"'.@$id.'","token":"'.@$_token.'","none":"0"}') ?>"><?php echo O::escapeHtml('') ?>
                <?php  { $project= project; ?>
                 <?php } ?>
                <img src="<?php echo O::escapeHtml('./modules/cms/ui/themes/default/images/icon_project.png') ?>" /><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@$name.'') ?>
                </span>
              </a>
              <div class="<?php echo O::escapeHtml('onrowvisible') ?>"><?php echo O::escapeHtml('') ?>
                <div class="<?php echo O::escapeHtml('arrow-down') ?>"><?php echo O::escapeHtml('') ?>
                </div>
                <div class="<?php echo O::escapeHtml('dropdown') ?>"><?php echo O::escapeHtml('') ?>
                  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('project') ?>" data-action="<?php echo O::escapeHtml('index') ?>" data-id="<?php echo O::escapeHtml(''.@$id.'') ?>" method="<?php echo O::escapeHtml('POST') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form index') ?>"><?php echo O::escapeHtml('') ?>
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
                      <input type="<?php echo O::escapeHtml('button') ?>" value="<?php echo O::escapeHtml(''.@O::lang('CANCEL').'') ?>" class="<?php echo O::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo O::escapeHtml('') ?>
                      <input type="<?php echo O::escapeHtml('submit') ?>" value="<?php echo O::escapeHtml(''.@O::lang('button_ok').'') ?>" class="<?php echo O::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo O::escapeHtml('') ?>
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