<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="pageelement" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form pageelement">
		<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
			<tr class="">
				<td class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
					</span>
				</td>
				<td class="name">
					<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
					</span>
				</td>
			</tr>
			<tr class="">
				<td class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('description'))) ?>
					</span>
				</td>
				<td class="">
					<span class=""><?php echo encodeHtml(htmlentities(@$description)) ?>
					</span>
				</td>
			</tr>
			<tr class="">
				<td class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('type'))) ?>
					</span>
				</td>
				<td class="filename">
					<i class="image-icon image-icon--action-el_<?php echo encodeHtml(htmlentities(@$element_type)) ?>">
					</i>
					<span class=""><?php echo encodeHtml(htmlentities(@lang('el_${element_type'))) ?>}
					</span>
				</td>
			</tr>
			<tr class="">
				<td colspan="2" class="">
					<fieldset class="or-group toggle-open-close open show"><div class="closable">
					</div></fieldset>
				</td>
			</tr>
			<tr class="">
				<td class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('template'))) ?>
					</span>
				</td>
				<td class="">
					<?php $if6=(isset($template_url)); if($if6) {  ?>
						<a target="_self" data-url="<?php echo encodeHtml(htmlentities(@$template_url)) ?>" data-action="" data-method="" data-id="" data-extra="[]" href="/#//" class="">
							<img src="./modules/cms-ui/themes/default/images/icon/icon_template.png" class="">
							</img>
							<span class=""><?php echo encodeHtml(htmlentities(@$template_name)) ?>
							</span>
						</a>
					 <?php } ?>
					<?php $if6=(($template_url)==FALSE); if($if6) {  ?>
						<img src="./modules/cms-ui/themes/default/images/icon/icon_template.png" class="">
						</img>
						<span class=""><?php echo encodeHtml(htmlentities(@$template_name)) ?>
						</span>
					 <?php } ?>
				</td>
			</tr>
			<tr class="">
				<td class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('element'))) ?>
					</span>
				</td>
				<td class="">
					<?php $if6=(isset($element_url)); if($if6) {  ?>
						<a target="_self" data-url="<?php echo encodeHtml(htmlentities(@$element_url)) ?>" data-action="" data-method="" data-id="" data-extra="[]" href="/#//" class="">
							<i class="image-icon image-icon--action-el_<?php echo encodeHtml(htmlentities(@$element_type)) ?>">
							</i>
							<span class=""><?php echo encodeHtml(htmlentities(@$element_name)) ?>
							</span>
						</a>
					 <?php } ?>
					<?php $if6=(($element_url)==FALSE); if($if6) {  ?>
						<img src="./modules/cms-ui/themes/default/images/icon/element.png" class="">
						</img>
						<span class=""><?php echo encodeHtml(htmlentities(@$element_name)) ?>
						</span>
					 <?php } ?>
				</td>
			</tr>
			<tr class="">
				<td colspan="2" class="">
					<fieldset class="or-group toggle-open-close open show"><div class="closable">
					</div></fieldset>
				</td>
			</tr>
			<tr class="">
				<td class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('lastchange'))) ?>
					</span>
				</td>
				<td class="">
					<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
						<tr class="">
							<td class="">
								<img src="./modules/cms-ui/themes/default/images/icon/el_date.png" class="">
								</img>
								<?php include_once( 'modules/template-engine/components/html/date/component-date.php'); { component_date($lastchange_date); ?>
								 <?php } ?>
							</td>
							<td class="">
								<img src="./modules/cms-ui/themes/default/images/icon/user.png" class="">
								</img>
								<?php include_once( 'modules/template-engine/components/html/user/component-user.php'); { component_user($lastchange_user); ?>
								 <?php } ?>
							</td>
						</tr>
					</table></div></div>
				</td>
			</tr>
		</table></div></div>
	</form>