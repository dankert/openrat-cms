<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<div class="or-menu">
			<div class="or-menu-group">
				<div class="toolbar-icon toggle-nav-open-close">
					<i class="image-icon image-icon--menu-menu"></i>
					
				</div>
				<div class="toolbar-icon toggle-nav-small">
					<i class="image-icon image-icon--menu-minimize"></i>
					
				</div>
				<?php $if4=(isset($$dbname)); if($if4){?>
					<div class="toolbar-icon">
						<i class="image-icon image-icon--action-database"></i>
						
						<span class="label"><?php echo nl2br('&nbsp;'); ?></span>
						
						<div class="arrow arrow-down">
						</div>
						<div class="dropdown">
							<div class="entry">
								<span title="<?php echo $dbid ?>"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $dbname,50,'..',constant('STR_PAD_BOTH') )))); ?></span>
								
							</div>
						</div>
					</div>
				<?php } ?>
				<?php $if4=($isLoggedIn); if($if4){?>
					<div class="toolbar-icon clickable filtered on-action-folder on-action-page on-action-file on-action-projectlist on-action-templatelist on-action-userlist on-action-grouplist on-action-languagelist on-action-modellist">
						<a title="<?php echo lang('menu_new_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="add" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'add'}" href="./#//">
							<i class="image-icon image-icon--method-add"></i>
							
						</a>
					</div>
				<?php } ?>
				<?php $if4=($isLoggedIn); if($if4){?>
					<div class="toolbar-icon clickable filtered on-action-folder on-action-page on-action-file on-action-image on-action-text on-action-pageelement on-action-template">
						<a title="<?php echo lang('menu_pub_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="pub" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'pub'}" href="./#//">
							<i class="image-icon image-icon--method-publish"></i>
							
						</a>
					</div>
				<?php } ?>
				<?php $if4=($isLoggedIn); if($if4){?>
					<div class="toolbar-icon menu">
						<i class="image-icon image-icon--action-file"></i>
						
						<span class="label"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'file'.'')))); ?></span>
						
						<div class="arrow arrow-down">
						</div>
						<div class="dropdown">
							<div class="entry clickable filtered on-action-folder on-action-page on-action-file on-action-projectlist on-action-templatelist on-action-userlist on-action-grouplist on-action-languagelist on-action-modellist">
								<a title="<?php echo lang('menu_new_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="add" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'add'}" href="./#//">
									<i class="image-icon image-icon--method-add"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_new'.'')))); ?></span>
									
									<span class="keystroke"><?php echo nl2br(encodeHtml(htmlentities(config('ui','keybinding','method','add')))); ?></span>
									
								</a>
							</div>
							<div class="divide">
							</div>
							<div class="entry clickable filtered on-action-folder">
								<a title="<?php echo lang('menu_createfolder_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="createfolder" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createfolder'}" href="./#//">
									<i class="image-icon image-icon--method-add"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createfolder'.'')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable filtered on-action-folder">
								<a title="<?php echo lang('menu_createpage_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="createpage" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createpage'}" href="./#//">
									<i class="image-icon image-icon--method-add"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createpage'.'')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable filtered on-action-folder">
								<a title="<?php echo lang('menu_createfile_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="createfile" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createfile'}" href="./#//">
									<i class="image-icon image-icon--method-add"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createfile'.'')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable filtered on-action-folder">
								<a title="<?php echo lang('menu_createimage_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="createimage" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createimage'}" href="./#//">
									<i class="image-icon image-icon--method-add"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createimage'.'')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable filtered on-action-folder">
								<a title="<?php echo lang('menu_createtext_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="createtext" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createtext'}" href="./#//">
									<i class="image-icon image-icon--method-add"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createtext'.'')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable filtered on-action-folder">
								<a title="<?php echo lang('menu_createlink_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="createlink" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createlink'}" href="./#//">
									<i class="image-icon image-icon--method-add"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createlink'.'')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable filtered on-action-folder">
								<a title="<?php echo lang('menu_createurl_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="createurl" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createurl'}" href="./#//">
									<i class="image-icon image-icon--method-add"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createurl'.'')))); ?></span>
									
								</a>
							</div>
							<div class="divide">
							</div>
							<div class="entry clickable filtered on-action-file">
								<a title="<?php echo lang('menu_compress_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="compress" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'compress'}" href="./#//">
									<i class="image-icon image-icon--method-compress"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_compress'.'')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable filtered on-action-file">
								<a title="<?php echo lang('menu_decompress_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="decompress" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'decompress'}" href="./#//">
									<i class="image-icon image-icon--method-decompress"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_decompress'.'')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable filtered on-action-file">
								<a title="<?php echo lang('menu_extract_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="extract" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'extract'}" href="./#//">
									<i class="image-icon image-icon--method-extract"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_extract'.'')))); ?></span>
									
								</a>
							</div>
							<div class="divide">
							</div>
							<div class="entry clickable">
								<a class="entry" title="<?php echo lang('USER_LOGOUT_DESC') ?>" target="_self" data-type="post" data-action="login" data-method="logout" data-id="<?php echo OR_ID ?>" data-extra="[]" data-data="{&quot;action&quot;:&quot;login&quot;,&quot;subaction&quot;:&quot;logout&quot;,&quot;id&quot;:&quot;<?php echo OR_ID ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
									<i class="image-icon image-icon--method-logout"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_LOGOUT'.'')))); ?></span>
									
								</a>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php $if4=($isLoggedIn); if($if4){?>
					<div class="toolbar-icon menu">
						<i class="image-icon image-icon--menu-edit"></i>
						
						<span class="label"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'edit'.'')))); ?></span>
						
						<div class="arrow arrow-down">
						</div>
						<div class="dropdown">
							<div class="entry clickable filtered on-action-user on-action-project on-action-link on-action-folder on-action-page on-action-template on-action-element on-action-file on-action-url on-action-image on-action-text on-action-language on-action-model">
								<a title="<?php echo lang('menu_prop_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="prop" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'prop'}" href="./#//">
									<i class="image-icon image-icon--method-prop"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_prop'.'')))); ?></span>
									
									<span class="keystroke"><?php echo nl2br(encodeHtml(htmlentities(config('ui','keybinding','method','prop')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable filtered on-action-link on-action-folder on-action-page on-action-file on-action-text on-action-url on-action-image">
								<a title="<?php echo lang('menu_settings_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="settings" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'settings'}" href="./#//">
									<i class="image-icon image-icon--method-settings"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_settings'.'')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable filtered on-action-page on-action-file on-action-folder on-action-text on-action-image on-action-pageelement on-action-template">
								<a title="<?php echo lang('menu_pub_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="pub" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'pub'}" href="./#//">
									<i class="image-icon image-icon--method-publish"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_pub'.'')))); ?></span>
									
									<span class="keystroke"><?php echo nl2br(encodeHtml(htmlentities(config('ui','keybinding','method','pub')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable filtered on-action-pageelement">
								<a class="entry" title="<?php echo lang('menu_archive_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="archive" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'archive'}" href="./#//">
									<i class="image-icon image-icon--method-archive"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_archive'.'')))); ?></span>
									
									<span class="keystroke"><?php echo nl2br(encodeHtml(htmlentities(config('ui','keybinding','method','archive')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable filtered on-action-project on-action-folder on-action-link on-action-user on-action-group on-action-page on-action-file on-action-image on-action-text on-action-url">
								<a title="<?php echo lang('menu_rights_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="rights" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'rights'}" href="./#//">
									<i class="image-icon image-icon--method-rights"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_rights'.'')))); ?></span>
									
									<span class="keystroke"><?php echo nl2br(encodeHtml(htmlentities(config('ui','keybinding','method','rights')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable filtered on-action-pageelement on-action-user on-action-group on-action-page on-action-project on-action-projectlist">
								<a title="<?php echo lang('menu_history_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="history" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'history'}" href="./#//">
									<i class="image-icon image-icon--method-history"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_history'.'')))); ?></span>
									
								</a>
							</div>
							<div class="divide">
							</div>
							<div class="entry clickable filtered on-action-project on-action-template on-action-page on-action-element on-action-image on-action-file on-action-folder on-action-url on-action-image on-action-text on-action-link on-action-language on-action-model on-action-user on-action-group">
								<a title="<?php echo lang('menu_delete_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="remove" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'remove'}" href="./#//">
									<i class="image-icon image-icon--method-delete"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_delete'.'')))); ?></span>
									
								</a>
							</div>
							<div class="divide">
							</div>
							<div class="entry clickable filtered on-action-page on-action-file on-action-image on-action-template on-action-pageelement">
								<a title="<?php echo lang('menu_preview_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="preview" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'preview'}" href="./#//">
									<i class="image-icon image-icon--method-preview"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_preview'.'')))); ?></span>
									
								</a>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php $if4=($isLoggedIn); if($if4){?>
					<div class="toolbar-icon menu">
						<i class="image-icon image-icon--menu-extra"></i>
						
						<span class="label"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'extras'.'')))); ?></span>
						
						<div class="arrow arrow-down">
						</div>
						<div class="dropdown">
							<div class="entry clickable filtered on-action-user">
								<a title="<?php echo lang('menu_password_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="pw" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'pw'}" href="./#//">
									<i class="image-icon image-icon--method-password"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_password'.'')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable filtered on-action-user on-action-group">
								<a title="<?php echo lang('menu_memberships_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="memberships" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'memberships'}" href="./#//">
									<i class="image-icon image-icon--method-membership"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_memberships'.'')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable filtered on-action-folder on-action-element on-action-file on-action-image on-action-text on-action-pageelement">
								<a title="<?php echo lang('menu_advanced_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="advanced" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'advanced'}" href="./#//">
									<i class="image-icon image-icon--method-advanced"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_advanced'.'')))); ?></span>
									
								</a>
							</div>
							<div class="divide">
							</div>
							<div class="entry clickable filtered on-action-page">
								<a title="<?php echo lang('menu_changetemplate_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="changetemplate" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'changetemplate'}" href="./#//">
									<i class="image-icon image-icon--method-changetemplate"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_changetemplate'.'')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable filtered on-action-template on-action-configuration on-action-page">
								<a title="<?php echo lang('menu_src_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="src" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'src'}" href="./#//">
									<i class="image-icon image-icon--method-code"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_src'.'')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable filtered on-action-template">
								<a title="<?php echo lang('menu_extension_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="extension" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'extension'}" href="./#//">
									<i class="image-icon image-icon--method-extension"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_extension'.'')))); ?></span>
									
								</a>
							</div>
							<div class="divide">
							</div>
							<div class="entry clickable filtered on-action-text">
								<a title="<?php echo lang('menu_value_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="value" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'value'}" href="./#//">
									<i class="image-icon image-icon--method-value"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_value'.'')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable filtered on-action-folder">
								<a title="<?php echo lang('menu_order_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="order" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'order'}" href="./#//">
									<i class="image-icon image-icon--method-order"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_order'.'')))); ?></span>
									
								</a>
							</div>
							<div class="divide">
							</div>
							<div class="entry clickable filtered on-action-image">
								<a title="<?php echo lang('menu_size_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="size" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'size'}" href="./#//">
									<i class="image-icon image-icon--method-size"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_size'.'')))); ?></span>
									
								</a>
							</div>
							<div class="divide">
							</div>
							<div class="entry clickable filtered on-action-project">
								<a title="<?php echo lang('menu_maintenance_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="maintenance" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'maintenance'}" href="./#//">
									<i class="image-icon image-icon--method-maintenance"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_maintenance'.'')))); ?></span>
									
								</a>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<div class="or-menu-group">
				<div class="toolbar-icon user menu">
					<i class="image-icon image-icon--action-user"></i>
					
					<span class="label"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $userfullname,25,'..',constant('STR_PAD_BOTH') )))); ?></span>
					
					<div class="arrow arrow-down">
					</div>
					<div class="dropdown">
						<?php $if6=($isLoggedIn); if($if6){?>
							<div class="entry clickable">
								<a title="<?php echo lang('menu_PROFILE_DESC') ?>" target="_self" data-type="dialog" data-action="profile" data-method="edit" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'profile','dialogMethod':'edit'}" href="./#/profile/">
									<i class="image-icon image-icon--action-user"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_profile'.'')))); ?></span>
									
									<span class="keystroke"><?php echo nl2br(encodeHtml(htmlentities(config('ui','keybinding','action','profile')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable">
								<a title="<?php echo lang('menu_password_DESC') ?>" target="_self" data-type="dialog" data-action="profile" data-method="pw" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'profile','dialogMethod':'pw'}" href="./#/profile/">
									<i class="image-icon image-icon--method-password"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_password'.'')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable">
								<a title="<?php echo lang('menu_mail_DESC') ?>" target="_self" data-type="dialog" data-action="profile" data-method="mail" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'profile','dialogMethod':'mail'}" href="./#/profile/">
									<i class="image-icon image-icon--method-mail"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_mail'.'')))); ?></span>
									
								</a>
							</div>
							<div class="entry clickable">
								<a title="<?php echo lang('menu_license_DESC') ?>" target="_self" data-type="dialog" data-action="login" data-method="license" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'login','dialogMethod':'license'}" href="./#/login/">
									<i class="image-icon image-icon--method-info"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_info'.'')))); ?></span>
									
								</a>
							</div>
							<div class="divide">
							</div>
							<div class="entry clickable">
								<a title="<?php echo lang('menu_history_desc') ?>" target="_self" data-type="dialog" data-action="profile" data-method="history" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'profile','dialogMethod':'history'}" href="./#/profile/">
									<i class="image-icon image-icon--method-history"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_history'.'')))); ?></span>
									
								</a>
							</div>
							<div class="divide">
							</div>
							<div class="entry clickable">
								<a data-after-success="reloadAll" class="entry" title="<?php echo lang('USER_LOGOUT_DESC') ?>" target="_self" data-type="post" data-action="login" data-method="logout" data-id="<?php echo OR_ID ?>" data-extra="[]" data-data="{&quot;action&quot;:&quot;login&quot;,&quot;subaction&quot;:&quot;logout&quot;,&quot;id&quot;:&quot;<?php echo OR_ID ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
									<i class="image-icon image-icon--method-logout"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_LOGOUT'.'')))); ?></span>
									
								</a>
							</div>
						<?php } ?>
						<?php if(!$if6){?>
							<div class="entry clickable">
								<a title="<?php echo lang('USER_LOGIN_DESC') ?>" target="_self" data-type="dialog" data-action="login" data-method="login" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'login','dialogMethod':'login'}" href="./#/login/">
									<i class="image-icon image-icon--method-user"></i>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_LOGIN'.'')))); ?></span>
									
								</a>
							</div>
						<?php } ?>
					</div>
				</div>
				<?php $if4=($isLoggedIn); if($if4){?>
					<div class="toolbar-icon menu search">
						<i class="image-icon image-icon--method-search"></i>
						
						<div class="inputholder"><input placeholder="<?php echo lang('search') ?>" id="<?php echo REQUEST_ID ?>_text" name="<?php if ('') echo ''.'_' ?>text<?php if (false) echo '_disabled' ?>" type="text" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$text) ?>" /><?php if (false) { ?><input type="hidden" name="text" value="<?php $text ?>"/><?php } ?></div>
						
						<div class="arrow arrow-down">
						</div>
						<div class="dropdown">
							<span><?php echo nl2br(encodeHtml(htmlentities(''))); ?></span>
							
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	