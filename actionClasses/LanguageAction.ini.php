
[setdefault]
target=listing

[listing]
menu=listing

[default]
goto=listing

[edit]
menu=edit
target=save

[add]
menu=listing
target=addlanguage

[remove]
menu=edit
target=delete

[delete]
goto=listing

[save]
goto=edit

[addlanguage]
goto=listing

[add]
target=addlanguage

[menu]
listing=listing,add
edit=edit,remove