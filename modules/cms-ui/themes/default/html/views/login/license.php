
	
		<div class="or-form">
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('USER') ?></legend><div class="closable">
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_USERNAME'.'')))); ?></span>
						
					</div>
					<div class="input">
						<span><?php echo nl2br(encodeHtml(htmlentities($user_name))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_FULLNAME'.'')))); ?></span>
						
					</div>
					<div class="input">
						<span><?php echo nl2br(encodeHtml(htmlentities($user_fullname))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_LOGIN_DATE'.'')))); ?></span>
						
					</div>
					<div class="input">
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($user_login) ?>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('CMS') ?></legend><div class="closable">
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'NAME'.'')))); ?></span>
						
					</div>
					<div class="input">
						<span><?php echo nl2br(encodeHtml(htmlentities($cms_name))); ?></span>
						
						<span><?php echo nl2br(encodeHtml(htmlentities($cms_version))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'OPERATOR'.'')))); ?></span>
						
					</div>
					<div class="input">
						<span><?php echo nl2br(encodeHtml(htmlentities($cms_operator))); ?></span>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('SYSTEM') ?></legend><div class="closable">
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'DATE_TIME'.'')))); ?></span>
						
					</div>
					<div class="input">
						<span><?php echo nl2br(encodeHtml(htmlentities($time))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'OPERATING_SYSTEM'.'')))); ?></span>
						
					</div>
					<div class="input">
						<span><?php echo nl2br(encodeHtml(htmlentities($os))); ?></span>
						
						<span><?php echo nl2br(encodeHtml(htmlentities($release))); ?></span>
						
						<span><?php echo nl2br(encodeHtml(htmlentities($machine))); ?></span>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'INTERPRETER'.'')))); ?></span>
						
					</div>
					<div class="input">
						<span><?php echo nl2br(encodeHtml(htmlentities($version))); ?></span>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('LICENSE') ?></legend><div class="closable">
				<div class="or-table-wrapper"><div class="or-table-area"><table width="100%">
					<tr class="headline">
						<td>
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
							
						</td>
						<td>
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'license'.'')))); ?></span>
							
						</td>
					</tr>
					<?php foreach($software as $list_key=>$list_value){ ?><?php extract($list_value) ?>
						<tr class="data">
							<td class="clickable">
								<a target="_self" data-url="<?php echo $url ?>" data-type="external" data-action="" data-method="license" data-id="<?php echo OR_ID ?>" data-extra="[]" href="<?php echo $url ?>">
									<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
									
								</a>
							</td>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities($license))); ?></span>
								
							</td>
						</tr>
					<?php } ?>
				</table></div></div>
			</div></fieldset>
		</div>
	