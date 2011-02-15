
[default]
goto=prop

[quicksearch]
async=true
;goto=result

[result]
menu=search

[prop]
menu=search
target=searchprop

[content]
menu=search
target=searchcontent

[searchcontent]
goto=result

[searchprop]
goto=result

[menu]
menu=prop,content
