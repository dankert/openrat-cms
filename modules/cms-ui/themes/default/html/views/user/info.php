
	
		
		
		<?php $if2=!(($image)==FALSE); if($if2){?>
			<div class="line">
				<div class="line">
					<img src="<?php echo $image ?>" />
					
				</div>
			</div>
		<?php } ?>
		<div class="line">
			<span class="name"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
			
		</div>
		<div class="line">
			<span><?php echo nl2br(encodeHtml(htmlentities($fullname))); ?></span>
			
		</div>
		<?php $if2=(config('security','user','show_admin_mail')); if($if2){?>
			<div class="line">
				<a target="_self" data-action="<?php echo $mail ?>" data-method="info" data-id="<?php echo OR_ID ?>" data-extra="[]" href="<?php echo Html::url($mail,'','',array()) ?>">
					<span><?php echo nl2br(encodeHtml(htmlentities($mail))); ?></span>
					
				</a>

			</div>
		<?php } ?>
		<div class="line">
			<span><?php echo nl2br(encodeHtml(htmlentities($desc))); ?></span>
			
		</div>
		<div class="line">
			<span><?php echo nl2br(encodeHtml(htmlentities(lang('user_tel')))); ?></span>
			
			<span><?php echo nl2br(encodeHtml(htmlentities($tel))); ?></span>
			
		</div>
		<?php $if2=($is_admin); if($if2){?>
			<div class="line">
				<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'user_admin'.'')))); ?></span>
				
			</div>
		<?php } ?>
	