<?php
date_default_timezone_set("Asia/Kolkata");
echo date_default_timezone_get();
echo "<br>".date("d m Y h:i:s",time());
echo "<br>".date("d m Y h:i:s",time()+strtotime("+1 month"));



?>