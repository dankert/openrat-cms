
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

; Anzeige der Gruppenzugehoerigkeiten
[groups]
menu=memberships
editable=true
target=savegroups

; Speichern der Gruppenzugehoerigkeiten
[savegroups]
menu=memberships
goto=groups

[pw]
menu=pw
write=true

[rights]
menu=rights

[menu]
listing=listing,add
edit=edit,remove
memberships=groups
pw=pw
;info=show,mail
rights=rights