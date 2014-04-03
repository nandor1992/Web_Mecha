<?php
session_start();

if ((!isset($_POST['w_name']))||(strlen($_POST['w_name'])<3))
{
header('Location: worksheet.php?error=3');
}
else
{
include 'db_settings.php';
$con = mysql_connect("localhost",$user,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_name,$con) or die ("Could not connect to database");
$w_name=$_POST['w_name'];
$w_type=$_POST['w_type'];
$id=$_SESSION['id'];

$sql="SELECT * FROM `users` WHERE username='".$id."'";
$result=mysql_query($sql) or die("error at results");
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
$row = mysql_fetch_assoc($result);
$u_id=$row['u_id'];
$sql="INSERT INTO `worksheet`(`u_id`, `w_name`, `w_type`) VALUES ($u_id,'$w_name',$w_type)";
$result=mysql_query($sql) or die("error at results");

header('Location: worksheet.php?error=2');
//Useless ??
//$_SESSION['w_type']=$w_type;

}
?>