<?php defined('APP_STARTED') || die('Forbidden'); use \template_engine\Output as O; ?>
  <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
    <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
      <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
        <?php foreach((array)$projects as $list_key=>$list_value) { extract($list_value); ?>
          <tr><?php echo O::escapeHtml('') ?>
            <td><?php echo O::escapeHtml('') ?>
              <fieldset class="<?php echo O::escapeHtml('or-group toggle-open-close open show') ?>"><?php echo O::escapeHtml('') ?>
                <legend class="<?php echo O::escapeHtml('on-click-open-close') ?>"><?php echo O::escapeHtml(''.@$projectname.'') ?>
                  <img /><?php echo O::escapeHtml('') ?>
                  <div class="<?php echo O::escapeHtml('arrow arrow-right on-closed') ?>"><?php echo O::escapeHtml('') ?>
                  </div>
                  <div class="<?php echo O::escapeHtml('arrow arrow-down on-open') ?>"><?php echo O::escapeHtml('') ?>
                  </div>
                </legend>
                <div class="<?php echo O::escapeHtml('closable') ?>"><?php echo O::escapeHtml('') ?>
                  <?php $if1=(($rights)==FALSE); if($if1) {  ?>
                    <tr><?php echo O::escapeHtml('') ?>
                      <td><?php echo O::escapeHtml('') ?>
                        <span><?php echo O::escapeHtml(''.@O::lang('NOT_FOUND').'') ?>
                        </span>
                      </td>
                    </tr>
                   <?php } ?>
                  <?php $if1=!(($rights)==FALSE); if($if1) {  ?>
                    <div class="<?php echo O::escapeHtml('or-table-wrapper') ?>"><?php echo O::escapeHtml('') ?>
                      <div class="<?php echo O::escapeHtml('or-table-filter') ?>"><?php echo O::escapeHtml('') ?>
                        <input type="<?php echo O::escapeHtml('search') ?>" name="<?php echo O::escapeHtml('filter') ?>" placeholder="<?php echo O::escapeHtml(''.@O::lang('SEARCH_FILTER').'') ?>" class="<?php echo O::escapeHtml('or-input') ?>" /><?php echo O::escapeHtml('') ?>
                      </div>
                      <div class="<?php echo O::escapeHtml('or-table-area') ?>"><?php echo O::escapeHtml('') ?>
                        <table width="<?php echo O::escapeHtml('100%') ?>"><?php echo O::escapeHtml('') ?>
                          <tr class="<?php echo O::escapeHtml('headline') ?>"><?php echo O::escapeHtml('') ?>
                            <td class="<?php echo O::escapeHtml('help') ?>"><?php echo O::escapeHtml('') ?>
                              <span><?php echo O::escapeHtml(''.@O::lang('USER').'') ?>
                              </span>
                            </td>
                            <td class="<?php echo O::escapeHtml('help') ?>"><?php echo O::escapeHtml('') ?>
                              <span><?php echo O::escapeHtml(''.@O::lang('NAME').'') ?>
                              </span>
                            </td>
                            <td class="<?php echo O::escapeHtml('help') ?>"><?php echo O::escapeHtml('') ?>
                              <span><?php echo O::escapeHtml(''.@O::lang('LANGUAGE').'') ?>
                              </span>
                            </td>
                            <?php foreach((array)$show as $list_key=>$t) {  ?>
                              <td class="<?php echo O::escapeHtml('help') ?>"><?php echo O::escapeHtml('') ?>
                                <span title="<?php echo O::escapeHtml(''.@O::lang('acl_'.@$t.'').'') ?>"><?php echo O::escapeHtml(''.@O::lang('acl_'.@$t.'_abbrev').'') ?>
                                </span>
                              </td>
                             <?php } ?>
                          </tr>
                          <?php foreach((array)$rights as $aclid=>$acl) { extract($acl); ?>
                            <tr class="<?php echo O::escapeHtml('data clickable') ?>"><?php echo O::escapeHtml('') ?>
                              <td><?php echo O::escapeHtml('') ?>
                                <?php $if1=(isset($groupname)); if($if1) {  ?>
                                  <i class="<?php echo O::escapeHtml('image-icon image-icon--action-group') ?>"><?php echo O::escapeHtml('') ?>
                                  </i>
                                  <span><?php echo O::escapeHtml(''.@$groupname.'') ?>
                                  </span>
                                 <?php } ?>
                                <?php $if1=!(isset($username)); if($if1) {  ?>
                                  <?php $if1=!(isset($groupname)); if($if1) {  ?>
                                    <i class="<?php echo O::escapeHtml('image-icon image-icon--action-group') ?>"><?php echo O::escapeHtml('') ?>
                                    </i>
                                    <span><?php echo O::escapeHtml(''.@O::lang('all').'') ?>
                                    </span>
                                   <?php } ?>
                                 <?php } ?>
                                <?php  { unset($username) ?>
                                 <?php } ?>
                                <?php  { unset($groupname) ?>
                                 <?php } ?>
                              </td>
                              <td title="<?php echo O::escapeHtml(''.@$objectname.'') ?>"><?php echo O::escapeHtml('') ?>
                                <i class="<?php echo O::escapeHtml('image-icon image-icon--action-'.@$objecttype.'') ?>"><?php echo O::escapeHtml('') ?>
                                </i>
                                <a target="<?php echo O::escapeHtml('_self') ?>" data-type="<?php echo O::escapeHtml('open') ?>" data-action="<?php echo O::escapeHtml(''.@$objecttype.'') ?>" data-method="<?php echo O::escapeHtml('') ?>" data-id="<?php echo O::escapeHtml(''.@$objectid.'') ?>" data-extra="<?php echo O::escapeHtml('[]') ?>" href="<?php echo O::escapeHtml('/#/'.@$objecttype.'/'.@$objectid.'') ?>"><?php echo O::escapeHtml('') ?>
                                  <span><?php echo O::escapeHtml(''.@$objectname.'') ?>
                                  </span>
                                </a>
                              </td>
                              <td><?php echo O::escapeHtml('') ?>
                                <span><?php echo O::escapeHtml(''.@$languagename.'') ?>
                                </span>
                              </td>
                              <?php foreach((array)$show as $list_key=>$list_value) {  ?>
                                <td><?php echo O::escapeHtml('') ?>
                                  <?php  { $$list_value= $bits['$list_value']; ?>
                                   <?php } ?>
                                  <input type="<?php echo O::escapeHtml('checkbox') ?>" name="<?php echo O::escapeHtml(''.@$list_value.'') ?>" disabled="<?php echo O::escapeHtml('disabled') ?>" value="<?php echo O::escapeHtml('1') ?>" <?php if(@$$list_value){ ?>checked="<?php echo O::escapeHtml('checked') ?>"<?php } ?> /><?php echo O::escapeHtml('') ?>
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
            </td>
          </tr>
         <?php } ?>
      </table>
    </div>
  </div>