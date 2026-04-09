<?php
session_start();

$uname = $_POST['username'];
$_SESSION['uname'] = $uname;

header('Location: ../verif.php');
?>