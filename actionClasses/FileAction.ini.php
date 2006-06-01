
[default]
goto=show

[show]

[edit]
menu=edit

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

[saveprop]
goto=showprop

[size]
menu=prop
target=resize

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

[aclform]
menu=rights
target=addacl

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
prop=showprop,prop,remove,size
rights=rights,aclform
pub=pub