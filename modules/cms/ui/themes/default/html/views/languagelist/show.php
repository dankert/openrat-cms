<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
        <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
      </div>
      <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
        <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
          <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('NAME').'') ?>
              </span>
            </td>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml(''.@lang('LANGUAGE_ISOCODE').'') ?>
              </span>
            </td>
            <td><?php echo escapeHtml('') ?>
              <span><?php echo escapeHtml('') ?>
              </span>
            </td>
          </tr>
          <?php foreach((array)$el as $list_key=>$list_value) { extract($list_value); ?>
            <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
              <td class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
                <i class="<?php echo escapeHtml('image-icon image-icon--action-language') ?>"><?php echo escapeHtml('') ?>
                </i>
                <a target="<?php echo escapeHtml('_self') ?>" date-name="<?php echo escapeHtml(''.@$name.'') ?>" name="<?php echo escapeHtml(''.@$name.'') ?>" data-type="<?php echo escapeHtml('open') ?>" data-action="<?php echo escapeHtml('language') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml(''.@$id.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/language/'.@$id.'') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@$name.'') ?>
                  </span>
                </a>
              </td>
              <td><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@$isocode.'') ?>
                </span>
              </td>
              <?php $if1=(!$is_default); if($if1) {  ?>
                <td class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
                  <?php $if1=(isset($id)); if($if1) {  ?>
                    <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('post') ?>" data-action="<?php echo escapeHtml('language') ?>" data-method="<?php echo escapeHtml('setdefault') ?>" data-id="<?php echo escapeHtml(''.@$id.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" data-data="<?php echo escapeHtml('{"action":"language","subaction":"setdefault","id":"'.@$id.'","token":"'.@$_token.'","none":"0"}') ?>"><?php echo escapeHtml('') ?>
                      <span><?php echo escapeHtml(''.@lang('make_default').'') ?>
                      </span>
                    </a>
                   <?php } ?>
                  <?php if(!$if1) {  ?>
                   <?php } ?>
                </td>
               <?php } ?>
              <?php if(!$if1) {  ?>
                <td><?php echo escapeHtml('') ?>
                  <em><?php echo escapeHtml(''.@lang('is_default').'') ?>
                  </em>
                </td>
               <?php } ?>
            </tr>
            <?php  { unset($select_url) ?>
             <?php } ?>
            <?php  { unset($default_url) ?>
             <?php } ?>
           <?php } ?>
          <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
            <td colspan="<?php echo escapeHtml('3') ?>" class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
              <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('dialog') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('add') ?>" data-id="<?php echo escapeHtml('') ?>" data-extra="<?php echo escapeHtml('{\'dialogAction\':null,\'dialogMethod\':\'add\'}') ?>" href="<?php echo escapeHtml('/#//') ?>"><?php echo escapeHtml('') ?>
                <i class="<?php echo escapeHtml('image-icon image-icon--method-add') ?>"><?php echo escapeHtml('') ?>
                </i>
                <span><?php echo escapeHtml(''.@lang('new').'') ?>
                </span>
              </a>
            </td>
          </tr>
        </table>
      </div>
    </div>
 <?php } ?>