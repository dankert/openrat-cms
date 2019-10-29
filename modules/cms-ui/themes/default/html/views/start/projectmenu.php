<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
			<tr>
				<td colspan="2" class="logo">
					<div class="line logo">
	<div class="label">
	<img src="themes/default/images/logo_projectmenu.png ?>"
	border="0" />
	</div>
	<div class="input">
	<h2>
			<?php echo langHtml('logo_projectmenu') ?>
		</h2>
		<p>
			<?php echo langHtml('logo_projectmenu_text') ?>
		</p>

	</div>
</div>
					</div>
				</td>
			</tr>
			<tr class="headline">
				<td>
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'project'.'')))); ?></span>
					
				</td>
			</tr>
			<?php foreach($projects as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td class="clickable">
						<a title="<?php echo lang('TREE_CHOOSE_PROJECT') ?>" target="_self" data-type="post" data-action="" data-method="projectmenu" data-id="<?php echo $id ?>" data-extra="[]" data-data="{&quot;action&quot;:&quot;start&quot;,&quot;subaction&quot;:&quot;projectmenu&quot;,&quot;id&quot;:&quot;<?php echo $id ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
							<?php $project= 'project'; ?>
							
							<img src="./modules/cms-ui/themes/default/images/icon_project.png" />
							
							<span><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $name,30,'..',constant('STR_PAD_BOTH') )))); ?></span>
							
						</a>
						<div class="onrowvisible">
							<div class="arrow-down">
							</div>
							<div class="dropdown">
								<form name="" target="_self" data-target="view" action="./" data-method="project" data-action="index" data-id="<?php echo $id ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form index" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="index" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="project" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $id ?>" />
									<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
										<tr>
											<td>
												<?php include_once( 'modules/template-engine/components/html/radiobox/component-radio-box.php') ?><?php component_radio_box('modelid',$models,$defaultmodelid) ?>
												
											</td>
											<td>
												<?php include_once( 'modules/template-engine/components/html/radiobox/component-radio-box.php') ?><?php component_radio_box('languageid',$languages,$defaultlanguageid) ?>
												
											</td>
											<td>
														<div class="invisible"><input type="submit" 	name="ok" class="%class%"
	title="?message:start_DESC?"
	value="&nbsp;&nbsp;&nbsp;&nbsp;?message:start?&nbsp;&nbsp;&nbsp;&nbsp;" />	
												</div>
											</td>
										</tr>
									</table></div></div>
								<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>
							</div>
						</div>
					</td>
				</tr>
			<?php } ?>
		</table></div></div>
	