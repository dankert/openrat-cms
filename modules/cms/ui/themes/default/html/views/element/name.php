<?php if (defined('OR_TITLE')) {  ?>
  
    
      <form name="" target="_self" data-target="view" action="./" data-method="name" data-action="element" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form element">
        <input type="hidden" name="token" value="<?php echo token();?>" />
        <input type="hidden" name="action" value="element" />
        <input type="hidden" name="subaction" value="name" />
        <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
        <div>
          
            <tr>
              <td>
                <span><?php echo encodeHtml(htmlentities(@lang('ELEMENT_NAME'))) ?>
                </span>
              </td>
              <td>
                <div class="inputholder">
                  <input name="name" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" />
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_DESCRIPTION'))) ?>
                </span>
              </td>
              <td>
                <textarea name="description" disabled="" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$description)) ?>
                </textarea>
              </td>
            </tr>
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