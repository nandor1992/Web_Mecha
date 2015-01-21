<?php
session_start();
if (!isset($_SESSION['u_id'])|| !isset($_POST['rep_id']))
{
   header('Location: report_history.php');
}
include 'db_settings.php';
$con = mysql_connect($host,$user,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_name,$con) or die ("Could not connect to database");
$rep_id=$_POST['rep_id'];
echo $rep_id;

//delete from server --- not working
/*
$sql2="SELECT rep_link FROM generated_reports WHERE rep_id='".$rep_id."'";
$result2=mysql_query($sql2) or die("sleep ");
$row2=mysql_fetch_assoc($result2);
$rep_link=$row2['rep_link'];
echo $rep_link; */

$sql="DELETE FROM `generated_reports` WHERE rep_id='$rep_id'";
$result=mysql_query($sql) or die("cannot connect 2 ");

//delete from server
/*
$base_directory = 'C:/xampp/htdocs/TECoL/reports';
$name = explode("/", $rep_link);
echo $name[1];
if(unlink($base_directory.$_GET[$name[1]]))
    echo "File Deleted.";*/
header('Location: report_history.php'); 

?>
