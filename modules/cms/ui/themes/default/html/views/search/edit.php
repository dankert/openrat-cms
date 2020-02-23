<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="result" data-action="search" data-id="<?php echo OR_ID ?>" method="GET" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form search">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="search" />
      <input type="hidden" name="subaction" value="result" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <div class="line">
          <div class="label">
            <label class="label">
              <span><?php echo encodeHtml(htmlentities(@lang('value'))) ?>
              </span>
            </label>
            <br />
          </div>
          <div class="input">
            <div class="inputholder">
              <input name="text" placeholder="<?php echo encodeHtml(htmlentities(@lang('search'))) ?>" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$text)) ?>" />
            </div>
          </div>
        </div>
        <div class="line">
          <div class="label">
            <label class="label">
              <span><?php echo encodeHtml(htmlentities(@lang('filter'))) ?>
              </span>
            </label>
            <br />
          </div>
          <div class="input">
            <input type="checkbox" name="id" value="1" checked="<?php echo encodeHtml(htmlentities(config('search','quicksearch','flag','id'))) ?>" />
            <label class="label">
              <span><?php echo encodeHtml(htmlentities(@lang('id'))) ?>
              </span>
            </label>
            <br />
            <input type="checkbox" name="name" value="1" checked="<?php echo encodeHtml(htmlentities(config('search','quicksearch','flag','name'))) ?>" />
            <label class="label">
              <span><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
              </span>
            </label>
            <br />
            <input type="checkbox" name="filename" value="1" checked="<?php echo encodeHtml(htmlentities(config('search','quicksearch','flag','filename'))) ?>" />
            <label class="label">
              <span><?php echo encodeHtml(htmlentities(@lang('filename'))) ?>
              </span>
            </label>
            <br />
            <input type="checkbox" name="description" value="1" checked="<?php echo encodeHtml(htmlentities(config('search','quicksearch','flag','description'))) ?>" />
            <label class="label">
              <span><?php echo encodeHtml(htmlentities(@lang('description'))) ?>
              </span>
            </label>
            <br />
            <input type="checkbox" name="content" value="1" checked="<?php echo encodeHtml(htmlentities(config('search','quicksearch','flag','content'))) ?>" />
            <label class="label">
              <span><?php echo encodeHtml(htmlentities(@lang('content'))) ?>
              </span>
            </label>
          </div>
        </div>
      </div>
      <div class="or-form-actionbar">
        <input type="button" value="<?php echo encodeHtml(htmlentities(@lang('CANCEL'))) ?>" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" />
        <input type="submit" value="<?php echo encodeHtml(htmlentities(@lang('button_ok'))) ?>" class="or-form-btn or-form-btn--primary or-form-btn--save" />
      </div>
    </form>
 <?php } ?>