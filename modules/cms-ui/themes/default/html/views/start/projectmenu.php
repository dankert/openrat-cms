<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
		<tr class="">
			<td colspan="2" class="logo">
				<div class="line logo">
				</div>
			</td>
		</tr>
		<tr class="headline">
			<td class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('project'))) ?>
				</span>
			</td>
		</tr>
		<?php foreach($projects as $list_key=>$list_value) { extract($list_value); ?>
			<tr class="data">
				<td class="clickable">
					<a title="<?php echo encodeHtml(htmlentities(@lang('TREE_CHOOSE_PROJECT'))) ?>" target="_self" data-type="post" data-action="" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" data-extra="[]" data-data="{"action":"start","subaction":"projectmenu","id":"<?php echo encodeHtml(htmlentities(@$id)) ?>",\"token":"<?php echo token() ?>","none":"0"}"" class="">
						<?php  { $project= 'project'; ?>
						 <?php } ?>
						<img src="./modules/cms-ui/themes/default/images/icon_project.png" class="">
						</img>
						<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
						</span>
					</a>
					<div class="onrowvisible">
						<div class="arrow-down">
						</div>
						<div class="dropdown">
							<form name="" target="_self" data-target="view" action="./" data-method="project" data-action="index" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form index">
								<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
									<tr class="">
										<td class="">
											<?php include_once( 'modules/template-engine/components/html/radiobox/component-radio-box.php'); { <?php component_radio_box(modelid,$models,${defaultmodelid}) ?> ?>
											 <?php } ?>
										</td>
										<td class="">
											<?php include_once( 'modules/template-engine/components/html/radiobox/component-radio-box.php'); { <?php component_radio_box(languageid,$languages,${defaultlanguageid}) ?> ?>
											 <?php } ?>
										</td>
										<td class="">
										</td>
									</tr>
								</table></div></div>
							</form>
						</div>
					</div>
				</td>
			</tr>
		 <?php } ?>
	</table></div></div>