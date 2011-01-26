
[default]
goto=show

[show]
menu=show

[select]
target=multiple
menu=show

[edit]
menu=show

[multiple]
goto=show

[prop]
menu=prop
target=saveprop
editable=true

[saveprop]
goto=prop

[remove]
menu=prop
target=delete

[delete]
goto=show

[order]
menu=show

; Die Aktionen "rights", "aclform", "addacl" und "delacl" sind
; f�r Seiten,Ordner,Links und Dateien identisch.
[rights]
menu=rights
editable=true
action=object
target=inherit

[aclform]
menu=rights
target=addacl
action=object

[addacl]
goto=rights

[delacl]
goto=rights

[inherit]
goto=rights


[pub]
menu=pub
write=true

[create]
target=createnew
menu=new

[createfolder]
target=createnewfolder
menu=new

[createlink]
target=createnewlink
menu=new

[createfile]
target=createnewfile
menu=new

[createpage]
target=createnewpage
menu=new

[createnewfolder]
goto=createfolder

[createnewfile]
goto=createfile

[createnewpage]
goto=createpage

[createnewlink]
goto=createlink

[createnew]
goto=create

[reorder]
menu=show
goto=order
write=get

[changesequence]
goto=order
write=get

[settop]
goto=order
write=get

[setbottom]
goto=order
write=get

[menu]
;pub=pub
;show=show,select,order
;new=create,createfolder,createfile,createpage,createlink
;prop=prop
;rights=rights,aclform

pub=show,select,order,create,pub,prop,rights,aclform
show=show,select,order,create,pub,prop,rights,aclform
new=show,select,order,create,pub,prop,rights,aclform
prop=show,select,order,create,pub,prop,rights,aclform
rights=show,select,order,create,pub,prop,rights,aclform
menu=show,pub,prop,rights
