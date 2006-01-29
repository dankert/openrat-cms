
[default]
goto=listing

[listing]
menu=list

[remove]
menu=edit
target=delete

[delete]
goto=listing

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
edit=edit,remove