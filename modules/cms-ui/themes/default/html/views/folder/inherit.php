<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="inherit" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form folder">
		<?php $if3=($type=='folder'); if($if3) {  ?>
			<fieldset class="or-group toggle-open-close open show"><div class="closable">
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php  { $inherit= '1'; ?>
						 <?php } ?>
						<input name="inherit" type="checkbox" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$inherit)) ?>" class="">
						</input>
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('inherit_rights'))) ?>
							</span>
						</label>
					</div>
				</div>
			</div></fieldset>
		 <?php } ?>
	</form>