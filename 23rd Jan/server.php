<?php

echo $_SERVER['SCRIPT_NAME'];
echo "<br>".$_SERVER['HTTP_HOST'];
echo "<br>".$_SERVER['REMOTE_ADDR'];
echo "<pre>";
//print_r($_SERVER);
print_r(get_browser(null,true));
?>