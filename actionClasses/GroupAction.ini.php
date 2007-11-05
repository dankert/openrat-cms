
admin=true

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

[deluser]
goto=users

[memberships]
goto=users

[users]
menu=memberships

[adduser]
target=addusertogroup
menu=memberships

[addusertogroup]
goto=users

[menu]
listing=listing,add
users=users,adduser
edit=edit,remove
memberships=users,adduser