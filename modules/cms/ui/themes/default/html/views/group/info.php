<?php if (defined('OR_TITLE')) {  ?>
  
    <form name="" target="_self" data-target="view" action="./" data-method="info" data-action="group" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form group">
      <input type="hidden" name="token" value="<?php echo token();?>" />
      <input type="hidden" name="action" value="group" />
      <input type="hidden" name="subaction" value="info" />
      <input type="hidden" name="id" value="<?php echo OR_ID ?>" />
      <div>
        <span class="headline"><?php echo encodeHtml(htmlentities(@$name)) ?>
        </span>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
            </span>
          </div>
          <div class="input clickable">
            <span><?php echo encodeHtml(htmlentities(@$name)) ?>
            </span>
            <a target="_self" data-type="edit" data-action="group" data-method="prop" data-id="" data-extra="[]" href="/#/group/" class="or-link-btn">
              <span><?php echo encodeHtml(htmlentities(@lang('edit'))) ?>
              </span>
            </a>
          </div>
        </div>
        <div class="line">
          <div class="label">
            <span><?php echo encodeHtml(htmlentities(@lang('USERS'))) ?>
            </span>
          </div>
          <div class="input">
            <?php foreach($users as $id=>$name) {  ?>
              <div class="clickable">
                <a target="_self" data-type="open" data-action="user" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" data-extra="[]" href="/#/user/<?php echo encodeHtml(htmlentities(@$id)) ?>">
                  <span><?php echo encodeHtml(htmlentities(@$name)) ?>
                  </span>
                </a>
                <br />
              </div>
             <?php } ?>
          </div>
        </div>
        <div class="line">
          <div class="label">
          </div>
          <div class="input clickable">
            <a target="_self" data-type="edit" data-action="group" data-method="memberships" data-id="" data-extra="[]" href="/#/group/" class="or-link-btn">
              <span><?php echo encodeHtml(htmlentities(@lang('edit'))) ?>
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="or-form-actionbar">
      </div>
    </form>
 <?php } ?>