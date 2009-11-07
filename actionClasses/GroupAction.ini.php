
admin=true

[default]
goto=listing

[add]
menu=listing
write=true

[listing]
menu=listing

[remove]
menu=edit
write=true

[edit]
menu=edit
editable=true
write=true

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

[rights]
menu=rights

[menu]
listing=listing,add
users=users,adduser
edit=edit,remove
memberships=users,adduser
rights=rights