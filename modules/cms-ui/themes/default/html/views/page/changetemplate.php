<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="changetemplateselectelements" data-action="page" data-id="<?php echo OR_ID ?>" method="get" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form page">
		<input type="hidden" name="templateid" value="<?php echo encodeHtml(htmlentities(@$templateid)) ?>" class="">
		</input>
		<input type="hidden" name="modelid" value="<?php echo encodeHtml(htmlentities(@$modelid)) ?>" class="">
		</input>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('page_template_old'))) ?>
				</span>
			</div>
			<div class="input">
				<a target="_self" data-url="<?php echo encodeHtml(htmlentities(@$template_url)) ?>" data-action="" data-method="" data-id="" data-extra="[]" href="/#//" class="">
					<img src="./modules/cms-ui/themes/default/images/icon_template.png" class="">
					</img>
					<span class=""><?php echo encodeHtml(htmlentities(@$template_name)) ?>
					</span>
				</a>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('page_template_new'))) ?>
				</span>
			</div>
			<div class="input">
				<input name="newtemplateid" value="" size="1" class="">
				</input>
			</div>
		</div>
	</form>