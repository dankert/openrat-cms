
	
		<table width="100%">
			<tr class="headline">
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
					
				</td>
			</tr>
			<?php foreach($templates as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td data-name="<?php echo $name ?>" data-action="template" data-id="<?php echo $id ?>" class="clickable">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<?php $if3=(empty($templates)); if($if3){?>
				<tr>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NO_TEMPLATES_AVAILABLE_DESC')))); ?></span>
					
				</tr>
			<?php } ?>
			<tr class="data">
				<td colspan="1" class="clickable">
					<a target="_self" data-type="view" data-action="" data-method="add" data-id="<?php echo OR_ID ?>" data-extra="[]" href="<?php echo Html::url('','add','',array()) ?>">
						<img class="" title="" src="./modules/cms-ui/themes/default/images/icon/add.png" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('new')))); ?></span>
						
					</a>

				</td>
			</tr>
		</table>
	