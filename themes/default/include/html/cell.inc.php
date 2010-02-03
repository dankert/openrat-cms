<?php $column_idx++; ?><td
#IF-ATTR width#
 width="%width%"
#ELSE#
 width="<?php if (!empty($column_widths)) echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
#END-IF#
#IF-ATTR style#
 style="%style%"
#END-IF#
#IF-ATTR class#
 class="%class%"
#ELSE#
 class="<?php if (!empty($column_classes)) echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
#END-IF#
#IF-ATTR colspan#
 colspan="%colspan%"
#END-IF#
#IF-ATTR rowspan#
 rowspan="%rowspan%"
#END-IF#
>