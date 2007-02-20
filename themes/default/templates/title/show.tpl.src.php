page class:title

	table padding:5 space:0 width:100%
		row
			cell class:title width:40%
				image icon:database align:left
				text title:var:dbid text:var:dbname
				###text title:USER_LOGINAS text:var:userfullname
				#text raw:_(
				#text title:dbid var:dbname
				#text raw:)_
				#text raw:_|_
				#link url:showtree_url target:_parent
				#	text var:showtree_text
			cell class:title width:20% style::text-align:center;
				text var:cms_title
			cell class:title width:40% style::text-align:right;
//				link title:USER_PROFILE_DESC url:profile_url target:cms_main_main
//					text text:USER_YOURPROFILE
//				text raw:_|_
//				link title:USER_LOGOUT_DESC url:logout_url target:_top
//					text text:USER_LOGOUT

				image icon:user align:right
				link title:USER_LOGOUT_DESC url:var:logout_url target:_top
					text text:USER_LOGOUT
				text raw:_(
				link title:USER_PROFILE_DESC url:var:profile_url target:cms_main_main
					text text:userfullname
					text raw:)
