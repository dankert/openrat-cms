
	
		<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="pageelement" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="pageelement" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="pageelement" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="prop" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
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
						<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('additional_info') ?></legend><div>
						</div></fieldset>
					</td>
				</tr>
				<tr>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'template'.'')))); ?></span>
						
					</td>
					<td>
						<?php $if6=(isset($template_url)); if($if6){?>
							<a target="_self" data-url="<?php echo $template_url ?>" data-action="" data-method="prop" data-id="<?php echo OR_ID ?>" data-extra="[]" href="<?php echo Html::url('','','',array()) ?>">
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
						<?php $if6=(isset($element_url)); if($if6){?>
							<a target="_self" data-url="<?php echo $element_url ?>" data-action="" data-method="prop" data-id="<?php echo OR_ID ?>" data-extra="[]" href="<?php echo Html::url('','','',array()) ?>">
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
						<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('prop_userinfo') ?></legend><div>
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
		<div class="bottom"><div class="command "><input type="submit" class="submit ok" value="OK" /></div></div></form>
	