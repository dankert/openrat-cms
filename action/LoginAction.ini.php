
admin=false


[default]
goto=show

[logout]
guest=true
goto=login
write=get
clear=tree

[switchuser]
goto=show

[object]
goto=show
guest=true

[language]
goto=show

[model]
goto=show

[applications]
menu=menu

[userinfo]
direct=true

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

[administration]
goto=show

[login]
menu=login
write=true
guest=true
;goto=projectmenu

[projectmenu]

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
menu =login

[license]
guest=true

[ping]
guest=true
direct=true
