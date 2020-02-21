<?php
function component_user( $user )
{
	extract( $user );
	
	if	( empty($name) )
		$name = lang('GLOBAL_UNKNOWN');
	if	( empty($fullname) )
		$fullname = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');

	if	( !empty($mail) && config('security','user','show_mail' ) )
		echo "<a href=\"mailto:$mail\" title=\"$fullname\">$name</a>";
	else
		echo "<span title=\"$fullname\">$name</span>";
}
?>