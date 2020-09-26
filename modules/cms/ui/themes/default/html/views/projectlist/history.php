<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
        <tr class="<?php echo O::escapeHtml('headline') ?>"><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('project').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('filename').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('user_username').'') ?>
            </span>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('lastchange').'') ?>
            </span>
          </td>
        </tr>
        <?php foreach((array)$timeline as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo O::escapeHtml('data') ?>"><?php echo O::escapeHtml('') ?>
            <td class="<?php echo O::escapeHtml('clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('post') ?>" data-action="<?php echo O::escapeHtml('start') ?>" data-method="<?php echo O::escapeHtml('projectmenu') ?>" data-id="<?php echo O::escapeHtml(''.@$projectid.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" data-data="<?php echo O::escapeHtml('{"action":"start","subaction":"projectmenu","id":"'.@$projectid.'","token":"'.@$_token.'","none":"0"}') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@$projectname.'') ?>
                </span>
              </a>
            </td>
            <td><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$filename.'') ?>
              </span>
            </td>
            <td><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$username.'') ?>
              </span>
            </td>
            <td><?php echo O::escapeHtml('') ?>
              <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastchange_date); ?>
               <?php } ?>
            </td>
          </tr>
         <?php } ?>
      </table>
    </div>
  </div>