<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
      </div>
      <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
        <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
          <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('project').'') ?>
              </span>
            </td>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('filename').'') ?>
              </span>
            </td>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('lastchange').'') ?>
              </span>
            </td>
          </tr>
          <?php foreach((array)$timeline as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
              <td class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
                <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('open') ?>" data-action="<?php echo escapeHtml('project') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml(''.@$projectid.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/project/'.@$projectid.'') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@$projectname.'') ?>
                  </span>
                </a>
              </td>
              <td title="<?php echo escapeHtml(''.@$filename.'') ?>" class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
                <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('open') ?>" data-action="<?php echo escapeHtml(''.@$type.'') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml(''.@$objectid.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/'.@$type.'/'.@$objectid.'') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@$filename.'') ?>
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
 <?php } ?>