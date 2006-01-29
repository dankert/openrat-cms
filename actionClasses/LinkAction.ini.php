
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

[delete]
goto=showprop

[remove]
menu=prop
target=delete

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
edit=edit,remove
prop=showprop,prop,remove
rights=rights,aclform