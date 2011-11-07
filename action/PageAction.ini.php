
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

[pub]
menu=pub
write=true

[prop]
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


