
	
		<table width="100%">
			<tr>
				<td>
				</td>
				<td>
					<em class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_COMPARE')))); ?></em>
					
					<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
					
					<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($date_left) ?>
					
				</td>
				<td>
				</td>
				<td>
					<em class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_WITH')))); ?></em>
					
					<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
					
					<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($date_right) ?>
					
				</td>
			</tr>
			<tr>
				<td colspan="4">
				</td>
			</tr>
			<?php foreach($diff as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="diff">
					<?php $if5=(!empty($left)); if($if5){?>
						<td width="5%" class="line">
							<tt class="text"><?php echo nl2br(encodeHtml(htmlentities(@$left[line]))); ?></tt>
							
						</td>
						<td width="45%" class="<?php echo @$left[type] ?>">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(@$left[text]))); ?></span>
							
						</td>
					<?php } ?>
					<?php if(!$if5){?>
						<td width="50%" class="help" colspan="2">
							<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
							
						</td>
					<?php } ?>
					<?php $if5=(!empty($right)); if($if5){?>
						<td width="5%" class="line">
							<tt class="text"><?php echo nl2br(encodeHtml(htmlentities(@$right[line]))); ?></tt>
							
						</td>
						<td width="45%" class="<?php echo @$right[type] ?>">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(@$right[text]))); ?></span>
							
						</td>
					<?php } ?>
					<?php if(!$if5){?>
						<td width="50%" class="help" colspan="2">
							<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
							
						</td>
					<?php } ?>
				</tr>
				<?php unset($left) ?>
				
				<?php unset($right) ?>
				
			<?php } ?>
		</table>
				<div class="invisible"><input type="submit" 	name="ok" class="%class%"
	title="Zurück"
	value="&nbsp;&nbsp;&nbsp;&nbsp;Zur&#xfc;ck&nbsp;&nbsp;&nbsp;&nbsp;" />	
		</div>
	