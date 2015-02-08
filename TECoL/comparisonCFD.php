<?php
session_start();
if (isset($_REQUEST['error']) and $_REQUEST['error']==1) 
{print "<script type=\"text/javascript\">";
print "alert('Please select at least one worksheet')";
print "</script>";   
}
?>
<link rel="stylesheet" href="styles/bootstrap.css" media="screen" type="text/css" />
<!-- Header -->
<?php
$title= "Comparison CFD Report";
$active=5;
define("STR",1);
include 'header.php';
include 'worksheet_ready_for_report.php';
?>
<!-- Main Body -->

	<?php
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db($db_name,$con) or die ("Could not connect to database");
	$id=$_SESSION['id'];
	$worksheetSelected=$_SESSION['firstWorksheet'];
    //echo $worksheetSelected;
	$excludedType=STR;
	if(!isset($_REQUEST['other_w_for_report']))
	{	$type=$_SESSION['typeOfWorksheetForReport'];
		$sql="SELECT * FROM `worksheet` JOIN `users` ON worksheet.u_id = users.u_id  WHERE (username='$id' AND w_id!='$worksheetSelected' AND w_type='$type')";
		$result=mysql_query($sql) or die("Cannot retrieve worksheets");

		$i=0;
		echo "</br><form action='comparisonCFD.php' method='POST' class='bootstrap-frm'>
		<h1>Select Reports for Comparison
					<span>You need to select the reports you want the initial report to be compared to. All of the reports are of the same type as the initial.</span>
				</h1>";
		while($row = mysql_fetch_array($result)) {

			echo "<input type='checkbox' name='other_worksheets[]' value='".$row['w_id']."'> ".$row['w_name']."</br>";
			echo "\r\n";
			$i++;
		}

		if ($i!=0)		
			{echo "</br><label> <span>&nbsp</span> <input type='submit' name='other_w_for_report' class='button' value='Next' /> </label> ";}
		else 
			{header('Location: report.php?error=1');}
		
		?>
	</form>
	<?php 
    }

    else {
    	if (isset($_POST['other_worksheets'])){
    		{   

    		    $ready_for_report=1; //if all worksheets complete this is 1, otherwise 0
    			$other_worksheets = $_POST['other_worksheets'];
    			$_SESSION['otherWorksheets']=$other_worksheets;
    			$no_of_selected_worksheets = count($other_worksheets);

    			for($i=0; $i < $no_of_selected_worksheets; $i++)
    			{  
    				if(worksheetReadyForReport($other_worksheets[$i]) == 0){
						$mystring="report.php?error=2&name=".getWorksheetName($other_worksheets[$i]);
						header("Location: ".$mystring);
    					$ready_for_report=0;
    				}
    			}
    			if($ready_for_report==1){
					
					echo "</br><form action='#'s method='POST' class='bootstrap-frm'>
				<h1>Confirm Report
					<span>You have selected worksheet  <b>".getWorksheetName($_SESSION['firstWorksheet'])."</b> to be compared to <b> ";
					for($i=0; $i < $no_of_selected_worksheets; $i++)
    				 if($i!=$no_of_selected_worksheets-1)
    				    echo getWorksheetName($other_worksheets[$i]).", ";
    				else echo getWorksheetName($other_worksheets[$i]);
					echo "</b></span>
				</h1>";
				echo " <p> You have selected the folliwing worksheets for comparison report: <b>".getWorksheetName($_SESSION['firstWorksheet']).", ";
				for($i=0; $i < $no_of_selected_worksheets; $i++)
    				 if($i!=$no_of_selected_worksheets-1)
    				    echo getWorksheetName($other_worksheets[$i]).", ";
    				else echo getWorksheetName($other_worksheets[$i]);
				echo "</b></p>";
				echo" <p> If these are correct press Confirm to Proceeed</p>";
					echo "<br>
					<a href='generate_comparison_CFD.php' style=' width: 220px;  height: 25px;  background: #4d90fe;  padding: 4 5px;  text-align: center;  border-radius: 6px;  color: #fff; font-size:16px; font-weight: bold; float:left;text-shadow: 0 1px rgba(0,0,0,0.4);'>Confirm</a></br></br>";
					}
					else
					{
					header("Location: report.php?error=3");
					}
					
    		}
    	}
	        
	    else 
		{
		header('Location: comparisonCFD.php?error=1');
		}

}
	
	?>



<!--Footer -->
<?php
include 'footer.php';
?>