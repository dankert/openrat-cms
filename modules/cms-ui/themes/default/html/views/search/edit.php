<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="result" data-action="search" data-id="<?php echo OR_ID ?>" method="GET" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form search">
		<div class="line">
			<div class="label">
				<label class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('value'))) ?>
					</span>
				</label>
				<br>
				</br>
			</div>
			<div class="input">
				<input name="text" disabled="" placeholder="<?php echo encodeHtml(htmlentities(@lang('search'))) ?>" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$text)) ?>" class="">
				</input>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<label class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('filter'))) ?>
					</span>
				</label>
				<br>
				</br>
			</div>
			<div class="input">
				<input type="checkbox" name="id" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(config('search','quicksearch','flag','id'))) ?>" class="">
				</input>
				<label class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('id'))) ?>
					</span>
				</label>
				<br>
				</br>
				<input type="checkbox" name="name" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(config('search','quicksearch','flag','name'))) ?>" class="">
				</input>
				<label class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
					</span>
				</label>
				<br>
				</br>
				<input type="checkbox" name="filename" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(config('search','quicksearch','flag','filename'))) ?>" class="">
				</input>
				<label class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('filename'))) ?>
					</span>
				</label>
				<br>
				</br>
				<input type="checkbox" name="description" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(config('search','quicksearch','flag','description'))) ?>" class="">
				</input>
				<label class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('description'))) ?>
					</span>
				</label>
				<br>
				</br>
				<input type="checkbox" name="content" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(config('search','quicksearch','flag','content'))) ?>" class="">
				</input>
				<label class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('content'))) ?>
					</span>
				</label>
			</div>
		</div>
	</form>