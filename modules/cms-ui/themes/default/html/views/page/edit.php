
	
		<div class="table-wrapper"><div class="table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><table width="100%"></div>
			<?php $if3=!(($el)==FALSE); if($if3){?>
				<tr class="headline">
					<td class="help">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('PAGE_ELEMENT_NAME')))); ?></span>
						
					</td>
					<td class="help">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('PAGE_ELEMENT_VALUE')))); ?></span>
						
					</td>
					<td class="help">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('EDIT')))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<?php $if3=(($el)==FALSE); if($if3){?>
				<tr>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NOT_FOUND')))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<?php foreach($el as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td class="clickable">
						<a title="<?php echo $desc ?>" target="_self" date-name="<?php echo $name ?>" name="<?php echo $name ?>" data-type="open" data-action="pageelement" data-method="edit" data-id="<?php echo $pageelementid ?>" data-extra="{'languageid':'<?php echo $languageid ?>','modelid':'<?php echo $modelid ?>'}" href="<?php echo Html::url('pageelement','',$pageelementid,array('languageid'=>$languageid,'modelid'=>$modelid)) ?>">
							<i class="image-icon image-icon--element-<?php echo $type ?>"></i>
							
							<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
							
						</a>

					</td>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $value,50,'..',constant('STR_PAD_BOTH') )))); ?></span>
						
						<span><?php echo nl2br('&nbsp;'); ?></span>
						
					</td>
					<td>
						<?php foreach($languages as $languageid=>$languagename){ ?>
							<div class="clickable">
								<a class="or-link-btn" target="_self" data-type="value" data-action="pageelement" data-method="edit" data-id="<?php echo $pageelementid ?>" data-extra="{'languageid':'<?php echo $languageid ?>'}" href="<?php echo Html::url('pageelement','edit',$pageelementid,array('languageid'=>$languageid)) ?>">
									<i class="image-icon image-icon--method-edit"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities($languagename))); ?></span>
									
								</a>

							</div>
						<?php } ?>
					</td>
				</tr>
			<?php } ?>
		</table>
	