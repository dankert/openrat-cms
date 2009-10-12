; <?php exit('direct access denied') ?>

; Conditional-GET enables the "304 not modified" HTTP-Header
; This is much faster, but sometimes caching is unwanted
; if you have caching problems, set this to 'false'. Default: 'true'
conditional_get=true



; Pages and files are cached in a temporary directory.
; 'false' means generate each page again and again
; 'true'  will cache a page's content. This will improve
;         the performance, but has some side effects,
;         f.e. no dynamic content will be updated.
enable_cache=false



; Directory for temporary files.
; Default=blank (OpenRat uses the system temporary dir)
tmp_dir=