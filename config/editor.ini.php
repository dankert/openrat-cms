; <?php exit('direct access denied') ?>

; Settings for Text Formatting Rules
[text-markup]

; Strong/important text (mostly "bold")
strong-begin = "*"
strong-end   = "*"

; Emphatic text (mostly "italic")
emphatic-begin = "_"
emphatic-end   = "_"

; Image
image-begin = "{"
image-end   = "}"

; Speech
speech-begin = QUOTE
speech-end   = QUOTE

; text with same width
code-begin = "="
code-end   = "="

; footnotes
footnote-begin = "["
footnote-end   = "]"

; pre-formatted Text
pre-begin = "="
pre-end   = "="

; Inserted Text
insert-begin = "++"
insert-end   = "++"

; Removed text
remove-begin = "--"
remove-end   = "--"

; Separator for a definition item
definition-sep = "::"

; Indenting headline
headline       = "+"

; Underlining of headline level 1
headline_level1_underline = "="

; Underlining of headline level 2
headline_level2_underline = "-"

; Underlining of headline level 3
headline_level3_underline = "."

; Unnumbered Listentry
list-unnumbered = "-"

; Numbered Listentry
list-numbered   = "#"

; Table of content
table-of-content= "##TOC##"

; Link to
linkto          = "->"

; Table cell separator
table-cell-sep  = "|"

style-begin = "'"
style-end   = "'"

; Quote Text
quote            = ">"
quote-line-begin = ">"
quote-line-end   = ">"

; Makro
makro-begin = "$$"
makro-end   = "$$"

[html]

; Which HTML-Tag to use for cites
tag_strong = "strong"

; Which HTML-Tag to use for emphatic text
tag_emphatic = "em"

; Which HTML-Tag to use for teletyped text
tag_teletype = "tt"

; Which HTML-Tag to use for cites
tag_speech = "cite"

; OpenRat tries to use a good speech tag. You may override this. 
override_speech = false
override_speech_open  = "&laquo;"
override_speech_close = "&raquo;"

; HTML-Rendermode
; explains how to handle emtpy elements.
; 'xml'  => <br />, <image src="..." />
; 'sgml' => <br>, <image src="...">
rendermode=sgml
;rendermode=xml

replace = "EUR:&euro; �:&Auml; �:&auml; �:&Ouml; �:&ouml; �:&Uuml; �:&uuml; �:&szlig; (c):&copy; (r):&reg; ^1:&sup1; ^2:&sup2; ^3:&sup3; 1/4:&frac14; 1/2:&frac12; 3/4:&frac34;"



[wiki]

convert_html=true
convert_bbcode=true



; Settings for text/plain-documents
[text]

; maximum line length
linelength=70



; Calendar settings
[calendar]

; Weekday-Offset: Ho many days a week begins after Sunday. 
; 0 = Week begins with Sunday (America, Australia, Islam)
; 1 = Week begins with Monday (ISO-8601, Europe)
weekday_offset=1


[text]
linelength=70
