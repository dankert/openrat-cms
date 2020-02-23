<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
		<form name="" target="_self" data-target="_top" action="./" data-method="passwordcode" data-action="login" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form login">
				<tr class="">
					<td colspan="2" class="logo">
						<div class="line logo">
						</div>
					</td>
					<tr class="">
						<td class="">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('mail_code'))) ?>
							</span>
						</td>
						<td class="">
							<input name="code" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$code)) ?>" class="">
							</input>
						</td>
					</tr>
					<tr class="">
						<td colspan="2" class="act">
						</td>
					</tr>
				</tr>
		</form>