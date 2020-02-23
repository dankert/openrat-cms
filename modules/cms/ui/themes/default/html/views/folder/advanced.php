<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="edit" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form folder">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="folder" />
      <input type="hidden" name="subaction" value="edit" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="or-table-wrapper">
          <div class="or-table-filter">
            <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
          </div>
          <div class="or-table-area">
            <table width="100%">
              <tr class="headline">
                <td class="help">
                  <input type="checkbox" name="checkall" value="1" <?php if(@$checkall){ ?>checked="1"<?php } ?> />
                </td>
                <td class="help">
                  <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_TYPE'))) ?>
                  </span>
                  <span> / 
                  </span>
                  <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
                  </span>
                </td>
              </tr>
              <?php foreach($object as $list_key=>$list_value) { extract($list_value); ?>
                <tr class="data">
                  <td width="1%">
                    <?php $if1=($writable); if($if1) {  ?>
                      <input type="checkbox" name="<?php echo encodeHtml(htmlentities(@$id)) ?>" value="1" <?php if(@$${id}){ ?>checked="1"<?php } ?> />
                     <?php } ?>
                    <?php $if1=(!'writable'); if($if1) {  ?>
                      <span> 
                      </span>
                     <?php } ?>
                  </td>
                  <td class="clickable">
                    <label class="label">
                      <a target="_self" date-name="<?php echo encodeHtml(htmlentities(@$name)) ?>" name="<?php echo encodeHtml(htmlentities(@$name)) ?>" data-type="open" data-action="<?php echo encodeHtml(htmlentities(@$type)) ?>" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$objectid)) ?>" data-extra="[]" href="/#/<?php echo encodeHtml(htmlentities(@$type)) ?>/<?php echo encodeHtml(htmlentities(@$objectid)) ?>">
                        <i class="image-icon image-icon--action-<?php echo encodeHtml(htmlentities(@$icon)) ?>">
                        </i>
                        <span><?php echo encodeHtml(htmlentities(@$name)) ?>
                        </span>
                        <span> 
                        </span>
                      </a>
                    </label>
                  </td>
                </tr>
               <?php } ?>
              <?php $if1=(($object)==FALSE); if($if1) {  ?>
                <tr>
                  <td colspan="2">
                    <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOT_FOUND'))) ?>
                    </span>
                  </td>
                </tr>
               <?php } ?>
              <tr class="data">
                <td>
                  <span> 
                  </span>
                </td>
                <td colspan="2" class="clickable">
                  <a target="_self" data-type="dialog" data-action="folder" data-method="create" data-id="" data-extra="{'dialogAction':'folder','dialogMethod':'create'}" href="/#/folder/">
                    <i class="image-icon image-icon--method-add">
                    </i>
                    <span><?php echo encodeHtml(htmlentities(@lang('menu_folder_create'))) ?>
                    </span>
                  </a>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('options'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <?php  { $type= $defaulttype; ?>
             <?php } ?>
            <?php foreach($actionlist as $list_key=>$actiontype) {  ?>
              <div class="line">
                <div class="label">
                </div>
                <div class="input">
                  <input type="radio" name="type" disabled="" value="<?php echo encodeHtml(htmlentities(@$actiontype)) ?>" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" />
                  <label class="label">
                    <span> 
                    </span>
                    <span><?php echo encodeHtml(htmlentities(@lang('${actiontype'))) ?>}
                    </span>
                  </label>
                </div>
              </div>
             <?php } ?>
            <div class="line">
              <div class="label">
              </div>
              <div class="input">
                <span>    
                </span>
                <input type="checkbox" name="confirm" value="1" <?php if(@$confirm){ ?>checked="1"<?php } ?> required="required" />
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('CONFIRM_DELETE'))) ?>
                  </span>
                </label>
              </div>
            </div>
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('FOLDER_SELECT_TARGET_FOLDER'))) ?>
                </span>
              </div>
              <div class="input">
                
              </div>
            </div>
          </div>
        </fieldset>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>