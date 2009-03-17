
admin=false

[default]
goto=show

[logout]
guest=true
goto=showlogin

[object]
goto=show
guest=true

[language]
goto=show

[model]
goto=show

[applications]
menu=menu

;[userinfo]
;

[project]
goto=show

[register]
menu=login
target=registercode
guest=true

[registercode]
goto=registeruserdata
guest=true

[registeruserdata]
menu=login
target=registercommit
guest=true

[registercommit]
menu=login
goto=showlogin
guest=true

[password]
menu=login
target=passwordcode
guest=true

[passwordcode]
guest=true
goto=passwordinputcode

[passwordinputcode]
menu=login
target=passwordcommit
guest=true

[passwordcommit]
menu=login
goto=showlogin
guest=true

[showlogin]
menu=login
guest=true

[administration]
goto=show

[login]
goto=show
guest=true

[openid]
guest=true
goto=show

[projectmenu]
menu=menu

[changepassword]
menu=menu
target=setnewpassword

[setnewpassword]
menu=menu
goto=projectmenu

[show]
guest=true

[menu]
login=showlogin,register,password
menu=applications,projectmenu,administration,logout