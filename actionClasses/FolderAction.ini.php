
[default]
goto=show

[show]
menu=show

[prop]
menu=prop
target=saveprop

[saveprop]
goto=showprop

[showprop]
menu=prop

[remove]
menu=prop
target=delete

[delete]
goto=show

[order]
menu=show

; Die Aktionen "rights", "aclform", "addacl" und "delacl" sind
; für Seiten,Ordner,Links und Dateien identisch.
[rights]
menu=rights

[aclform]
menu=rights
target=addacl

[addacl]
goto=rights

[delacl]
goto=rights

[pub]
menu=pub
target=pubnow

[create]
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
goto=show

[createnewfile]
goto=show

[createnewpage]
goto=show

[createnewlink]
goto=show

[changesequence]
goto=order

[settop]
goto=order

[setbottom]
goto=order

[menu]
pub=pub
show=show,order
new=createfolder,createfile,createpage,createlink
prop=showprop,prop,remove
rights=rights,aclform