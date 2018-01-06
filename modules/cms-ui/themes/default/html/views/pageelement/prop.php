
	
		<form name="" target="_self" action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<table width="100%">
				<tr>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('name')))); ?></span>
						
					</td>
					<td class="name">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						
					</td>
				</tr>
				<tr>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('description')))); ?></span>
						
					</td>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($description))); ?></span>
						
					</td>
				</tr>
				<tr>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('type')))); ?></span>
						
					</td>
					<td class="filename">
						<img class="image-icon image-icon--element" title="" src="./modules/cms-ui/themes/default/images/icon/element/<?php echo $element_type ?>.svg" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'el_'.$element_type.''.'')))); ?></span>
						
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('additional_info') ?></legend><div>
						</div></fieldset>
					</td>
				</tr>
				<tr>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'template'.'')))); ?></span>
						
					</td>
					<td>
						<?php $if6=(!empty($template_url)); if($if6){?>
							<a target="_self" data-url="<?php echo $template_url ?>" data-action="" data-method="<?php echo OR_METHOD ?>" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
								<img class="" title="" src="./modules/cms-ui/themes/default/images/icon/icon_template.png" />
								
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities($template_name))); ?></span>
								
							</a>

						<?php } ?>
						<?php $if6=(empty($template_url)); if($if6){?>
							<img class="" title="" src="./modules/cms-ui/themes/default/images/icon/icon_template.png" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($template_name))); ?></span>
							
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'element'.'')))); ?></span>
						
					</td>
					<td>
						<?php $if6=(!empty($element_url)); if($if6){?>
							<a target="_self" data-url="<?php echo $element_url ?>" data-action="" data-method="<?php echo OR_METHOD ?>" data-id="<?php echo OR_ID ?>" href="javascript:void(0);">
								<img class="image-icon image-icon--element" title="" src="./modules/cms-ui/themes/default/images/icon/element/<?php echo $element_type ?>.svg" />
								
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities($element_name))); ?></span>
								
							</a>

						<?php } ?>
						<?php $if6=(empty($element_url)); if($if6){?>
							<img class="" title="" src="./modules/cms-ui/themes/default/images/icon/element.png" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($element_name))); ?></span>
							
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('prop_userinfo') ?></legend><div>
						</div></fieldset>
					</td>
				</tr>
				<tr>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('lastchange')))); ?></span>
						
					</td>
					<td>
						<table width="100%">
							<tr>
								<td>
									<img class="" title="" src="./modules/cms-ui/themes/default/images/icon/el_date.png" />
									
									<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($lastchange_date) ?>
									
								</td>
								<td>
									<img class="" title="" src="./modules/cms-ui/themes/default/images/icon/user.png" />
									
									<?php include_once( 'modules/template-engine/components/html/user/component-user.php') ?><?php component_user($lastchange_user) ?>
									
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		<div class="bottom"><div class="command "><input type="button" class="submit ok" value="OK" /></div></div></form>
	