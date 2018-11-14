
	
		<div class="table-wrapper"><div class="table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><table width="100%"></div>
			<tr class="data">
				<td colspan="1">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'id'.'')))); ?></span>
					
				</td>
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities($id))); ?></span>
					
				</td>
			</tr>
			<tr class="headline">
				<td colspan="2">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'pages'.'')))); ?></span>
					
				</td>
			</tr>
			<?php foreach($pages as $pageid=>$name){ ?>
				<tr class="data">
					<td colspan="2">
						<img class="" title="" src="./modules/cms-ui/themes/default/images/icon/page.png" />
						
						<a target="_self" data-action="main" data-method="page" data-id="<?php echo $pageid ?>" data-extra="[]" href="<?php echo Html::url('main','page',$pageid,array()) ?>">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
							
						</a>

					</td>
				</tr>
			<?php } ?>
		</table>
	