
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

[save]
goto=listing

[remove]
menu=edit
target=delete

[delete]
goto=listing

[groups]
menu=groups

[addgroup]
menu=groups
target=addgrouptouser

[delgroup]
goto=groups

[addgrouptouser]
goto=groups

[pw]
menu=pw
target=pwchange

[rights]

[pwchange]
goto=pw

[menu]
listing=listing,add
edit=edit,remove
groups=groups,addgroup
pw=pw