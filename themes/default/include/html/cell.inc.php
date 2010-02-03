<?php $column_idx++; ?><td
#IF-ATTR width#
 width="%width%"
#ELSE#
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
#END-IF#
#IF-ATTR style#
 style="%style%"
#END-IF#
#IF-ATTR class#
 class="%class%"
#ELSE#
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
#END-IF#
#IF-ATTR colspan#
 colspan="%colspan%"
#END-IF#
#IF-ATTR rowspan#
 rowspan="%rowspan%"
#END-IF#
>