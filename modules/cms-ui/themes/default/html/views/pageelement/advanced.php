
	
		<div class="table-wrapper"><div class="table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><table width="100%"></div>
			<tr class="headline">
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'language'.'')))); ?></span>
					
				</td>
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'value'.'')))); ?></span>
					
				</td>
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'editor'.'')))); ?></span>
					
				</td>
			</tr>
			<?php foreach($languages as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities($languagename))); ?></span>
						
					</td>
					<td class="clickable">
						<a target="_self" data-type="edit" data-action="pageelement" data-method="value" data-id="<?php echo OR_ID ?>" data-extra="{'languageid':'<?php echo $languageid ?>'}" href="<?php echo Html::url('pageelement','value','',array('languageid'=>$languageid)) ?>">
							<span><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $value,30,'..',constant('STR_PAD_BOTH') )))); ?></span>
							
						</a>

					</td>
					<td>
						<?php foreach($editors as $id=>$name){ ?>
							<div class="clickable">
								<a target="_self" data-type="edit" data-action="pageelement" data-method="value" data-id="<?php echo OR_ID ?>" data-extra="{'languageid':'<?php echo $languageid ?>','format':'<?php echo $id ?>'}" href="<?php echo Html::url('pageelement','value','',array('languageid'=>$languageid,'format'=>$id)) ?>">
									<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
									
								</a>

							</div>
						<?php } ?>
					</td>
				</tr>
			<?php } ?>
		</table>
	