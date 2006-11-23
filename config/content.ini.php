; <?php exit('direct access denied') ?>



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

