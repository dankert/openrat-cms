
	
		<?php foreach($info as $list_key=>$list_value){ ?>
			<div class="line">
				<div class="label">
					<label class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('project_info_'.$list_key.'')))); ?></span>
						
					</label>
				</div>
				<div class="input">
					<strong><?php echo nl2br(encodeHtml(htmlentities($list_value))); ?></strong>
					
				</div>
			</div>
		<?php } ?>
	