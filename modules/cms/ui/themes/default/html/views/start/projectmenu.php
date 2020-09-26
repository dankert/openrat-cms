<?php defined('APP_STARTED') || die('Forbidden'); ?>
  <div class="<?php echo \template_engine\Output::escapeHtml('or-table-wrapper') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-filter') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('search') ?>" name="<?php echo \template_engine\Output::escapeHtml('filter') ?>" placeholder="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('SEARCH_FILTER').'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-area') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <table width="<?php echo \template_engine\Output::escapeHtml('100%') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <tr><?php echo \template_engine\Output::escapeHtml('') ?>
          <td colspan="<?php echo \template_engine\Output::escapeHtml('2') ?>" class="<?php echo \template_engine\Output::escapeHtml('logo') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('line logo') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <div class="<?php echo \template_engine\Output::escapeHtml('label') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <img src="<?php echo \template_engine\Output::escapeHtml('themes/default/images/logo_projectmenu.png') ?>" border="<?php echo \template_engine\Output::escapeHtml('') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
              </div>
              <div class="<?php echo \template_engine\Output::escapeHtml('input') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <h2><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('logo_projectmenu').'') ?>
                </h2>
                <p><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('logo_projectmenu_text').'') ?>
                </p>
              </div>
            </div>
          </td>
        </tr>
        <tr class="<?php echo \template_engine\Output::escapeHtml('headline') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('project').'') ?>
            </span>
          </td>
        </tr>
        <?php foreach((array)$projects as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <td class="<?php echo \template_engine\Output::escapeHtml('clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('TREE_CHOOSE_PROJECT').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('post') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" data-data="<?php echo \template_engine\Output::escapeHtml('{"action":"start","subaction":"projectmenu","id":"'.@$id.'","token":"'.@$_token.'","none":"0"}') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php  { $project= project; ?>
                 <?php } ?>
                <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon_project.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>
                </span>
              </a>
              <div class="<?php echo \template_engine\Output::escapeHtml('onrowvisible') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <div class="<?php echo \template_engine\Output::escapeHtml('arrow-down') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                </div>
                <div class="<?php echo \template_engine\Output::escapeHtml('dropdown') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <form name="<?php echo \template_engine\Output::escapeHtml('') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-target="<?php echo \template_engine\Output::escapeHtml('view') ?>" action="<?php echo \template_engine\Output::escapeHtml('./') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('project') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('index') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$id.'') ?>" method="<?php echo \template_engine\Output::escapeHtml('POST') ?>" enctype="<?php echo \template_engine\Output::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo \template_engine\Output::escapeHtml('') ?>" data-autosave="<?php echo \template_engine\Output::escapeHtml('') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form index') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('token') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_token.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('action') ?>" value="<?php echo \template_engine\Output::escapeHtml('index') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('subaction') ?>" value="<?php echo \template_engine\Output::escapeHtml('project') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('id') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$id.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                    <div><?php echo \template_engine\Output::escapeHtml('') ?>
                      <div class="<?php echo \template_engine\Output::escapeHtml('or-table-wrapper') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                        <div class="<?php echo \template_engine\Output::escapeHtml('or-table-filter') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                          <input type="<?php echo \template_engine\Output::escapeHtml('search') ?>" name="<?php echo \template_engine\Output::escapeHtml('filter') ?>" placeholder="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('SEARCH_FILTER').'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                        </div>
                        <div class="<?php echo \template_engine\Output::escapeHtml('or-table-area') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                          <table width="<?php echo \template_engine\Output::escapeHtml('100%') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                            <tr><?php echo \template_engine\Output::escapeHtml('') ?>
                              <td><?php echo \template_engine\Output::escapeHtml('') ?>
                                <?php foreach( $models as $_key=>$_value) {  ?>
                                  <label><?php echo \template_engine\Output::escapeHtml('') ?>
                                    <input type="<?php echo \template_engine\Output::escapeHtml('radio') ?>" name="<?php echo \template_engine\Output::escapeHtml('modelid') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==${defaultmodelid}){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                                    <span><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
                                    </span>
                                  </label>
                                  <br /><?php echo \template_engine\Output::escapeHtml('') ?>
                                 <?php } ?>
                              </td>
                              <td><?php echo \template_engine\Output::escapeHtml('') ?>
                                <?php foreach( $languages as $_key=>$_value) {  ?>
                                  <label><?php echo \template_engine\Output::escapeHtml('') ?>
                                    <input type="<?php echo \template_engine\Output::escapeHtml('radio') ?>" name="<?php echo \template_engine\Output::escapeHtml('languageid') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_key.'') ?>" <?php if($_key==${defaultlanguageid}){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                                    <span><?php echo \template_engine\Output::escapeHtml(''.@$_value.'') ?>
                                    </span>
                                  </label>
                                  <br /><?php echo \template_engine\Output::escapeHtml('') ?>
                                 <?php } ?>
                              </td>
                              <td><?php echo \template_engine\Output::escapeHtml('') ?>
                                
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="<?php echo \template_engine\Output::escapeHtml('or-form-actionbar') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                      <input type="<?php echo \template_engine\Output::escapeHtml('button') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('CANCEL').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
                      <input type="<?php echo \template_engine\Output::escapeHtml('submit') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('button_ok').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
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