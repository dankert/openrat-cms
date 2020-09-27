<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" /><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
        <tr class="<?php echo O::escapeHtml('headline') ?>"><?php echo O::escapeHtml('') ?>
          <th><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('language').'') ?>
            </span>
          </th>
          <th><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('value').'') ?>
            </span>
          </th>
          <th><?php echo O::escapeHtml('') ?>
            <span><?php echo O::escapeHtml(''.@O::lang('editor').'') ?>
            </span>
          </th>
        </tr>
        <?php foreach((array)$languages as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo O::escapeHtml('data') ?>"><?php echo O::escapeHtml('') ?>
            <td><?php echo O::escapeHtml('') ?>
              <span><?php echo O::escapeHtml(''.@$languagename.'') ?>
              </span>
            </td>
            <td title="<?php echo O::escapeHtml(''.@$text.'') ?>" class="<?php echo O::escapeHtml('clickable') ?>"><?php echo O::escapeHtml('') ?>
              <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('edit') ?>" data-action="<?php echo O::escapeHtml('pageelement') ?>" data-method="<?php echo O::escapeHtml('value') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-languageid="<?php echo O::escapeHtml(''.@$languageid.'') ?>" data-extra="<?php echo O::escapeHtml('{\'languageid\':\''.@$languageid.'\'}') ?>" href="<?php echo O::escapeHtml('/#/pageelement/') ?>"><?php echo O::escapeHtml('') ?>
                <?php $if1=($date); if($if1) {  ?>
                  <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($date); ?>
                   <?php } ?>
                 <?php } ?>
                <?php $if1=($text); if($if1) {  ?>
                  <span><?php echo O::escapeHtml(''.@$text.'') ?>
                  </span>
                 <?php } ?>
              </a>
            </td>
            <td><?php echo O::escapeHtml('') ?>
              <?php foreach((array)$editors as $id=>$name) {  ?>
                <div class="<?php echo O::escapeHtml('clickable') ?>"><?php echo O::escapeHtml('') ?>
                  <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('edit') ?>" data-action="<?php echo O::escapeHtml('pageelement') ?>" data-method="<?php echo O::escapeHtml('value') ?>" data-id="<?php echo O::escapeHtml('') ?>" data-extra-languageid="<?php echo O::escapeHtml(''.@$languageid.'') ?>" data-extra-format="<?php echo O::escapeHtml(''.@$id.'') ?>" data-extra="<?php echo O::escapeHtml('{\'languageid\':\''.@$languageid.'\',\'format\':\''.@$id.'\'}') ?>" href="<?php echo O::escapeHtml('/#/pageelement/') ?>"><?php echo O::escapeHtml('') ?>
                    <span><?php echo O::escapeHtml(''.@$name.'') ?>
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