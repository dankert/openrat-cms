
	
		<div class="table-wrapper"><div class="table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><table width="100%"></div>
			<tr class="headline">
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'project'.'')))); ?></span>
					
				</td>
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'filename'.'')))); ?></span>
					
				</td>
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'user_username'.'')))); ?></span>
					
				</td>
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'lastchange'.'')))); ?></span>
					
				</td>
			</tr>
			<?php foreach($timeline as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td class="clickable">
						<a target="_self" data-type="post" data-action="start" data-method="projectmenu" data-id="<?php echo $projectid ?>" data-extra="[]" data-data="{&quot;action&quot;:&quot;start&quot;,&quot;subaction&quot;:&quot;projectmenu&quot;,&quot;id&quot;:&quot;<?php echo $projectid ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($projectname))); ?></span>
							
						</a>

					</td>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $filename,30,'..',constant('STR_PAD_BOTH') )))); ?></span>
						
					</td>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($username))); ?></span>
						
					</td>
					<td>
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($lastchange_date) ?>
						
					</td>
				</tr>
			<?php } ?>
		</table>
	