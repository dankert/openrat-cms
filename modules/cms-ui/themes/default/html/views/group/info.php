<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="info" data-action="group" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form group">
		<span class="headline"><?php echo encodeHtml(htmlentities(@$name)) ?>
		</span>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
				</span>
			</div>
			<div class="input clickable">
				<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
				</span>
				<a target="_self" data-type="edit" data-action="group" data-method="prop" data-id="" data-extra="[]" href="/#/group/" class="or-link-btn">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('edit'))) ?>
					</span>
				</a>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('USERS'))) ?>
				</span>
			</div>
			<div class="input">
				<?php foreach($users as $id=>$name) {  ?>
					<div class="clickable">
						<a target="_self" data-type="open" data-action="user" data-method="" data-id="<?php echo encodeHtml(htmlentities(@$id)) ?>" data-extra="[]" href="/#/user/<?php echo encodeHtml(htmlentities(@$id)) ?>" class="">
							<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
							</span>
						</a>
						<br>
						</br>
					</div>
				 <?php } ?>
			</div>
		</div>
		<div class="line">
			<div class="label">
			</div>
			<div class="input clickable">
				<a target="_self" data-type="edit" data-action="group" data-method="memberships" data-id="" data-extra="[]" href="/#/group/" class="or-link-btn">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('edit'))) ?>
					</span>
				</a>
			</div>
		</div>
	</form>