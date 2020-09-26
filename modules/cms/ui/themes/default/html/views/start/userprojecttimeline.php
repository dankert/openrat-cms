<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo \template_engine\Output::escapeHtml('or-table-wrapper') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-filter') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('search') ?>" name="<?php echo \template_engine\Output::escapeHtml('filter') ?>" placeholder="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('SEARCH_FILTER').'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-area') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <table width="<?php echo \template_engine\Output::escapeHtml('100%') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <tr class="<?php echo \template_engine\Output::escapeHtml('headline') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('name').'') ?>
            </span>
          </td>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('filename').'') ?>
            </span>
          </td>
          <td><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('lastchange').'') ?>
            </span>
          </td>
        </tr>
        <?php foreach((array)$timeline as $list_key=>$list_value) { extract($list_value); ?>
          <?php $if1=($typeid=='1'); if($if1) {  ?>
            <?php  { $type= folder; ?>
             <?php } ?>
           <?php } ?>
          <?php $if1=($typeid=='2'); if($if1) {  ?>
            <?php  { $type= file; ?>
             <?php } ?>
           <?php } ?>
          <?php $if1=($typeid=='4'); if($if1) {  ?>
            <?php  { $type= link; ?>
             <?php } ?>
           <?php } ?>
          <?php $if1=($typeid=='3'); if($if1) {  ?>
            <?php  { $type= page; ?>
             <?php } ?>
           <?php } ?>
          <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <td class="<?php echo \template_engine\Output::escapeHtml('clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" date-name="<?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>" name="<?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('open') ?>" data-action="<?php echo \template_engine\Output::escapeHtml(''.@$type.'') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$objectid.'') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/'.@$type.'/'.@$objectid.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>
                </span>
              </a>
            </td>
            <td><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@$filename.'') ?>
              </span>
            </td>
            <td><?php echo \template_engine\Output::escapeHtml('') ?>
              <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($lastchange_date); ?>
               <?php } ?>
            </td>
          </tr>
         <?php } ?>
      </table>
    </div>
  </div>