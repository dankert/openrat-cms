
; Only admins are allowed to change project settings
admin=true

[phpinfo]
direct=true

[default]
goto=listing

[listing]
menu=list

[remove]
menu=edit
write=true

[maintenance]
menu=edit
write=true

[export]
menu=edit
write=true

[edit]
menu=edit
editable=true
write=true

[add]
menu=list
write=true

[info]
menu=edit

[menu]
list=listing,add
edit=edit,remove,info,export,maintenance
