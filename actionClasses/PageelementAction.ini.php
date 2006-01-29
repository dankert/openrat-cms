
[default]
goto=show

[edittext]
target=savetext
menu=text

[editlink]
target=savelink
menu=link

[editselect]
target=saveselect
menu=select

[editnumber]
target=savenumber
menu=number

[editlist]
target=savelist
menu=list

[editlongtext]
target=savelongtext
menu=longtext

[editdate]
target=savedate
menu=date

[editdateform]
target=savedate
menu=date

[editdatecalendar]
target=savedate
menu=date

[archive]
menu=text
target=diff

[savedate]
goto=show

[savetext]
goto=show

[savelongtext]
goto=show

[savelink]
goto=show

[savelist]
goto=show

[saveselect]
goto=show

[savenumber]
goto=show

[show]
menu=text

[diff]
menu=text

[menu]
longtext=editlongtext,archive
text=edittext,archive
link=editlink,archive
list=editlist,archive
select=editselect,archive
number=editnumber,archive
date=editdate,editdatecalendar,editdateform,archive