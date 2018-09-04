
	
		<br/>
		
		<table width="100%">
			<tr class="headline">
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
					
				</td>
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'license'.'')))); ?></span>
					
				</td>
			</tr>
			<?php foreach($software as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td class="clickable">
						<a target="_self" data-url="<?php echo $url ?>" data-type="external" data-action="" data-method="license" data-id="<?php echo OR_ID ?>" data-extra="[]" href="<?php echo Html::url('','','',array()) ?>">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
							
						</a>

					</td>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($license))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
		</table>
	