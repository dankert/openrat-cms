<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="size" data-action="image" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form image">
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('IMAGE_OLD_SIZE'))) ?>
				</span>
			</div>
			<div class="input">
				<span class=""><?php echo encodeHtml(htmlentities(@$width)) ?>
				</span>
				<span class=""> * 
				</span>
				<span class=""><?php echo encodeHtml(htmlentities(@$height)) ?>
				</span>
			</div>
		</div>
		<?php $if3=!(($formats)==FALSE); if($if3) {  ?>
			<fieldset class="or-group toggle-open-close open show"><div class="closable">
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<input type="radio" name="type" disabled="" value="factor" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
						</input>
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('FILE_IMAGE_SIZE_FACTOR'))) ?>
							</span>
						</label>
						<input name="factor" value="<?php echo encodeHtml(htmlentities(@$factor)) ?>" size="1" class="">
						</input>
						<?php  { $factor= '1'; ?>
						 <?php } ?>
					</div>
				</div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<input type="radio" name="type" disabled="" value="input" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
						</input>
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('FILE_IMAGE_NEW_WIDTH_HEIGHT'))) ?>
							</span>
						</label>
					</div>
					<div class="label">
					</div>
					<div class="input">
						<input name="width" disabled="" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$width)) ?>" class="">
						</input>
						<span class=""> * 
						</span>
						<input name="height" disabled="" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$height)) ?>" class="">
						</input>
					</div>
				</div>
			</div></fieldset>
			<fieldset class="or-group toggle-open-close open show"><div class="closable">
				<div class="line">
					<div class="label">
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('FILE_IMAGE_FORMAT'))) ?>
							</span>
						</label>
					</div>
					<div class="input">
						<input name="format" value="<?php echo encodeHtml(htmlentities(@$format)) ?>" size="1" class="">
						</input>
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('FILE_IMAGE_JPEG_COMPRESSION'))) ?>
							</span>
						</label>
					</div>
					<div class="input">
						<?php  { $jpeg_compression= '70'; ?>
						 <?php } ?>
						<input name="jpeg_compression" value="<?php echo encodeHtml(htmlentities(@$jpeg_compression)) ?>" size="1" class="">
						</input>
					</div>
				</div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<input type="checkbox" name="copy" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$copy)) ?>" class="">
						</input>
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('copy'))) ?>
							</span>
						</label>
					</div>
				</div>
			</div></fieldset>
		 <?php } ?>
	</form>