page
	form action:file subaction:docompress
		window name:asdf title:asdfdfs
			row
				cell
					text text:type
				cell
					set var:gz value:gz
					selectbox list:formats name:format default:gz
			row
				cell colspan:2
					fieldset title:message:OPTIONS
			row
				cell
				cell
					radio name:replace value:1
					label for:replace value:1
						text key:replace
					newline
					radio name:replace value:nix
					label for:replace value:nix
						text key:new
			row
				cell colspan:2 class:act
					button type:ok