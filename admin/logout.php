<?php
//encerra
include("includes/config.php");
$_SESSION['login'] = "";
session_unset();
session_destroy();
header('Location:index.php');
?>