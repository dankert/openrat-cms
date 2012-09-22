
[default]
goto=show

[show]
menu=edit

[preview]
direct=true

[edit]
menu=edit

[replace]
menu=edit
goto=edit

[editvalue]
menu=edit
target=savevalue

[savevalue]
goto=show

[prop]
menu=prop
target=saveprop
editable=true

[saveprop]
goto=prop

[size]
menu=prop
editable=true

[remove]
menu=prop
target=delete

[delete]
goto=prop

[resize]
goto=prop

[pub]
write=true
menu=pub

; Die Aktionen "rights", "aclform", "addacl" und "delacl" sind
; f�r Seiten,Ordner,Links und Dateien identisch.
[rights]
menu=rights
action=object
editable=true

[aclform]
menu=rights
target=addacl
action=object

[addacl]
goto=rights

[delacl]
goto=rights


[compress]
menu=edit
write=true

[uncompress]
menu=edit
write=true

[extract]
menu=edit
write=true

[menu]
actions=show,edit,editvalue,compress,uncompress,extract,pub,prop,size,rights,aclform
edit=show,edit,editvalue,compress,uncompress,extract,pub,prop,size,rights,aclform
prop=show,edit,editvalue,compress,uncompress,extract,pub,prop,size,rights,aclform
rights=show,edit,editvalue,compress,uncompress,extract,pub,prop,size,rights,aclform
pub=show,edit,editvalue,compress,uncompress,extract,pub,prop,size,rights,aclform
menu=show,pub,prop,rights