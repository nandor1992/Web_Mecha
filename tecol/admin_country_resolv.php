<?php
include 'db_settings.php';
session_start();
if (!isset($_POST['Submit']))
{
header('Location: index.php?error=3');
}

if (strlen($_POST['country'])<4)
{
header('Location: admin_country.php?error=3');
}
else{

$con = mysql_connect($host,$user,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_name,$con) or die ("Could not connect to database");


switch ($_POST['Submit'])
{
case 'Insert':
$sql="INSERT INTO `countries`(`country`) VALUES ('".$_POST['country']."')";
$result=mysql_query($sql) or die("cannot connect 3 ");
header('Location: admin_country.php?error=1');
break;


case 'Remove Country':
$sql="DELETE FROM `countries` WHERE q_id='".$_POST['q_id']."'";
$result=mysql_query($sql) or die("cannot connect del country ");

header('Location: admin_country.php?error=2');
break;
}}
?>