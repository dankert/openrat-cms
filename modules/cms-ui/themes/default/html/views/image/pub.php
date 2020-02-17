<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<?php $if2=(config('security','nopublish')); if($if2) {  ?>
		<div class="message warn">
			<span class="help"><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NOPUBLISH_DESC'))) ?>
			</span>
		</div>
	 <?php } ?>
	<form name="" target="_self" data-target="view" action="./" data-method="pub" data-action="image" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="1" data-autosave="" class="or-form image">
		<tr class="">
			<td class="">
				<br>
				</br>
			</td>
		</tr>
		<tr class="">
			<td class="act">
			</td>
		</tr>
	</form>