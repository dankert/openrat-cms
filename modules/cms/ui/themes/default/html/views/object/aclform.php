<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="aclform" data-action="object" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form object">
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<input type="radio" name="type" disabled="" value="all" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
					</input>
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_ALL'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
				</div>
			</div>
			<div class="line">
				<div class="label">
					<input type="radio" name="type" disabled="" value="user" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
					</input>
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_USER'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<input name="userid" value="" size="1" class="">
					</input>
				</div>
			</div>
			<?php $if4=(isset($groups)); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<input type="radio" name="type" disabled="" value="group" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
						</input>
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_GROUP'))) ?>
							</span>
						</label>
					</div>
					<div class="input">
						<input name="groupid" value="" size="1" class="">
						</input>
					</div>
				</div>
			 <?php } ?>
		</div></fieldset>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_LANGUAGE'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<input name="languageid" value="" size="1" class="">
					</input>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<?php foreach($show as $k=>$t) {  ?>
						<div class="">
							<?php $if8=($t=='read'); if($if8) {  ?>
								<?php  { $$t= true; ?>
								 <?php } ?>
								<input type="checkbox" name="<?php echo encodeHtml(htmlentities(@$t)) ?>" disabled="disabled" value="1" <?php if(''.@$${t.'}'){ ?>checked="1"<?php } ?> class="">
								</input>
							 <?php } ?>
							<?php if(!$if8) {  ?>
								<?php  { unset($$t) ?>
								 <?php } ?>
								<input type="checkbox" name="<?php echo encodeHtml(htmlentities(@$t)) ?>" value="1" <?php if(''.@$${t.'}'){ ?>checked="1"<?php } ?> class="">
								</input>
							 <?php } ?>
							<label class="label">
								<span class=""><?php echo encodeHtml(htmlentities(@lang('${t'))) ?>}
								</span>
							</label>
						</div>
					 <?php } ?>
				</div>
			</div>
		</div></fieldset>
	</form>