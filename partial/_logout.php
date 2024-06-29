<?php

session_start();
echo "Wait..! logging out...";

session_destroy();
header("Location: /PHP_CWH/forum_web/index.php");

?>