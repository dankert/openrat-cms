[default]
goto=listing

[listing]
menu=listing

[add]
menu=listing
target=addtemplate

[addtemplate]
goto=listing

[edit]
menu=edit

[show]
direct=true

[prop]
goto=name

[el]
menu=el

[addel]
menu=el
target=addelement

[addelement]
goto=el

[src]
menu=edit
target=savesrc
editable=true

[srcelement]
menu=edit
target=srcaddelement

[srcaddelement]
goto=edit

[savesrc]
goto=edit

[name]
menu=prop
target=savename

[savename]
goto=name

[saveextension]
goto=name

[extension]
menu=prop
target=saveextension

[remove]
menu=prop
target=delete

[delete]
goto=listing

[pages]
menu=prop

[menu]
listing=listing,add
prop=name,extension,pages,remove
el=el,addel
edit=edit,src,srcelement