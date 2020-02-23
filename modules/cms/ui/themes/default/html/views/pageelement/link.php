<?php if (defined('OR_TITLE')) {  ?>
  
    
      <form name="" target="_self" data-target="view" action="./" data-method="link" data-action="pageelement" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form pageelement">
        <input type="hidden" name="token" value="<?php echo token();?>" />
        <input type="hidden" name="action" value="pageelement" />
        <input type="hidden" name="subaction" value="link" />
        <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
        <div>
          
            <tr>
              <td colspan="2" class="help">
                <span><?php echo encodeHtml(htmlentities(@$desc)) ?>
                </span>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <select name="linkobjectid" size="1">
                  <?php foreach($objects as $_key=>$_value) {  ?>
                    <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$linkobjectid){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                    </option>
                   <?php } ?>
                </select>
              </td>
            </tr>
            <?php $if1=(isset($release)); if($if1) {  ?>
              <?php $if1=(isset($publish)); if($if1) {  ?>
                <tr>
                  <td colspan="2">
                    <fieldset class="or-group toggle-open-close open show">
                      <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('options'))) ?>
                        <img />
                        <div class="arrow arrow-right on-closed">
                        </div>
                        <div class="arrow arrow-down on-open">
                        </div>
                      </legend>
                      <div class="closable">
                      </div>
                    </fieldset>
                  </td>
                </tr>
               <?php } ?>
             <?php } ?>
            <?php $if1=(isset($release)); if($if1) {  ?>
              <tr>
                <td colspan="2">
                  <input type="checkbox" name="release" value="1" <?php if(@$release){ ?>checked="1"<?php } ?> />
                  <label class="label">
                    <span> 
                    </span>
                    <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_RELEASE'))) ?>
                    </span>
                  </label>
                </td>
              </tr>
             <?php } ?>
            <?php $if1=(isset($publish)); if($if1) {  ?>
              <tr>
                <td colspan="2">
                  <input type="checkbox" name="publish" value="1" <?php if(@$publish){ ?>checked="1"<?php } ?> />
                  <label class="label">
                    <span> 
                    </span>
                    <span><?php echo encodeHtml(htmlentities(@lang('PAGE_PUBLISH_AFTER_SAVE'))) ?>
                    </span>
                  </label>
                </td>
              </tr>
             <?php } ?>
            <tr>
              <td colspan="2" class="act">
                
              </td>
            </tr>
        </div>
        <div class="or-form-actionbar">
          <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
          <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
        </div>
      </form>
      
 <?php } ?>