<?php

use cms\base\Configuration as C;
use cms\base\Language;
use language\Messages;

function component_user($user )
{
	extract( $user );

	if	( empty($fullname) )
		$fullname = Language::lang( Messages::UNKNOWN );

	$showName = C::subset(['security','user'])->is('show_username',false );

	if   ( $showName ) {
		if	( empty($name) )
			$name = Language::lang(Messages::UNKNOWN );
	}
	else
		$name = $fullname;


	$showMail = isset($mail) && $mail && C::subset(['security','user'])->is('show_mail',false );

	if	( $showMail )
		echo "<a href=\"mailto:$mail\" title=\"$fullname\">";

	echo "<span class=\"or-username\" title=\"$fullname\">$name</span>";

	if	( $showMail )
		echo "</a>";

}