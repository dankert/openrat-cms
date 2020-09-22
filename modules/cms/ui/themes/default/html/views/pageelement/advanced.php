<?php if (!defined('OR_TITLE')) exit(); ?>
  <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
    <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
    </div>
    <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
      <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
        <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
          <th><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('language').'') ?>
            </span>
          </th>
          <th><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('value').'') ?>
            </span>
          </th>
          <th><?php echo escapeHtml('') ?>
            <span><?php echo escapeHtml(''.@lang('editor').'') ?>
            </span>
          </th>
        </tr>
        <?php foreach((array)$languages as $list_key=>$list_value) { extract($list_value); ?>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@$languagename.'') ?>
              </span>
            </td>
            <td title="<?php echo escapeHtml(''.@$text.'') ?>" class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
              <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('edit') ?>" data-action="<?php echo escapeHtml('pageelement') ?>" data-method="<?php echo escapeHtml('value') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'languageid\':\''.@$languageid.'\'}') ?>" href="<?php echo escapeHtml('/#/pageelement/') ?>"><?php echo escapeHtml('') ?>
                <?php $if1=($date); if($if1) {  ?>
                  <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($date); ?>
                   <?php } ?>
                 <?php } ?>
                <?php $if1=($text); if($if1) {  ?>
                  <span><?php echo escapeHtml(''.@$text.'') ?>
                  </span>
                 <?php } ?>
              </a>
            </td>
            <td><?php echo escapeHtml('') ?>
              <?php foreach((array)$editors as $id=>$name) {  ?>
                <div class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
                  <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('edit') ?>" data-action="<?php echo escapeHtml('pageelement') ?>" data-method="<?php echo escapeHtml('value') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'languageid\':\''.@$languageid.'\',\'format\':\''.@$id.'\'}') ?>" href="<?php echo escapeHtml('/#/pageelement/') ?>"><?php echo escapeHtml('') ?>
                    <span><?php echo escapeHtml(''.@$name.'') ?>
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