
	
		<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
			<tr class="headline">
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'project'.'')))); ?></span>
					
				</td>
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'filename'.'')))); ?></span>
					
				</td>
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'lastchange'.'')))); ?></span>
					
				</td>
			</tr>
			<?php foreach($timeline as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td class="clickable">
						<a target="_self" data-type="open" data-action="project" data-method="history" data-id="<?php echo $projectid ?>" data-extra="[]" href="./#/project/<?php echo $projectid ?>">
							<span><?php echo nl2br(encodeHtml(htmlentities($projectname))); ?></span>
							
						</a>
					</td>
					<td title="<?php echo $filename ?>" class="clickable">
						<a target="_self" data-type="open" data-action="<?php echo $type ?>" data-method="history" data-id="<?php echo $objectid ?>" data-extra="[]" href="./#/<?php echo $type ?>/<?php echo $objectid ?>">
							<span><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $filename,30,'..',constant('STR_PAD_BOTH') )))); ?></span>
							
						</a>
					</td>
					<td>
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($lastchange_date) ?>
						
					</td>
				</tr>
			<?php } ?>
		</table></div></div>
	