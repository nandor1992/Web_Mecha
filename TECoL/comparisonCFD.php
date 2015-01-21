<?php
session_start();

?>
<!-- Header -->
<?php
$title= "Comparison CFD Report";
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
	$worksheetSelected=$_SESSION['firstWorksheet'];
    //echo $worksheetSelected;
	$excludedType=STR;
	if(!isset($_REQUEST['other_w_for_report']))
	{	$type=$_SESSION['typeOfWorksheetForReport'];
		$sql="SELECT * FROM `worksheet` JOIN `users` ON worksheet.u_id = users.u_id  WHERE (username='$id' AND w_id!='$worksheetSelected' AND w_type='$type')";
		$result=mysql_query($sql) or die("Cannot retrieve worksheets");

		echo "<div style='text-align:center; width:500px'> 
		<div id='page-title'><h3> Select the worksheets for comparison</h3></div>
		</br>";
		$i=0;
		while($row = mysql_fetch_array($result)) {

			echo "<input type='checkbox' name='other_worksheets[]' value='".$row['w_id']."'>".$row['w_name']."</br>";
			echo "\r\n";
			$i++;
		}

		if ($i!=0) 
			echo "<input type='submit' name='other_w_for_report' value='Next' > ";
		else 
			echo "<font color='red'>You must create minimum two CFD worksheets before being able to generate a comparison report</font>";
		
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

    			echo "<div id='page-title'><h3> Worksheet ".getWorksheetName($_SESSION['firstWorksheet'])." compared to: ";
    			for($i=0; $i < $no_of_selected_worksheets; $i++)
    				 if($i!=$no_of_selected_worksheets-1)
    				    echo getWorksheetName($other_worksheets[$i]).", ";
    				else echo getWorksheetName($other_worksheets[$i]);
    			echo "</h3></div><br>";
    			for($i=0; $i < $no_of_selected_worksheets; $i++)
    			{  
    				if(worksheetReadyForReport($other_worksheets[$i]) == 0){
    					echo "<font color='red'>Worksheet ";
    					echo getWorksheetName($other_worksheets[$i])." ";
    					echo "is incomplete. Please revise your answers <br></font>";
    					$ready_for_report=0;
    				}
    			}
    			if($ready_for_report==1)
    				echo "<a href='generate_comparison_CFD.php' style='display: block;  width: 220px;  height: 25px;  background: #DCDCDC;  padding: 10px;  text-align: center;  border-radius: 20px; color: black; font-size:16px; font-weight: bold; float:center;'>Generate</a>";
    		}
    	}
	        
	    else echo "<font color='red'>Please select at least one worksheet</font>";

}
	
	?>



<!--Footer -->
<?php
include 'footer.php';
?>