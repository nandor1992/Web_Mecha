<?php
session_start();

?>
<!-- Header -->
<?php
$title= "Structural Report";
$active=5;
include 'header.php';
include 'worksheet_to_Json.php';
?>

<?php
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db($db_name,$con) or die ("Could not connect to database");
	$id=$_SESSION['id'];
	$worksheetSelected=$_SESSION['firstWorksheet'];

	echo worksheetToJson($worksheetSelected);
?>

<?php
include 'footer.php';
?>