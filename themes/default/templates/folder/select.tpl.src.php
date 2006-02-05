page
	form action:folder subaction:multiple
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
							checkbox prefix:obj name:id
						if false:writable
							text raw:_

					cell class:fx
						link url:url target:cms_main title:desc
							image type:icon
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
					radio name:type value:move
					text raw:_
					text text:GLOBAL_MOVE
					newline
					radio name:type value:copy
					text raw:_
					text text:GLOBAL_COPY
					newline
					radio name:type value:link
					text raw:_
					text text:GLOBAL_LINK
					newline
					radio name:type value:archive
					text raw:_
					text text:GLOBAL_ARCHIVE
					newline
					radio name:type value:delete
					text raw:_
					text text:GLOBAL_DELETE
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
<?php foreach( $object as $id=>$z ) { ?>
document.forms[0].obj<?php echo $id ?>.checked=true;
<?php } ?>
}
function unmark()
{
<?php foreach( $object as $id=>$z ) { ?>
document.forms[0].obj<?php echo $id ?>.checked=false;
<?php } ?>
}
function flip()
{
<?php foreach( $object as $id=>$z ) { ?>
if	(document.forms[0].obj<?php echo $id ?>.checked==false)
 document.forms[0].obj<?php echo $id ?>.checked=true;
else document.forms[0].obj<?php echo $id ?>.checked=false;
<?php } ?>
}
//-->
</script>
END

