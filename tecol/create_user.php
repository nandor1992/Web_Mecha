<?php
session_start();
if (!isset($_POST['username']))
{
header('Location: index.php?error=3');
}
if ((strlen($_POST['username'])<4)||(strlen($_POST['first_name'])<2)||(strlen($_POST['last_name'])<2)||(strlen($_POST['email'])<2)||(strlen($_POST['password'])<4)||(strlen($_POST['password-confirm'])<4))
{
header('Location: create.php?error=1');
}
else
{
include 'db_settings.php';
$con = mysql_connect($host,$user,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_name,$con) or die ("Could not connect to database");
$username=$_POST['username'];
$first=$_POST['first_name'];
$last=$_POST['last_name'];
$pass=md5($_POST['password']);
$mail=$_POST['email'];
$type=1;
if ($_POST['password']!=$_POST['password-confirm'])
{
   header('Location: create.php?error=3');
}
else
{
$sql="SELECT * FROM `users` WHERE `username`='".$username."'";
$result=mysql_query($sql) or die("cannot connect 3 ");
if (mysql_num_rows($result) != 0) { 
   header('Location: create.php?error=2'); 
}
else
{
$sql="INSERT INTO users(u_type,username,password,email,first_name,last_name) VALUES('$type','$username','$pass','$mail','$first','$last')";
echo $sql;
$result=mysql_query($sql) or die("Error at sql");
if($result){
$_SESSION['username']=$first." ".$last;
$_SESSION['id']=$username;
$sql="SELECT * FROM `users` WHERE username='".$username."'";
$result=mysql_query($sql) or die("Error at sql2");
$row = mysql_fetch_array($result);
$_SESSION['u_id']=$row['u_id'];
header('Location: index.php?');
}
}
}
}
?>