<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
		<form name="" target="_self" data-target="view" action="./" data-method="form" data-action="page" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form page">
				<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
					<?php $if6=(($el)==FALSE); if($if6) {  ?>
						<tr class="">
							<td colspan="4" class="">
								<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOT_FOUND'))) ?>
								</span>
							</td>
						</tr>
					 <?php } ?>
					<?php $if6=!(($el)==FALSE); if($if6) {  ?>
						<tr class="">
							<td class="help">
								<span class=""><?php echo encodeHtml(htmlentities(@lang('PAGE_ELEMENT_NAME'))) ?>
								</span>
							</td>
							<td class="help">
								<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_CHANGE'))) ?>
								</span>
							</td>
							<td class="help">
								<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_VALUE'))) ?>
								</span>
							</td>
						</tr>
						<?php foreach($el as $list_key=>$list_value) { extract($list_value); ?>
							<tr class="data">
								<td class="">
									<label class="label">
										<i class="image-icon image-icon--action-el_<?php echo encodeHtml(htmlentities(@$type)) ?>">
										</i>
										<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
										</span>
									</label>
								</td>
								<td class="">
									<input type="checkbox" name="<?php echo encodeHtml(htmlentities(@$saveid)) ?>" value="1" <?php if(''.@$${saveid.'}'){ ?>checked="1"<?php } ?> class="">
									</input>
								</td>
								<td class="">
									<?php $if10=(in_array($type,explode(",",'text,date,number')); if($if10) {  ?>
										<input name="<?php echo encodeHtml(htmlentities(@$id)) ?>" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$value)) ?>" class="">
										</input>
									 <?php } ?>
									<?php $if10=($type=='longtext'); if($if10) {  ?>
										<textarea name="<?php echo encodeHtml(htmlentities(@$id)) ?>" disabled="" maxlength="0" class="inputarea"><?php echo encodeHtml(htmlentities(@$value)) ?>
										</textarea>
									 <?php } ?>
									<?php $if10=(in_array($type,explode(",",'select,link,list')); if($if10) {  ?>
										<input name="<?php echo encodeHtml(htmlentities(@$id)) ?>" value="<?php echo encodeHtml(htmlentities(@$value)) ?>" size="1" class="">
										</input>
									 <?php } ?>
								</td>
							</tr>
						 <?php } ?>
					 <?php } ?>
				</table></div></div>
				<fieldset class="or-group toggle-open-close open show"><div class="closable">
					<?php $if6=(isset($release)); if($if6) {  ?>
						<div class="">
							<input type="checkbox" name="release" value="1" <?php if(''.@$release.''){ ?>checked="1"<?php } ?> class="">
							</input>
							<label class="label">
								<span class=""> 
								</span>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_RELEASE'))) ?>
								</span>
							</label>
						</div>
					 <?php } ?>
					<?php $if6=(isset($publish)); if($if6) {  ?>
						<div class="">
							<input type="checkbox" name="publish" value="1" <?php if(''.@$publish.''){ ?>checked="1"<?php } ?> class="">
							</input>
							<label class="label">
								<span class=""> 
								</span>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('PAGE_PUBLISH_AFTER_SAVE'))) ?>
								</span>
							</label>
						</div>
					 <?php } ?>
				</div></fieldset>
		</form>