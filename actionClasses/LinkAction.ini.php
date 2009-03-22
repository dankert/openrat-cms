
[default]
goto=prop

[saveprop]
goto=prop

[save]
goto=prop

[prop]
menu=prop
target=saveprop
editable=true

[edit]
menu=edit
target=save

[rights]
editable=true

[delete]
goto=prop

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
prop=prop
rights=rights,aclform