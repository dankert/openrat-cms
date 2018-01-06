
	
		<table width="100%">
			<?php $if3=(empty($el)); if($if3){?>
				<tr class="headline">
					<td class="help">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('PAGE_ELEMENT_NAME')))); ?></span>
						
					</td>
					<td class="help">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('PAGE_ELEMENT_VALUE')))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<?php $if3=(empty($el)); if($if3){?>
				<tr>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NOT_FOUND')))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<?php foreach($el as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td class="clickable">
						<a title="<?php echo $desc ?>" target="_self" date-name="<?php echo $name ?>" name="<?php echo $name ?>" data-type="open" data-action="pageelement" data-method="<?php echo OR_METHOD ?>" data-id="<?php echo $pageelementid ?>" href="javascript:void(0);">
							<img class="image-icon image-icon--element" title="" src="./modules/cms-ui/themes/default/images/icon/element/<?php echo $type ?>.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
							
						</a>

					</td>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $value,50,'..',constant('STR_PAD_BOTH') )))); ?></span>
						
						<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
						
					</td>
				</tr>
			<?php } ?>
		</table>
		<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('menu_page_show') ?></legend><div>
			<div>
				<iframe name="preview" src="<?php echo $preview_url ?>"></iframe>
				
			</div>
		</div></fieldset>
	