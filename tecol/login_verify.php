<?php
//echo $_POST['username'];
//echo $_POST['password'];
include 'db_settings.php';
session_start();
if (!isset($_POST['username']))
{
header('Location: index.php?error=3');
}
$con = mysql_connect("localhost",$user,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_name,$con) or die ("Could not connect to database");
$username= $_POST['username'];
$password= $_POST['password'];
$q="SELECT *
                      FROM users
                      WHERE username = '".mysql_real_escape_string($username)."'
                      AND password = '".mysql_real_escape_string(md5($password))."'";
$result=mysql_query($q);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
$row = mysql_fetch_assoc($result);
$num_results = mysql_num_rows($result); 
if ($num_results > 0){
$_SESSION['username']=$row['first_name']." ".$row['last_name'];
if ($row['u_type']==2)
{
$_SESSION['admin']=1;
}
header('Location: index.php');
}else{
header('Location: login.php?error=1');
} 
?>