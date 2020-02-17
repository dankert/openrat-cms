<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
			<div class="or-table-wrapper"><div class="or-table-area"><table width="100%" class="">
				<tr class="headline">
					<td class="">
						<img src="./modules/cms-ui/themes/default/images/icon_user.png" class="">
						</img>
						<span class=""><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
						</span>
					</td>
					<td class="">
						<span class="">
						</span>
					</td>
					<td class="">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('LOGIN'))) ?>
						</span>
					</td>
				</tr>
				<?php foreach($el as $list_key=>$list_value) { extract($list_value); ?>
					<tr class="data">
						<td class="">
							<img src="./modules/cms-ui/themes/default/images/icon_user.png" class="">
							</img>
							<span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
							</span>
						</td>
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@$fullname)) ?>
							</span>
							<?php $if8=($isAdmin); if($if8) {  ?>
								<span class=""> (
								</span>
								<span class=""><?php echo encodeHtml(htmlentities(@lang('USER_ADMIN'))) ?>
								</span>
								<span class="">)
								</span>
							 <?php } ?>
						</td>
						<td class="">
							<a target="_self" data-action="index" data-method="switchuser" data-id="<?php echo encodeHtml(htmlentities(@$userid)) ?>" data-extra="[]" href="/#/index/<?php echo encodeHtml(htmlentities(@$userid)) ?>" class="">
								<span class=""><?php echo encodeHtml(htmlentities(@lang('LOGIN'))) ?>
								</span>
							</a>
						</td>
					</tr>
				 <?php } ?>
			</table></div></div>