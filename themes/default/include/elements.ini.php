; Control-file for template elements
; format: <element-name>=<attribute1>:<default-value>,<attributeN>,...
; default-value could be nothing (blank), a string or "*" for required attributes


button   = type:submit,src,class:ok,value:ok,text:button_ok
cell     = width,style,class,colspan
char     = type:*
checkbox = default:false,readonly:false,name:*
date     = date
dummy    =
focus    = field:*
form     = action,subaction,id,name:,target:_self,method:post,enctype:application/x-www-form-urlencoded
frame    = file,name,scrolling
frameset = rows,columns
frameset-page=menu
hidden   = name:*,default
editor   = name:*,type:*
else     =
if       = equals,value,invert,not,empty,present,contains,true,false
image    = config,file,url,icon,align:left,type,elementtype,fileext
input    = class:,default:,type:text,index,name:*,prefix,value,size:40,maxlength:256,onchange:,readonly:false
inputarea= name,rows:10,cols:40,value,index,onchange,prefix,class:,default:
insert   = file:*
label    = for:*,value
fieldset = title
link     = title:,config,target:_self,var,url,class:,action,subaction,id,var1,value1,var2,value2,var3,value3,var4,value4,var5,value5,accesskey
list     = list:*,extract:false,key:list_key,value:list_value
logo     = name:*
newline  =
page     = class:main,title:var:cms_title,menu
password = name:*,default:,class:,size:40,maxlength:256
radio    = readonly:false,name:*,value,default:false,prefix:,suffix:,class:,onchange:
raw      =
row      = class
selectbox= list:*,name:*,default,onchange:,title:,class:,addempty:false,multiple:false,size:1
radiobox = list:*,name:*,default,onchange:,title:,class:
set      = var:*,value,key
table    = class,width:100%,space:0px,padding:0px,widths,rowclasses:oddCOMMAeven,columnclasses
text     = title,class:text,var,text,key,textvar,raw,maxlength,value,suffix,prefix,accesskey,escape:true
upload   = name:*,class:upload,maxlength,size:40
user     = user
window   = title,name,icon,widths,width:93%,rowclasses:oddCOMMAeven,columnclasses:1COMMA2COMMA3