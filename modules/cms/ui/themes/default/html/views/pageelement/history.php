<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo escapeHtml('') ?>" target="<?php echo escapeHtml('_self') ?>" data-target="<?php echo escapeHtml('view') ?>" action="<?php echo escapeHtml('./') ?>" data-method="<?php echo escapeHtml('diff') ?>" data-action="<?php echo escapeHtml('pageelement') ?>" data-id="<?php echo escapeHtml(''.@$_id.'') ?>" method="<?php echo escapeHtml('get') ?>" enctype="<?php echo escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo escapeHtml('') ?>" data-autosave="<?php echo escapeHtml('') ?>" class="<?php echo escapeHtml('or-form pageelement') ?>"><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('token') ?>" value="<?php echo escapeHtml(''.@$_token.'') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('action') ?>" value="<?php echo escapeHtml('pageelement') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('subaction') ?>" value="<?php echo escapeHtml('diff') ?>" /><?php echo escapeHtml('') ?>
    <input type="<?php echo escapeHtml('hidden') ?>" name="<?php echo escapeHtml('id') ?>" value="<?php echo escapeHtml(''.@$_id.'') ?>" /><?php echo escapeHtml('') ?>
    <div><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
        <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
          <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
        </div>
        <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
          <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
            <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
              <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('NR').'') ?>
                </span>
              </td>
              <td colspan="<?php echo escapeHtml('2') ?>" class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                <?php $if1=(isset($compareid)); if($if1) {  ?>
                  <span><?php echo escapeHtml(''.@lang('COMPARE').'') ?>
                  </span>
                 <?php } ?>
                <?php if(!$if1) {  ?>
                  <span><?php echo escapeHtml(' ') ?>
                  </span>
                 <?php } ?>
              </td>
              <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('DATE').'') ?>
                </span>
              </td>
              <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('USER').'') ?>
                </span>
              </td>
              <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('VALUE').'') ?>
                </span>
              </td>
              <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('STATE').'') ?>
                </span>
              </td>
              <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                <span><?php echo escapeHtml(''.@lang('ACTION').'') ?>
                </span>
              </td>
            </tr>
            <?php $if1=(($el)==FALSE); if($if1) {  ?>
              <tr><?php echo escapeHtml('') ?>
                <td colspan="<?php echo escapeHtml('8') ?>"><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@lang('NOT_FOUND').'') ?>
                  </span>
                </td>
              </tr>
             <?php } ?>
            <?php foreach((array)$el as $list_key=>$list_value) { extract($list_value); ?>
              <tr class="<?php echo escapeHtml('data') ?>"><?php echo escapeHtml('') ?>
                <td><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@$lfd_nr.'') ?>
                  </span>
                </td>
                <td><?php echo escapeHtml('') ?>
                  <?php $if1=(isset($compareid)); if($if1) {  ?>
                    <input type="<?php echo escapeHtml('radio') ?>" name="<?php echo escapeHtml('compareid') ?>" value="<?php echo escapeHtml(''.@$id.'') ?>" checked="<?php echo escapeHtml(''.@$compareid.'') ?>" /><?php echo escapeHtml('') ?>
                   <?php } ?>
                  <?php if(!$if1) {  ?>
                    <span><?php echo escapeHtml(' ') ?>
                    </span>
                   <?php } ?>
                </td>
                <td><?php echo escapeHtml('') ?>
                  <?php $if1=(isset($compareid)); if($if1) {  ?>
                    <input type="<?php echo escapeHtml('radio') ?>" name="<?php echo escapeHtml('withid') ?>" value="<?php echo escapeHtml(''.@$id.'') ?>" checked="<?php echo escapeHtml(''.@$withid.'') ?>" /><?php echo escapeHtml('') ?>
                   <?php } ?>
                  <?php if(!$if1) {  ?>
                    <span><?php echo escapeHtml(' ') ?>
                    </span>
                   <?php } ?>
                </td>
                <td><?php echo escapeHtml('') ?>
                  <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($date); ?>
                   <?php } ?>
                </td>
                <td><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@$user.'') ?>
                  </span>
                </td>
                <td><?php echo escapeHtml('') ?>
                  <span><?php echo escapeHtml(''.@$value.'') ?>
                  </span>
                </td>
                <?php $if1=($public); if($if1) {  ?>
                  <td><?php echo escapeHtml('') ?>
                    <strong><?php echo escapeHtml(''.@lang('PUBLIC').'') ?>
                    </strong>
                  </td>
                 <?php } ?>
                <?php if(!$if1) {  ?>
                  <?php $if1=(isset($releaseUrl)); if($if1) {  ?>
                    <td class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
                      <a title="<?php echo escapeHtml(''.@lang('RELEASE_DESC').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('post') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('release') ?>" data-id="<?php echo escapeHtml(''.@$objectid.'') ?>" data-extra="<?php echo escapeHtml('{\'valueid\':\''.@$valueid.'\'}') ?>" data-data="<?php echo escapeHtml('{"action":"pageelement","subaction":"release","id":"'.@$objectid.'","token":"'.@$_token.'","valueid":"'.@$valueid.'","none":"0"}') ?>"><?php echo escapeHtml('') ?>
                        <strong><?php echo escapeHtml(''.@lang('RELEASE').'') ?>
                        </strong>
                      </a>
                    </td>
                   <?php } ?>
                  <?php if(!$if1) {  ?>
                    <td><?php echo escapeHtml('') ?>
                      <em><?php echo escapeHtml(''.@lang('INACTIVE').'') ?>
                      </em>
                    </td>
                   <?php } ?>
                 <?php } ?>
                <?php $if1=($active); if($if1) {  ?>
                  <td><?php echo escapeHtml('') ?>
                    <em><?php echo escapeHtml(''.@lang('ACTIVE').'') ?>
                    </em>
                  </td>
                 <?php } ?>
                <?php if(!$if1) {  ?>
                  <?php $if1=(isset($useUrl)); if($if1) {  ?>
                    <td class="<?php echo escapeHtml('clickable') ?>"><?php echo escapeHtml('') ?>
                      <a title="<?php echo escapeHtml(''.@lang('USE_DESC').'') ?>" target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('post') ?>" data-action="<?php echo escapeHtml('') ?>" data-method="<?php echo escapeHtml('use') ?>" data-id="<?php echo escapeHtml(''.@$objectid.'') ?>" data-extra="<?php echo escapeHtml('{\'valueid\':\''.@$valueid.'\'}') ?>" data-data="<?php echo escapeHtml('{"action":"pageelement","subaction":"use","id":"'.@$objectid.'","token":"'.@$_token.'","valueid":"'.@$valueid.'","none":"0"}') ?>"><?php echo escapeHtml('') ?>
                        <span><?php echo escapeHtml(''.@lang('USE').'') ?>
                        </span>
                      </a>
                    </td>
                   <?php } ?>
                  <?php if(!$if1) {  ?>
                    <td><?php echo escapeHtml('') ?>
                    </td>
                   <?php } ?>
                 <?php } ?>
              </tr>
             <?php } ?>
          </table>
        </div>
      </div>
    </div>
    <div class="<?php echo escapeHtml('or-form-actionbar') ?>"><?php echo escapeHtml('') ?>
      <input type="<?php echo escapeHtml('submit') ?>" value="<?php echo escapeHtml(''.@lang('compare').'') ?>" class="<?php echo escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo escapeHtml('') ?>
    </div>
  </form>