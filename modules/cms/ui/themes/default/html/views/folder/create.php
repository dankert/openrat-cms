<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-linklist">
		<?php $if3=($mayCreateFolder); if($if3) {  ?>
			<div class="clickable or-linklist-line or-round-corners or-hover-effect">
				<a target="_self" data-type="dialog" data-action="" data-method="createfolder" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createfolder'}" href="/#//" class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_createfolder'))) ?>
					</span>
				</a>
			</div>
		 <?php } ?>
		<?php $if3=($mayCreatePage); if($if3) {  ?>
			<div class="clickable or-linklist-line or-round-corners or-hover-effect">
				<a target="_self" data-type="dialog" data-action="" data-method="createpage" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createpage'}" href="/#//" class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_createpage'))) ?>
					</span>
				</a>
			</div>
		 <?php } ?>
		<?php $if3=($mayCreateFile); if($if3) {  ?>
			<div class="clickable or-linklist-line or-round-corners or-hover-effect">
				<a target="_self" data-type="dialog" data-action="" data-method="createfile" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createfile'}" href="/#//" class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_createfile'))) ?>
					</span>
				</a>
			</div>
		 <?php } ?>
		<?php $if3=($mayCreateImage); if($if3) {  ?>
			<div class="clickable or-linklist-line or-round-corners or-hover-effect">
				<a target="_self" data-type="dialog" data-action="" data-method="createimage" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createimage'}" href="/#//" class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_createimage'))) ?>
					</span>
				</a>
			</div>
		 <?php } ?>
		<?php $if3=($mayCreateText); if($if3) {  ?>
			<div class="clickable or-linklist-line or-round-corners or-hover-effect">
				<a target="_self" data-type="dialog" data-action="" data-method="createtext" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createtext'}" href="/#//" class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_createtext'))) ?>
					</span>
				</a>
			</div>
		 <?php } ?>
		<?php $if3=($mayCreateUrl); if($if3) {  ?>
			<div class="clickable or-linklist-line or-round-corners or-hover-effect">
				<a target="_self" data-type="dialog" data-action="" data-method="createurl" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createurl'}" href="/#//" class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_createurl'))) ?>
					</span>
				</a>
			</div>
		 <?php } ?>
		<?php $if3=($mayCreateLink); if($if3) {  ?>
			<div class="clickable or-linklist-line or-round-corners or-hover-effect">
				<a target="_self" data-type="dialog" data-action="" data-method="createlink" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createlink'}" href="/#//" class="">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_createlink'))) ?>
					</span>
				</a>
			</div>
		 <?php } ?>
	</div>