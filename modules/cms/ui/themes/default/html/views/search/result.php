<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
    <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
    </div>
    <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
      <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
        <tr><?php echo escapeHtml('') ?>
          <td class="<?php echo escapeHtml('header') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('NAME').'') ?>
            </span>
          </td>
          <td class="<?php echo escapeHtml('header') ?>"><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('LASTCHANGE').'') ?>
            </span>
          </td>
        </tr>
        <?php foreach((array)$result as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
              <a target="<?php echo escapeHtml('_self') ?>" date-name="<?php echo escapeHtml(''.@$name.'') ?>" name="<?php echo escapeHtml(''.@$name.'') ?>" data-type="<?php echo escapeHtml('open') ?>" data-action="<?php echo escapeHtml(''.@$type.'') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml(''.@$id.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/'.@$type.'/'.@$id.'') ?>"><?php echo escapeHtml('') ?>
                <img src="<?php echo escapeHtml('./modules/cms/ui/themes/default/images/icon_'.@$type.'.png') ?>" /><?php echo escapeHtml('') ?>
                <span title="<?php echo escapeHtml(''.@$desc.'') ?>"><?php echo escapeHtml(''.@$name.'') ?>
                </span>
              </a>
            </td>
            <td><?php echo escapeHtml('') ?>
              <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastchange_date); ?>
               <?php } ?>
            </td>
          </tr>
         <?php } ?>
      </table>
    </div>
  </div>