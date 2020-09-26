<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo \template_engine\Output::escapeHtml('or-table-wrapper') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-filter') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('search') ?>" name="<?php echo \template_engine\Output::escapeHtml('filter') ?>" placeholder="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('SEARCH_FILTER').'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-table-area') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <table width="<?php echo \template_engine\Output::escapeHtml('100%') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <tr class="<?php echo \template_engine\Output::escapeHtml('headline') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <th><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('language').'') ?>
            </span>
          </th>
          <th><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('value').'') ?>
            </span>
          </th>
          <th><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('editor').'') ?>
            </span>
          </th>
        </tr>
        <?php foreach((array)$languages as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <td><?php echo \template_engine\Output::escapeHtml('') ?>
              <span><?php echo \template_engine\Output::escapeHtml(''.@$languagename.'') ?>
              </span>
            </td>
            <td title="<?php echo \template_engine\Output::escapeHtml(''.@$text.'') ?>" class="<?php echo \template_engine\Output::escapeHtml('clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('edit') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('pageelement') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('value') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'languageid\':\''.@$languageid.'\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/pageelement/') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php $if1=($date); if($if1) {  ?>
                  <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($date); ?>
                   <?php } ?>
                 <?php } ?>
                <?php $if1=($text); if($if1) {  ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@$text.'') ?>
                  </span>
                 <?php } ?>
              </a>
            </td>
            <td><?php echo \template_engine\Output::escapeHtml('') ?>
              <?php foreach((array)$editors as $id=>$name) {  ?>
                <div class="<?php echo \template_engine\Output::escapeHtml('clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('edit') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('pageelement') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('value') ?>" data-id="<?php echo \template_engine\Output::escapeHtml('') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'languageid\':\''.@$languageid.'\',\'format\':\''.@$id.'\'}') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/pageelement/') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    <span><?php echo \template_engine\Output::escapeHtml(''.@$name.'') ?>
                    </span>
                  </a>
                </div>
               <?php } ?>
            </td>
          </tr>
         <?php } ?>
      </table>
    </div>
  </div>