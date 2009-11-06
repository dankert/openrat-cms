
[default]
goto=show

[show]
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
target=resize
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

[uncompress]
menu=edit

[extract]
menu=edit
target=doextract

[doextract]
menu=edit
goto=edit

[menu]
edit=edit,editvalue,compress,uncompress,extract
prop=prop,size
rights=rights,aclform
pub=pub