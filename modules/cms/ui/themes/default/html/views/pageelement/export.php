<?php if (defined('OR_TITLE')) {  ?>
  
    
      <form name="" target="_self" data-target="view" action="./" data-method="export" data-action="pageelement" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form pageelement">
        <input type="hidden" name="token" value="<?php echo token();?>" />
        <input type="hidden" name="action" value="pageelement" />
        <input type="hidden" name="subaction" value="export" />
        <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
        <div>
          
            <tr>
              <td>
                <select name="type" size="1">
                  <?php foreach($types as $_key=>$_value) {  ?>
                    <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key==$type){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                    </option>
                   <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                
              </td>
            </tr>
        </div>
        <div class="or-form-actionbar">
          <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
          <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
        </div>
      </form>
      
 <?php } ?>