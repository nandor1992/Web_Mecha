<?php
include 'db_settings.php';
session_start();
if (!isset($_POST['user_id']))
{
header('Location: index.php?error=3');
}
$con = mysql_connect($host,$user,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_name,$con) or die ("Could not connect to database");


switch ($_POST['Submit'])
{
case 'Remove as Admin':
$sql="UPDATE `users` SET `u_type`=1 WHERE u_id='".$_POST['user_id']."'";
$result=mysql_query($sql) or die("cannot connect 3 ");
header('Location: admin_user.php?error=2');
break;

case 'Upgrade as Admin':
$sql="UPDATE `users` SET `u_type`=2 WHERE u_id='".$_POST['user_id']."'";
$result=mysql_query($sql) or die("cannot connect 3 ");
header('Location: admin_user.php?error=1');
break;

case 'Remove User':
$sql="DELETE FROM `users` WHERE u_id='".$_POST['user_id']."'";
$result=mysql_query($sql) or die("cannot connect del user ");
$sql="SELECT * FROM `worksheet` WHERE u_id='".$_POST['user_id']."'";
$result=mysql_query($sql) or die("cannot connect del worksheet ");
while ($row=mysql_fetch_assoc($result))
{
$sql="DELETE FROM `answers` WHERE w_id='".$row['w_id']."'";
$result=mysql_query($sql) or die("cannot connect del answers ");
}
$sql="DELETE FROM `worksheet` WHERE u_id='".$_POST['user_id']."'";
$result2=mysql_query($sql) or die("cannot connect del worksheet ");
header('Location: admin_user.php?error=3');
break;
}
?>