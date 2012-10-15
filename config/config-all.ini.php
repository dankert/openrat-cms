; /* vim: set filetype=ini : */
;
;

; OpenRat configuration file

; Per host configuration:
; A file 'config-<hostname>.ini.php' is preferred before file 'config.ini.php'.

; Rules for reading this file:
; 1. if environment-variable 'OR_CONFIG_FILE' is set, then this value is used for the configuration filename.
; 2. if environment-variable 'OR_CONFIG_DIR' is set, then a file 'config-<hostname>.ini.php' is read. If it does not exist,  'config.ini.php' is read instead.
; 3. file 'config/config-<hostname>.ini.php' is read. If it does not exist,  'config/config.ini.php' is read instead.
;
; Lines which begins with ';' are ignored.



; Configuration



; Start other applications out of OpenRat.
; Other applications are able to authenticate the user with a ticket id (Single Signon)
; see documentation for more details.

; The Name of the application
;applications.phpmyadmin.name=PHPYourAdmin

; URL
;applications.phpmyadmin.url="https://example.com/anotherapplication/index.cgi"

; Name of the HTTP-Parameter for the Ticket-Id.
; OpenRat puts the session-id into this parameter.
;applications.phpmyadmin.param="ticketidforopenrat"

; Groups
; Only User, who are in this group, may see the application
; (optional)
;applications.phpmyadmin.group=

; A brief description of this application.
;applications.phpmyadmin.description="Your database administration"
;



; Conditional-GET enables the "304 not modified" HTTP-Header
; This is much faster, but sometimes caching is unwanted
; if you have caching problems, set this to 'false'.
; Default: 'true'
;cache.conditional_get=true



; Pages and files are cached in a temporary directory.
; 'false' means generate each page again and again
; 'true'  will cache a page's content. This will improve
;         the performance, but has some side effects,
;         f.e. no dynamic content will be updated.
; Default: 'false'
;cache.enable_cache=false



; Directory for temporary files.
; Default: blank (means: OpenRat is using the system temporary dir)
;cache.tmp_dir=



; Auto-Reload session.
; If the configuration file is changed, its content is reloaded automatically
; Default: true
;config.auto_reload=true;

;
; If the configuration file is changed, a new session will be created.
; Default: true
;config.session_destroy_on_config_reload= true;



; Maximum file size for uploads in KB
; Special values: 0,-1 = not restricted
; Default: 0
;content.file.max_file_size=1500




; Delete-strategy of old content.

; Values are deleted, if
; a) max-age and min-revisions are reached OR
; b) max-revisions and min-age are reached
;content.revision-limit.enabled = false

; max age of values (days)
;content.revision-limit.max-age = 120
; min age of values (days)
;content.revision-limit.min-age = 1

; number of revisions
;content.revision-limit.max-revisions = 100
;content.revision-limit.min-revisions = 3



; If a textvalue is empty, try using the default language
; Default: true
;content.language.use_default_language = true




; Database configuration.
; You have to have at least one database connection which has 'enabled=true'.
;
; Supported RDBMS-types:
; - 'mysql'      the old PHP-mysql-driver
; - 'mysqli'     PHP-mysql-driver with support for prepared statements (EXPERIMENTAL) (since PHP 5.0)
; - 'postgresql' Postgresql
; - 'sqlite'     SQ-Lite 2.x-databases                                                (since PHP 5.1)
; - 'sqlite3'    SQ-Lite 3.x-databases (EXPERIMENTAL)                                 (since PHP 5.3)
; - 'pdo'        A common PHP database abstraction layer for a lot of DBs.            (since PHP 5.1)



; Default Database
; This database will be selected by default.
; There has to exist a section with this name.
;database.default=sample_db_mysql



; This is a sample database connection.
; If you want to use it, just fill out the login data and set 'enabled' to 'true'

;database.sample_db_mysql.enabled    = false                 ; set this to 'true' for using this connection
;database.sample_db_mysql.comment    = "DB MySQL"            ; comment of this database

;database.sample_db_mysql.type       = mysql                 ;
;database.sample_db_mysql.user       = dbuser                ; database user
;database.sample_db_mysql.password   = dbpass                ; database password
;database.sample_db_mysql.host       = localhost             ; database hostname
;database.sample_db_mysql.port                              ; database TCP/IP-Port (optional)
;database.sample_db_mysql.database   = cms                   ; database name

;database.sample_db_mysql.base64     = false                 ; store binary as BASE64
;database.sample_db_mysql.prefix     = or_                   ; table praefix
;database.sample_db_mysql.persistent = yes                   ; use persistent connections (try this, it's faster)
;database.sample_db_mysql.charset = UTF-8

; SQL-Statement which is executed after opening the connection
; connection_sql = "SET NAMES 'UTF8';"  ; using UTF-8 as database charset
;database.sample_db_mysql.connection_sql = ""

; System command for executing before connecting to the database.
; Maybe for installing an SSH-Tunnel.
; For background programs, you have to redirect stdin and stdout! (maybe to /dev/null)
; Example: "sudo -u u123 /usr/local/bin/sshtunnel-example.sh"
; Default: blank.
;database.sample_db_mysql.cmd = ""

; Using prepared statements.
; The 'old' mysql-interface in PHP does not support prepared statements
;database.sample_db_mysql.prepare = false

; Using transactions. Set to 'true' when you are using 'InnoDB'-tables.
; If so, maybe you need to set 'SET AUTOCOMMIT=0' as connection_sql above.
; Default: false
;database.sample_db_mysql.transaction = false

; Readonly tables. Set to 'true' during maintainance activitys.
; If 'true', OpenRat will disable all writing operations.
;database.sample_db_mysql.readonly = false



; This is a sample database connection.
; If you want to use it, just fill out the login data and set 'enabled' to 'true'

;database.sample_db_postgresql.enabled    = false                 ; set this to 'true' for using this connection
;database.sample_db_postgresql.comment    = "DB-PostgreSQL"       ; comment of this database

;database.sample_db_postgresql.type       = postgresql            ;
;database.sample_db_postgresql.user       = dbuser                ; database user
;database.sample_db_postgresql.password   = dbpass                ; database password
;database.sample_db_postgresql.host       = localhost             ; database hostname
;database.sample_db_postgresql.port                              ; database TCP/IP-Port (optional)
;database.sample_db_postgresql.database   = cms                   ; database name

;database.sample_db_postgresql.base64     = false                 ; store binary as BASE64 (in postgresql 7.x set this to 'true')
;database.sample_db_postgresql.prefix     = or_                   ; table praefix
;database.sample_db_postgresql.persistent = yes                   ; use persistent connections (try this, it's faster)
;database.sample_db_postgresql.charset = UTF-8

; SQL-Statement which is executed after opening the connection
;database.sample_db_postgresql.connection_sql = ""

; System command for executing before connecting to the database.
; Maybe for installing an SSH-Tunnel.
; For background programs, you have to redirect stdin and stdout! (maybe to /dev/null)
; Example: "sudo -u u123 /usr/local/bin/sshtunnel-example.sh"
; Default: blank.
;database.sample_db_postgresql.cmd = ""

; Using prepared statements.
; This is EXPERIMENTAL, do not use in production environments
;database.sample_db_postgresql.prepare = false

; Using transactions. Set this to true, if the MySQL table engine supports transactions
;database.sample_db_postgresql.transaction = false



; SQ-Lite is an embedded, 'mostly-ANSI-SQL-supporting' database system.
; for using SQLite, please check for the PHP module
; f.e. on ubuntu 'sudo apt-get install php5-sqlite'

;database.sample_db_sqlite.enabled    = false                    ; set this to 'true' for using this connection
;database.sample_db_sqlite.comment    = "DB-SQLite"              ; comment of this database

;database.sample_db_sqlite.type       = sqlite                   ;

; Filename of your SQlite database
;database.sample_db_sqlite.filename   = "/local/path/to/your/sqlite/openrat.db"

;database.sample_db_sqlite.base64     = false                 ; store binary as BASE64 (in postgresql=true)
;database.sample_db_sqlite.prefix     = or_                   ; table praefix
;database.sample_db_sqlite.persistent = yes                   ; use persistent connections (try this, it's faster)
;database.sample_db_sqlite.charset = UTF-8

; per default SQlite uses table-prefixed column names when using JOINs which MUST BE off.
;database.sample_db_sqlite.connection_sql = "pragma short_column_names=true;"

; System command for executing before connecting to the database.
;database.sample_db_sqlite.cmd = ""

;database.sample_db_sqlite.prepare = false

; Set this to true, if you want to use transactions.
;database.sample_db_sqlite.transaction = false



; PDO (means PHP Data Objects) is an abstract database interface

;database.sample_pdo_sqlite.enabled    = false                    ; set this to 'true' for using this connection
;database.sample_pdo_sqlite.comment    = "DB-PDO"                 ; comment of this database

;database.sample_pdo_sqlite.type       = pdo                      ;

; The DSN-Url for your database
;database.sample_pdo_sqlite.dsn = ""
; Examples:
; MySql
;database.sample_pdo_sqlite.dsn = "mysql:dbname=testdb;host=127.0.0.1"
; PostgreSQL
;database.sample_pdo_sqlite.dsn = "pgsql:host=localhost port=5432 dbname=mydb user=dbuser password=dbpass"
; SQLite
;database.sample_pdo_sqlite.dsn = "sqlite:/path/to/mydb.db"
; JDBC-Url when using OpenRat in Quercus
;database.sample_pdo_sqlite.dsn = "java:comp/env/jdbc/mydb"

; If not part of the DSN this is the right place for username/password
;database.sample_pdo_sqlite.user     = "dbuser"
;database.sample_pdo_sqlite.password = "dbpass"

;database.sample_pdo_sqlite.base64     = false                 ; store binary as BASE64 (in postgresql=true)
;database.sample_pdo_sqlite.prefix     = or_                   ; table praefix
;database.sample_pdo_sqlite.persistent = yes                   ; use persistent connections (try this, it's faster)
;database.sample_pdo_sqlite.charset = UTF-8

; SQL-Statement which is executed after opening the connection
;database.sample_pdo_sqlite.connection_sql = ""
; Examples:
; per default SQlite uses table-prefixed column names when using JOINs which MUST BE off.
;database.sample_pdo_sqlite.connection_sql = "pragma short_column_names=true;"
; set default schema for Oracle
;database.sample_pdo_sqlite.connection_sql = "alter session set current_schema=myschema;"

; System command for executing before connecting to the database.
;database.sample_pdo_sqlite.cmd = ""

;database.sample_pdo_sqlite.prepare = false

; Set this to true, if you want to use transactions.
;database.sample_pdo_sqlite.transaction = false

;database.sample_pdo_sqlite.readonly = false


; The database results MUST contain lowercase column names.
; if using Oracle, set this to 'true', default is 'false'.
;database.sample_pdo_sqlite.convert_to_lowercase = false

; PDO driver-specific options
; key 'option_a' means option 'a'.
;database.sample_pdo_sqlite.option_myoption_a
;database.sample_pdo_sqlite.option_myoption_b


; Add here more sections with other database connections.
; next unused section: ;[another_db]
; type=...
; comment="My production DB ..."
; ...




;
; Date formats
; see http://www.php.net/manual/en/function.date.php for details

;date.format.SHORT = ""
;date.format.ISO8601SHORT = "Ymd"
;date.format.ISO8601 = "Y-m-d"
;date.format.ISO8601BAS = "YmdTHis"
;date.format.ISO8601EXT = "Y-m-dTH:i:s"
;date.format.ISO8601FULL = "Y-m-dTH:i:sO"
;date.format.ISO8601WEEK = "YWW"
;date.format.GER1 = "d.m.Y"
;date.format.GER2 = "d.m.Y, H:i"
;date.format.GER3 = "d.m.Y, H:i:s"
;date.format.GER4 = "d. F Y, H:i:s"
;date.format.ENGLONG = "l dS of F Y h:i:s A"
;date.format.GMDATE = "D, d M Y H:i:s GMT"
;date.format.RFC822 = "r"
;date.format.UNIX = "U"
;date.format.LONG = "F j, Y, g:i a"


;date.timezone.-6="New York"
;date.timezone.0="UTC (GMT)"
;date.timezone.60="MET (Middle European Time)"
;date.timezone.120="MEST (Middle European Summertime)"



; Editor configuration

; Strong/important text (mostly "bold")
;editor.text-markup.strong-begin = "*"
;editor.text-markup.strong-end   = "*"

; Emphatic text (mostly "italic")
;editor.text-markup.emphatic-begin = "_"
;editor.text-markup.emphatic-end   = "_"

; Image
;editor.text-markup.image-begin = "{"
;editor.text-markup.image-end   = "}"

; Speech
;editor.text-markup.speech-begin = QUOTE
;editor.text-markup.speech-end   = QUOTE

; text with same width
;editor.text-markup.code-begin = "="
;editor.text-markup.code-end   = "="

; footnotes
;editor.text-markup.footnote-begin = "["
;editor.text-markup.footnote-end   = "]"

; pre-formatted Text
;editor.text-markup.pre-begin = "="
;editor.text-markup.pre-end   = "="

; Inserted Text
;editor.text-markup.insert-begin = "++"
;editor.text-markup.insert-end   = "++"

; Removed text
;editor.text-markup.remove-begin = "--"
;editor.text-markup.remove-end   = "--"

; Separator for a definition item
;editor.text-markup.definition-sep = "::"

; Indenting headline
;editor.text-markup.headline       = "+"

; Underlining of headline level 1
;editor.text-markup.headline_level1_underline = "="

; Underlining of headline level 2
;editor.text-markup.headline_level2_underline = "-"

; Underlining of headline level 3
;editor.text-markup.headline_level3_underline = "."

; Unnumbered Listentry
;editor.text-markup.list-unnumbered = "-"

; Numbered Listentry
;editor.text-markup.list-numbered   = "#"

; Table of content
;editor.text-markup.table-of-content= "##TOC##"

; Link to
;editor.text-markup.linkto          = "->"

; Table cell separator
;editor.text-markup.table-cell-sep  = "|"

;editor.text-markup.style-begin = "'"
;editor.text-markup.style-end   = "'"

; Quote Text
;editor.text-markup.quote            = ">"
;editor.text-markup.quote-line-begin = ">"
;editor.text-markup.quote-line-end   = ">"

; Makro
;editor.text-markup.macro-begin = "<<"
;editor.text-markup.macro-end   = ">>"
;editor.text-markup.macro-attribute-quote = "'"
;editor.text-markup.macro-attribute-value-seperator = "="



; Which HTML-Tag to use for cites
;editor.html.tag_strong = "strong"

; Which HTML-Tag to use for emphatic text
;editor.html.tag_emphatic = "em"

; Which HTML-Tag to use for teletyped text
;editor.html.tag_teletype = "tt"

; Which HTML-Tag to use for cites
;editor.html.tag_speech = "cite"

; OpenRat tries to use a good speech tag. You may override this.
;editor.html.override_speech = false
;editor.html.override_speech_open  = "&laquo;"
;editor.html.override_speech_close = "&raquo;"

; HTML-Rendermode
; explains how to handle emtpy elements.
; 'xml'  => <br />, <image src="..." />
; 'sgml' => <br>, <image src="...">
;editor.html.rendermode=sgml
;editor.html.rendermode=xml

;editor.html.replace = "EUR:&euro; (c):&copy; (r):&reg; ^1:&sup1; ^2:&sup2; ^3:&sup3; 1/4:&frac14; 1/2:&frac12; 3/4:&frac34;"




;editor.wiki.convert_html=true
;editor.wiki.convert_bbcode=true




; Calendar settings

; Weekday-Offset: Ho many days a week begins after Sunday.
; 0 = Week begins with Sunday (America, Australia, Islam)
; 1 = Week begins with Monday (ISO-8601, Europe)
;editor.calendar.weekday_offset=1


;editor.text.linelength=70

;editor.macro.show_errors=false



; Should filenames be editable?
; 'true' : Author may edit the filenames of pages, files and folders.
; 'false': filenames are generated by the CMS
; Default: true
;filename.edit    = true

; filename of folder start file
; Default: 'index'.
;filename.default = index


; 'ss'     : nerdy and poor imitation of story server urls. Looks important, but is cheap ;)
; 'id'     : simply use the object id for the url
; 'longid ': use a more longer id in the url
; 'short'  : use a url which is as short as possible (uses all possible characters)
; Default: 'short'
;filename.style   = short          ; use a url which is as short as possible

; hint: If edit=true, then the stored filename will be used.
;       If no filename stored, or if edit=false, then the defined style is used.

; how the links to other pages are generated.
; 'relative': Links are generated like '../../path/page.html'
; 'absolute': Links are generated like '/path/page.html'
; Default: relative
;filename.url=relative



; FTP configuration


; for which file extensions the ASCII-Mode should be used
;ftp.ascii    = html,htm,php



; Enable online help
; Default: true
;help.enabled=true

; URL praefix to the help documents
;help.url=help/html/
;help.url=http://help.openrat.de/

; file extension of the help documents
;help.suffix=.html



; Search for language in HTTP header
; This is a useful setting. The Browser says, which language will be taken.
;i18n.use_http=true


; Default language
; If no language is found, which should be used?
;i18n.default=de


; Available Languages.
; A comma seperated list with language codes.
; for each language there must be a file named 'language/<code>.ini'.
;i18n.available=de,en,es,fr,it,ru,cn



; Mappings from the language to installed locales
;i18n.locale.de="de_DE.utf8"
;i18n.locale.en="en_US.utf8"



; Say 'true' if GD2 is available, otherwise 'false'
;image.truecolor=true



; The seperator char between directory names
;interface.file_separator = " &raquo; "


; be aware: if 'true' you need special rewrite rules in a .htaccess file!
; Default: false
;interface.nice_urls = false


; In most environments this setting is "false"
;interface.url_sessionid = false


; Theme
; At the moment, der is only "default" available.
; *deprecated*
;interface.theme = "default"


; Show request duration on every page. Only useful for developers.
;interface.show_duration = false


; Request timeout in seconds
; This sets the PHP time limit for an Request.
; Default: '' (blank=system default)
;interface.timeout =


; Replace the default title (Program name+version) with this text
; If blank, the default is "OpenRat {Version}".
; Maybe you want to use your company name here.
;interface.override_title =



; Use of human date format
; looks like "3 years ago", or "7 months ago"
; Default: false
;interface.human_date_format = false



; The default style which is used, when no user is logged in.
; 'default' is the classic Openrat style.
;interface.style.default=default

; 'system' uses system colors from the client (nice choice)
;interface.style.default=system



; Settings for preferences (under "Administration")

; If you have an online editor for editing the .ini-files you can put the URL here.
; Security belongs to the 3rd-party editor! Openrat only creates a link to this url!
; Set to '' (blank) for disabling this.
;interface.config.file_manager_url=""

; Enable "preferences"-menu
;interface.config.enable=true

; show system settings (operating system, system time, ...)
;interface.config.show_system=true

; show PHP settings
;interface.config.show_interpreter=true

; show a list of PHP extensions (without any details)
;interface.config.show_extensions=true



; Frameset settings

; Logical name of top-frame. Change this, if you want Openrat running in another parent frameset
;interface.frames.top=_top


; Manipulating the URL of Openrat.


; faking urls
; for faking urls you HAVE TO create a url rewriting rule!
; If unsure, set to "false"
; Default: false
;interface.url.fake_url = false

; If the entry filename is the index file of the directory, set this to true.
; This enables urls like "path/to/openrat/?a=1&b=2" and hides PHP.
; only useful, if fake_url=false
; if unsure, set to 'false' (default)
;interface.url.index = false

; You can create funny urls which look like asp,jsp,jsf and other crap :)
; Hint: Hiding the PHP interpreter *can* increase security.
; But remember, Security by obscurity is lame :)

; abc,xyz.1
;interface.url.url_format= "%s,%s.%i"

; looks like Jakarta Struts: abc,xyz,1.do
;interface.url.url_format= "%s,%s,%d.do"


; add the session ID as an URL-Parameter.
; useful, if you do not want cookies and trans_sid is not installed.
; if unsure, set to "false"
;interface.url.add_sessionid = false



; Use gravatar for user images
; see http://www.gravator.com for details

;interface.gravatar.enable=true
;interface.gravatar.size=80
;interface.gravatar.default=404
;interface.gravatar.rating=g



; Session-related settings

; auto-extend the session while the browser is still open.
; if 'true', the title frame will be refreshed automatically
; 1 minute before the session times out.
; Because this is maybe unsecure, the default setting is 'false'.
;interface.session.auto_extend=false
;


; Openrat is able to check passwords against a LDAP-based directory.

; Hostname of your LDAP server.
;ldap.host="localhost"

; TCP-Port of your LDAP server.
;ldap.port="389"

; Protocol-Version
; Set this to '2' or '3'.
;ldap.protocol="2"

; The format of the DN
; If blank, the DN is automatically searched in the LDAP tree (see section "search").
; for using LDAP authentication, /security/auth/type has to be set to "ldap"!
;ldap.dn = "uid={user},ou=users,dc=example,dc=com"
;ldap.dn = "";


; Settings for authentication against a LDAP directory
; This is only activated, if the setting 'security.auth.type' is 'ldap'.

; use of anonymous bind ('true' or 'false')
; if 'true', the following user and password settings are ignored.
;ldap.search.anonymous = true

; if 'anonymous' is 'false': DN of technical user for searching the real user DN
;ldap.search.user      = "uid=openrat,ou=users,dc=example,dc=com"

; if 'anonymous' is 'false': password of technical user
;ldap.search.password  = "verysecret"

; Base-DN of the subtree where the search begins
;ldap.search.basedn    = "dc=example,dc=com"

; Filter setting for searching the user objects.
; The string {user} will be replaced by the user name.
;ldap.search.filter    = "(uid={user})"

; Aliases are dereferenced ('true' or 'false')
;ldap.search.aliases   = true

; Timeout in seconds
;ldap.search.timeout   = 30

; If the user is found in the LDAP tree, but is not yet stored in the internal database.
; 'true'  the user will be logged in and automatically inserted in the internal database.
; 'false' login will be rejected, all users must exist in the internal database.
;ldap.search.add       = true



; The user-group-relation can be read out of the LDAP tree.
; For using this, 'security.authorize.type' must be set to 'ldap'.

; Search filter for reading the groups a user belongs to.
;ldap.authorize.group_filter="(memberUid={dn})"

; LDAP attribute name of the name of the group
;ldap.authorize.group_name="cn"

; Add groups found in LDAP (but not known in the internal database) automatically into database?
; If 'false', the LDAP groups cannot be used!
;ldap.authorize.auto_add = true
;
; converted from login.ini.php
; <?php exit('direct access denied') ?>

;login.motd=""                                  ; Message of the day, shown in login mask
;login.nologin=false                            ; Disable Login (for maintanance jobs)
;login.register=false
;login.send_password=false

;login.gpl.url="http://www.gnu.org/licenses/old-licenses/gpl-2.0.html"

;login.logo.file="./themes/default/images/logo.jpg"  ; logo (url to image) in login mask
;login.logo.url="http://www.openrat.de"              ; linked url in login mask


; After Login, start with the last changed object.
; If 'true', the project menu is not displayed.
;login.start.start_lastchanged_object=true
;
; converted from log.ini.php
; <?php exit('direct access denied') ?>


; Logfile settings


; filename of logfile. Every log entry will be appended to this file.
; This file must be writable by the webserver.
; If blank (default), no logging will be done.
;log.file = ""

; loglevel are one of 'trace','debug','info','warn','error'
;log.level = "warn"

; date format (for variable %time, see 'format'. This format is used by PHPs date()-function.
; See http://www.php.net/date
;log.date_format = "M j H:i:s"

; lookup hostname of client-IP
; this may increase performance, if 'true'. Be careful!
;log.dns_lookup = false

; output format
; the following variables are replaced:
; %time by the current time of the log entry.
; %level the logging level
; %host client ip ore hostname (see 'dns_lookup' entry above)
; %user username, who is logged in, ore '-' if not logged in.
; %action what is happening now
; %text reason of the log entry
;log.format = "%time %level %host %user %action %text"
;
; converted from mail.ini.php
; <?php exit('direct access denied') ?>

; E-Mail Settings

; Does your server send e-mails?
; 'true' or 'false'
;mail.enabled=true

; The "from"-Adress. Creates a "From: "-Header.
; This is not neccecary. Hint: Most MTAs require a valid email adress.
;mail.from="OpenRat <user@example.com>"

; This signature is appended at the end of a mail. Use ';' for line-breaks.
; A useful information is maybe the URL of your OpenRat installation.
;mail.signature="http://www.openrat.de"

; Copy Recipient
;mail.cc=

; Blind Copy recipient
;mail.bcc=

; Priority of the mail (creates an "X-Priority"-Header)
; 1=Highest, 2=High, 3=Normal, 4=Low, 5=Lowest
; Hint: Most MUAs ignore this header.
;mail.priority=3


; Non-7-bit-chars are not allowed in Mailheaders (see RFC 822, 2045, 2047)
; and must be encoded. Openrat supports 3 types of encoding:
; 'Quoted-printable' (default),
; 'Base64'
; '' (blank) no encoding.
;mail.header_encoding="Quoted-printable"


; Which SMTP client you want to use.
; 'php' : Internal PHP function mail().
; 'smtp': OpenRat internal SMTP-client
; If unsure, use the builtin PHP function.
;mail.client=smtp
;mail.client=php


; Whitelist
; A comma-seperated list of domains names
;mail.whitelist = ""

; Blacklist
; A comma-seperated list of domain names
;mail.blacklist = ""



; Settings for the internal SMTP client.
; If client='php', you have no need to change anything in this section.

; Relay host
; It is useful, to have your own relay host, as servers doing greylisting
; *will* deny our smtp try.
; If this is blank, the mail is delivered directly to the destination MX host.
; I repeat, it is better to always use a relay host!
;mail.smtp.host="mail.yourdomain.example"
;mail.smtp.host="locahost"

; SMTP-Port is '25' in most environments
;mail.smtp.port="25"

; SMTP Authentication
; (only needed if using a relay host)
; (FYI: The client makes use of the SMTP "AUTH LOGIN" method.
;mail.smtp.auth_username="your.user@something.example"
;mail.smtp.auth_password="notsecret"

; Timeout in seconds
;mail.smtp.timeout="45"

; Your fully-qualified hostname (FQDN)
; if empty, Openrat will use your simple hostname
;mail.smtp.localhost=
;mail.smtp.localhost="your.fully.qualified.hostname.example"

; Use TLS
; The client will send a "STARTTLS" command after HELO.
; TLS is not tested, use at your own risk!
;mail.smtp.tls=false

; Use SSL
; The client will connection using the SSL-protocol.
; This is not tested, use at your own risk!
;mail.smtp.ssl=false


;
; converted from publish.ini.php
; <?php exit('direct access denied') ?>

; Allow editing of file names.
; 'true' : Author is allowed to edit the file names of his files and pages.
; 'false': File names are generated by OpenRat only.
;publish.edit=true


; filename for the first object in a folder.
; Default is 'index'.
;publish.default=index


; File naming conventions
; See http://httpd.apache.org/docs/2.0/content-negotiation.html#naming
; '{filename}{language_sep}{language}{type_sep}{type}' means 'foo.en.html'
;publish.format       = "{filename}{language_sep}{language}{type_sep}{type}"


; Seperators, mostly you will use '.'
;publish.language_sep = "."
;publish.type_sep     = "."


; 'always': language name is always appended to the filename
; 'auto'  : language is appended if there are at least 2 languages
;publish.filename_language = auto


; 'always': type is always appended to the filename
; 'auto'  : type is appended if there are at least 2 project models
;publish.filename_type = always


; Filename Mode. Only used, if edit=false or no filename is set for an object.
; 'ss'    : nice hack for lamers which like storyserver urls like '0,1513,453556,00.html'
; 'id'    : simply use the object id.
; 'longid': use a unique and long number.
; 'short' : use a unique name which is as short as possible.
;publish.style="id"


; Mode of generated URLs.
; 'relative': (Default) Generates URLs like '../../path/to/example.html'.
; 'absolute': Generates URLs like '/path/to/example.html'.
;publish.url=relative
;publish.url=absolute

; Should PHP code in page source be interpreted
; 'false': page source is never interpreted as PHP
; 'auto' : interpreted, if page extension = '.php'
; 'true' : always interpret PHP in page source
;publish.enable_php_in_page_content=false

; Should PHP code in file content be interpreted
; 'false': file content is never interpreted as PHP
; 'auto' : interpreted, if file extension = '.php'
; 'true' : always interpret PHP in file content
;publish.enable_php_in_file_content=false

; Escape all non-ascii characters to HTML entities.
; Normally this is not necessary, if there is a correct charset in the meta-section of your HTML-head.
; 'true' : Escape all non-ascii-characters
; 'false': Do nothing (default)
;publish.escape_8bit_characters=false



; Content-Negotiation as defined in RFC 2295.
; These settings are only considered, if the project setting "use content negotiation" is switched on.

; if 'true', then the mime-type is omitted in the URL for page links.
;publish.negotiation.page_negotiate_type = true

; if 'true', then the language is omitted in the URL for page links.
;publish.negotiation.page_negotiate_language = true

; if 'true', then the mime type is omitted in the URL for file links
;publish.negotiation.file_negotiate_type = true



; Default publish directory. The edited target directory is appended.
;publish.project.publish_dir="/var/www/"

; Allow paths in target directory
; 'false': only the base name is taken
; 'true' : user input is taken with full path
;publish.project.override_publish_dir=true

; Default system command.
; Vars: {name}    = project name,
;       {dir}     = Target directory,
;       {dirbase} = Target directory basename
;publish.project.system_command="sudo -u xyz /usr/local/bin/mirror.sh {dirbase}"
;publish.project.system_command=

; Input overrides the default system command.
; 'true' or 'false'
;publish.project.override_system_command=true



; 'true' : (Default) FTP is enabled
; 'false': FTP is disabled, f.e. if FTP is not compiled with PHP.
;publish.ftp.enable=true

; Default FTP-Port
; Default: '21'
;publish.ftp.port=21

; Default hostname
;publish.ftp.host="ftp.example.com"

; Default path
;publish.ftp.path="/path/to/site"

; Login data
; If not specified (default), anonymous login will be used.
;publish.ftp.user=agent_smith
;publish.ftp.pass=smith
;
; converted from replace.ini.php
; <!-- $Id$ -->
; <?php exit('direct access denied') ?>

; *** This part is deprecated and will be moved/removed in one of the next versions.

; THIS FILE IS OUTDATED AND NOT USED ANY MORE!!!
;replace.
; See file editor.ini.php section "html", setting "replace".
;replace.
;replace.euro   = "EUR,&euro;"
;replace.copy   = "(c),&copy;"
;
; converted from search.ini.php


; Settings for the quicksearch field
;search.

; Show submit button for quicksearch. Not needed for modern browsers
;search.quicksearch.show_button=false

; Search in the name of objects
;search.quicksearch.search_name=true

; search in the filename of objects
;search.quicksearch.search_filename=true

; search in the description of objects
;search.quicksearch.search_description=true

; Search in all text content (slow on big databases!)
;search.quicksearch.search_content=false
;
; converted from security.ini.php
; <?php exit('direct access denied') ?>

; Security settings for Openrat - be careful :)



; All is readonly (for maintanance jobs)
; true|false, default:false
;security.readonly=false

; Disable publishing
;security.nopublish=false

; Unix-UMask for all created files
; Default: none (uses system default)
; Example: '0022' (means '-rw-r--r--')
; Example: '0002' (means '-rw-rw-r--')
;security.umask=

; CHMOD for created files
; Default: none
; Example: '0644' (means '-rw-r--r--')
; Example: '0755' (means '-rwxr-xr-x')
;security.chmod=

; CHMOD for created directories
; Default: none
; Example: '0755' (means 'drwxr-xr-x')
; Example: '0770' (means 'drwxrwx---')
;security.chmod_dir=

; You may disable dynamic code.
; dynamic code ("CODE"-Elements in templates) are dangerous, because they may
; interact with the file system (and much more!).
;security.
; Hint: only admin users are allowed to save dynamic code.
; Enable, if admin users are trustful.
; Disable, if admin users are anonym (f.e. demo-installations).
; Default: true (for secure default installation).
;security.disable_dynamic_code = true


; Enable or disable the displaying of system information
;security.show_system_info = true


; Useful against CSRF-attacks, this adds a token to all POST request.
;security.use_post_token=true

; Creates a new Session on login.
; Useful against session fixation attacks.
;security.renew_session_login=false

; Creates a new Session on logout.
; Useful against session fixation attacks.
;security.renew_session_logout=false



; Default Login
; These values are used for the login form.

; default: ''
;security.default.username=

; default: ''
;security.default.password=



; Guest Login
; if enabled, a named guest user is automatically logged in.

; enable auto-login for a guest user.
;security.guest.enable=false

; Name of the guest user, who is automatically logged in.
; This username must exist in your user database.
;security.guest.user=guest



; Type of authorization.
; 'http' uses the HTTP Basic Authrization.
;        Only available if PHP is used in the module version.
;        Not available, if PHP is used via the CGI way.
;        Only the default database is available (because there is no way to select another one)
; 'form' shows a login form via a HTML page.
; Default: 'form'

;security.login.type=form
;security.login.type=http



; this is the backend where the passwords are checked against.
; 'database' uses the internal database table as password store.
; 'authdb'   uses an external database table as password store, see section 'security.auth'.
; 'ldap'     uses an external LDAP directory for password checking, see section 'ldap'.
; 'http'     uses an HTTP-Auth Server for password checking
; Default: 'database'
;security.auth.type=database

; per-user setting of the LDAP DN.
; 'true'  users which have there LDAP-DN explicitly stored are authenticated against LDAP.
; 'false' no LDAP-DN storage per user.
;security.auth.userdn=false



; A user belongs to certain groups. This information can be stored in 2 ways.
; 'database' uses the internal database for the user-group-relation. (default)
; 'ldap' reads the user-group-relations in a LDAP-Directory
;        (in this case, /security/auth/type has to be set to "ldap", too!)
;        (see /ldap/authorize!)
;security.authorize.type=database
;security.authorize.type=ldap



; password settings

; length of automatic generated password
;security.password.random_length=8

; minimum passwort length
;security.password.min_length=5

; Password "salt"
; ''        : no salt (default)
; 'id'      : salt the password with userid
; 'username': salt the password with username
; 'custom'  : use the 'salt_text'-setting
; Default: ''
;security.password.salt = ""

;security.password.salt_text = "somerandomtext"



; this section is needed if the setting "auth/type" is 'http'.
; passwords are checked against another HTTP-Server with Basic Authorization.

; The URL where an HTTP basic authorization ist required.
;security.http.url = "http://example.net/restricted-area"



; this section is needed if the setting "auth/type" is 'authdb'.
; passwords are stored against an external database table.
; This is quite useful, if you have another software running (f.e. a forum system)
; and so the user must only remember 1 password.

; 'mysql', 'postgresql' or 'sqlite'
;security.authdb.type = postgresql

;security.authdb.user = dbuser
;security.authdb.password = dbpassword
;security.authdb.host = 127.0.0.1
;security.authdb.database = dbname
;security.authdb.persistent = false

; the sql which is executed while checking the password.
; the variables {username} and {password} are replaced.
;security.authdb.sql = "select 1 from table where user={username} and password=md5({password})"

; if the user exists in the external database, should it
; automatically be inserted into the openrat internal table?
;security.authdb.add = true



; SSL Client certificate Authentication

; The environment variable name which has the username out of the certificate.
; See modssl-configuration for more infos:
; http://httpd.apache.org/docs/2.0/mod/mod_ssl.html.en#envvars
; if blank, ssl client auth is unused (default)
;security.ssl.user_var=
;security.ssl.user_var="REMOTE_USER"
;security.ssl.user_var="SSL_CLIENT_S_DN"
;security.ssl.user_var="SSL_CLIENT_S_DN_CN"

; if 'true', you trust the client certificate fully, this is a passwordless login!
; take care tto have an useful webserver configuration where you only trust CA-signed certificates.
; if 'true', the 'user_var' is needed.
;security.ssl.trust=false



; Open-ID
; see http://openid.net/ for specifications and more informations.

; Enable Open-ID
; default=false
;security.openid.enable=false

; Should authenticated users, which are not in your user database, automatically be added?
; default=false
;security.openid.add=false

; Open-Id Logo
; The specification recommends the original Open-Id logo.
;security.openid.logo_url=
;security.openid.logo_url="http://openid.net/login-bg.gif"

; Trust-Root
; URL-Prefix in which your OpenRat installations are running.
; default=<empty> (OpenRat tries to use its own server name)
;security.openid.trust_root=http://your.server.example/openrat/
;security.openid.trust_root=

; Trustful servers
; Default='' (all)
;security.openid.trusted_server=openid1.example.com,openid2.example.com
;security.openid.trusted_server=

; Should Users fullname and e-mail updated from the OpenId-Server?
;security.openid.update_user=true

; Using User-Identitys?
;security.openid.user_identity=true

; List of OpenId-Provider to use
; Special name "identity" for user defined identitys
;security.openid.provider=example
;security.openid.provider.name=google

; location of the providers Yadis-document (XRDS-file)
;security.openid.provider.example.xrds_uri=http://google.com/accounts
; which attribute is used for mappin to the internal database
;security.openid.provider.example.map_attribute=email
; which attribut of internal user database is used
; valid values are 'mail', 'username'
;security.openid.provider.example.map_internal=mail

; Google supports Open-Id 2.0
;security.openid.provider.google.xrds_uri=http://google.com/accounts/o8/id
;security.openid.provider.google.map_attribute=email
;security.openid.provider.google.name=Google
;security.openid.provider.google.map_internal=mail

; Yahoo
;security.openid.provider.yahoo.xrds_uri=http://??????
;security.openid.provider.yahoo.map_attribute=usename
;security.openid.provider.yahoo.map_internal=mail



; Single Sign-on
; These settings are an example for checking login against "PhpMyAdmin".
; PhpMyAdmin must include a link to Openrat with the authid which includes the serialized cookies.
; Example: Include this in the file .../phpmyadmin/main.php:
; <a href="https://example.com/openrat/?authid=<?php echo urlencode(serialize($_COOKIE)) ?>">OpenRat</a>

; use single sign-on? Set to 'true' or 'false'.
;security.sso.enable=false

; the url against the auth-id will be checked.
;security.sso.url="http://localhost/check.php?phpsessid={id}&check=true"
;security.sso.url="https://www.example.com/phpmyadmin/main.php?server=1"

; the name of the parameter, where OpenRat will receive the Id, which will then be checked.
;security.sso.auth_param_name=authid

; is the auth-id serialized?
;security.sso.auth_param_serialized=true

; the auth-id will be used as a cookie
;security.sso.cookie=true

; if the auth-id is no array, use this cookie-name.
;security.sso.cookie_name=

;security.sso.force=true

; leave this blank.
;security.sso.expect=

; this is a regular expression which checks, if the login at the third-party-system is ok.
;security.sso.expect_regexp="/running on/"

; regular expression for find out the username
; this example is used for "PhpMyAdmin"
;security.sso.username_regexp="/running on localhost as ([a-z]+)@localhost/"



; Settings for a new user

; These groups are automatically added while a new user is inserted.
; Default: ''
;security.newuser.groups=YourGroup,AnotherGroup



; Logout settings

; Redirect to this URL after logout
; <blank>= Show Login.
; Default: ''
;security.logout.redirect_url="http://your.intranet.example/"
;security.logout.redirect_url=



; Show E-Mail-Adress in Administration-Interface.
; Default=true. If admin users should not know the mail adresses, set this to false.
; Useful for Demo-Installations where a lot of users may have administration rights.
;security.user.show_admin_mail=true

; Show users e-mail-address to other users.
; Default=true.
;security.user.show_mail=true

; Users are able to send mesages to another users via e-mail
; (not yet implemented)
;security.user.send_message=true
;



; Theme compiler.

; Enable the Template Compiler
; Templates files are written to a temporary directory.
; default=true
;theme.compiler.enable=true

; Only compile, if the file under themes/default/templates is changed.
; default=true
;theme.compiler.cache=true

; Do a CHMOD on the output file.
; default: empty
;theme.compiler.chmod=

; Compile ALL templates at logout
; (only useful while developing)
; default: false
;theme.compiler.compile_at_logout=false

; Compile ALL templates to temporary directory
; only useful while developing! Not for production use.
; default:false
;theme.compiler.compile_to_tmp_dir=false
;
; converted from webdav.ini.php
; <!-- $Id$ -->
; <?php exit('direct access denied') ?>

; WEBDAV-settings

;webdav.enable=false

; Creation of new folders, files.
;webdav.create=true

; Maximum filesize for uploaded files (in kB)
;webdav.max_file_size=1000

; Readonly-Access.
;webdav.readonly=true

; Set "X-powered-by"-Header?
;webdav.expose_openrat = true

; Redirecting from "http://server/path/webdav.php"
;               to "http://server/<prefix><session-id>/webdav.php"
; This is a must-have for clients who do not use cookies.
; If 'true', a rewriting rule (.htaccess) is needed.
;webdav.session_in_uri = false

; the prefix before the session id.
;webdav.session_in_uri_prefix = ors

; Make some Microsoft-specific stuff (they cannot read RFCs):
; - Set "MS-Author-Via:"-Header
; Set to 'true', if you want to use lame clients like MS-Office, MS-IE, ...
; Set to 'false' for strict WEBDAV, but no MS-clients are doing the job...
; Default: true
;webdav.compliant_to_redmond = true
;

; *** The following settings are deprecated and will be removed in one of the next versions.

; convert simple HTML-tags to wiki-markup (if HTML is disabled)
;wiki.convert_html         = true

; convert a few BB-code tags to wiki-markup
;wiki.convert_bbcode       = true

; how strong text is marked
;wiki.tag_strong           = "*"

; how emphatic text is marked
;wiki.tag_emphatic         = "_"
