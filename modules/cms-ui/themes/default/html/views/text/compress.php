<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="compress" data-action="text" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form text">
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('type'))) ?>
					</span>
				</div>
				<div class="input">
					<?php  { $gz= 'gz'; ?>
					 <?php } ?>
					<input name="format" value="gz" size="1" class="">
					</input>
					<?php  { $replace= '1'; ?>
					 <?php } ?>
					<input type="radio" name="replace" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$replace)) ?>" class="">
					</input>
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('replace'))) ?>
						</span>
					</label>
					<br>
					</br>
					<input type="radio" name="replace" disabled="" value="0" checked="<?php echo encodeHtml(htmlentities(@$replace)) ?>" class="">
					</input>
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('new'))) ?>
						</span>
					</label>
				</div>
			</div>
		</div></fieldset>
	</form>