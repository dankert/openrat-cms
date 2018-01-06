
	
		<table width="100%">
			<tr class="headline">
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
					
				</td>
			</tr>
			<?php $if3=(empty($groups)); if($if3){?>
				<tr class="data">
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'NOT_FOUND'.'')))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<?php foreach($groups as $list_key=>$group){ ?>
				<tr class="data">
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($group))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
		</table>
	