<?php
// Wenn Eingabefehler vorhanden, dann den Fokus auf das Fehlerfeld setzen.
if (isset($errors[0])) $attr_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $attr_field ?>.focus();
document.forms[0].<?php echo $attr_field ?>.select(); // --></script>