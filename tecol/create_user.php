<?php
session_start();
if (!isset($_POST['username']))
{
header('Location: index.php?error=3');
}
if ((strlen($_POST['username'])<4)||(strlen($_POST['first_name'])<2)||(strlen($_POST['last_name'])<2)||(strlen($_POST['password'])<4))
{
header('Location: create.php?error=1');
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
$username=$_POST['username'];
$first=$_POST['first_name'];
$last=$_POST['last_name'];
$pass=md5($_POST['password']);
$type=1;
$sql="INSERT INTO users(u_type,username,password,first_name,last_name) VALUES('$type','$username','$pass','$first','$last')";
$result=mysql_query($sql);
if($result){
$_SESSION['username']=$first." ".$last;
$_SESSION['id']=$username;
header('Location: index.php?');
}
}
?>