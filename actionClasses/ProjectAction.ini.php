
admin=true

[phpinfo]
direct=true

[default]
goto=listing

[listing]
menu=list

[remove]
menu=edit
target=delete

[delete]
goto=listing

[maintenance]
menu=edit
target=maintenance

[export]
menu=edit
target=export

[edit]
target=save
menu=edit
editable=true

[addproject]
goto=listing

[save]
goto=edit

[add]
menu=list
target=addproject

[menu]
list=listing,add
edit=edit,remove,export,maintenance