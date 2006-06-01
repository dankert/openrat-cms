
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

[edit]
target=save
menu=edit

[addproject]
goto=listing

[save]
goto=listing

[add]
menu=list
target=addproject

[menu]
list=listing,add
edit=edit,remove,maintenance