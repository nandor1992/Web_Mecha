
<?php
session_start();

?>
<!-- Header -->
<?php
$title= "Report - Main Page";
$active=5;
define("STR",1);
include 'header.php';
include 'worksheet_ready_for_report.php';
?>
<!-- Main Body -->
<form action="<?php $_PHP_SELF ?>" method="POST">
	<?php
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db($db_name,$con) or die ("Could not connect to database");
	$id=$_SESSION['id'];
	unset($_SESSION['otherWorksheets']);
	
	if(!isset($_REQUEST['w_for_report']))
	{	echo "<a href='report_history.php' style='display: block;   height: 25px;   text-align: center;  border-radius: 20px;  color: black; font-size:16px; font-weight: bold; float:left;'>Click here to view report history</a><br><br>";
		unset($_SESSION['w_for_report']);
		unset($_SESSION['firstWorksheet']);
		unset($_SESSION['typeOfWorksheetForReport']);
		$sql="SELECT * FROM `worksheet` JOIN `users` ON worksheet.u_id = users.u_id  WHERE (username='$id')";
		$result=mysql_query($sql) or die("Cannot retrieve worksheets");

		echo "<div style='text-align:center; width:500px'> 
		<div id='page-title'><h3> Select the worksheet from which you want the report</h3></div>
		</br>";
		$i=0;

//retine idul worksheetului selectat
		
		while($row = mysql_fetch_array($result)) {

			echo "<input type='radio' name='worksheet' value='".$row['w_id']."'>".$row['w_name']."</br>";
			echo "\r\n";
			$i++;
		}
		if($i!=0)
            echo "<input type='submit' name='w_for_report' value='Next' > ";
        else 
        	echo "You must create a worksheet before being able to generate a report";
			
		?>
		
	</form>

	<?php
	
}

else
	{   if (isset($_POST['worksheet'])){
		$_SESSION['w_for_report']=$_REQUEST['w_for_report'];
		$_SESSION['firstWorksheet']=$_POST['worksheet'];
		$sql="SELECT w_name, w_type FROM `worksheet` WHERE w_id='".$_POST['worksheet']."'";
		$result=mysql_query($sql);
		while ($row = mysql_fetch_assoc($result)) 
		{
			$worksheet_name=$row['w_name'];
			$worksheet_type=$row['w_type'];
			$_SESSION['typeOfWorksheetForReport']=$worksheet_type;
		}

		//echo "<div id='page-title'><h3> You have selected " .$worksheet_name."</h3></div>";
		//</br>";

		$worksheet_ready=worksheetReadyForReport($_POST['worksheet']);

		if($worksheet_ready==1)
		{
			if($worksheet_type!=STR){
				
				echo "<div id='page-title'><h3> You have selected " .$worksheet_name." Select your report type<br><br></h3></div>
				
				<a href='simpleCFD.php' style='display: block;  width: 220px;  height: 25px;  background: #DCDCDC;  padding: 10px;  text-align: center;  border-radius: 20px;  color: black; font-size:16px; font-weight: bold; float:left;'>simple</a>
				<a href='comparisonCFD.php' style='display: block;  width: 220px;  height: 25px;  background: #DCDCDC;  padding: 10px;  text-align: center;  border-radius: 20px; color: black; font-size:16px; font-weight: bold; float:left;'>comparison</a>
				";

			}
			else {
					echo "<br><a href='generate_str.php' style='display: block;  width: 220px;  height: 25px;  background: #DCDCDC;  padding: 10px;  text-align: center;  border-radius: 20px;  color: black; font-size:16px; font-weight: bold; float:50;'>Confirm</a>";
				
					
				/*	?>
					<form action="generate_str.php" method='post' >
		            <br> Insert Report name:  
		  
		            <input type='text' name='report_name' id='report_name'  maxlength='30' style='width:130;'> <br>
		            <input type='submit' name='Submit' value='Generate' style='width:130px;float:left' /> <br>
		            </form>
		            <?php */
					
		}
		}
		else { 
			//echo "<font color='red'>The worksheet you selected is incomplete, please revise your answers</font>";
			unset($_SESSION['w_for_report']);
			echo "<script>
			alert('The worksheet you selected is incomplete, please revise your answers!')
			window.location.href ='report.php';
			</script>";  
		}
	}

	else 
	{
	//echo "<font color='red'>Please select a worksheet</font>";
	unset($_SESSION['w_for_report']);
			echo "<script>
			alert('Please select a worksheet')
			window.location.href ='report.php';
			</script>"; 
	}
}
?>
<!-- Footer -->

<?php
include 'footer.php';
?>
