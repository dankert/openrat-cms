
	
		<table width="100%">
			<tr>
				<td class="logo" colspan="2">
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
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'project'.'')))); ?></span>
					
				</td>
			</tr>
			<?php foreach($projects as $list_key=>$list_value){ ?><?php extract($list_value) ?>
				<tr class="data">
					<td class="clickable">
						<a title="<?php echo lang('TREE_CHOOSE_PROJECT') ?>" target="_self" data-type="post" data-action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-id="<?php echo $id ?>" data-data="{&quot;action&quot;:&quot;<?php echo OR_ACTION ?>&quot;,&quot;subaction&quot;:&quot;<?php echo OR_METHOD ?>&quot;,&quot;id&quot;:&quot;<?php echo $id ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
							<?php $project= 'project'; ?>
							
							<img class="" title="" src="./themes/default/images/icon_project.png" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $name,30,'..',constant('STR_PAD_BOTH') )))); ?></span>
							
						</a>

						<div class="onrowvisible">
							<div class="arrow-down">
							</div>
							<div class="dropdown">
								<form name="" target="_self" action="index" data-method="project" data-action="index" data-id="<?php echo $id ?>" method="project" enctype="application/x-www-form-urlencoded" class="index" data-async="" data-autosave="" onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="index" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="project" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $id ?>" />
									<table width="100%">
										<tr>
											<td>
												<?php include_once( OR_THEMES_DIR.'default/include/html/radiobox/component-radio-box.php') ?><?php component_radio_box('modelid',$models,$defaultmodelid) ?>
												
											</td>
											<td>
												<?php include_once( OR_THEMES_DIR.'default/include/html/radiobox/component-radio-box.php') ?><?php component_radio_box('languageid',$languages,$defaultlanguageid) ?>
												
											</td>
											<td>
														<div class="invisible"><input type="submit" 	name="ok" class="%class%"
	title="?message:start_DESC?"
	value="&nbsp;&nbsp;&nbsp;&nbsp;?message:start?&nbsp;&nbsp;&nbsp;&nbsp;" />	
												</div>
											</td>
										</tr>
									</table>
								
<div class="bottom">
	<div class="command ">
	
		<input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->	</div>
</div>

</form>

							</div>
						</div>
					</td>
				</tr>
			<?php } ?>
		</table>
	