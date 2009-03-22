
[default]
goto=showprop

[showprop]
menu=prop

[saveprop]
goto=showprop

[save]
goto=showprop

[prop]
menu=prop
target=saveprop

[edit]
menu=edit
target=save

[rights]
editable=true

[delete]
goto=showprop

[remove]
menu=prop
target=delete

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

[menu]
edit=edit
prop=showprop,prop
rights=rights,aclform