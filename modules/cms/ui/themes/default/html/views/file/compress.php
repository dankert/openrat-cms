<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="compress" data-action="file" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form file">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="file" />
      <input type="hidden" name="subaction" value="compress" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <fieldset class="or-group toggle-open-close open show">
          <legend class="on-click-open-close"><?php echo encodeHtml(htmlentities(@lang('OPTIONS'))) ?>
            <img />
            <div class="arrow arrow-right on-closed">
            </div>
            <div class="arrow arrow-down on-open">
            </div>
          </legend>
          <div class="closable">
            <div class="line">
              <div class="label">
                <span><?php echo encodeHtml(htmlentities(@lang('type'))) ?>
                </span>
              </div>
              <div class="input">
                <?php  { $gz= 'gz'; ?>
                 <?php } ?>
                <select name="format" size="1">
                  <?php foreach($formats as $_key=>$_value) {  ?>
                    <option value="<?php echo encodeHtml(htmlentities(@$_key)) ?>" <?php if($_key=='gz'){ ?>selected="selected"<?php } ?>><?php echo encodeHtml(htmlentities(@$_value)) ?>
                    </option>
                   <?php } ?>
                </select>
                <?php  { $replace= '1'; ?>
                 <?php } ?>
                <input type="radio" name="replace" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$replace)) ?>" />
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('replace'))) ?>
                  </span>
                </label>
                <br />
                <input type="radio" name="replace" disabled="" value="0" checked="<?php echo encodeHtml(htmlentities(@$replace)) ?>" />
                <label class="label">
                  <span><?php echo encodeHtml(htmlentities(@lang('new'))) ?>
                  </span>
                </label>
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