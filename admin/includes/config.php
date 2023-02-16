<?php
session_start();
if (strlen($_SESSION['login']) == 0) {
   header('location:index.php');
   exit;
}
include_once('../includes/config.php');
?>