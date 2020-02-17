<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="_top" action="./" data-method="login" data-action="login" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form login">
		<?php $if3=(config('security','openid','enable')); if($if3) {  ?>
			<fieldset class="or-group toggle-open-close open show"><div class="closable">
				<div class="line">
					<div class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('openid_user'))) ?>
						</span>
						<?php $if7=!((config('security','openid','logo_url'))==FALSE); if($if7) {  ?>
							<img src="<?php echo encodeHtml(htmlentities(config('security','openid','logo_url'))) ?>" class="">
							</img>
						 <?php } ?>
					</div>
					<div class="input">
						<?php include_once( 'modules/template-engine/components/html/radiobox/component-radio-box.php'); { <?php component_radio_box(openid_provider,$openid_providers,${openid_provider}) ?> ?>
						 <?php } ?>
						<?php $if7=($openid_user_identity); if($if7) {  ?>
							<input type="radio" name="openid_provider" disabled="" value="identity" checked="<?php echo encodeHtml(htmlentities(@$openid_provider)) ?>" class="">
							</input>
							<input name="openid_url" disabled="" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$openid_url)) ?>" class="name">
							</input>
						 <?php } ?>
					</div>
				</div>
			</div></fieldset>
			<?php $if4=(intval('1')<intval('size:dbids')); if($if4) {  ?>
				<fieldset class="or-group toggle-open-close open show"><div class="closable">
					<div class="line">
						<div class="label">
							<label class="label">
								<span class=""><?php echo encodeHtml(htmlentities(@lang('DATABASE'))) ?>
								</span>
							</label>
						</div>
						<div class="input">
							<input name="dbid" value="<?php echo encodeHtml(htmlentities(@$actdbid)) ?>" size="1" class="">
							</input>
							<input type="hidden" name="screenwidth" value="9999" class="">
							</input>
						</div>
					</div>
				</div></fieldset>
			 <?php } ?>
			<?php if(!$if4) {  ?>
				<input type="hidden" name="dbid" value="<?php echo encodeHtml(htmlentities(@$actdbid)) ?>" class="">
				</input>
			 <?php } ?>
			<input type="hidden" name="objectid" value="<?php echo encodeHtml(htmlentities(@$objectid)) ?>" class="">
			</input>
			<input type="hidden" name="modelid" value="<?php echo encodeHtml(htmlentities(@$modelid)) ?>" class="">
			</input>
			<input type="hidden" name="projectid" value="<?php echo encodeHtml(htmlentities(@$projectid)) ?>" class="">
			</input>
			<input type="hidden" name="languageid" value="<?php echo encodeHtml(htmlentities(@$languageid)) ?>" class="">
			</input>
		 <?php } ?>
		<?php if(!$if3) {  ?>
			<div class="message error">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('OPENID_NOT_ENABLED'))) ?>
				</span>
			</div>
		 <?php } ?>
	</form>