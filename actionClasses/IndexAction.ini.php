
[default]
goto=showlogin

[logout]
goto=showlogin

[object]
goto=show

[project]
goto=show

[register]
menu=login
target=registercode

[registercode]
menu=login
target=registercommit

[registercommit]
menu=login
goto=showlogin

[password]
menu=login
target=passwordcode

[passwordcode]
menu=login
target=passwordcommit

[passwordcommit]
menu=login
goto=showlogin

[showlogin]
menu=login

[administration]
goto=show

[login]
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

[menu]
login=showlogin,register,password
menu=projectmenu,administration,changepassword,logout