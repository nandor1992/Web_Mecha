<?php
session_start();

?>
<!-- Header -->
<?php
$title= "Simple CFD Report";
$active=5;
define("STR",1);
include 'header.php';
include 'worksheet_ready_for_report.php';
?>

<?php
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db($db_name,$con) or die ("Could not connect to database");
	$id=$_SESSION['id'];
	$worksheetSelected=$_SESSION['firstWorksheet'];
	echo "<h2>You have selected worksheet ".getWorksheetName($worksheetSelected)."</h2><br>";
	echo "<a href='generate_simple_CFD.php' style='display: block;  width: 220px;  height: 25px;  background: #DCDCDC;  padding: 10px;  text-align: center;  border-radius: 20px; color: black; font-size:16px; font-weight: bold; float:center;'>Generate</a>";
				
?>

<!--Footer -->
<?php
include 'footer.php';
?>