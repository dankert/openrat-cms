; <!-- $Id$ -->
; <?php exit('direct access denied') ?>

; This is the main configuration file for OpenRat
; Lines beginnung with a semicolon are comments. Empty lines are ignored.

; Quickstart:
; Only change the database parameters in section [database_DB1] 



; ===================================================================
; Global database settings
; ===================================================================
[database]

; -------------------------------------------------------------------
; You can set multiple database names here. Every database name need his own section (see below)  
databases = DB1
;databases = DB1,DB2,ANOTHERDB
; -------------------------------------------------------------------

; -------------------------------------------------------------------
; This database will be the default at login
default = DB1
; -------------------------------------------------------------------



; ===================================================================
; Example database connection
; ===================================================================
[database_DB1]

; -------------------------------------------------------------------
; add a short description of this connection
comment = "My DB connection"
; -------------------------------------------------------------------

; -------------------------------------------------------------------
; supported types are "mysql" and "postgresql"
type = mysql;
; -------------------------------------------------------------------

; -------------------------------------------------------------------
; database username and password
user = dbuser
password = dbpass
; -------------------------------------------------------------------

; -------------------------------------------------------------------
; Hostname to connect to
host = localhost
;host = :/var/run/mysqld/mysqld.sock
; -------------------------------------------------------------------

; -------------------------------------------------------------------
; Port to connect to (empty value will use the standard port)
;port=
; -------------------------------------------------------------------

; -------------------------------------------------------------------
; Store binary data base64-encoded. Slower, but more compatible.
; Postgresql Users must set this to true!
; If you set this to false (faster) be sure to use a BLOB field for
; column value in table or_file
base64 = true
; -------------------------------------------------------------------

; -------------------------------------------------------------------
; logical database name
database = cms
; -------------------------------------------------------------------

; -------------------------------------------------------------------
;if you want more than one installation per database you can do this with a prefix 
prefix = or_
; -------------------------------------------------------------------

; -------------------------------------------------------------------
; Use persistent connections. This is faster, so try using it.
persistent = yes
; -------------------------------------------------------------------



; ===================================================================
; LDAP Server Settings
; ===================================================================

[ldap]

; LDAP server hostname for password checking with this server
; If you want to use this method, you simply set a LDAP-dn for that user
; Default: '' (blank)

host = "10.1.2.3"
port = "389";



; ===================================================================
; FTP Settings
; ===================================================================
[ftp]

; -------------------------------------------------------------------
asciimode = html,htm,php
; -------------------------------------------------------------------



; ===================================================================
; Global Settings
; ===================================================================
[global]

; -------------------------------------------------------------------
; The default language which is used, if the requested language from
; the user agent is not available. 
; Needs the 2-letter ISO-Countrycode
; -------------------------------------------------------------------
default_language = de
; -------------------------------------------------------------------

; -------------------------------------------------------------------
; The title displayed in the title bar of your browser.
; Maybe you like to change it to something more friendly :-)
title = "OpenRat"
version = "0.3"
; -------------------------------------------------------------------


; -------------------------------------------------------------------
; The php file extension which is used on your server.
; Default: php
; -------------------------------------------------------------------
ext = php
; -------------------------------------------------------------------


; -------------------------------------------------------------------
; Width of the left Tree
; -------------------------------------------------------------------
;tree_width = "250"
tree_width = "25%"
; -------------------------------------------------------------------



; ===================================================================
; Directories
; ===================================================================

[directories]

datadir     = "./data"
incldir     = "./functions"
themedir    = "./themes/default"
languagedir = "./language"
tmpdir      = "./tmp"


; ===================================================================
; Logfile
; ===================================================================

[log]

; -------------------------------------------------------------------
; log-level can be one of the following
; - debug: Show all messages
; - info:  Show informational messages
; - warn:  Show warnings
; - error: Show only errors
; -------------------------------------------------------------------
level    = "debug"
; -------------------------------------------------------------------

file     = "./log/cms.log"

; -------------------------------------------------------------------
; date_format is parameter for PHP-function date()
; -------------------------------------------------------------------
date_format = "M j H:i:s"
; -------------------------------------------------------------------

; -------------------------------------------------------------------
; Whether to do DNS lookups for logfile entries
; A setting of true can slow down the system.
; -------------------------------------------------------------------
dns_lookup  = false
; -------------------------------------------------------------------

; -------------------------------------------------------------------
; %user    = username
; %host    = remote host
; %time    = time
; %level   = facility
; %agent   = browser string
; %action  = the actual action mode
; %text    = the message
; -------------------------------------------------------------------
format   = "%time %level %host %user %action %text"
;format   = "%time %host %user %level %action '%text' '%agent'"
; -------------------------------------------------------------------


; ---------------------------------------------------------------------
; GD Image Library
; ---------------------------------------------------------------------
[gd]

; -------------------------------------------------------------------
; is GD installed (with GD you can use dynamic resizing of images)
; -------------------------------------------------------------------
gd  = yes
; -------------------------------------------------------------------

; -------------------------------------------------------------------
; Version of GD ( set to 1 or 2 )
; GD version 2 allows you to use TrueColor Images
; -------------------------------------------------------------------
version2 = true
; -------------------------------------------------------------------

; -------------------------------------------------------------------
; if using GD, which Image-Types are supported (seperated by commas)
; -------------------------------------------------------------------
extension = jpeg,jpg,png
; -------------------------------------------------------------------


; END OF DOCUMENT