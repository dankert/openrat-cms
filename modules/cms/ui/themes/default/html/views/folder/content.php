<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo \template_engine\Output::escapeHtml('or-table-wrapper') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-filter') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('search') ?>" name="<?php echo \template_engine\Output::escapeHtml('filter') ?>" placeholder="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('SEARCH_FILTER').'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-area') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <table width="<?php echo \template_engine\Output::escapeHtml('100%') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <tr class="<?php echo \template_engine\Output::escapeHtml('headline') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('TYPE').'') ?>
            </span>
            <span><?php echo \template_engine\Output::escapeHtml(' / ') ?>
            </span>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('NAME').'') ?>
            </span>
          </td>
          <td class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('LASTCHANGE').'') ?>
            </span>
          </td>
        </tr>
        <?php $if1=(isset($up_url)); if($if1) {  ?>
          <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <td><?php echo \template_engine\Output::escapeHtml('') ?>
              <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon_folder.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml('..') ?>
              </span>
            </td>
            <td><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml('') ?>
              </span>
            </td>
          </tr>
         <?php } ?>
        <?php foreach((array)$object as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <td title="<?php echo \template_engine\Output::escapeHtml(''.@$desc.'') ?>" data-name="<?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>" data-action="<?php echo \template_engine\Output::escapeHtml(''.@$type.'') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$id.'') ?>" class="<?php echo \template_engine\Output::escapeHtml('clickable '.@$class.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon_'.@$icon.'.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>
              </span>
              <span><?php echo \template_engine\Output::escapeHtml(' ') ?>
              </span>
            </td>
            <td><?php echo \template_engine\Output::escapeHtml('') ?>
              <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($date); ?>
               <?php } ?>
            </td>
          </tr>
         <?php } ?>
        <?php $if1=(($object)==FALSE); if($if1) {  ?>
          <tr><?php echo \template_engine\Output::escapeHtml('') ?>
            <td colspan="<?php echo \template_engine\Output::escapeHtml('2') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('NOT_FOUND').'') ?>
              </span>
            </td>
          </tr>
         <?php } ?>
        <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td colspan="<?php echo \template_engine\Output::escapeHtml('2') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('view') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('folder') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('createfolder') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/folder/') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon/icon/create.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_folder_createfolder').'') ?>
              </span>
            </a>
          </td>
        </tr>
        <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td colspan="<?php echo \template_engine\Output::escapeHtml('2') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('view') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('folder') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('createpage') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/folder/') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon/icon/create.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_folder_createpage').'') ?>
              </span>
            </a>
          </td>
        </tr>
        <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td colspan="<?php echo \template_engine\Output::escapeHtml('2') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('view') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('folder') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('createfile') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/folder/') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon/icon/create.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_folder_createfile').'') ?>
              </span>
            </a>
          </td>
        </tr>
        <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td colspan="<?php echo \template_engine\Output::escapeHtml('2') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('modal') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('folder') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('createlink') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/folder/') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <img src="<?php echo \template_engine\Output::escapeHtml('./modules/cms/ui/themes/default/images/icon/icon/create.png') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('menu_folder_createlink').'') ?>
              </span>
            </a>
          </td>
        </tr>
      </table>
    </div>
  </div>