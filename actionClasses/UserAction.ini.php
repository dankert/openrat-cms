
admin=true

[default]
goto=listing

[listing]
menu=listing

[add]
menu=listing
target=adduser

[adduser]
goto=listing

[edit]
menu=edit
target=save

;[show]
;menu=info

[save]
goto=listing

[remove]
menu=edit
target=delete

[delete]
goto=listing

[memberships]
goto=groups

[groups]
menu=memberships
editable=true
target=savegroups

[savegroups]
menu=memberships
goto=groups

[addgroup]
menu=memberships
target=addgrouptouser

[delgroup]
goto=groups

[addgrouptouser]
goto=groups

[pw]
menu=pw
target=pwchange

[rights]
menu=rights

[pwchange]
goto=pw

[menu]
listing=listing,add
edit=edit,remove
memberships=groups,addgroup
pw=pw
;info=show,mail
rights=rights