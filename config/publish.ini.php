; <?php exit('direct access denied') ?>

; Allow editing of file names.
; 'true' : Author is allowed to edit the file names of his files and pages.
; 'false': File names are generated by OpenRat only.
edit=true


; filename for the first object in a folder.
; Default is 'index'.
default=index


; File naming conventions
; See http://httpd.apache.org/docs/2.0/content-negotiation.html#naming
; '{filename}{language_sep}{language}{type_sep}{type}' means 'foo.en.html' 
format       = "{filename}{language_sep}{language}{type_sep}{type}"


; Seperators, mostly you will use '.'
language_sep = "."
type_sep     = "."


; 'always': language name is always appended to the filename
; 'auto'  : language is appended if there are at least 2 languages
filename_language = auto


; 'always': type is always appended to the filename
; 'auto'  : type is appended if there are at least 2 project models
filename_type = always


; Filename Mode. Only used, if edit=false or no filename is set for an object. 
; 'ss'    : nice hack for lamers which like storyserver urls like '0,1513,453556,00.html'
; 'id'    : simply use the object id.
; 'longid': use a unique and long number.
; 'short' : use a unique name which is as short as possible.
style="id"


; Mode of generated URLs.
; 'relative': (Default) Generates URLs like '../../path/to/example.html'.
; 'absolute': Generates URLs like '/path/to/example.html'.
url=relative
;url=absolute



; Content-Negotiation as defined in RFC 2295.
; These settings are only considered, if the project setting "use content negotiation" is switched on. 
[negotiation]

; if 'true', then the mime-type is omitted in the URL for page links.
page_negotiate_type = true

; if 'true', then the language is omitted in the URL for page links.
page_negotiate_language = true

; if 'true', then the mime type is omitted in the URL for file links
file_negotiate_type = true



[project]
; Default publish directory. The edited target directory is appended.
publish_dir="/var/www/"

; Allow paths in target directory
; 'false': only the base name is taken
; 'true' : user input is taken with full path
override_publish_dir=true

; Default system command.
; Vars: {name}    = project name,
;       {dir}     = Target directory,
;       {dirbase} = Target directory basename
;system_command="sudo -u xyz /usr/local/bin/mirror.sh {dirbase}"

; Input overrides the default system command.
; 'true' or 'false'
override_system_command=true



[ftp]
; 'true' : (Default) FTP is enabled
; 'false': FTP is disabled, f.e. if FTP is not compiled with PHP.
enable=true

; Default FTP-Port
; Default: '21'
port=21

; Default hostname
;host="ftp.example.com"

; Default path
;path="/path/to/site"

; Login data
; If not specified (default), anonymous login will be used.
;user=agent_smith
;pass=smith
