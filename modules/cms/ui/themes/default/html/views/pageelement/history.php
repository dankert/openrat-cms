<?php if (!defined('OR_TITLE')) exit(); ?>
  <form name="<?php echo \template_engine\Output::escapeHtml('') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-target="<?php echo \template_engine\Output::escapeHtml('view') ?>" action="<?php echo \template_engine\Output::escapeHtml('./') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('diff') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('pageelement') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" method="<?php echo \template_engine\Output::escapeHtml('get') ?>" enctype="<?php echo \template_engine\Output::escapeHtml('application/x-www-form-urlencoded') ?>" data-async="<?php echo \template_engine\Output::escapeHtml('') ?>" data-autosave="<?php echo \template_engine\Output::escapeHtml('') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form pageelement') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('token') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_token.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('action') ?>" value="<?php echo \template_engine\Output::escapeHtml('pageelement') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('subaction') ?>" value="<?php echo \template_engine\Output::escapeHtml('diff') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <input type="<?php echo \template_engine\Output::escapeHtml('hidden') ?>" name="<?php echo \template_engine\Output::escapeHtml('id') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$_id.'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    <div><?php echo \template_engine\Output::escapeHtml('') ?>
      <div class="<?php echo \template_engine\Output::escapeHtml('or-table-wrapper') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('or-table-filter') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <input type="<?php echo \template_engine\Output::escapeHtml('search') ?>" name="<?php echo \template_engine\Output::escapeHtml('filter') ?>" placeholder="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('SEARCH_FILTER').'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
        </div>
        <div class="<?php echo \template_engine\Output::escapeHtml('or-table-area') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
          <table width="<?php echo \template_engine\Output::escapeHtml('100%') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <tr class="<?php echo \template_engine\Output::escapeHtml('headline') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <td class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('NR').'') ?>
                </span>
              </td>
              <td colspan="<?php echo \template_engine\Output::escapeHtml('2') ?>" class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <?php $if1=(isset($compareid)); if($if1) {  ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('COMPARE').'') ?>
                  </span>
                 <?php } ?>
                <?php if(!$if1) {  ?>
                  <span><?php echo \template_engine\Output::escapeHtml(' ') ?>
                  </span>
                 <?php } ?>
              </td>
              <td class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('DATE').'') ?>
                </span>
              </td>
              <td class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('USER').'') ?>
                </span>
              </td>
              <td class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('VALUE').'') ?>
                </span>
              </td>
              <td class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('STATE').'') ?>
                </span>
              </td>
              <td class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('ACTION').'') ?>
                </span>
              </td>
            </tr>
            <?php $if1=(($el)==FALSE); if($if1) {  ?>
              <tr><?php echo \template_engine\Output::escapeHtml('') ?>
                <td colspan="<?php echo \template_engine\Output::escapeHtml('8') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('NOT_FOUND').'') ?>
                  </span>
                </td>
              </tr>
             <?php } ?>
            <?php foreach((array)$el as $list_key=>$list_value) { extract($list_value); ?>
              <tr class="<?php echo \template_engine\Output::escapeHtml('data') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <td><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@$lfd_nr.'') ?>
                  </span>
                </td>
                <td><?php echo \template_engine\Output::escapeHtml('') ?>
                  <?php $if1=(isset($compareid)); if($if1) {  ?>
                    <input type="<?php echo \template_engine\Output::escapeHtml('radio') ?>" name="<?php echo \template_engine\Output::escapeHtml('compareid') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$id.'') ?>" <?php if(@$compareid=='${id}'){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                   <?php } ?>
                  <?php if(!$if1) {  ?>
                    <span><?php echo \template_engine\Output::escapeHtml(' ') ?>
                    </span>
                   <?php } ?>
                </td>
                <td><?php echo \template_engine\Output::escapeHtml('') ?>
                  <?php $if1=(isset($compareid)); if($if1) {  ?>
                    <input type="<?php echo \template_engine\Output::escapeHtml('radio') ?>" name="<?php echo \template_engine\Output::escapeHtml('withid') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@$id.'') ?>" <?php if(@$withid=='${id}'){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                   <?php } ?>
                  <?php if(!$if1) {  ?>
                    <span><?php echo \template_engine\Output::escapeHtml(' ') ?>
                    </span>
                   <?php } ?>
                </td>
                <td><?php echo \template_engine\Output::escapeHtml('') ?>
                  <?php include_once( 'modules/template_engine/components/html/date/component-date.php'); { component_date($date); ?>
                   <?php } ?>
                </td>
                <td><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@$user.'') ?>
                  </span>
                </td>
                <td><?php echo \template_engine\Output::escapeHtml('') ?>
                  <span><?php echo \template_engine\Output::escapeHtml(''.@$value.'') ?>
                  </span>
                </td>
                <?php $if1=($public); if($if1) {  ?>
                  <td><?php echo \template_engine\Output::escapeHtml('') ?>
                    <strong><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('PUBLIC').'') ?>
                    </strong>
                  </td>
                 <?php } ?>
                <?php if(!$if1) {  ?>
                  <?php $if1=(isset($releaseUrl)); if($if1) {  ?>
                    <td class="<?php echo \template_engine\Output::escapeHtml('clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                      <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('RELEASE_DESC').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('post') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('release') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$objectid.'') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'valueid\':\''.@$valueid.'\'}') ?>" data-data="<?php echo \template_engine\Output::escapeHtml('{"action":"pageelement","subaction":"release","id":"'.@$objectid.'","token":"'.@$_token.'","valueid":"'.@$valueid.'","none":"0"}') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                        <strong><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('RELEASE').'') ?>
                        </strong>
                      </a>
                    </td>
                   <?php } ?>
                  <?php if(!$if1) {  ?>
                    <td><?php echo \template_engine\Output::escapeHtml('') ?>
                      <em><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('INACTIVE').'') ?>
                      </em>
                    </td>
                   <?php } ?>
                 <?php } ?>
                <?php $if1=($active); if($if1) {  ?>
                  <td><?php echo \template_engine\Output::escapeHtml('') ?>
                    <em><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('ACTIVE').'') ?>
                    </em>
                  </td>
                 <?php } ?>
                <?php if(!$if1) {  ?>
                  <?php $if1=(isset($useUrl)); if($if1) {  ?>
                    <td class="<?php echo \template_engine\Output::escapeHtml('clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                      <a title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('USE_DESC').'') ?>" target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('post') ?>" data-action="<?php echo \template_engine\Output::escapeHtml('') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('use') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$objectid.'') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('{\'valueid\':\''.@$valueid.'\'}') ?>" data-data="<?php echo \template_engine\Output::escapeHtml('{"action":"pageelement","subaction":"use","id":"'.@$objectid.'","token":"'.@$_token.'","valueid":"'.@$valueid.'","none":"0"}') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                        <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('USE').'') ?>
                        </span>
                      </a>
                    </td>
                   <?php } ?>
                  <?php if(!$if1) {  ?>
                    <td><?php echo \template_engine\Output::escapeHtml('') ?>
                    </td>
                   <?php } ?>
                 <?php } ?>
              </tr>
             <?php } ?>
          </table>
        </div>
      </div>
    </div>
    <div class="<?php echo \template_engine\Output::escapeHtml('or-form-actionbar') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <input type="<?php echo \template_engine\Output::escapeHtml('submit') ?>" value="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('compare').'') ?>" class="<?php echo \template_engine\Output::escapeHtml('or-form-btn or-form-btn--primary or-form-btn--save') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
    </div>
  </form>