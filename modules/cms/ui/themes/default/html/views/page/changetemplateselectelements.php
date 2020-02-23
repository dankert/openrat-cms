<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="changetemplateselectelements" data-action="page" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form page">
		<input type="hidden" name="newtemplateid" value="<?php echo encodeHtml(htmlentities(@$newtemplateid)) ?>" class="">
		</input>
		<?php foreach($elements as $list_key=>$list_value) { extract($list_value); ?>
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
					</span>
				</div>
				<div class="input">
					<input name="<?php echo encodeHtml(htmlentities(@$newElementsName)) ?>" value="" size="1" class="">
					</input>
				</div>
			</div>
		 <?php } ?>
	</form>