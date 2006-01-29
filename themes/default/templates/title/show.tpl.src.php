page

	table padding:5 space:0 width:100%
		row
			cell class:title width:40%
				text class:title title:USER_LOGINAS var:userfullname
				text raw:_(
				text title:dbid var:dbname
				text raw:_|_
				link url:showtree_url target:_parent
					text var:showtree_text
			cell class:title width:20% style:text-align:center;
				text var:cms_title
			cell class:title width:40% style:text-align:right;
				link title:USER_PROFILE_DESC url:profile_url target:cms_main_main
					text text:USER_YOURPROFILE
				text raw:_|_
				link title:USER_LOGOUT_DESC url:logout_url target:_top
					text text:USER_LOGOUT
