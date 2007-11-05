
admin=false

[default]
goto=show

[logout]
goto=showlogin

[object]
goto=show
guest=true

[language]
goto=show
guest=true

[model]
goto=show
guest=true

[applications]
menu=menu

[userinfo]

[project]
goto=show

[register]
menu=login
target=registercode
guest=true

[registercode]
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