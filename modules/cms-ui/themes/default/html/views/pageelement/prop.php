
	
		<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="pageelement" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form pageelement" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="pageelement" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="prop" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
				<tr>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('name')))); ?></span>
						
					</td>
					<td class="name">
						<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						
					</td>
				</tr>
				<tr>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('description')))); ?></span>
						
					</td>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities($description))); ?></span>
						
					</td>
				</tr>
				<tr>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('type')))); ?></span>
						
					</td>
					<td class="filename">
						<i class="image-icon image-icon--element-<?php echo $element_type ?>"></i>
						
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'el_'.$element_type.''.'')))); ?></span>
						
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('additional_info') ?></legend><div class="closable">
						</div></fieldset>
					</td>
				</tr>
				<tr>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'template'.'')))); ?></span>
						
					</td>
					<td>
						<?php $if6=(isset($template_url)); if($if6){?>
							<a target="_self" data-url="<?php echo $template_url ?>" data-action="" data-method="prop" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#//">
								<img src="./modules/cms-ui/themes/default/images/icon/icon_template.png" />
								
								<span><?php echo nl2br(encodeHtml(htmlentities($template_name))); ?></span>
								
							</a>
						<?php } ?>
						<?php $if6=(($template_url)==FALSE); if($if6){?>
							<img src="./modules/cms-ui/themes/default/images/icon/icon_template.png" />
							
							<span><?php echo nl2br(encodeHtml(htmlentities($template_name))); ?></span>
							
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'element'.'')))); ?></span>
						
					</td>
					<td>
						<?php $if6=(isset($element_url)); if($if6){?>
							<a target="_self" data-url="<?php echo $element_url ?>" data-action="" data-method="prop" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#//">
								<i class="image-icon image-icon--element-<?php echo $element_type ?>"></i>
								
								<span><?php echo nl2br(encodeHtml(htmlentities($element_name))); ?></span>
								
							</a>
						<?php } ?>
						<?php $if6=(($element_url)==FALSE); if($if6){?>
							<img src="./modules/cms-ui/themes/default/images/icon/element.png" />
							
							<span><?php echo nl2br(encodeHtml(htmlentities($element_name))); ?></span>
							
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('prop_userinfo') ?></legend><div class="closable">
						</div></fieldset>
					</td>
				</tr>
				<tr>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('lastchange')))); ?></span>
						
					</td>
					<td>
						<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
							<tr>
								<td>
									<img src="./modules/cms-ui/themes/default/images/icon/el_date.png" />
									
									<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($lastchange_date) ?>
									
								</td>
								<td>
									<img src="./modules/cms-ui/themes/default/images/icon/user.png" />
									
									<?php include_once( 'modules/template-engine/components/html/user/component-user.php') ?><?php component_user($lastchange_user) ?>
									
								</td>
							</tr>
						</table></div></div>
					</td>
				</tr>
			</table></div></div>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="?BUTTON_OK?" /></div></form>
	