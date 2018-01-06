
	
		<table width="100%">
			<tr class="headline">
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
					
				</td>
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'filename'.'')))); ?></span>
					
				</td>
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'lastchange'.'')))); ?></span>
					
				</td>
			</tr>
			<?php foreach($timeline as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<?php $if4=($typeid=='1'); if($if4){?>
					<?php $type= 'folder'; ?>
					
				<?php } ?>
				<?php $if4=($typeid=='2'); if($if4){?>
					<?php $type= 'file'; ?>
					
				<?php } ?>
				<?php $if4=($typeid=='4'); if($if4){?>
					<?php $type= 'link'; ?>
					
				<?php } ?>
				<?php $if4=($typeid=='3'); if($if4){?>
					<?php $type= 'page'; ?>
					
				<?php } ?>
				<tr class="data">
					<td class="clickable">
						<a target="_self" date-name="<?php echo $name ?>" name="<?php echo $name ?>" data-type="open" data-action="<?php echo $type ?>" data-method="<?php echo OR_METHOD ?>" data-id="<?php echo $objectid ?>" href="javascript:void(0);">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $name,30,'..',constant('STR_PAD_BOTH') )))); ?></span>
							
						</a>

					</td>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $filename,30,'..',constant('STR_PAD_BOTH') )))); ?></span>
						
					</td>
					<td>
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($lastchange_date) ?>
						
					</td>
				</tr>
			<?php } ?>
		</table>
	