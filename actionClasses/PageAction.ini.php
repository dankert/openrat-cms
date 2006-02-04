
[default]
goto=show

[remove]
menu=prop
target=delete

[delete]
target=prop

[show]

[edit]

[el]
menu=elements

[form]
menu=elements

[pub]
menu=pub
target=pubnow

[pubnow]
goto=pub

[saveprop]
goto=showprop

[showprop]
menu=prop

[prop]
menu=prop
target=saveprop

[changetemplate]
menu=prop
target=changetemplateselectelements

[changetemplateselectelements]
menu=prop
target=replacetemplate

[replacetemplate]
goto=showprop

[src]
menu=src

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


[menu]
pub=pub
elements=el,form
rights=rights,aclform
src=src
prop=showprop,prop,changetemplate