<html>
<head>
<title>OpenRat CMS API</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<meta name="robots" content="noindex,nofollow" >
</head>
<body>
<h1>CMS API</h1>

<p>A web interface for communicating with the CMS API.</p>
<hr>
<form action="../../">
<table>
<tr>
<th>Parameter</th><th>Value</th>
</tr>
<tr>
	<td>Action</td>
	<td><select name="action">
			<?php foreach( array(
				'Alias','Configuration','Element','File','Folder','Group','Grouplist','Image','Language','Languagelist','Link','Login','Model','Modellist','Object','Page','Pageelement','Profile','Project','Projectlist','Search','Start','Template','Templatelist','Text','Url','User','Usergroup','Userlist') as $type ) { ?>
				<option value="<?php echo strtolower($type) ?>"><?php echo $type ?></option>
			<?php } ?>
		</select>
	</td>
</tr>
	<tr>
		<td>Method</td>
		<td><input name="subaction" value="" placeholder="info" size="10" required="required"/>
		</td>
	</tr>
	<tr>
		<td>Id</td>
		<td><input name="id" value="" placeholder="1" size="10" required="required"></td>
	</tr>

<?php for( $i=1; $i<=5; $i++ ) { ?>
<tr>
<td><input class="dyn name"  data-nr="<?php echo $i ?>" name="param-<?php echo $i ?>" value="" size="15"></td>
<td><input class="dyn value" data-nr="<?php echo $i ?>" name="value-<?php echo $i ?>" value="" size="50"></td>
</tr>
<?php } ?>
</table><br>


<select name="method">
<option value="GET">GET</option>
<option value="POST">POST</option>
</select>

<select name="output">
	<?php foreach( array('JSON','XML','YAML','HTML','PLAIN',) as $type ) { ?>
		<option value="<?php echo strtolower($type) ?>"><?php echo $type ?></option>
	<?php } ?>
</select>

<hr><br />
	<input type="reset" /> <input type="submit" style="font-weight: bold" />

</form>

<script type="text/javascript" src="../../modules/cms/ui/themes/default/script/jquery.min.js"></script>
<script type="text/javascript">

	$form = $("form");

	window.onload = function() {
		$('.dyn').removeAttr('disabled');
	};
	window.onunload = function(){};

	$form.submit( function(e) {
		$form.attr('method',$('select[name=method]').val() );
		$('input[type=hidden]').remove();
		$('input.dyn.name').each( function(e) {
			$inputName  = $(this);
			let nr = $inputName.data('nr');
			$inputValue = $('.dyn.value[data-nr='+nr+']');

			let $hiddenInput = $('<input>');
			$hiddenInput.attr('type','hidden' );
			$hiddenInput.attr('name' ,$(this).val() );
			$hiddenInput.attr('value',$inputValue.val() );

			$inputName.attr('disabled','disabled');
			$inputValue.attr('disabled','disabled');
			$form.append( $hiddenInput );
		});
		// now the form is submitted.
	} );
</script>

</body>
</html>