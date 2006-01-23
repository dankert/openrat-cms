[default]
goto=listing

[add]
menu=listing
target=addgroup

[addgroup]

[listing]
menu=listing

[remove]
menu=edit
target=delete

[delete]
goto=listing

[edit]
menu=edit
target=save

[save]
goto=listing

[users]
menu=users

[adduser]
target=addusertogroup
menu=users

[addusertogroup]
goto=users

[menu]
listing=listing,add
users=users,adduser
edit=edit,remove