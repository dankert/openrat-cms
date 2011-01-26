; <?php exit('direct access denied') ?>

; Theme compiler.
; These settings are only useful for developers!
[compiler]

; Enable the Template Compiler
; files under themes/default/pages must be writable.
; default=false
enable=false

; Only compile, if the file under themes/default/templates is changed.
; default=true
cache=true

; Do a CHMOD on a written file.
; default=
chmod=

; Compile ALL templates at logout
; (only useful while developing)
; default=false
compile_at_logout=true

; Compile ALL templates to temporary directory
; only useful while developing! Not for production use.
; default:false 
compile_to_tmp_dir=false
