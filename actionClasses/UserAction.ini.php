
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
editable=true

[save]
goto=listing

[remove]
menu=edit
target=delete

[delete]
goto=listing

[memberships]
goto=groups

; Anzeige der Gruppenzugehörigkeiten
[groups]
menu=memberships
editable=true
target=savegroups

; Speichern der Gruppenzugehörigkeiten
[savegroups]
menu=memberships
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
memberships=groups
pw=pw
;info=show,mail
rights=rights