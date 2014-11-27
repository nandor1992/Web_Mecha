<?php
include 'db_settings.php';
session_start();
$con = mysql_connect($host,$user,$password);
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

case 'Modify Question':
if (strlen($_POST['text'])<3)
{
header('Location: admin_questions.php?error=1');
}
else{
$sql="UPDATE `questions` SET `question`='".$_POST['text']."' WHERE `q_id`='".$_POST['q_id']."'";
$result=mysql_query($sql) or die("cannot connect 4 ");
header('Location: admin_questions.php?error=4');
}
break;

case 'Modify Variable':
if (strlen($_POST['text'])<3)
{
header('Location: admin_questions.php?error=1');
}
else{
$sql="UPDATE `variable` SET `var_text`='".$_POST['text']."' WHERE `var_id`='".$_POST['var_id']."'";
$result=mysql_query($sql) or die("cannot connect 5 ");
header('Location: admin_questions.php?error=5');
}
break;

}
?>
