<?php
include 'db_settings.php';
session_start();
if (!isset($_POST['Submit']))
{
header('Location: index.php?error=3');
}
if ($_POST['Submit']=='Display')
{
$_SESSION['hint']=$_POST['w_type'];
header('Location: admin_hints.php');
}
else
{
$con = mysql_connect("localhost",$user,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_name,$con) or die ("Could not connect to database");
$sql="SELECT * FROM `hint` WHERE `h_id`='".$_POST['h_id']."'";
$result=mysql_query($sql) or die("cannot connect 3 ");
if($row=mysql_fetch_assoc($result))
{
$sql="UPDATE `hint` SET `hint`='".$_POST['text']."' WHERE h_id='".$_POST['h_id']."'";
$result=mysql_query($sql) or die("cannot connect 3 ");
}
else
{
$sql="INSERT INTO `hint` ( `q_id`, `country_id`, `hint`) VALUES ('".$_POST['q_id']."','".$_POST['country']."','".$_POST['text']."')";
$result=mysql_query($sql) or die("cannot connect This time ");
}
header('Location: admin_hints.php?error=1');
}
?>