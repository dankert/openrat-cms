<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
		<form name="" target="_self" data-target="view" action="./" data-method="add" data-action="project" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form project">
				<tr class="">
					<td colspan="2" class="">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
						</span>
					</td>
					<td class="">
						<input name="name" disabled="" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="">
						</input>
					</td>
				</tr>
				<tr class="">
					<td colspan="3" class="">
						<fieldset class="or-group toggle-open-close open show"><div class="closable">
							<div class="">
								<input type="radio" name="type" disabled="" value="empty" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
								</input>
								<label class="label">
									<span class=""><?php echo encodeHtml(htmlentities(@lang('empty'))) ?>
									</span>
								</label>
							</div>
							<div class="">
								<input type="radio" name="type" disabled="" value="copy" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
								</input>
								<label class="label">
									<span class=""><?php echo encodeHtml(htmlentities(@lang('copy'))) ?>
									</span>
								</label>
								<input name="projectid" value="<?php echo encodeHtml(htmlentities(@$projectid)) ?>" size="1" class="">
								</input>
							</div>
						</div></fieldset>
					</td>
				</tr>
				<tr class="">
					<td colspan="3" class="act">
					</td>
				</tr>
		</form>