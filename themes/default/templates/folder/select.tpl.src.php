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
#						link url:var:url target:cms_main title:desc
						label for:var:id
							image type:var:icon
							text var:name
							text raw:_

			row
				cell colspan:2 class:fx			
					image fileext:tree_none_end.gif align:left
					text raw:_
					link url::javascript:mark();
						text text:message:FOLDER_MARK_ALL
					text raw:_|_
					link url::javascript:unmark();
						text text:message:FOLDER_UNMARK_ALL
					text raw:_|_
					link url::javascript:flip();
						text text:message:FOLDER_FLIP_MARK
			row
				cell class:fx colspan:2
				
					list list:actionlist extract:true
						radio name:type value:var:type
						label for:type value:var:type
							text raw:_
							text key:var:type prefix:FOLDER_SELECT_
						newline
			row
				cell class:act colspan:2
					button type:ok text:button_next
			if empty:object
			
				row
					cell class:fx colspan:2
						text text:GLOBAL_NOT_FOUND
	dummy
			
RAW
<script name="JavaScript" type="text/javascript">
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

