<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<form name="" target="_self" data-target="view" action="./" data-method="info" data-action="group" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form group" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="group" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="info" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<span class="headline"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
			
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NAME')))); ?></span>
					
				</div>
				<div class="input clickable">
					<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
					
					<a class="or-link-btn" target="_self" data-type="edit" data-action="group" data-method="prop" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#/group/">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'edit'.'')))); ?></span>
						
					</a>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('USERS')))); ?></span>
					
				</div>
				<div class="input">
					<?php foreach($users as $id=>$name){ ?>
						<div class="clickable">
							<a target="_self" data-type="open" data-action="user" data-method="info" data-id="<?php echo $id ?>" data-extra="[]" href="./#/user/<?php echo $id ?>">
								<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
								
							</a>
							<br/>
							
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="line">
				<div class="label">
				</div>
				<div class="input clickable">
					<a class="or-link-btn" target="_self" data-type="edit" data-action="group" data-method="memberships" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#/group/">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'edit'.'')))); ?></span>
						
					</a>
				</div>
			</div>
		<div class="or-form-actionbar"></div></form>
	