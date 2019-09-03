
	
		<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
			<tr class="headline">
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
					
				</td>
			</tr>
			<?php foreach($templates as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td class="clickable">
						<i class="image-icon image-icon--action-template"></i>
						
						<a target="_self" date-name="<?php echo $name ?>" name="<?php echo $name ?>" data-type="open" data-action="template" data-method="show" data-id="<?php echo $id ?>" data-extra="[]" href="./#/template/<?php echo $id ?>">
							<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
							
						</a>
					</td>
				</tr>
			<?php } ?>
			<?php $if3=(($templates)==FALSE); if($if3){?>
				<tr>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NO_TEMPLATES_AVAILABLE_DESC')))); ?></span>
					
				</tr>
			<?php } ?>
			<tr class="data">
				<td colspan="1" class="clickable">
					<a target="_self" data-type="dialog" data-action="" data-method="add" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'add'}" href="./#//">
						<i class="image-icon image-icon--method-add"></i>
						
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('new')))); ?></span>
						
					</a>
				</td>
			</tr>
		</table></div></div>
	