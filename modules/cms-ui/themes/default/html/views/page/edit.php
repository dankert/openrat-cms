
	
		<div class="table-wrapper"><div class="table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><table width="100%">
			<tr class="headline">
				<th>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'NAME'.'')))); ?></span>
					
				</th>
				<th>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('DESCRIPTION')))); ?></span>
					
				</th>
				<th>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'TYPE'.'')))); ?></span>
					
				</th>
			</tr>
			<?php $if3=(($elements)==FALSE); if($if3){?>
				<tr>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'NOT_FOUND'.'')))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<?php foreach($elements as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data clickable">
					<td>
						<a title="<?php echo $desc ?>" target="_self" date-name="<?php echo $name ?>" name="<?php echo $name ?>" data-type="open" data-action="pageelement" data-method="edit" data-id="<?php echo $pageelementid ?>" data-extra="[]" href="<?php echo Html::url('pageelement','',$pageelementid,array()) ?>">
							<i class="image-icon image-icon--action-pageelement"></i>
							
							<span><?php echo nl2br(encodeHtml(htmlentities($label))); ?></span>
							
						</a>

					</td>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $desc,50,'..',constant('STR_PAD_BOTH') )))); ?></span>
						
					</td>
					<td>
						<i class="image-icon image-icon--element-<?php echo $typename ?>"></i>
						
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('el_'.$typename.'')))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
		</table></div>
	