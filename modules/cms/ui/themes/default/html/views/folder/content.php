<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
      </div>
      <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
        <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
          <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
            <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('TYPE').'') ?>
              </span>
              <span><?php echo escapeHtml(' / ') ?>
              </span>
              <span><?php echo escapeHtml(''.@lang('NAME').'') ?>
              </span>
            </td>
            <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('LASTCHANGE').'') ?>
              </span>
            </td>
          </tr>
          <?php $if1=(isset($up_url)); if($if1) {  ?>
            <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
              <td><?php echo escapeHtml('') ?>
                <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon_folder.png') ?>" /><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml('..') ?>
                </span>
              </td>
              <td><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml('') ?>
                </span>
              </td>
            </tr>
           <?php } ?>
          <?php foreach((array)$object as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
              <td title="<?php echo escapeHtml(''.@$desc.'') ?>" data-name="<?php echo escapeHtml(''.@$name.'') ?>" data-action="<?php echo escapeHtml(''.@$type.'') ?>" data-id="<?php echo escapeHtml(''.@$id.'') ?>" class="<?php echo escapeHtml('clickable '.@$class.'') ?>"><?php echo escapeHtml('') ?>
                <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon_'.@$icon.'.png') ?>" /><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@$name.'') ?>
                </span>
                <span><?php echo escapeHtml(' ') ?>
                </span>
              </td>
              <td><?php echo escapeHtml('') ?>
                <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($date); ?>
                 <?php } ?>
              </td>
            </tr>
           <?php } ?>
          <?php $if1=(($object)==FALSE); if($if1) {  ?>
            <tr><?php echo escapeHtml('') ?>
              <td colspan="<?php echo escapeHtml('2') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('NOT_FOUND').'') ?>
                </span>
              </td>
            </tr>
           <?php } ?>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td colspan="<?php echo escapeHtml('2') ?>"><?php echo escapeHtml('') ?>
              <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('view') ?>" data-action="<?php echo escapeHtml('folder') ?>" data-method="<?php echo escapeHtml('createfolder') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/folder/') ?>"><?php echo escapeHtml('') ?>
                <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/icon/create.png') ?>" /><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('menu_folder_createfolder').'') ?>
                </span>
              </a>
            </td>
          </tr>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td colspan="<?php echo escapeHtml('2') ?>"><?php echo escapeHtml('') ?>
              <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('view') ?>" data-action="<?php echo escapeHtml('folder') ?>" data-method="<?php echo escapeHtml('createpage') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/folder/') ?>"><?php echo escapeHtml('') ?>
                <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/icon/create.png') ?>" /><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('menu_folder_createpage').'') ?>
                </span>
              </a>
            </td>
          </tr>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td colspan="<?php echo escapeHtml('2') ?>"><?php echo escapeHtml('') ?>
              <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('view') ?>" data-action="<?php echo escapeHtml('folder') ?>" data-method="<?php echo escapeHtml('createfile') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/folder/') ?>"><?php echo escapeHtml('') ?>
                <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/icon/create.png') ?>" /><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('menu_folder_createfile').'') ?>
                </span>
              </a>
            </td>
          </tr>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td colspan="<?php echo escapeHtml('2') ?>"><?php echo escapeHtml('') ?>
              <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('modal') ?>" data-action="<?php echo escapeHtml('folder') ?>" data-method="<?php echo escapeHtml('createlink') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/folder/') ?>"><?php echo escapeHtml('') ?>
                <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon/icon/create.png') ?>" /><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('menu_folder_createlink').'') ?>
                </span>
              </a>
            </td>
          </tr>
        </table>
      </div>
    </div>
 <?php } ?>