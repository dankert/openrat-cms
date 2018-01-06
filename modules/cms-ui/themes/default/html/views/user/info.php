
	
		
		
		<?php $if2=!(empty($image)); if($if2){?>
			<div class="line">
				<div class="line">
					<img class="" title="" src="<?php echo $image ?>" />
					
				</div>
			</div>
		<?php } ?>
		<div class="line">
			<span class="name"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
			
		</div>
		<div class="line">
			<span class="text"><?php echo nl2br(encodeHtml(htmlentities($fullname))); ?></span>
			
		</div>
		<?php $if2=(@$conf['security']['user']['show_admin_mail']); if($if2){?>
			<div class="line">
				<a target="_self" data-action="<?php echo $mail ?>" data-method="<?php echo OR_METHOD ?>" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities($mail))); ?></span>
					
				</a>

			</div>
		<?php } ?>
		<div class="line">
			<span class="text"><?php echo nl2br(encodeHtml(htmlentities($desc))); ?></span>
			
		</div>
		<div class="line">
			<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('user_tel')))); ?></span>
			
			<span class="text"><?php echo nl2br(encodeHtml(htmlentities($tel))); ?></span>
			
		</div>
		<?php $if2=($is_admin); if($if2){?>
			<div class="line">
				<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'user_admin'.'')))); ?></span>
				
			</div>
		<?php } ?>
	