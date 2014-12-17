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
	?>
	
	<form action="<?php $_PHP_SELF ?>" method="POST" >
	<?php	       
	   echo"  <br> Report name: 
		            <input type='text' name='report_name'   maxlength='30' style='width:130;'> <br>
		            <br> Comment: 
		            <input type='text' name='comment'  maxlength='100' style='width:330;'> <br><br><br>
		            <input type='submit' name='report_details' value='Generate Report' style='width:130px;float:left' /> <br>
		            </form>";
	if(isset($_POST['report_details']))
		{ echo $_POST['report_name'];
	      echo worksheetToJson($worksheetSelected);
	  }
?>

<?php
include 'footer.php';
?>