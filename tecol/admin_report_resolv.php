<?php
include 'db_settings.php';
session_start();
if (!isset($_POST['Submit']))
{
header('Location: index.php?error=3');
}

if (strlen($_POST['text'])<2)
{
header('Location: admin_report.php?error=2');
}
else{

$con = mysql_connect("localhost",$user,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_name,$con) or die ("Could not connect to database");

$sql="UPDATE `report_text` SET `text`='".$_POST['text']."' WHERE t_id='".$_POST['t_id']."'";
$result=mysql_query($sql) or die("cannot connect 3 ");
header('Location: admin_report.php?error=1');
break;
}
?>