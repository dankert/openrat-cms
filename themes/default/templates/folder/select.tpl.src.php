page
	form action:folder subaction:edit
		window name:bla title:titelso widths:5%,75%
			row
				cell class:help
					text raw:_
				cell class:help
					text text:GLOBAL_TYPE
					text raw:_/_
					text text:GLOBAL_NAME
					
			list list:object extract:true
				row
					cell class:fx
						if true:writable
							checkbox name:var:id
						if false:writable
							text raw:_

					cell class:fx
						link url:var:url target:cms_main title:desc
							image type:var:icon
							text var:name
							text raw:_

			row
				cell colspan:2 class:fx			
RAW			
    <img src="<?php echo $image_dir ?>tree_none_end.gif" align="left" />&nbsp;
    <a href="javascript:mark();"><?php echo lang('FOLDER_MARK_ALL') ?></a> | <a href="javascript:unmark();"><?php echo lang('FOLDER_UNMARK_ALL') ?></a> | <a href="javascript:flip();"><?php echo lang('FOLDER_FLIP_MARK') ?></a>
END
			row
				cell class:fx colspan:2
				
					list list:actionlist extract:true
						radio name:var:type value:var:type
						text raw:_
						text text:var:type
						newline
			row
				cell class:act colspan:2
					button type:ok		
			if empty:object
			
				row
					cell class:fx colspan:2
						text text:GLOBAL_NOT_FOUND
	dummy
			
RAW

<script name="JavaScript">
<!--
function mark()
{
<?php foreach( array_keys($object)  as $id ) { ?>
document.forms[0].obj<?php echo $id ?>.checked=true;
<?php } ?>
}
function unmark()
{
<?php foreach( array_keys($object) as $id ) { ?>
document.forms[0].obj<?php echo $id ?>.checked=false;
<?php } ?>
}
function flip()
{
<?php foreach( array_keys($object) as $id ) { ?>
if	(document.forms[0].obj<?php echo $id ?>.checked==false)
 document.forms[0].obj<?php echo $id ?>.checked=true;
else document.forms[0].obj<?php echo $id ?>.checked=false;
<?php } ?>
}
//-->
</script>
END

