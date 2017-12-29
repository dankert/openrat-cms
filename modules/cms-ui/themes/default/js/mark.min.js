
function mark()
{
	for( i=0; i<document.forms[0].elements.length; i++ )
	{
		if	(document.forms[0].elements[i].type=='checkbox')
			document.forms[0].elements[i].checked=true;
	}
}

function unmark()
{
	for( i=0; i<document.forms[0].elements.length; i++ )
	{
		if	(document.forms[0].elements[i].type=='checkbox')
			document.forms[0].elements[i].checked=false;
	}
}

function flip()
{
	for( i=0; i<document.forms[0].elements.length; i++ )
	{
		if	(document.forms[0].elements[i].type=='checkbox')
			document.forms[0].elements[i].checked=!document.forms[0].elements[i].checked;
	}
}
