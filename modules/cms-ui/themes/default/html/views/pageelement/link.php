<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
		<form name="" target="_self" data-target="view" action="./" data-method="link" data-action="pageelement" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form pageelement">
				<tr class="">
					<td colspan="2" class="help">
						<span class=""><?php echo encodeHtml(htmlentities(@$desc)) ?>
						</span>
					</td>
				</tr>
				<tr class="">
					<td colspan="2" class="">
						<input name="linkobjectid" value="<?php echo encodeHtml(htmlentities(@$linkobjectid)) ?>" size="1" class="">
						</input>
					</td>
				</tr>
				<?php $if5=(isset($release)); if($if5) {  ?>
					<?php $if6=(isset($publish)); if($if6) {  ?>
						<tr class="">
							<td colspan="2" class="">
								<fieldset class="or-group toggle-open-close open show"><div class="closable">
								</div></fieldset>
							</td>
						</tr>
					 <?php } ?>
				 <?php } ?>
				<?php $if5=(isset($release)); if($if5) {  ?>
					<tr class="">
						<td colspan="2" class="">
							<input type="checkbox" name="release" value="1" <?php if(''.@$release.''){ ?>checked="1"<?php } ?> class="">
							</input>
							<label class="label">
								<span class=""> 
								</span>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_RELEASE'))) ?>
								</span>
							</label>
						</td>
					</tr>
				 <?php } ?>
				<?php $if5=(isset($publish)); if($if5) {  ?>
					<tr class="">
						<td colspan="2" class="">
							<input type="checkbox" name="publish" value="1" <?php if(''.@$publish.''){ ?>checked="1"<?php } ?> class="">
							</input>
							<label class="label">
								<span class=""> 
								</span>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('PAGE_PUBLISH_AFTER_SAVE'))) ?>
								</span>
							</label>
						</td>
					</tr>
				 <?php } ?>
				<tr class="">
					<td colspan="2" class="act">
					</td>
				</tr>
		</form>