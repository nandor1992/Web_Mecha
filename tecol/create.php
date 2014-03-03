<?php
session_start();
$_SESSION['username']="anyad";
$_SESSION['admin']=1;
header('Location: index.php');
?>