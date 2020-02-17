<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-menu">
		<div class="or-menu-group">
			<div class="toolbar-icon toggle-nav-open-close">
				<i class="image-icon image-icon--menu-menu">
				</i>
			</div>
			<div class="toolbar-icon toggle-nav-small">
				<i class="image-icon image-icon--menu-minimize">
				</i>
			</div>
			<?php $if4=(isset($dbname)); if($if4) {  ?>
				<div class="toolbar-icon">
					<i class="image-icon image-icon--action-database">
					</i>
					<span class="label"> 
					</span>
					<div class="arrow arrow-down">
					</div>
					<div class="dropdown">
						<div class="entry">
							<span title="<?php echo encodeHtml(htmlentities(@$dbid)) ?>" class=""><?php echo encodeHtml(htmlentities(@$dbname)) ?>
							</span>
						</div>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=($isLoggedIn); if($if4) {  ?>
				<div class="toolbar-icon clickable filtered on-action-folder on-action-page on-action-file on-action-projectlist on-action-templatelist on-action-userlist on-action-grouplist on-action-languagelist on-action-modellist">
					<a title="<?php echo encodeHtml(htmlentities(@lang('menu_new_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="add" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'add'}" href="/#//" class="">
						<i class="image-icon image-icon--method-add">
						</i>
					</a>
				</div>
			 <?php } ?>
			<?php $if4=($isLoggedIn); if($if4) {  ?>
				<div class="toolbar-icon clickable filtered on-action-folder on-action-page on-action-file on-action-image on-action-text on-action-pageelement on-action-template">
					<a title="<?php echo encodeHtml(htmlentities(@lang('menu_pub_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="pub" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'pub'}" href="/#//" class="">
						<i class="image-icon image-icon--method-publish">
						</i>
					</a>
				</div>
			 <?php } ?>
			<?php $if4=($isLoggedIn); if($if4) {  ?>
				<div class="toolbar-icon menu">
					<i class="image-icon image-icon--action-file">
					</i>
					<span class="label"><?php echo encodeHtml(htmlentities(@lang('file'))) ?>
					</span>
					<div class="arrow arrow-down">
					</div>
					<div class="dropdown">
						<div class="entry clickable filtered on-action-folder on-action-page on-action-file on-action-projectlist on-action-templatelist on-action-userlist on-action-grouplist on-action-languagelist on-action-modellist">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_new_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="add" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'add'}" href="/#//" class="">
								<i class="image-icon image-icon--method-add">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_new'))) ?>
								</span>
								<span class="keystroke"><?php echo encodeHtml(htmlentities(config('ui','keybinding','method','add'))) ?>
								</span>
							</a>
						</div>
						<div class="divide">
						</div>
						<div class="entry clickable filtered on-action-folder">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_createfolder_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="createfolder" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createfolder'}" href="/#//" class="">
								<i class="image-icon image-icon--method-add">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_createfolder'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable filtered on-action-folder">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_createpage_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="createpage" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createpage'}" href="/#//" class="">
								<i class="image-icon image-icon--method-add">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_createpage'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable filtered on-action-folder">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_createfile_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="createfile" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createfile'}" href="/#//" class="">
								<i class="image-icon image-icon--method-add">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_createfile'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable filtered on-action-folder">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_createimage_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="createimage" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createimage'}" href="/#//" class="">
								<i class="image-icon image-icon--method-add">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_createimage'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable filtered on-action-folder">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_createtext_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="createtext" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createtext'}" href="/#//" class="">
								<i class="image-icon image-icon--method-add">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_createtext'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable filtered on-action-folder">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_createlink_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="createlink" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createlink'}" href="/#//" class="">
								<i class="image-icon image-icon--method-add">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_createlink'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable filtered on-action-folder">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_createurl_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="createurl" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'createurl'}" href="/#//" class="">
								<i class="image-icon image-icon--method-add">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_createurl'))) ?>
								</span>
							</a>
						</div>
						<div class="divide">
						</div>
						<div class="entry clickable filtered on-action-file">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_compress_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="compress" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'compress'}" href="/#//" class="">
								<i class="image-icon image-icon--method-compress">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_compress'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable filtered on-action-file">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_decompress_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="decompress" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'decompress'}" href="/#//" class="">
								<i class="image-icon image-icon--method-decompress">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_decompress'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable filtered on-action-file">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_extract_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="extract" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'extract'}" href="/#//" class="">
								<i class="image-icon image-icon--method-extract">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_extract'))) ?>
								</span>
							</a>
						</div>
						<div class="divide">
						</div>
						<div class="entry clickable">
							<a title="<?php echo encodeHtml(htmlentities(@lang('USER_LOGOUT_DESC'))) ?>" target="_self" data-type="post" data-action="login" data-method="logout" data-id="" data-extra="[]" data-data="{"action":"login","subaction":"logout","id":"",\"token":"<?php echo token() ?>","none":"0"}"" class="entry">
								<i class="image-icon image-icon--method-logout">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('USER_LOGOUT'))) ?>
								</span>
							</a>
						</div>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=($isLoggedIn); if($if4) {  ?>
				<div class="toolbar-icon menu">
					<i class="image-icon image-icon--menu-edit">
					</i>
					<span class="label"><?php echo encodeHtml(htmlentities(@lang('edit'))) ?>
					</span>
					<div class="arrow arrow-down">
					</div>
					<div class="dropdown">
						<div class="entry clickable filtered on-action-user on-action-project on-action-link on-action-folder on-action-page on-action-template on-action-element on-action-file on-action-url on-action-image on-action-text on-action-language on-action-model">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_prop_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="prop" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'prop'}" href="/#//" class="">
								<i class="image-icon image-icon--method-prop">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_prop'))) ?>
								</span>
								<span class="keystroke"><?php echo encodeHtml(htmlentities(config('ui','keybinding','method','prop'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable filtered on-action-link on-action-folder on-action-page on-action-file on-action-text on-action-url on-action-image">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_settings_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="settings" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'settings'}" href="/#//" class="">
								<i class="image-icon image-icon--method-settings">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_settings'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable filtered on-action-page on-action-file on-action-folder on-action-text on-action-image on-action-pageelement on-action-template">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_pub_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="pub" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'pub'}" href="/#//" class="">
								<i class="image-icon image-icon--method-publish">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_pub'))) ?>
								</span>
								<span class="keystroke"><?php echo encodeHtml(htmlentities(config('ui','keybinding','method','pub'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable filtered on-action-pageelement">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_archive_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="archive" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'archive'}" href="/#//" class="entry">
								<i class="image-icon image-icon--method-archive">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_archive'))) ?>
								</span>
								<span class="keystroke"><?php echo encodeHtml(htmlentities(config('ui','keybinding','method','archive'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable filtered on-action-project on-action-folder on-action-link on-action-user on-action-group on-action-page on-action-file on-action-image on-action-text on-action-url">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_rights_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="rights" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'rights'}" href="/#//" class="">
								<i class="image-icon image-icon--method-rights">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_rights'))) ?>
								</span>
								<span class="keystroke"><?php echo encodeHtml(htmlentities(config('ui','keybinding','method','rights'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable filtered on-action-pageelement on-action-user on-action-group on-action-page on-action-project on-action-projectlist">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_history_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="history" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'history'}" href="/#//" class="">
								<i class="image-icon image-icon--method-history">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_history'))) ?>
								</span>
							</a>
						</div>
						<div class="divide">
						</div>
						<div class="entry clickable filtered on-action-project on-action-template on-action-page on-action-element on-action-image on-action-file on-action-folder on-action-url on-action-image on-action-text on-action-link on-action-language on-action-model on-action-user on-action-group">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_delete_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="remove" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'remove'}" href="/#//" class="">
								<i class="image-icon image-icon--method-delete">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_delete'))) ?>
								</span>
							</a>
						</div>
						<div class="divide">
						</div>
						<div class="entry clickable filtered on-action-page on-action-file on-action-image on-action-template on-action-pageelement">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_preview_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="preview" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'preview'}" href="/#//" class="">
								<i class="image-icon image-icon--method-preview">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_preview'))) ?>
								</span>
							</a>
						</div>
					</div>
				</div>
			 <?php } ?>
			<?php $if4=($isLoggedIn); if($if4) {  ?>
				<div class="toolbar-icon menu">
					<i class="image-icon image-icon--menu-extra">
					</i>
					<span class="label"><?php echo encodeHtml(htmlentities(@lang('extras'))) ?>
					</span>
					<div class="arrow arrow-down">
					</div>
					<div class="dropdown">
						<div class="entry clickable filtered on-action-user">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_password_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="pw" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'pw'}" href="/#//" class="">
								<i class="image-icon image-icon--method-password">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_password'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable filtered on-action-user on-action-group">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_memberships_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="memberships" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'memberships'}" href="/#//" class="">
								<i class="image-icon image-icon--method-membership">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_memberships'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable filtered on-action-folder on-action-element on-action-file on-action-image on-action-text on-action-pageelement">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_advanced_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="advanced" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'advanced'}" href="/#//" class="">
								<i class="image-icon image-icon--method-advanced">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_advanced'))) ?>
								</span>
							</a>
						</div>
						<div class="divide">
						</div>
						<div class="entry clickable filtered on-action-page">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_changetemplate_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="changetemplate" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'changetemplate'}" href="/#//" class="">
								<i class="image-icon image-icon--method-changetemplate">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_changetemplate'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable filtered on-action-template on-action-configuration on-action-page">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_src_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="src" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'src'}" href="/#//" class="">
								<i class="image-icon image-icon--method-code">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_src'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable filtered on-action-template">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_extension_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="extension" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'extension'}" href="/#//" class="">
								<i class="image-icon image-icon--method-extension">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_extension'))) ?>
								</span>
							</a>
						</div>
						<div class="divide">
						</div>
						<div class="entry clickable filtered on-action-text">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_value_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="value" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'value'}" href="/#//" class="">
								<i class="image-icon image-icon--method-value">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_value'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable filtered on-action-folder">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_order_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="order" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'order'}" href="/#//" class="">
								<i class="image-icon image-icon--method-order">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_order'))) ?>
								</span>
							</a>
						</div>
						<div class="divide">
						</div>
						<div class="entry clickable filtered on-action-image">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_size_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="size" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'size'}" href="/#//" class="">
								<i class="image-icon image-icon--method-size">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_size'))) ?>
								</span>
							</a>
						</div>
						<div class="divide">
						</div>
						<div class="entry clickable filtered on-action-project">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_maintenance_desc'))) ?>" target="_self" data-type="dialog" data-action="" data-method="maintenance" data-id="" data-extra="{'dialogAction':null,'dialogMethod':'maintenance'}" href="/#//" class="">
								<i class="image-icon image-icon--method-maintenance">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_maintenance'))) ?>
								</span>
							</a>
						</div>
					</div>
				</div>
			 <?php } ?>
		</div>
		<div class="or-menu-group">
			<div class="toolbar-icon user menu">
				<i class="image-icon image-icon--action-user">
				</i>
				<span class="label"><?php echo encodeHtml(htmlentities(@$userfullname)) ?>
				</span>
				<div class="arrow arrow-down">
				</div>
				<div class="dropdown">
					<?php $if6=($isLoggedIn); if($if6) {  ?>
						<div class="entry clickable">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_PROFILE_DESC'))) ?>" target="_self" data-type="dialog" data-action="profile" data-method="edit" data-id="" data-extra="{'dialogAction':'profile','dialogMethod':'edit'}" href="/#/profile/" class="">
								<i class="image-icon image-icon--action-user">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_profile'))) ?>
								</span>
								<span class="keystroke"><?php echo encodeHtml(htmlentities(config('ui','keybinding','action','profile'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_password_DESC'))) ?>" target="_self" data-type="dialog" data-action="profile" data-method="pw" data-id="" data-extra="{'dialogAction':'profile','dialogMethod':'pw'}" href="/#/profile/" class="">
								<i class="image-icon image-icon--method-password">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_password'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_mail_DESC'))) ?>" target="_self" data-type="dialog" data-action="profile" data-method="mail" data-id="" data-extra="{'dialogAction':'profile','dialogMethod':'mail'}" href="/#/profile/" class="">
								<i class="image-icon image-icon--method-mail">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_mail'))) ?>
								</span>
							</a>
						</div>
						<div class="entry clickable">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_license_DESC'))) ?>" target="_self" data-type="dialog" data-action="login" data-method="license" data-id="" data-extra="{'dialogAction':'login','dialogMethod':'license'}" href="/#/login/" class="">
								<i class="image-icon image-icon--method-info">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_info'))) ?>
								</span>
							</a>
						</div>
						<div class="divide">
						</div>
						<div class="entry clickable">
							<a title="<?php echo encodeHtml(htmlentities(@lang('menu_history_desc'))) ?>" target="_self" data-type="dialog" data-action="profile" data-method="history" data-id="" data-extra="{'dialogAction':'profile','dialogMethod':'history'}" href="/#/profile/" class="">
								<i class="image-icon image-icon--method-history">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_history'))) ?>
								</span>
							</a>
						</div>
						<div class="divide">
						</div>
						<div class="entry clickable">
							<a data-after-success="reloadAll" title="<?php echo encodeHtml(htmlentities(@lang('USER_LOGOUT_DESC'))) ?>" target="_self" data-type="post" data-action="login" data-method="logout" data-id="" data-extra="[]" data-data="{"action":"login","subaction":"logout","id":"",\"token":"<?php echo token() ?>","none":"0"}"" class="entry">
								<i class="image-icon image-icon--method-logout">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('USER_LOGOUT'))) ?>
								</span>
							</a>
						</div>
					 <?php } ?>
					<?php if(!$if6) {  ?>
						<div class="entry clickable">
							<a title="<?php echo encodeHtml(htmlentities(@lang('USER_LOGIN_DESC'))) ?>" target="_self" data-type="dialog" data-action="login" data-method="login" data-id="" data-extra="{'dialogAction':'login','dialogMethod':'login'}" href="/#/login/" class="">
								<i class="image-icon image-icon--method-user">
								</i>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('USER_LOGIN'))) ?>
								</span>
							</a>
						</div>
					 <?php } ?>
				</div>
			</div>
			<?php $if4=($isLoggedIn); if($if4) {  ?>
				<div class="toolbar-icon menu search">
					<i class="image-icon image-icon--method-search">
					</i>
					<input name="text" disabled="" placeholder="<?php echo encodeHtml(htmlentities(@lang('search'))) ?>" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$text)) ?>" class="">
					</input>
					<div class="arrow arrow-down">
					</div>
					<div class="dropdown">
						<span class="">
						</span>
					</div>
				</div>
			 <?php } ?>
		</div>
	</div>