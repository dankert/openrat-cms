
[default]
goto=edit

[edit]
target=saveprofile
menu=edit
editable=true

[groups]
menu=edit

[pwchange]
target=savepw
menu=edit

[mail]
target=mailcode
menu=edit

[mailcode]
goto=confirmmail

[confirmmail]
target=savemail
menu=edit

[savemail]
goto=edit

[savepw]
goto=edit

[saveprofile]
goto=edit

[menu]
edit=edit,pwchange,mail,groups