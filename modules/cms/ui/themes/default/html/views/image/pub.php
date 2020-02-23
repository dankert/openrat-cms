<?php if (defined('OR_TITLE')) {  ?>
  
    <?php $if1=(config('security','nopublish')); if($if1) {  ?>
      <div class="message warn">
        <span class="help"><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOPUBLISH_DESC'))) ?>
        </span>
      </div>
     <?php } ?>
    <form name="" target="_self" data-target="view" action="./" data-method="pub" data-action="image" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="1" data-autosave="" class="or-form image">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="image" />
      <input type="hidden" name="subaction" value="pub" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <tr>
          <td>
            <br />
          </td>
        </tr>
        <tr>
          <td class="act">
            
          </td>
        </tr>
      </div>
      <div class="or-form-actionbar">
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('publish'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>