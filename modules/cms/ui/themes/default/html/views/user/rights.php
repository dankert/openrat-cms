<?php defined('APP_STARTED') || die('Forbidden'); ?>
  <?php foreach((array)$projects as $list_key=>$list_value) { extract($list_value); ?>
    <fieldset class="<?php echo \template_engine\Output::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
      <legend class="<?php echo \template_engine\Output::escapeHtml('on-click-open-close') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$projectname.'') ?>
        <img /><?php echo \template_engine\Output::escapeHtml('') ?>
        <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        </div>
        <div class="<?php echo \template_engine\Output::escapeHtml('arrow arrow-down on-open') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        </div>
      </legend>
      <div class="<?php echo \template_engine\Output::escapeHtml('closable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
        <?php $if1=(($rights)==FALSE); if($if1) {  ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('NOT_FOUND').'') ?>
            </span>
          </div>
         <?php } ?>
        <?php $if1=!(($rights)==FALSE); if($if1) {  ?>
          <div class="<?php echo \template_engine\Output::escapeHtml('or-table-wrapper') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
            <div class="<?php echo \template_engine\Output::escapeHtml('or-table-filter') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <input type="<?php echo \template_engine\Output::escapeHtml('search') ?>" name="<?php echo \template_engine\Output::escapeHtml('filter') ?>" placeholder="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('SEARCH_FILTER').'') ?>" /><?php echo \template_engine\Output::escapeHtml('') ?>
            </div>
            <div class="<?php echo \template_engine\Output::escapeHtml('or-table-area') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
              <table width="<?php echo \template_engine\Output::escapeHtml('100%') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                <tr class="<?php echo \template_engine\Output::escapeHtml('headline') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                  <td class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('USER').'') ?>
                    </span>
                  </td>
                  <td class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('NAME').'') ?>
                    </span>
                  </td>
                  <td class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('LANGUAGE').'') ?>
                    </span>
                  </td>
                  <?php foreach((array)$show as $list_key=>$t) {  ?>
                    <td class="<?php echo \template_engine\Output::escapeHtml('help') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                      <span title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('acl_'.@$t.'').'') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('acl_'.@$t.'_abbrev').'') ?>
                      </span>
                      <span title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('acl_').'') ?>"><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('acl__abbrev').'') ?>
                      </span>
                    </td>
                   <?php } ?>
                </tr>
                <?php foreach((array)$rights as $aclid=>$acl) { extract($acl); ?>
                  <tr class="<?php echo \template_engine\Output::escapeHtml('data clickable') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                    <td><?php echo \template_engine\Output::escapeHtml('') ?>
                      <?php $if1=(isset($username)); if($if1) {  ?>
                        <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-user') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                        </i>
                        <span><?php echo \template_engine\Output::escapeHtml(''.@$username.'') ?>
                        </span>
                       <?php } ?>
                      <?php $if1=(isset($groupname)); if($if1) {  ?>
                        <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-group') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                        </i>
                        <span><?php echo \template_engine\Output::escapeHtml(''.@$groupname.'') ?>
                        </span>
                       <?php } ?>
                      <?php $if1=!(isset($username)); if($if1) {  ?>
                        <?php $if1=!(isset($groupname)); if($if1) {  ?>
                          <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-group') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                          </i>
                          <span><?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('all').'') ?>
                          </span>
                         <?php } ?>
                       <?php } ?>
                      <?php  { unset($username) ?>
                       <?php } ?>
                      <?php  { unset($groupname) ?>
                       <?php } ?>
                    </td>
                    <td><?php echo \template_engine\Output::escapeHtml('') ?>
                      <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-'.@$objecttype.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                      </i>
                      <a target="<?php echo \template_engine\Output::escapeHtml('_self') ?>" data-type="<?php echo \template_engine\Output::escapeHtml('open') ?>" data-action="<?php echo \template_engine\Output::escapeHtml(''.@$objecttype.'') ?>" data-method="<?php echo \template_engine\Output::escapeHtml('') ?>" data-id="<?php echo \template_engine\Output::escapeHtml(''.@$objectid.'') ?>" data-extra="<?php echo \template_engine\Output::escapeHtml('[]') ?>" href="<?php echo \template_engine\Output::escapeHtml('/#/'.@$objecttype.'/'.@$objectid.'') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                        <span title="<?php echo \template_engine\Output::escapeHtml(''.@\template_engine\Output::lang('select').'') ?>"><?php echo \template_engine\Output::escapeHtml(''.@$objectname.'') ?>
                        </span>
                      </a>
                    </td>
                    <td><?php echo \template_engine\Output::escapeHtml('') ?>
                      <i class="<?php echo \template_engine\Output::escapeHtml('image-icon image-icon--action-language') ?>"><?php echo \template_engine\Output::escapeHtml('') ?>
                      </i>
                      <span><?php echo \template_engine\Output::escapeHtml(''.@$languagename.'') ?>
                      </span>
                    </td>
                    <?php foreach((array)$show as $list_key=>$list_value) {  ?>
                      <td><?php echo \template_engine\Output::escapeHtml('') ?>
                        <?php  { $$list_value= $bits[$list_value]; ?>
                         <?php } ?>
                        <input type="<?php echo \template_engine\Output::escapeHtml('checkbox') ?>" name="<?php echo \template_engine\Output::escapeHtml(''.@$list_value.'') ?>" disabled="<?php echo \template_engine\Output::escapeHtml('disabled') ?>" value="<?php echo \template_engine\Output::escapeHtml('1') ?>" <?php if(@$$list_value){ ?>checked="<?php echo \template_engine\Output::escapeHtml('checked') ?>"<?php } ?> /><?php echo \template_engine\Output::escapeHtml('') ?>
                      </td>
                     <?php } ?>
                  </tr>
                 <?php } ?>
              </table>
            </div>
          </div>
         <?php } ?>
      </div>
    </fieldset>
   <?php } ?>