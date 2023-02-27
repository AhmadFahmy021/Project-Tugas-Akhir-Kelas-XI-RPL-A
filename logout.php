<?php

session_start();
session_reset();
session_unset();
session_destroy();

setcookie('id', '', time()- 36000);
setcookie('key','',time()-3600);

$_SESSION = [];
header("Location: index.php");
exit;
