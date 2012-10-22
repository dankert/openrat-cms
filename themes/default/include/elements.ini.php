; Control-file for template elements
; format: <element-name>=<attribute1>:<default-value>,<attributeN>,...
; default-value could be nothing (blank), a string or "*" for required attributes


output   =
button   = type:submit,src,class:ok,value:ok,text:button_ok
char     = type:*
checkbox = default:false,readonly:false,name:*
column   = width,style,class,colspan,rowspan,header:false,title,url,action,id,name
date     = date
dummy    =
focus    = field:*
form     = action,subaction,id,name:,target:_self,method:post,enctype:application/x-www-form-urlencoded,type:,cancel:true,label,visible:false
frame    = file,name,scrolling
frameset = rows,columns
frameset-page=menu
group    = title,icon,open:false,class
hidden   = name:*,default
header   = name:,views,back:false
editor   = name:*,type:*
else     =
if       = equals,value,not,empty,present,contains,greaterthan,lessthan,true,false
image    = config,file,url,icon,align:left,type,elementtype,fileext,tree,notice,size,title
input    = class:text,default:,type:text,index,name:*,prefix,value,size:,maxlength:256,onchange:,readonly:false,hint:,icon:
inputarea= name,rows:10,cols:40,value,index,onchange,prefix,class:inputarea,default:
insert   = file,script,inline:false,url,name,function
label    = for,value,key,text
link     = title:,config,type:,target,var,url,class:,action,subaction,id,var1,value1,var2,value2,var3,value3,var4,value4,var5,value5,accesskey,name,anchor,frame:_self,modal:false
list     = list:*,extract:false,key:list_key,value:list_value
logo     = name:*
newline  =
page     = class:main,title,menu
part     = id,class
password = name:*,default:,class:,size:40,maxlength:256
radio    = readonly:false,name:*,value,default:false,prefix:,suffix:,class:,onchange:,children,checked
raw      =
row      = class,classes,id
selectbox= list:*,name:*,default,onchange:,title:,class:,addempty:false,multiple:false,size:1,lang:false
radiobox = list:*,name:*,default,onchange:,title:,class:
selector = type:all,name,id
set      = var:*,value,key
table    = class,width:100%,space:0px,padding:0px,widths,rowclasses,columnclasses
text     = title,class:text,var,text,key,textvar,raw,maxlength,value,suffix,prefix,accesskey,escape:true,type,cut:both
tree     = tree
upload   = name:*,class:upload,maxlength,size:40
user     = user
window   = title,name,icon,widths,width:93%,rowclasses:oddCOMMAeven,columnclasses:1COMMA2COMMA3