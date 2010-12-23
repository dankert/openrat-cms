
[default]
goto=show

;[remove]
;menu=prop
;target=delete

;[delete]
;target=prop

[show]
menu=elements

[preview]
direct=true

[edit]
direct=true

[el]
menu=elements

[form]
target=saveform
menu=elements

[pub]
menu=pub
write=true

[saveform]
goto=el

[prop]
menu=prop
write=true
target=prop
editable=true

[changetemplate]
menu=prop
target=changetemplateselectelements

[changetemplateselectelements]
menu=prop
target=replacetemplate

[replacetemplate]
goto=prop

[src]
menu=src

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


[menu]
pub=show,pub,el,form,rights,prop,changetemplate,src
elements=show,pub,el,form,rights,prop,changetemplate,src
rights=show,pub,el,form,rights,prop,changetemplate,src
src=show,pub,el,form,rights,prop,changetemplate,src
prop=show,pub,el,form,rights,prop,changetemplate,src