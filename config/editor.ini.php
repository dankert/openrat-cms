; <?php exit('direct access denied') ?>

; Settings for Text Formatting Rules
[text-markup]

; Strong/important text (mostly "bold")
strong-begin = *
strong-end   = *

; Emphatic text (mostly "italic")
emphatic-begin = _
emphatic-end   = _

; Image
image-begin = "{"
image-end   = "}"

; Speech
speech-begin = QUOTE
speech-end   = QUOTE

; text with same width
code-begin = "="
code-end   = "="

; pre-formatted Text
pre-begin = "="
pre-end   = "="

; Inserted Text
insert-begin = ++
insert-end   = ++

; Removed text
remove-begin = --
remove-end   = --

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
quote            = >
quote-line-begin = >
quote-line-end   = >


[html]

; Which HTML-Tag to use for cites
tag_strong_open="strong""

; Which HTML-Tag to use for emphatic text
tag_emphatic=em

; Which HTML-Tag to use for teletyped text
tag_teletype=tt

; Which HTML-Tag to use for cites
tag_speech_="cite"

; OpenRat tries to use a good speech tag. You may override this. 
override_speech=false
override_speech_open=&laquo;
override_speech_close=&raquo;

; HTML-Rendermode
; explains how to handle emtpy elements.
; 'xml'  => <br />, <image src="..." />
; 'sgml' => <br>, <image src="...">
rendermode=sgml
;rendermode=xml

[wiki]

convert_html=true
convert_bbcode=true
