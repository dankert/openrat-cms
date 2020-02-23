<?php if (defined('OR_TITLE')) {  ?>
  
    
      <form name="" target="_self" data-target="view" action="./" data-method="extract" data-action="image" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form image">
        <input type="hidden" name="token" value="<?php echo token();?>" />
        <input type="hidden" name="action" value="image" />
        <input type="hidden" name="subaction" value="extract" />
        <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
        <div>
          
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