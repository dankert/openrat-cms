<?php

include('../util/Password.class.php');
?>

<p>
<?php
echo "Hash: ".Password::hash("wtf");
?>
</p>


<p>
<?php
echo "Check: ".Password::check("wtf",'$2y$10$LNY2qCb9elkMe/ITN09cB.6t5QqDzm9Uh9h/LV1I');

echo "Check: ".Password::check("wtf",'aadce520e20c2899f4ced228a79a3083');


?>
</p>