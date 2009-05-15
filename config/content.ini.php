; <?php exit('direct access denied') ?>


[file]

; Maximum file size for uploads in KB
; 0,-1 = not restricted
max_file_size=1500



[revision-limit]

; This is your delete-strategy of old content.

; Values are deleted, if
; a) max-age and min-revisions are reached OR
; b) max-revisions and min-age are reached

; max age of values (days)
max-age = 120
; min age of values (days)
min-age = 1

; number of revisions
max-revisions = 100
min-revisions = 3



[language]

; If a text is empty, try using the default language
; Default: true
use_default_language = true
