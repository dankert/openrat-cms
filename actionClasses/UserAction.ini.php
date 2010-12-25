
admin=true

[default]
goto=listing

[listing]
menu=listing

[add]
menu=listing
write=true

[edit]
menu=edit
editable=true
write=true

[remove]
menu=edit
write=true

[memberships]
goto=groups

; Gruppenzugehoerigkeiten
[groups]
menu=memberships
editable=true
write=yes

[pw]
menu=pw
write=true

[rights]
menu=rights

[menu]
menu=listing,add,edit,remove,groups,pw,rights
;info=show,mail
