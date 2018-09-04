
	
		<div class="toolbar-icon toggle-nav-open-close">
			<img class="" title="" src="./modules/cms-ui/themes/default/images/icon/menu/menu.svg" />
			
		</div>
		<?php $if2=(isset($$dbname)); if($if2){?>
			<div class="toolbar-icon">
				<img class="image-icon image-icon--action" title="" src="./modules/cms-ui/themes/default/images/icon/action/database.svg" />
				
				<span class="label"><?php echo nl2br('&nbsp;'); ?></span>
				
				<div class="arrow-down">
				</div>
				<div class="dropdown">
					<div class="entry">
						<span class="text" title="<?php echo $dbid ?>"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $dbname,50,'..',constant('STR_PAD_BOTH') )))); ?></span>
						
					</div>
				</div>
			</div>
		<?php } ?>
		<?php $if2=($isLoggedIn); if($if2){?>
			<div class="toolbar-icon menu">
				<img class="image-icon image-icon--action" title="" src="./modules/cms-ui/themes/default/images/icon/action/file.svg" />
				
				<span class="label"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'file'.'')))); ?></span>
				
				<div class="arrow-down">
				</div>
				<div class="dropdown">
					<div class="entry clickable filtered on-action-folder on-action-page on-action-file">
						<a title="<?php echo lang('menu_new_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="new" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'new'}" href="<?php echo Html::url('','new','',array('dialogAction'=>'','dialogMethod'=>'new')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/add.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_new'.'')))); ?></span>
							
						</a>

					</div>
					<div class="divide">
					</div>
					<div class="entry clickable filtered on-action-folder">
						<a title="<?php echo lang('menu_createfolder_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="createfolder" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createfolder'}" href="<?php echo Html::url('','createfolder','',array('dialogAction'=>'','dialogMethod'=>'createfolder')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/add.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createfolder'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-folder">
						<a title="<?php echo lang('menu_createpage_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="createpage" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createpage'}" href="<?php echo Html::url('','createpage','',array('dialogAction'=>'','dialogMethod'=>'createpage')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/add.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createpage'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-folder">
						<a title="<?php echo lang('menu_createfile_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="createfile" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createfile'}" href="<?php echo Html::url('','createfile','',array('dialogAction'=>'','dialogMethod'=>'createfile')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/add.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createfile'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-folder">
						<a title="<?php echo lang('menu_createimage_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="createimage" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createimage'}" href="<?php echo Html::url('','createimage','',array('dialogAction'=>'','dialogMethod'=>'createimage')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/add.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createimage'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-folder">
						<a title="<?php echo lang('menu_createtext_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="createtext" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createtext'}" href="<?php echo Html::url('','createtext','',array('dialogAction'=>'','dialogMethod'=>'createtext')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/add.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createtext'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-folder">
						<a title="<?php echo lang('menu_createlink_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="createlink" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createlink'}" href="<?php echo Html::url('','createlink','',array('dialogAction'=>'','dialogMethod'=>'createlink')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/add.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createlink'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-folder">
						<a title="<?php echo lang('menu_createurl_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="createurl" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'createurl'}" href="<?php echo Html::url('','createurl','',array('dialogAction'=>'','dialogMethod'=>'createurl')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/add.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_createurl'.'')))); ?></span>
							
						</a>

					</div>
					<div class="divide">
					</div>
					<div class="entry clickable">
						<a title="<?php echo lang('menu_save_desc') ?>" target="_self" data-type="post" data-action="" data-method="save" data-id="<?php echo OR_ID ?>" data-extra="[]" data-data="{&quot;action&quot;:&quot;title&quot;,&quot;subaction&quot;:&quot;save&quot;,&quot;id&quot;:&quot;<?php echo OR_ID ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/save.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_save'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable">
						<a title="<?php echo lang('menu_saveall_desc') ?>" target="_self" data-type="post" data-action="" data-method="saveall" data-id="<?php echo OR_ID ?>" data-extra="[]" data-data="{&quot;action&quot;:&quot;title&quot;,&quot;subaction&quot;:&quot;saveall&quot;,&quot;id&quot;:&quot;<?php echo OR_ID ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/save.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_saveall'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-page on-action-file on-action-image on-action-template on-action-pageelement">
						<a title="<?php echo lang('menu_preview_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="preview" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'preview'}" href="<?php echo Html::url('','preview','',array('dialogAction'=>'','dialogMethod'=>'preview')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/preview.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_preview'.'')))); ?></span>
							
						</a>

					</div>
					<div class="divide">
					</div>
					<div class="entry clickable">
						<a class="entry" title="<?php echo lang('USER_LOGOUT_DESC') ?>" target="_self" data-type="post" data-action="login" data-method="logout" data-id="<?php echo OR_ID ?>" data-extra="[]" data-data="{&quot;action&quot;:&quot;login&quot;,&quot;subaction&quot;:&quot;logout&quot;,&quot;id&quot;:&quot;<?php echo OR_ID ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/logout.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_LOGOUT'.'')))); ?></span>
							
						</a>

					</div>
				</div>
			</div>
		<?php } ?>
		<?php $if2=($isLoggedIn); if($if2){?>
			<div class="toolbar-icon menu">
				<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/edit.svg" />
				
				<span class="label"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'edit'.'')))); ?></span>
				
				<div class="arrow-down">
				</div>
				<div class="dropdown">
					<div class="entry clickable filtered on-action-link on-action-folder on-action-page on-action-template on-action-element on-action-file">
						<a title="<?php echo lang('menu_prop_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="prop" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'prop'}" href="<?php echo Html::url('','prop','',array('dialogAction'=>'','dialogMethod'=>'prop')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/prop.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_prop'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-page on-action-file on-action-folder on-action-pageelement on-action-template">
						<a title="<?php echo lang('menu_pub_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="pub" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'pub'}" href="<?php echo Html::url('','pub','',array('dialogAction'=>'','dialogMethod'=>'pub')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/publish.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_pub'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-pageelement">
						<a class="entry" title="<?php echo lang('menu_archive_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="archive" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'archive'}" href="<?php echo Html::url('','archive','',array('dialogAction'=>'','dialogMethod'=>'archive')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/archive.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_archive'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-project on-action-folder on-action-link on-action-user on-action-group on-action-page on-action-file">
						<a title="<?php echo lang('menu_rights_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="rights" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'rights'}" href="<?php echo Html::url('','rights','',array('dialogAction'=>'','dialogMethod'=>'rights')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/rights.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_rights'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-pageelement on-action-user on-action-group on-action-page on-action-project on-action-projectlist">
						<a title="<?php echo lang('menu_history_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="history" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'history'}" href="<?php echo Html::url('','history','',array('dialogAction'=>'','dialogMethod'=>'history')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/history.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_history'.'')))); ?></span>
							
						</a>

					</div>
					<div class="divide">
					</div>
					<div class="entry clickable filtered on-action-page">
						<a title="<?php echo lang('menu_changetemplate_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="changetemplate" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'changetemplate'}" href="<?php echo Html::url('','changetemplate','',array('dialogAction'=>'','dialogMethod'=>'changetemplate')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/changetemplate.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_changetemplate'.'')))); ?></span>
							
						</a>

					</div>
					<div class="divide">
					</div>
					<div class="entry clickable filtered on-action-user">
						<a title="<?php echo lang('menu_password_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="pw" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'pw'}" href="<?php echo Html::url('','pw','',array('dialogAction'=>'','dialogMethod'=>'pw')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/password.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_password'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-language on-action-element">
						<a title="<?php echo lang('menu_advanced_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="advanced" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'advanced'}" href="<?php echo Html::url('','advanced','',array('dialogAction'=>'','dialogMethod'=>'advanced')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/advanced.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_advanced'.'')))); ?></span>
							
						</a>

					</div>
					<div class="divide">
					</div>
					<div class="entry clickable filtered on-action-project on-action-template on-action-page on-action-element on-action-image on-action-file on-action-folder on-action-link on-action-language on-action-model">
						<a title="<?php echo lang('menu_delete_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="remove" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'remove'}" href="<?php echo Html::url('','remove','',array('dialogAction'=>'','dialogMethod'=>'remove')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/delete.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_delete'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-template on-action-configuration on-action-page">
						<a title="<?php echo lang('menu_src_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="src" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'src'}" href="<?php echo Html::url('','src','',array('dialogAction'=>'','dialogMethod'=>'src')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/code.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_src'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-template">
						<a title="<?php echo lang('menu_extension_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="extension" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'extension'}" href="<?php echo Html::url('','extension','',array('dialogAction'=>'','dialogMethod'=>'extension')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/extension.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_extension'.'')))); ?></span>
							
						</a>

					</div>
					<div class="divide">
					</div>
					<div class="entry clickable filtered on-action-text">
						<a title="<?php echo lang('menu_value_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="value" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'value'}" href="<?php echo Html::url('','value','',array('dialogAction'=>'','dialogMethod'=>'value')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/value.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_value'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-folder">
						<a title="<?php echo lang('menu_order_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="order" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'order'}" href="<?php echo Html::url('','order','',array('dialogAction'=>'','dialogMethod'=>'order')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/order.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_order'.'')))); ?></span>
							
						</a>

					</div>
					<div class="divide">
					</div>
					<div class="entry clickable filtered on-action-file">
						<a title="<?php echo lang('menu_compress_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="compress" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'compress'}" href="<?php echo Html::url('','compress','',array('dialogAction'=>'','dialogMethod'=>'compress')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/compress.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_compress'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-file">
						<a title="<?php echo lang('menu_decompress_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="decompress" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'decompress'}" href="<?php echo Html::url('','decompress','',array('dialogAction'=>'','dialogMethod'=>'decompress')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/decompress.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_decompress'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-file">
						<a title="<?php echo lang('menu_extract_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="extract" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'extract'}" href="<?php echo Html::url('','extract','',array('dialogAction'=>'','dialogMethod'=>'extract')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/extract.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_extract'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-image">
						<a title="<?php echo lang('menu_size_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="size" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'size'}" href="<?php echo Html::url('','size','',array('dialogAction'=>'','dialogMethod'=>'size')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/size.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_size'.'')))); ?></span>
							
						</a>

					</div>
					<div class="divide">
					</div>
					<div class="entry clickable filtered on-action-project">
						<a title="<?php echo lang('menu_maintenance_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="maintenance" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'maintenance'}" href="<?php echo Html::url('','maintenance','',array('dialogAction'=>'','dialogMethod'=>'maintenance')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/maintenance.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_maintenance'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-project">
						<a title="<?php echo lang('menu_export_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="export" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'export'}" href="<?php echo Html::url('','export','',array('dialogAction'=>'','dialogMethod'=>'export')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/export.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_export'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable filtered on-action-user on-action-group">
						<a title="<?php echo lang('menu_memberships_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="memberships" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'memberships'}" href="<?php echo Html::url('','memberships','',array('dialogAction'=>'','dialogMethod'=>'memberships')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/membership.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_memberships'.'')))); ?></span>
							
						</a>

					</div>
				</div>
			</div>
		<?php } ?>
		<?php $if2=($isLoggedIn); if($if2){?>
			<div class="toolbar-icon clickable filtered on-action-folder on-action-page on-action-file on-action-pageelement on-action-template">
				<a title="<?php echo lang('menu_pub_desc') ?>" target="_self" data-type="dialog" data-action="" data-method="pub" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'pub'}" href="<?php echo Html::url('','pub','',array('dialogAction'=>'','dialogMethod'=>'pub')) ?>">
					<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/publish.svg" />
					
					<span class="label"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_pub'.'')))); ?></span>
					
				</a>

			</div>
		<?php } ?>
		<?php $if2=!(empty(config('login','motd'))); if($if2){?>
			<div class="toolbar-icon menu">
				<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/motd.svg" />
				
				<span class="label"><?php echo nl2br('&nbsp;'); ?></span>
				
				<div class="arrow-down">
				</div>
				<div class="dropdown">
					<div class="entry">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(config('login','motd')))); ?></span>
						
					</div>
				</div>
			</div>
		<?php } ?>
		<?php $if2=($isLoggedIn); if($if2){?>
			<div class="toolbar-icon search">
				<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/search.svg" />
				
				<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> placeholder="<?php echo lang('search') ?>" id="<?php echo REQUEST_ID ?>_text" name="text<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$text) ?>" /><?php if ('') { ?><input type="hidden" name="text" value="<?php $text ?>"/><?php } ?></div>
				
				<div class="arrow-down">
				</div>
				<div class="dropdown">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(''))); ?></span>
					
				</div>
			</div>
		<?php } ?>
		<div class="toolbar-icon menu">
			<img class="image-icon image-icon--action" title="" src="./modules/cms-ui/themes/default/images/icon/action/user.svg" />
			
			<span class="label"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_help'.'')))); ?></span>
			
			<div class="arrow-down">
			</div>
			<div class="dropdown">
				<div class="entry clickable">
					<a title="<?php echo lang('menu_license_DESC') ?>" target="_self" data-type="dialog" data-action="login" data-method="license" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'login','dialogMethod':'license'}" href="<?php echo Html::url('login','license','',array('dialogAction'=>'login','dialogMethod'=>'license')) ?>">
						<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/license.svg" />
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_license'.'')))); ?></span>
						
					</a>

				</div>
			</div>
		</div>
		<div class="toolbar-icon user menu">
			<img class="image-icon image-icon--action" title="" src="./modules/cms-ui/themes/default/images/icon/action/user.svg" />
			
			<span class="label"><?php echo nl2br(encodeHtml(htmlentities(Text::maxLength( $userfullname,25,'..',constant('STR_PAD_BOTH') )))); ?></span>
			
			<div class="arrow-down">
			</div>
			<div class="dropdown">
				<?php $if4=($isLoggedIn); if($if4){?>
					<div class="entry clickable">
						<a title="<?php echo lang('menu_PROFILE_DESC') ?>" target="_self" data-type="dialog" data-action="profile" data-method="edit" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'profile','dialogMethod':'edit'}" href="<?php echo Html::url('profile','edit','',array('dialogAction'=>'profile','dialogMethod'=>'edit')) ?>">
							<img class="image-icon image-icon--action" title="" src="./modules/cms-ui/themes/default/images/icon/action/user.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_profile'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable">
						<a title="<?php echo lang('menu_password_DESC') ?>" target="_self" data-type="dialog" data-action="profile" data-method="pw" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'profile','dialogMethod':'pw'}" href="<?php echo Html::url('profile','pw','',array('dialogAction'=>'profile','dialogMethod'=>'pw')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/password.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_password'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable">
						<a title="<?php echo lang('menu_mail_DESC') ?>" target="_self" data-type="dialog" data-action="profile" data-method="mail" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'profile','dialogMethod':'mail'}" href="<?php echo Html::url('profile','mail','',array('dialogAction'=>'profile','dialogMethod'=>'mail')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/mail.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_mail'.'')))); ?></span>
							
						</a>

					</div>
					<div class="entry clickable">
						<a title="<?php echo lang('menu_start_desc') ?>" target="_self" data-type="post" data-action="start" data-method="start" data-id="<?php echo OR_ID ?>" data-extra="[]" data-data="{&quot;action&quot;:&quot;start&quot;,&quot;subaction&quot;:&quot;start&quot;,&quot;id&quot;:&quot;<?php echo OR_ID ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
							<img class="image-icon image-icon--action" title="" src="./modules/cms-ui/themes/default/images/icon/action/dashboard.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_start'.'')))); ?></span>
							
						</a>

					</div>
					<div class="divide">
					</div>
					<div class="entry clickable">
						<a title="<?php echo lang('menu_history_desc') ?>" target="_self" data-type="dialog" data-action="profile" data-method="history" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'profile','dialogMethod':'history'}" href="<?php echo Html::url('profile','history','',array('dialogAction'=>'profile','dialogMethod'=>'history')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/history.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_history'.'')))); ?></span>
							
						</a>

					</div>
					<div class="divide">
					</div>
					<div class="entry clickable">
						<a class="entry" title="<?php echo lang('USER_LOGOUT_DESC') ?>" target="_self" data-type="post" data-action="login" data-method="logout" data-id="<?php echo OR_ID ?>" data-extra="[]" data-data="{&quot;action&quot;:&quot;login&quot;,&quot;subaction&quot;:&quot;logout&quot;,&quot;id&quot;:&quot;<?php echo OR_ID ?>&quot;,&quot;token&quot;:&quot;<?php echo token() ?>&quot;,&quot;none&quot;:&quot;0&quot;}">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/close.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_LOGOUT'.'')))); ?></span>
							
						</a>

					</div>
				<?php } ?>
				<?php if(!$if4){?>
					<div class="entry clickable">
						<a title="<?php echo lang('USER_LOGIN_DESC') ?>" target="_self" data-type="dialog" data-action="login" data-method="login" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'login','dialogMethod':'login'}" href="<?php echo Html::url('login','login','',array('dialogAction'=>'login','dialogMethod'=>'login')) ?>">
							<img class="image-icon image-icon--method" title="" src="./modules/cms-ui/themes/default/images/icon/method/user.svg" />
							
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_LOGIN'.'')))); ?></span>
							
						</a>

					</div>
				<?php } ?>
			</div>
		</div>
	