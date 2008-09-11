
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

[showprop]
menu=prop

[prop]
menu=prop
target=saveprop
editable=true

[saveprop]
goto=showprop

[size]
menu=prop
target=resize
editable=true

[remove]
menu=prop
target=delete

[delete]
goto=showprop

[resize]
goto=showprop

[pub]
target=pubnow
menu=pub

[pubnow]
goto=pub

; Die Aktionen "rights", "aclform", "addacl" und "delacl" sind
; für Seiten,Ordner,Links und Dateien identisch.
[rights]
menu=rights
action=object

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
prop=showprop,prop,size
rights=rights,aclform
pub=pub