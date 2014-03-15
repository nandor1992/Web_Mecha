<?php
include 'db_settings.php';
session_start();
$con = mysql_connect("localhost",$user,$password);
					if (!$con)
					{
					die('Could not connect: ' . mysql_error());
						}
					mysql_select_db($db_name,$con) or die ("Could not connect to database");

if (!isset($_POST['Submit']))
{
header('Location: index.php?error=3');
}
switch ($_POST['Submit'])
{
case 'Save Question':
if (strlen($_POST['question'])<4)
{
header('Location: admin_questions.php?error=1');
}
else{
$sql="INSERT INTO `questions`(`w_type`, `question`) VALUES ('".$_POST['w_type']."','".$_POST['question']."')";
$result=mysql_query($sql) or die("cannot connect 3 ");
header('Location: admin_questions.php?error=2');
}
break;

case 'Save Variable':
if (strlen($_POST['q_name'])<1||strlen($_POST['q_text'])<2)
{
header('Location: admin_questions.php?error=1');
}
else{
$sql="INSERT INTO `variable`(`q_id`, `var_name`, `var_text`, `var_type`) VALUES ('".$_POST['q_type']."','".$_POST['q_name']."','".$_POST['q_text']."','".$_POST['v_type']."')";
$result=mysql_query($sql) or die("cannot connect 3 ");
header('Location: admin_questions.php?error=3');
}
break;

}
?>
