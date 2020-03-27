<?php if (defined('OR_TITLE')) {  ?>
  
    
      <form name="" target="_self" data-target="view" action="./" data-method="form" data-action="page" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form page">
        <input type="hidden" name="token" value="<?php echo token();?>" />
        <input type="hidden" name="action" value="page" />
        <input type="hidden" name="subaction" value="form" />
        <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
        <div>
          
            <div class="or-table-wrapper">
              <div class="or-table-filter">
                <input type="search" name="filter" placeholder="<?php echo encodeHtml(htmlentities(@lang('SEARCH_FILTER'))) ?>" />
              </div>
              <div class="or-table-area">
                <table width="100%">
                  <?php $if1=(($el)==FALSE); if($if1) {  ?>
                    <tr>
                      <td colspan="4">
                        <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOT_FOUND'))) ?>
                        </span>
                      </td>
                    </tr>
                   <?php } ?>
                  <?php $if1=!(($el)==FALSE); if($if1) {  ?>
                    <tr>
                      <td class="help">
                        <span><?php echo encodeHtml(htmlentities(@lang('PAGE_ELEMENT_NAME'))) ?>
                        </span>
                      </td>
                      <td class="help">
                        <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_CHANGE'))) ?>
                        </span>
                      </td>
                      <td class="help">
                        <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_VALUE'))) ?>
                        </span>
                      </td>
                    </tr>
                    <?php foreach($el as $list_key=>$list_value) { extract($list_value); ?>
                      <tr class="data">
                        <td>
                          <label class="label">
                            <i class="image-icon image-icon--action-el_<?php echo encodeHtml(htmlentities(@$type)) ?>">
                            </i>
                            <span><?php echo encodeHtml(htmlentities(@$name)) ?>
                            </span>
                          </label>
                        </td>
                        <td>
                          <input type="checkbox" name="<?php echo encodeHtml(htmlentities(@$saveid)) ?>" value="1" <?php if(@$${saveid}){ ?>checked="1"<?php } ?> />
                        </td>
                        <td>
                          <?php $if1=(in_array($type,explode(",",'text,date,number')); if($if1) {  ?>
                            <div class="inputholder">
                              <input name="<?php echo encodeHtml(htmlentities(@$id)) ?>" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$value)) ?>" />
                            </div>
                           <?php } ?>
                          <?php $if1=($type=='longtext'); if($if1) {  ?>
                            <textarea name="<?php echo encodeHtml(htmlentities(@$id)) ?>" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$value)) ?>
                            </textarea>
                           <?php } ?>
                          <?php $if1=(in_array($type,explode(",",'select,link,list')); if($if1) {  ?>
                            <select name="<?php echo encodeHtml(htmlentities(@$id)) ?>" size="1">
                              <?php foreach($list as $_key=>$_value) {  ?>
                                <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==''.@$value.''){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                                </option>
                               <?php } ?>
                            </select>
                           <?php } ?>
                        </td>
                      </tr>
                     <?php } ?>
                   <?php } ?>
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
                <?php $if1=(isset($release)); if($if1) {  ?>
                  <div class="">
                    <input type="checkbox" name="release" value="1" <?php if(@$release){ ?>checked="1"<?php } ?> />
                    <label class="label">
                      <span> 
                      </span>
                      <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_RELEASE'))) ?>
                      </span>
                    </label>
                  </div>
                 <?php } ?>
                <?php $if1=(isset($publish)); if($if1) {  ?>
                  <div class="">
                    <input type="checkbox" name="publish" value="1" <?php if(@$publish){ ?>checked="1"<?php } ?> />
                    <label class="label">
                      <span> 
                      </span>
                      <span><?php echo encodeHtml(htmlentities(@lang('PAGE_PUBLISH_AFTER_SAVE'))) ?>
                      </span>
                    </label>
                  </div>
                 <?php } ?>
              </div>
            </fieldset>
            
        </div>
        <div class="or-form-actionbar">
          <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
          <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
        </div>
      </form>
 <?php } ?>