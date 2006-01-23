; Control-file for template elements
; format: <element-name>=<attribute1>:<default-value>,<attributeN>,...
; default-value could be nothing (blank), a string or "*" for required attributes


button   = type:*
cell     = width,style,class,colspan
char     = type:*
checkbox = default:false,var,readonly:false,name:*,prefix
date     = var
dummy    =
focus    = field:*
form     = action,subaction,id,name,target:_self,method:post,enctype:application/x-www-form-urlencoded
frame    = file,name,scrolling
frameset = rows,columns
frameset-page=
hidden   = name:*,default
if       = var,value,invert,empty,present,contains,true,false
image    = file,url,align:left,type
input    = class,default,type:text,index,name:*,prefix,value,size:40,maxlength:256,onchange
inputarea=name,rows,cols,value,index,onchange,prefix
insert   = file:*
link     = title,target,url,class,action,subaction,id,var1,value1
list     = list:*,extract:false,key:list_key,value:list_value
newline  =
page     = class
password = name:*,default,class,size:40,maxlength:256
radio    = readonly,name:*,value,default,prefix,suffix
row      =
selectbox=list:*,name:*,default,onchange,title,class
listbox  =list:*,name:*,default,onchange,title,class
set      = var:*,value:*
table    = class,width:100%,space:0px,padding:0px,widths
text     = title,class,var,text,raw,maxlength
upload   = name:*,class:upload
user
window   = title,name,icon,widths,width:85%