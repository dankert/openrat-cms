<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
      </div>
      <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
        <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
          <tr><?php echo escapeHtml('') ?>
            <td><?php echo escapeHtml('') ?>
            </td>
            <td><?php echo escapeHtml('') ?>
              <em><?php echo escapeHtml(''.@lang('COMPARE').'') ?>
              </em>
              <span><?php echo escapeHtml(' ') ?>
              </span>
              <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($date_left); ?>
               <?php } ?>
            </td>
            <td><?php echo escapeHtml('') ?>
            </td>
            <td><?php echo escapeHtml('') ?>
              <em><?php echo escapeHtml(''.@lang('WITH').'') ?>
              </em>
              <span><?php echo escapeHtml(' ') ?>
              </span>
              <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($date_right); ?>
               <?php } ?>
            </td>
          </tr>
          <tr><?php echo escapeHtml('') ?>
            <td colspan="<?php echo escapeHtml('4') ?>"><?php echo escapeHtml('') ?>
            </td>
          </tr>
          <?php foreach((array)$diff as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="<?php echo escapeHtml('diff') ?>"><?php echo escapeHtml('') ?>
              <?php $if1=(isset($left)); if($if1) {  ?>
                <td width="<?php echo escapeHtml('5%') ?>" class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
                  <tt><?php echo escapeHtml(''.'.@$left.'[' . line . '].'') ?>
                  </tt>
                </td>
                <td width="<?php echo escapeHtml('45%') ?>" class="<?php echo escapeHtml(''.'.@$left.'[' . type . '].'') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.'.@$left.'[' . text . '].'') ?>
                  </span>
                </td>
               <?php } ?>
              <?php if(!$if1) {  ?>
                <td width="<?php echo escapeHtml('50%') ?>" colspan="<?php echo escapeHtml('2') ?>" class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(' ') ?>
                  </span>
                </td>
               <?php } ?>
              <?php $if1=(isset($right)); if($if1) {  ?>
                <td width="<?php echo escapeHtml('5%') ?>" class="<?php echo escapeHtml('line') ?>"><?php echo escapeHtml('') ?>
                  <tt><?php echo escapeHtml(''.'.@$right.'[' . line . '].'') ?>
                  </tt>
                </td>
                <td width="<?php echo escapeHtml('45%') ?>" class="<?php echo escapeHtml(''.'.@$right.'[' . type . '].'') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.'.@$right.'[' . text . '].'') ?>
                  </span>
                </td>
               <?php } ?>
              <?php if(!$if1) {  ?>
                <td width="<?php echo escapeHtml('50%') ?>" colspan="<?php echo escapeHtml('2') ?>" class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(' ') ?>
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
    
 <?php } ?>