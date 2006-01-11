; Control-file for template elements
; format: <element-name>=<attribute1>:<default-value>,<attributeN>,...
; default-value could be nothing (blank), a string or "*" for required attributes


button   = type:*
cell     = width,style,class,colspan
checkbox = default:false, readonly:false, name:*, prefix
date     = var
dummy    =
focus    = field:*
form     = action:*,subaction:*,id,name,target:_self,method:post,enctype:application/x-www-form-urlencoded
frame    = file,name,scrolling
frameset = rows,columns
frameset-page=
if       = var,value,invert,empty,present,contains,true,false
image    = file,url,align:left,type
input    = default,type,index,name:*,prefix,value,size,maxlength,onchange
inputarea=name,rows,cols,value,index,onchange,prefix
insert   = file:*
link     = title,target,url:*
list     = list:*,extract:false,key:list_key,value:list_value
newline  =
page     = class
radio    = readonly,name:*,value,default
row      =
selectbox=list:*,name:*,default
set      = var:*,value:*
table    = class,width:100%,space:0px,padding:0px,widths
text     = title,class,var,text,raw
user
window   = title,name,widths,width