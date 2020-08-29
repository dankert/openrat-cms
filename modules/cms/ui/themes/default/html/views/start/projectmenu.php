<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
    <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
    </div>
    <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
      <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
        <tr><?php echo escapeHtml('') ?>
          <td colspan="<?php echo escapeHtml('2') ?>" class="<?php echo escapeHtml('logo') ?>"><?php echo escapeHtml('') ?>
            <div class="<?php echo escapeHtml('line logo') ?>"><?php echo escapeHtml('') ?>
              <div class="<?php echo escapeHtml('label') ?>"><?php echo escapeHtml('') ?>
                <img src="<?php echo escapeHtml('themes/default/images/logo_projectmenu.png') ?>" border="<?php echo escapeHtml('') ?>" /><?php echo escapeHtml('') ?>
              </div>
              <div class="<?php echo escapeHtml('input') ?>"><?php echo escapeHtml('') ?>
                <h2><?php echo escapeHtml(''.@lang('logo_projectmenu').'') ?>
                </h2>
                <p><?php echo escapeHtml(''.@lang('logo_projectmenu_text').'') ?>
                </p>
              </div>
            </div>
          </td>
        </tr>
        <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
          <td><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('project').'') ?>
            </span>
          </td>
        </tr>
        <?php foreach((array)$projects as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
              <a title="<?php echo escapeHtml(''.@lang('TREE_CHOOSE_PROJECT').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('post') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml(''.@$id.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" data-data="<?php echo escapeHtml('{"action":"start","subaction":"projectmenu","id":"'.@$id.'","token":"'.@$_token.'","none":"0"}') ?>"><?php echo escapeHtml('') ?>
                <?php  { $project= project; ?>
                 <?php } ?>
                <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon_project.png') ?>" /><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@$name.'') ?>
                </span>
              </a>
              <div class="<?php echo escapeHtml('onrowvisible') ?>"><?php echo escapeHtml('') ?>
                <div class="<?php echo escapeHtml('arrow-down') ?>"><?php echo escapeHtml('') ?>
                </div>
                <div class="<?php echo escapeHtml('dropdown') ?>"><?php echo escapeHtml('') ?>
                  <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('project') ?>" data-action="<?php echo escapeHtml('index') ?>" data-id="<?php echo escapeHtml(''.@$id.'') ?>" method="<?php echo escapeHtml('POST') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form index') ?>"><?php echo escapeHtml('') ?>
                    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
                    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('index') ?>" /><?php echo escapeHtml('') ?>
                    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('project') ?>" /><?php echo escapeHtml('') ?>
                    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$id.'') ?>" /><?php echo escapeHtml('') ?>
                    <div><?php echo escapeHtml('') ?>
                      <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
                        <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
                          <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
                        </div>
                        <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
                          <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
                            <tr><?php echo escapeHtml('') ?>
                              <td><?php echo escapeHtml('') ?>
                                <?php foreach( $models as $_key=>$_value) {  ?>
                                  <label><?php echo escapeHtml('') ?>
                                    <input type="<?php echo escapeHtml('radio') ?>" name="<?php echo escapeHtml('modelid') ?>" value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==${defaultmodelid}){ ?>checked="<?php echo escapeHtml('checked') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                                    <span><?php echo escapeHtml(''.@$_value.'') ?>
                                    </span>
                                  </label>
                                  <br /><?php echo escapeHtml('') ?>
                                 <?php } ?>
                              </td>
                              <td><?php echo escapeHtml('') ?>
                                <?php foreach( $languages as $_key=>$_value) {  ?>
                                  <label><?php echo escapeHtml('') ?>
                                    <input type="<?php echo escapeHtml('radio') ?>" name="<?php echo escapeHtml('languageid') ?>" value="<?php echo escapeHtml(''.@$_key.'') ?>" <?php if($_key==${defaultlanguageid}){ ?>checked="<?php echo escapeHtml('checked') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
                                    <span><?php echo escapeHtml(''.@$_value.'') ?>
                                    </span>
                                  </label>
                                  <br /><?php echo escapeHtml('') ?>
                                 <?php } ?>
                              </td>
                              <td><?php echo escapeHtml('') ?>
                                
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
                      <input type="<?php echo escapeHtml('button') ?>" value="<?php echo escapeHtml(''.@lang('CANCEL').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--secondary or-form-btn--cancel') ?>" /><?php echo escapeHtml('') ?>
                      <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('button_ok').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
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