page class:title

	table padding:5 space:0 width:100%
		row
			cell class:title width:30%
				image icon:database align:left
				text title:message:database text:var:dbname
				text raw:_-_
				text var:cms_title
				
			cell class:title width:40% style::text-align:center;
				if present:projectname
//					image icon:project align:left
					text title:message:project text:var:projectname
				if present:modelname
					text raw:_(
					text title:message:model text:var:modelname
					text raw:,
					text title:message:language text:var:languagename
					text raw:)

//			cell class:title width:10%
//				if present:languagename
//					image icon:language align:left
//					text text:var:languagename
//
//			cell class:title width:10%
//				if present:modelname
//					image icon:model align:left
//					text text:var:modelname
					
				###text title:USER_LOGINAS text:var:userfullname
				#text raw:_(
				#text title:dbid var:dbname
				#text raw:)_
				#text raw:_|_
				#link url:showtree_url target:_parent
				#	text var:showtree_text
//			cell class:title width:20% style::text-align:center;
//				text var:cms_title
			cell class:title width:30% style::text-align:right;
//				link title:USER_PROFILE_DESC url:profile_url target:cms_main_main
//					text text:USER_YOURPROFILE
//				text raw:_|_
//				link title:USER_LOGOUT_DESC url:logout_url target:_top
//					text text:message:USER_LOGOUT

				image icon:user align:right
				link title:message:USER_LOGOUT_DESC url:var:logout_url target:_top
					text text:USER_LOGOUT
				text raw:_(
				link title:message:USER_PROFILE_DESC url:var:profile_url target:cms_main_main
					text text:userfullname
					text raw:)
