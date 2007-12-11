; <?php exit('direct access denied') ?>

; Conditional-GET enables the "304 not modified" HTTP-Header
; This is much faster, but sometimes caching is unwanted
; if you have caching problems, set this to 'false'. Default: 'true'
conditional_get=true



; Pages and files are cached in a temporary directory.
; Leave this to "true", as it will improve the performance.
enable_cache=true



; Directory for temporary files.
; Default=blank (OpenRat uses the system temporary dir)
tmp_dir=