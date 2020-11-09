<?php /* THIS FILE IS GENERATED from history.tpl.src.xml - DO NOT CHANGE */ defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <form name="<?php echo O::escapeHtml('') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-target="<?php echo O::escapeHtml('view') ?>" action="<?php echo O::escapeHtml('./') ?>" data-method="<?php echo O::escapeHtml('diff') ?>" data-action="<?php echo O::escapeHtml('pageelement') ?>" data-id="<?php echo O::escapeHtml(''.@$_id.'') ?>" method="<?php echo O::escapeHtml('get') ?>" enctype="<?php echo O::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo O::escapeHtml('') ?>" data-autosave="<?php echo O::escapeHtml('') ?>" class="<?php echo O::escapeHtml('or-form or-pageelement') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-form-headline') ?>"><?php echo O::escapeHtml('') ?>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-content') ?>"><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('token') ?>" value="<?php echo O::escapeHtml(''.@$_token.'') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('action') ?>" value="<?php echo O::escapeHtml('pageelement') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('subaction') ?>" value="<?php echo O::escapeHtml('diff') ?>" /><?php echo O::escapeHtml('') ?>
      <input type="<?php echo O::escapeHtml('hidden') ?>" name="<?php echo O::escapeHtml('id') ?>" value="<?php echo O::escapeHtml(''.@$_id.'') ?>" /><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
        <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
          <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input or-table-filter-input') ?>" /><?php echo O::escapeHtml('') ?>
        </div>
        <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
          <table width="<?php echo O::escapeHtml('100%') ?>" class="<?php echo O::escapeHtml('or-table') ?>"><?php echo O::escapeHtml('') ?>
            <tr class="<?php echo O::escapeHtml('or-headline') ?>"><?php echo O::escapeHtml('') ?>
              <td class="<?php echo O::escapeHtml('or-help') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('NR').'') ?>
                </span>
              </td>
              <td colspan="<?php echo O::escapeHtml('2') ?>" class="<?php echo O::escapeHtml('or-help') ?>"><?php echo O::escapeHtml('') ?>
                <?php $if6=(isset($compareid)); if($if6) {  ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('COMPARE').'') ?>
                  </span>
                 <?php } ?>
                <?php if(!$if6) {  ?>
                  <span><?php echo O::escapeHtml(' ') ?>
                  </span>
                 <?php } ?>
              </td>
              <td class="<?php echo O::escapeHtml('or-help') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('DATE').'') ?>
                </span>
              </td>
              <td class="<?php echo O::escapeHtml('or-help') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('USER').'') ?>
                </span>
              </td>
              <td class="<?php echo O::escapeHtml('or-help') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('VALUE').'') ?>
                </span>
              </td>
              <td class="<?php echo O::escapeHtml('or-help') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('STATE').'') ?>
                </span>
              </td>
              <td class="<?php echo O::escapeHtml('or-help') ?>"><?php echo O::escapeHtml('') ?>
                <span><?php echo O::escapeHtml(''.@O::lang('ACTION').'') ?>
                </span>
              </td>
            </tr>
            <?php $if4=(($el)==FALSE); if($if4) {  ?>
              <tr><?php echo O::escapeHtml('') ?>
                <td colspan="<?php echo O::escapeHtml('8') ?>"><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@O::lang('NOT_FOUND').'') ?>
                  </span>
                </td>
              </tr>
             <?php } ?>
            <?php foreach((array)$el as $list_key=>$list_value) { extract($list_value); ?>
              <tr class="<?php echo O::escapeHtml('or-data') ?>"><?php echo O::escapeHtml('') ?>
                <td><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@$lfd_nr.'') ?>
                  </span>
                </td>
                <td><?php echo O::escapeHtml('') ?>
                  <?php $if7=(isset($compareid)); if($if7) {  ?>
                    <input type="<?php echo O::escapeHtml('radio') ?>" name="<?php echo O::escapeHtml('compareid') ?>" value="<?php echo O::escapeHtml(''.@$id.'') ?>" <?php if(@$compareid=='${id}'){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-radio') ?>" /><?php echo O::escapeHtml('') ?>
                   <?php } ?>
                  <?php if(!$if7) {  ?>
                    <span><?php echo O::escapeHtml(' ') ?>
                    </span>
                   <?php } ?>
                </td>
                <td><?php echo O::escapeHtml('') ?>
                  <?php $if7=(isset($compareid)); if($if7) {  ?>
                    <input type="<?php echo O::escapeHtml('radio') ?>" name="<?php echo O::escapeHtml('withid') ?>" value="<?php echo O::escapeHtml(''.@$id.'') ?>" <?php if(@$withid=='${id}'){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> class="<?php echo O::escapeHtml('or-form-radio') ?>" /><?php echo O::escapeHtml('') ?>
                   <?php } ?>
                  <?php if(!$if7) {  ?>
                    <span><?php echo O::escapeHtml(' ') ?>
                    </span>
                   <?php } ?>
                </td>
                <td><?php echo O::escapeHtml('') ?>
                  <?php include_once( 'modules/template_engine/components/html/component_date/component-date.php'); { component_date($date); ?>
                   <?php } ?>
                </td>
                <td><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@$user.'') ?>
                  </span>
                </td>
                <td><?php echo O::escapeHtml('') ?>
                  <span><?php echo O::escapeHtml(''.@$value.'') ?>
                  </span>
                </td>
                <?php $if6=($public); if($if6) {  ?>
                  <td><?php echo O::escapeHtml('') ?>
                    <strong><?php echo O::escapeHtml(''.@O::lang('PUBLIC').'') ?>
                    </strong>
                  </td>
                 <?php } ?>
                <?php if(!$if6) {  ?>
                  <?php $if7=(isset($releaseUrl)); if($if7) {  ?>
                    <td class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                      <a title="<?php echo O::escapeHtml(''.@O::lang('RELEASE_DESC').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('post') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('release') ?>" data-id="<?php echo O::escapeHtml(''.@$objectid.'') ?>" data-extra-valueid="<?php echo O::escapeHtml(''.@$valueid.'') ?>" data-extra="<?php echo O::escapeHtml('{\'valueid\':\''.@$valueid.'\'}') ?>" data-data="<?php echo O::escapeHtml('{"action":"pageelement","subaction":"release","id":"'.@$objectid.'","token":"'.@$_token.'","valueid":"'.@$valueid.'","none":"0"}') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                        <strong><?php echo O::escapeHtml(''.@O::lang('RELEASE').'') ?>
                        </strong>
                      </a>
                    </td>
                   <?php } ?>
                  <?php if(!$if7) {  ?>
                    <td><?php echo O::escapeHtml('') ?>
                      <em><?php echo O::escapeHtml(''.@O::lang('INACTIVE').'') ?>
                      </em>
                    </td>
                   <?php } ?>
                 <?php } ?>
                <?php $if6=($active); if($if6) {  ?>
                  <td><?php echo O::escapeHtml('') ?>
                    <em><?php echo O::escapeHtml(''.@O::lang('ACTIVE').'') ?>
                    </em>
                  </td>
                 <?php } ?>
                <?php if(!$if6) {  ?>
                  <?php $if7=(isset($useUrl)); if($if7) {  ?>
                    <td class="<?php echo O::escapeHtml('or-act-clickable') ?>"><?php echo O::escapeHtml('') ?>
                      <a title="<?php echo O::escapeHtml(''.@O::lang('USE_DESC').'') ?>" target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('post') ?>" data-action="<?php echo O::escapeHtml('') ?>" data-method="<?php echo O::escapeHtml('use') ?>" data-id="<?php echo O::escapeHtml(''.@$objectid.'') ?>" data-extra-valueid="<?php echo O::escapeHtml(''.@$valueid.'') ?>" data-extra="<?php echo O::escapeHtml('{\'valueid\':\''.@$valueid.'\'}') ?>" data-data="<?php echo O::escapeHtml('{"action":"pageelement","subaction":"use","id":"'.@$objectid.'","token":"'.@$_token.'","valueid":"'.@$valueid.'","none":"0"}') ?>" class="<?php echo O::escapeHtml('or-link') ?>"><?php echo O::escapeHtml('') ?>
                        <span><?php echo O::escapeHtml(''.@O::lang('USE').'') ?>
                        </span>
                      </a>
                    </td>
                   <?php } ?>
                  <?php if(!$if7) {  ?>
                    <td><?php echo O::escapeHtml('') ?>
                    </td>
                   <?php } ?>
                 <?php } ?>
              </tr>
             <?php } ?>
          </table>
        </div>
      </div>
    </div>
    <div class="<?php echo O::escapeHtml('or-form-actionbar') ?>"><?php echo O::escapeHtml('') ?>
      <div class="<?php echo O::escapeHtml('or-btn or-btn--primary or-act-form-save') ?>"><?php echo O::escapeHtml('') ?>
        <i class="<?php echo O::escapeHtml('or-image-icon or-image-icon--form-ok') ?>"><?php echo O::escapeHtml('') ?>
        </i>
        <span class="<?php echo O::escapeHtml('or-form-btn-label') ?>"><?php echo O::escapeHtml(''.@O::lang('compare').'') ?>
        </span>
      </div>
    </div>
  </form>