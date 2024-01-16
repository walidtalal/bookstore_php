<?php include "../includes/header.php"?>

<?php

session_start();
session_unset();
session_destroy();

header("location: ".APPURL."");
exit();