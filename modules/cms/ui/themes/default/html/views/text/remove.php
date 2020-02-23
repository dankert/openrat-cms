<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="remove" data-action="text" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form text">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="text" />
      <input type="hidden" name="subaction" value="remove" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <tr>
          <td>
            <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
            </span>
          </td>
          <td>
            <span><?php echo encodeHtml(htmlentities(@$name)) ?>
            </span>
          </td>
        </tr>
        <tr>
          <td>
            <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_DELETE'))) ?>
            </span>
          </td>
          <td>
            <input type="checkbox" name="delete" value="1" <?php if(@$delete){ ?>checked="1"<?php } ?> />
          </td>
        </tr>
        <tr>
          <td colspan="2">
            
          </td>
        </tr>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>