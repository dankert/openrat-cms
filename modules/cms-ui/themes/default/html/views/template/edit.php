
	
		<div class="headermenu"><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_SRC') ?>" data-type="dialog" data-name="<?php echo lang('MENU_SRC') ?>" data-method="src"><img src="./themes/default/images/icon/action/src.svg" title="<?php echo lang('MENU_src_DESC') ?>" /><?php echo lang('MENU_src') ?></a></div><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_REMOVE') ?>" data-type="dialog" data-name="<?php echo lang('MENU_REMOVE') ?>" data-method="remove"><img src="./themes/default/images/icon/action/remove.svg" title="<?php echo lang('MENU_remove_DESC') ?>" /><?php echo lang('MENU_remove') ?></a></div></div>
		
		<table width="100%">
			<tr class="headline">
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
					
				</td>
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'type'.'')))); ?></span>
					
				</td>
			</tr>
			<?php foreach($elements as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td data-name="<?php echo $name ?>" data-action="element" data-id="<?php echo $id ?>" class="clickable">
						<img class="image-icon image-icon--element" title="" src="./modules/cms-ui/themes/default/images/icon/element/<?php echo $type ?>.svg" />
						
						<span class="text" title="<?php echo $description ?>"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						
					</td>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_'.$type.'')))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<?php $if3=(empty($el)); if($if3){?>
				<tr>
					<td colspan="2">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_NOT_FOUND'.'')))); ?></span>
						
					</td>
				</tr>
			<?php } ?>
			<tr class="data">
				<td colspan="2" class="clickable">
					<a target="_self" data-type="view" data-action="template" data-method="addel" data-id="<?php echo $templateid ?>" href="javascript:void(0);">
						<img class="" title="" src="./modules/cms-ui/themes/default/images/icon/add.png" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_template_addel'.'')))); ?></span>
						
					</a>

				</td>
			</tr>
		</table>
		<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('src') ?></legend><div>
			<table width="100%">
				<tr class="data">
					<td>
						<div class="clickable">
							<a target="_self" data-type="view" data-action="" data-method="src" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
								<img class="" title="" src="./modules/cms-ui/themes/default/images/icon/template.png" />
								
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'edit'.'')))); ?></span>
								
							</a>

						</div>
					</td>
				</tr>
			</table>
			<code class="text"><?php echo nl2br($text); ?></code>
			
		</div></fieldset>
	