<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="inherit" data-action="object" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form object">
		<?php $if3=($type=='folder'); if($if3) {  ?>
			<fieldset class="or-group toggle-open-close open show"><div class="closable">
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php  { $inherit= '1'; ?>
						 <?php } ?>
						<input type="checkbox" name="inherit" value="1" <?php if(''.@$inherit.''){ ?>checked="1"<?php } ?> class="">
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