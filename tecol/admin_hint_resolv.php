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
$con = mysql_connect($host,$user,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_name,$con) or die ("Could not connect to database");
$sql="SELECT * FROM `hint` WHERE `h_id`='".$_POST['h_id']."'";
$result=mysql_query($sql) or die("cannot connect 3 ");
if($row=mysql_fetch_assoc($result))
{

if(($_POST['text']=="" )&&($_POST['link']==""))
{
$sql="DELETE FROM `hint` WHERE h_id='".$_POST['h_id']."'";
$result=mysql_query($sql) or die("cannot connect 3a ");
}
else
$sql="UPDATE `hint` SET `hint`='".$_POST['text']."',`hint_link`='".$_POST['link']."'  WHERE h_id='".$_POST['h_id']."'";
$result=mysql_query($sql) or die("cannot connect 3b ");
}
else
{
$sql="INSERT INTO `hint` ( `q_id`, `hint`,`hint_link`) VALUES ('".$_POST['q_id']."','".$_POST['text']."','".$_POST['link']."')";
$result=mysql_query($sql) or die("cannot connect This time ");
}
header('Location: admin_hints.php?error=1');
}
?>