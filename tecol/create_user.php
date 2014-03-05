<?php
session_start();
if (!isset($_POST['username']))
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
$username=$_POST['username'];
$first=$_POST['first_name'];
$last=$_POST['last_name'];
$pass=md5($_POST['password']);
$type=1;
$sql="INSERT INTO users(u_type,username,password,first_name,last_name) VALUES('$type','$username','$pass','$first','$last')";
$result=mysql_query($sql);
if($result){
$_SESSION['username']=$first." ".$last;
header('Location: index.php?');
}
else
echo "Error inserting into database, values might not be correct";
?>