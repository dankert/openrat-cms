
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

[diff]

[diffdate]
alias=diff
menu=date

[difftext]
alias=diff
menu=text

[difflongtext]
alias=diff
menu=longtext

[difflink]
alias=diff
menu=link

[editdatecalendar]
target=savedate
menu=date

[archive]
menu=text

[savedate]
goto=show

[archivedate]
menu=date
goto=archive
target=diffdate

[savetext]
goto=showtext

[savelongtext]
goto=showlongtext

[savelink]
goto=showlink

[showlink]
alias=show
menu=link

[shownumber]
alias=show
menu=number

[showdate]
alias=show
menu=date

[showlongtext]
alias=show
menu=longtext

[archivelink]
menu=link
alias=archive

[archivelongtext]
menu=longtext
alias=archive
target=difflongtext

[archivedate]
menu=date
alias=archive
target=diffdate

[archivenumber]
menu=number
alias=archive
target=diffnumber

[savelist]
goto=showlist

[saveselect]
goto=showselect

[savenumber]
goto=shownumber

[menu]
longtext=showlongtext,editlongtext,archivelongtext
text=showtext,edittext,archivetext
link=showlink,editlink,archivelink
list=showlist,editlist,archivelist
select=showselect,editselect,archiveselect
number=shownumber,editnumber,archivenumber
date=showdate,editdate,editdatecalendar,editdateform,archivedate