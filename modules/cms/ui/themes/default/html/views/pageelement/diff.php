<?php /* THIS FILE IS GENERATED from diff.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input or-table-filter-input') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table width="<?php echo O::escapeHtml('100%') ?>" class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
        <tr><?php echo O::escapeHtml('') ?>
          <td><?php echo O::escapeHtml('') ?>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <em><?php echo O::escapeHtml(''.@O::lang('COMPARE').'') ?>
            </em>
            <span><?php echo O::escapeHtml(' ') ?>
            </span>
            <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($date_left); ?>
             <?php } ?>
          </td>
          <td><?php echo O::escapeHtml('') ?>
          </td>
          <td><?php echo O::escapeHtml('') ?>
            <em><?php echo O::escapeHtml(''.@O::lang('WITH').'') ?>
            </em>
            <span><?php echo O::escapeHtml(' ') ?>
            </span>
            <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($date_right); ?>
             <?php } ?>
          </td>
        </tr>
        <tr><?php echo O::escapeHtml('') ?>
          <td colspan="<?php echo O::escapeHtml('4') ?>"><?php echo O::escapeHtml('') ?>
          </td>
        </tr>
        <?php foreach((array)$diff as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo O::escapeHtml('or-diff') ?>"><?php echo O::escapeHtml('') ?>
            <?php $if5=(isset($left)); if($if5) {  ?>
              <td width="<?php echo O::escapeHtml('5%') ?>" class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
                <tt><?php echo O::escapeHtml(''.@$left['line'].'') ?>
                </tt>
              </td>
              <td width="<?php echo O::escapeHtml('45%') ?>" class="<?php echo O::escapeHtml('or-'.@$left['type'].'') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@$left['text'].'') ?>
                </span>
              </td>
             <?php } ?>
            <?php if(!$if5) {  ?>
              <td width="<?php echo O::escapeHtml('50%') ?>" colspan="<?php echo O::escapeHtml('2') ?>" class="<?php echo O::escapeHtml('or-help') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(' ') ?>
                </span>
              </td>
             <?php } ?>
            <?php $if5=(isset($right)); if($if5) {  ?>
              <td width="<?php echo O::escapeHtml('5%') ?>" class="<?php echo O::escapeHtml('or-line') ?>"><?php echo O::escapeHtml('') ?>
                <tt><?php echo O::escapeHtml(''.@$right['line'].'') ?>
                </tt>
              </td>
              <td width="<?php echo O::escapeHtml('45%') ?>" class="<?php echo O::escapeHtml('or-'.@$right['type'].'') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@$right['text'].'') ?>
                </span>
              </td>
             <?php } ?>
            <?php if(!$if5) {  ?>
              <td width="<?php echo O::escapeHtml('50%') ?>" colspan="<?php echo O::escapeHtml('2') ?>" class="<?php echo O::escapeHtml('or-help') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(' ') ?>
                </span>
              </td>
             <?php } ?>
          </tr>
          <?php  { unset($left) ?>
           <?php } ?>
          <?php  { unset($right) ?>
           <?php } ?>
         <?php } ?>
      </table>
    </div>
  </div>
  