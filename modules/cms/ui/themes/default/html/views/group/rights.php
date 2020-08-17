<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
      <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
        <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
          <?php foreach((array)$projects as $list_key=>$list_value) { extract($list_value); ?>
            <tr><?php echo escapeHtml('') ?>
              <td><?php echo escapeHtml('') ?>
                <fieldset class="<?php echo escapeHtml('or-group toggle-open-close open show') ?>"><?php echo escapeHtml('') ?>
                  <legend class="<?php echo escapeHtml('on-click-open-close') ?>"><?php echo escapeHtml(''.@$projectname.'') ?>
                    <img /><?php echo escapeHtml('') ?>
                    <div class="<?php echo escapeHtml('arrow arrow-right on-closed') ?>"><?php echo escapeHtml('') ?>
                    </div>
                    <div class="<?php echo escapeHtml('arrow arrow-down on-open') ?>"><?php echo escapeHtml('') ?>
                    </div>
                  </legend>
                  <div class="<?php echo escapeHtml('closable') ?>"><?php echo escapeHtml('') ?>
                    <?php $if1=(($rights)==FALSE); if($if1) {  ?>
                      <tr><?php echo escapeHtml('') ?>
                        <td><?php echo escapeHtml('') ?>
                          <span><?php echo escapeHtml(''.@lang('GLOBAL_NOT_FOUND').'') ?>
                          </span>
                        </td>
                      </tr>
                     <?php } ?>
                    <?php $if1=!(($rights)==FALSE); if($if1) {  ?>
                      <div class="<?php echo escapeHtml('or-table-wrapper') ?>"><?php echo escapeHtml('') ?>
                        <div class="<?php echo escapeHtml('or-table-filter') ?>"><?php echo escapeHtml('') ?>
                          <input type="<?php echo escapeHtml('search') ?>" name="<?php echo escapeHtml('filter') ?>" placeholder="<?php echo escapeHtml(''.@lang('SEARCH_FILTER').'') ?>" /><?php echo escapeHtml('') ?>
                        </div>
                        <div class="<?php echo escapeHtml('or-table-area') ?>"><?php echo escapeHtml('') ?>
                          <table width="<?php echo escapeHtml('100%') ?>"><?php echo escapeHtml('') ?>
                            <tr class="<?php echo escapeHtml('headline') ?>"><?php echo escapeHtml('') ?>
                              <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                                <span><?php echo escapeHtml(''.@lang('GLOBAL_USER').'') ?>
                                </span>
                              </td>
                              <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                                <span><?php echo escapeHtml(''.@lang('GLOBAL_NAME').'') ?>
                                </span>
                              </td>
                              <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                                <span><?php echo escapeHtml(''.@lang('GLOBAL_LANGUAGE').'') ?>
                                </span>
                              </td>
                              <?php foreach((array)$show as $list_key=>$t) {  ?>
                                <td class="<?php echo escapeHtml('help') ?>"><?php echo escapeHtml('') ?>
                                  <span title="<?php echo escapeHtml('message:acl_{t}') ?>"><?php echo escapeHtml(''.@lang('acl_'.@$t.'_abbrev').'') ?>
                                  </span>
                                </td>
                               <?php } ?>
                            </tr>
                            <?php foreach((array)$rights as $aclid=>$acl) { extract($acl); ?>
                              <tr class="<?php echo escapeHtml('data clickable') ?>"><?php echo escapeHtml('') ?>
                                <td><?php echo escapeHtml('') ?>
                                  <?php $if1=(isset($groupname)); if($if1) {  ?>
                                    <i class="<?php echo escapeHtml('image-icon image-icon--action-group') ?>"><?php echo escapeHtml('') ?>
                                    </i>
                                    <span><?php echo escapeHtml(''.@$groupname.'') ?>
                                    </span>
                                   <?php } ?>
                                  <?php $if1=!(isset($username)); if($if1) {  ?>
                                    <?php $if1=!(isset($groupname)); if($if1) {  ?>
                                      <i class="<?php echo escapeHtml('image-icon image-icon--action-group') ?>"><?php echo escapeHtml('') ?>
                                      </i>
                                      <span><?php echo escapeHtml(''.@lang('global_all').'') ?>
                                      </span>
                                     <?php } ?>
                                   <?php } ?>
                                  <?php  { unset($username) ?>
                                   <?php } ?>
                                  <?php  { unset($groupname) ?>
                                   <?php } ?>
                                </td>
                                <td title="<?php echo escapeHtml(''.@$objectname.'') ?>"><?php echo escapeHtml('') ?>
                                  <i class="<?php echo escapeHtml('image-icon image-icon--action-'.@$objecttype.'') ?>"><?php echo escapeHtml('') ?>
                                  </i>
                                  <a target="<?php echo escapeHtml('_self') ?>" data-type="<?php echo escapeHtml('open') ?>" data-action="<?php echo escapeHtml(''.@$objecttype.'') ?>" data-method="<?php echo escapeHtml('') ?>" data-id="<?php echo escapeHtml(''.@$objectid.'') ?>" data-extra="<?php echo escapeHtml('[]') ?>" href="<?php echo escapeHtml('/#/'.@$objecttype.'/'.@$objectid.'') ?>"><?php echo escapeHtml('') ?>
                                    <span><?php echo escapeHtml(''.@$objectname.'') ?>
                                    </span>
                                  </a>
                                </td>
                                <td><?php echo escapeHtml('') ?>
                                  <span><?php echo escapeHtml(''.@$languagename.'') ?>
                                  </span>
                                </td>
                                <?php foreach((array)$show as $list_key=>$list_value) {  ?>
                                  <td><?php echo escapeHtml('') ?>
                                    <?php  { $$list_value= $bits[$list_value]; ?>
                                     <?php } ?>
                                    <input type="<?php echo escapeHtml('checkbox') ?>" name="<?php echo escapeHtml(''.@$list_value.'') ?>" disabled="<?php echo escapeHtml('disabled') ?>" value="<?php echo escapeHtml('1') ?>" <?php if(@$$list_value){ ?>checked="<?php echo escapeHtml('1') ?>"<?php } ?> /><?php echo escapeHtml('') ?>
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
 <?php } ?>