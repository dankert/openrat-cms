<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="or-form">
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('USER_USERNAME'))) ?>
					</span>
				</div>
				<div class="input">
					<span class=""><?php echo encodeHtml(htmlentities(@$user_name)) ?>
					</span>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('USER_FULLNAME'))) ?>
					</span>
				</div>
				<div class="input">
					<span class=""><?php echo encodeHtml(htmlentities(@$user_fullname)) ?>
					</span>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('USER_LOGIN_DATE'))) ?>
					</span>
				</div>
				<div class="input">
					<?php include_once( 'modules/template-engine/components/html/date/component-date.php'); { component_date($user_login); ?>
					 <?php } ?>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('NAME'))) ?>
					</span>
				</div>
				<div class="input">
					<span class=""><?php echo encodeHtml(htmlentities(@$cms_name)) ?>
					</span>
					<span class=""><?php echo encodeHtml(htmlentities(@$cms_version)) ?>
					</span>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('OPERATOR'))) ?>
					</span>
				</div>
				<div class="input">
					<span class=""><?php echo encodeHtml(htmlentities(@$cms_operator)) ?>
					</span>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('DATE_TIME'))) ?>
					</span>
				</div>
				<div class="input">
					<span class=""><?php echo encodeHtml(htmlentities(@$time)) ?>
					</span>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('OPERATING_SYSTEM'))) ?>
					</span>
				</div>
				<div class="input">
					<span class=""><?php echo encodeHtml(htmlentities(@$os)) ?>
					</span>
					<span class=""><?php echo encodeHtml(htmlentities(@$release)) ?>
					</span>
					<span class=""><?php echo encodeHtml(htmlentities(@$machine)) ?>
					</span>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('INTERPRETER'))) ?>
					</span>
				</div>
				<div class="input">
					<span class=""><?php echo encodeHtml(htmlentities(@$version)) ?>
					</span>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
				<tr class="headline">
					<td class="">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
						</span>
					</td>
					<td class="">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('license'))) ?>
						</span>
					</td>
				</tr>
				<?php foreach($software as $list_key=>$list_value) { extract($list_value); ?>
					<tr class="data">
						<td class="clickable">
							<a target="_self" data-url="<?php echo encodeHtml(htmlentities(@$url)) ?>" data-type="external" data-action="" data-method="" data-id="" data-extra="[]" href="<?php echo encodeHtml(htmlentities(@$url)) ?>" class="">
								<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
								</span>
							</a>
						</td>
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@$license)) ?>
							</span>
						</td>
					</tr>
				 <?php } ?>
			</table></div></div>
		</div></fieldset>
	</div>