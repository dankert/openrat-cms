; <!-- $Id$ -->
; <?php exit('direct access denied') ?>

[database]

count = 2


[database_1]

name = FSTEST
comment = "Testdatenbank MySQL"
type = mysql
user = cms
password = horst
host = :/var/run/mysqld/mysqld.sock
database = cms
prefix = 
persistent = yes


[database_2]

name = FSTESTXXX
comment = "Testdatenbank MySQL persistent"
type = mysql
user = cms
password = horst
host = 127.0.0.1
database = cms
prefix = 
persistent = yes



[debug]

; This is a switch to switch on or off the debugging mode.
; The debugging mode ist only useful for developers :-)
; Default: 'false'

debug = true







[ldap]

; LDAP server hostname for password checking with this server
; If you want to use this method, you MUST set a LDAP-rdn for each user
; Default: '' (blank)
; UNDER DEVELOPMENT!

host = "192.168.10.19"



; External database for password checking
; You only need this if you have your own password server!
; Default: '' (blank)
; UNDER DEVELOPMENT!

[auth_database]

dsn    = "mysql://cms:horst@127.0.0.1/cms"
db_sql = "select * from tablexy where user={user} and password={pw}"



[global]

; ---------------------------------------------------------------------
; The title displayed in the title bar of your browser.
; Maybe you like to change it to something more friendly :-)

title = "Content Management System DaCMS'03"
version = "0.1 cvs"
; ---------------------------------------------------------------------


; ---------------------------------------------------------------------
; The php file extension which is used on your server.
; Default: php
; ---------------------------------------------------------------------
ext = php
; ---------------------------------------------------------------------

; ---------------------------------------------------------------------
; Authorization method
; Can be one of "url", "cookie" or "http"
; at the moment, only "url" is supported
; ---------------------------------------------------------------------
auth = url
; ---------------------------------------------------------------------


; ---------------------------------------------------------------------
; Width of the left Tree
; ---------------------------------------------------------------------
;tree_width = "250"
tree_width = "25%"
; ---------------------------------------------------------------------



; ---------------------------------------------------------------------
; Directories
; ---------------------------------------------------------------------

[directories]

datadir     = "./data"
incldir     = "./functions"
themedir    = "./themes/default"
languagedir = "./language"
plugindir   = "./plugins"
tmpdir      = "./tmp"

[log]

level    = "debug"
file     = "./data/cms.log"


; ---------------------------------------------------------------------
; Session config
; ---------------------------------------------------------------------

[session]

cookies = no
transient = no


; ---------------------------------------------------------------------
; GD Image Library
; ---------------------------------------------------------------------
[gd]

; is GD installed (with GD you can use dynamic resizing of images)
gd  = yes

; Version of GD ( set to 1 or 2 )
; GD version 2 allows you to use TrueColor Images
version = 2

; if using GD, which Image-Types are supported (seperated by commas)
extension = jpeg,jpg,png



; Thats it :-)
; Have a lovely day