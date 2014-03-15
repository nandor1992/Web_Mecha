<?php
session_start();
if (!isset($_SESSION['id'])||!isset($_POST['worksheet']))
{
header('Location: index.php?error=3');
}
include 'db_settings.php';
$con = mysql_connect("localhost",$user,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_name,$con) or die ("Could not connect to database");
$worksheet=$_POST['worksheet'];

$sql="DELETE FROM `worksheet` WHERE w_id=".$worksheet;
$result=mysql_query($sql) or die("cannot connect 2 ");

$sql="DELETE FROM `answers` WHERE w_id=".$worksheet;
$result=mysql_query($sql) or die("cannot connect 3 ");

$sql="DELETE FROM `answers` WHERE w_id=".$worksheet;
$result=mysql_query($sql) or die("cannot connect 4 ");

$sql="DELETE FROM `answers` WHERE w_id=".$worksheet;
$result=mysql_query($sql) or die("cannot connect 5 ");

header('Location: worksheet.php?error=1');

?>
