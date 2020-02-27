<?php if (defined('OR_TITLE')) {  ?>
  
    <div class="or-table-wrapper">
      <div class="or-table-area">
        <table width="100%">
          <?php foreach($projects as $list_key=>$list_value) { extract($list_value); ?>
            <tr>
              <td>
                <fieldset class="or-group toggle-open-close open show">
                  <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@$projectname)) ?>
                    <img />
                    <div class="arrow arrow-right on-closed">
                    </div>
                    <div class="arrow arrow-down on-open">
                    </div>
                  </legend>
                  <div class="closable">
                    <?php $if1=(($rights)==FALSE); if($if1) {  ?>
                      <tr>
                        <td>
                          <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOT_FOUND'))) ?>
                          </span>
                        </td>
                      </tr>
                     <?php } ?>
                    <?php $if1=!(($rights)==FALSE); if($if1) {  ?>
                      <div class="or-table-wrapper">
                        <div class="or-table-filter">
                          <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
                        </div>
                        <div class="or-table-area">
                          <table width="100%">
                            <tr class="headline">
                              <td class="help">
                                <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_USER'))) ?>
                                </span>
                              </td>
                              <td class="help">
                                <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
                                </span>
                              </td>
                              <td class="help">
                                <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_LANGUAGE'))) ?>
                                </span>
                              </td>
                              <?php foreach($show as $list_key=>$t) {  ?>
                                <td class="help">
                                  <span title="message:acl<?php echo encodeHtml(htmlentities()) ?>"><?php echo encodeHtml(htmlentities(@lang(''.@$t.''))) ?>
                                  </span>
                                </td>
                               <?php } ?>
                            </tr>
                            <?php foreach($rights as $aclid=>$acl) { extract($acl); ?>
                              <tr class="data clickable">
                                <td>
                                  <?php $if1=(isset($groupname)); if($if1) {  ?>
                                    <i class="image-icon image-icon--action-group">
                                    </i>
                                    <span><?php echo encodeHtml(htmlentities(@$groupname)) ?>
                                    </span>
                                   <?php } ?>
                                  <?php $if1=!(isset($username)); if($if1) {  ?>
                                    <?php $if1=!(isset($groupname)); if($if1) {  ?>
                                      <i class="image-icon image-icon--action-group">
                                      </i>
                                      <span><?php echo encodeHtml(htmlentities(@lang('global_all'))) ?>
                                      </span>
                                     <?php } ?>
                                   <?php } ?>
                                  <?php  { unset($username) ?>
                                   <?php } ?>
                                  <?php  { unset($groupname) ?>
                                   <?php } ?>
                                </td>
                                <td title="<?php echo encodeHtml(htmlentities(@$objectname)) ?>">
                                  <i class="image-icon image-icon--action-<?php echo encodeHtml(htmlentities(@$objecttype)) ?>">
                                  </i>
                                  <a target="_self" data-type="open" data-action="<?php echo encodeHtml(htmlentities(@$objecttype)) ?>" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$objectid)) ?>" data-extra="[]" href="/#/<?php echo encodeHtml(htmlentities(@$objecttype)) ?>/<?php echo encodeHtml(htmlentities(@$objectid)) ?>">
                                    <span><?php echo encodeHtml(htmlentities(@$objectname)) ?>
                                    </span>
                                  </a>
                                </td>
                                <td>
                                  <span><?php echo encodeHtml(htmlentities(@$languagename)) ?>
                                  </span>
                                </td>
                                <?php foreach($show as $list_key=>$list_value) {  ?>
                                  <td>
                                    <?php  { $$list_value= $bits[$list_value]; ?>
                                     <?php } ?>
                                    <input type="checkbox" name="<?php echo encodeHtml(htmlentities(@$list_value)) ?>" disabled="disabled" value="1" <?php if(@$${list_value}){ ?>checked="1"<?php } ?> />
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