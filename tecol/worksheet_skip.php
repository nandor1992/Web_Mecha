<?php
session_start();
//test
if (!isset($_SESSION['id'])||!isset($_POST['question']))
{
header('Location: index.php?error=3');
}
//basic db connection
include 'db_settings.php';
$con = mysql_connect($host,$user,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_name,$con) or die ("Could not connect to database");
//initialize known variables
$worksheet=$_POST['worksheet'];
$question=$_POST['question'];
//loking if we have any answered variables
$sql="SELECT * FROM `variable` WHERE `q_id`=".$question;
$result=mysql_query($sql) or die("cannot connect 2 ");
while($row = mysql_fetch_assoc($result))
{
echo $row['var_id'];
$sql="SELECT * FROM `answers` WHERE q_id=".$question." AND w_id=".$worksheet." AND var_id=".$row['var_id'];
$result2=mysql_query($sql) or die("cannot connect 3 ");
$row2 = mysql_fetch_assoc($result2);
if(isset($row2['a_id']))
{
echo "Update";
$sql="UPDATE `answers` SET `skip`=1,`answer`='' WHERE `a_id`=".$row2['a_id'];
$result2=mysql_query($sql) or die("cannot connect 4 ");
}
else
{
echo "Insert";
$var=$row['var_id'];
$sql="INSERT INTO `answers`( `q_id`, `w_id`, `var_id`, `skip`) VALUES ('$question','$worksheet','$var',1)";
$result2=mysql_query($sql) or die("cannot connect 4 ");

}
}

header('Location: worksheet_detailed.php');

?>