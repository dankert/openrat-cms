<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo \template_engine\Output::escapeHtml('or-table-wrapper') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-filter') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('search') ?>" name="<?php echo \template_engine\Output::escapeHtml('filter') ?>" placeholder="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('SEARCH_FILTER').'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-area') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <table width="<?php echo \template_engine\Output::escapeHtml('100%') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <tr><?php echo \template_engine\Output::escapeHtml('') ?>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
          </td>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <em><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('COMPARE').'') ?>
            </em>
            <span><?php echo \template_engine\Output::escapeHtml(' ') ?>
            </span>
            <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($date_left); ?>
             <?php } ?>
          </td>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
          </td>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <em><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('WITH').'') ?>
            </em>
            <span><?php echo \template_engine\Output::escapeHtml(' ') ?>
            </span>
            <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($date_right); ?>
             <?php } ?>
          </td>
        </tr>
        <tr><?php echo \template_engine\Output::escapeHtml('') ?>
          <td colspan="<?php echo \template_engine\Output::escapeHtml('4') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          </td>
        </tr>
        <?php foreach((array)$diff as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo \template_engine\Output::escapeHtml('diff') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <?php $if1=(isset($left)); if($if1) {  ?>
              <td width="<?php echo \template_engine\Output::escapeHtml('5%') ?>" class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <tt><?php echo \template_engine\Output::escapeHtml(''.'.@$left.'[' . line . '].'') ?>
                </tt>
              </td>
              <td width="<?php echo \template_engine\Output::escapeHtml('45%') ?>" class="<?php echo \template_engine\Output::escapeHtml(''.'.@$left.'[' . type . '].'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.'.@$left.'[' . text . '].'') ?>
                </span>
              </td>
             <?php } ?>
            <?php if(!$if1) {  ?>
              <td width="<?php echo \template_engine\Output::escapeHtml('50%') ?>" colspan="<?php echo \template_engine\Output::escapeHtml('2') ?>" class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(' ') ?>
                </span>
              </td>
             <?php } ?>
            <?php $if1=(isset($right)); if($if1) {  ?>
              <td width="<?php echo \template_engine\Output::escapeHtml('5%') ?>" class="<?php echo \template_engine\Output::escapeHtml('line') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <tt><?php echo \template_engine\Output::escapeHtml(''.'.@$right.'[' . line . '].'') ?>
                </tt>
              </td>
              <td width="<?php echo \template_engine\Output::escapeHtml('45%') ?>" class="<?php echo \template_engine\Output::escapeHtml(''.'.@$right.'[' . type . '].'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.'.@$right.'[' . text . '].'') ?>
                </span>
              </td>
             <?php } ?>
            <?php if(!$if1) {  ?>
              <td width="<?php echo \template_engine\Output::escapeHtml('50%') ?>" colspan="<?php echo \template_engine\Output::escapeHtml('2') ?>" class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(' ') ?>
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
  