<?php
session_start();

?>
<!-- Header -->
<?php
$title= "Comparison CFD Report";
$active=5;
include 'header.php';
require 'cfd_worksheet_to_pdf.php';
include 'worksheet_ready_for_report.php';
?>
<?php
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db($db_name,$con) or die ("Could not connect to database");
	
	$u_id=$_SESSION['u_id'];
	$worksheetSelected=$_SESSION['firstWorksheet'];
	$r_type=$_SESSION['typeOfWorksheetForReport'];

	?>
	
	<form action="<?php $_PHP_SELF ?>" method="POST" >
	<?php	
			$other_worksheets=$_SESSION['otherWorksheets'];
			$no_of_selected_worksheets = count($other_worksheets);

    			echo "<div id='page-title'><h3> Worksheet ".getWorksheetName($_SESSION['firstWorksheet'])." compared to: ";
    			for($i=0; $i < $no_of_selected_worksheets; $i++)
    				 if($i!=$no_of_selected_worksheets-1)
    				    echo getWorksheetName($other_worksheets[$i]).", ";
    				else echo getWorksheetName($other_worksheets[$i]);
    				echo "</div>";

	   echo"  <br> Report name: 
		            <input type='text' name='report_name'   maxlength='30' style='width:130;'> <br>
		            <br> Comment: 
		            <input type='text' name='comment'  maxlength='100' style='width:330;'> <br><br><br>
		            <input type='submit' name='report_details' value='Generate Report' style='width:130px;float:left' /> <br>
		            </form>";
	if(isset($_POST['report_details']))
		{ $time=$_SERVER['REQUEST_TIME'];
	      $date=date('d-m-y H:i:s', $time);
		 $rep_name=$_POST['report_name'];
		  $rep_name = str_replace(' ', '_', $rep_name);
		  $rep_link='reports/'.$u_id.$rep_name.$time.'.pdf';
		  $comment=$_POST['comment'];
		  //generate reports with no of graphs
		  if($r_type==2)
	            cfd1WorksheetToPDF($worksheetSelected, $other_worksheets, $rep_name, $rep_link, $_SESSION['username'], $comment, 5,-1); //question 5 needs graph
	        else if($r_type==4)
	        	 cfd1WorksheetToPDF($worksheetSelected, $other_worksheets, $rep_name, $rep_link, $_SESSION['username'], $comment, 4,-1); //question 4 needs graph
	        	else if($r_type==5)
	        		cfd1WorksheetToPDF($worksheetSelected, $other_worksheets, $rep_name, $rep_link, $_SESSION['username'], $comment, -1,-1); //there is no q -1 so no graph will be generated
	     			else if($r_type==3 || $r_type==6 || $r_type==7)
	     				cfd2WorksheetToPDF($worksheetSelected, $other_worksheets, $rep_name, $rep_link, $_SESSION['username'], $comment, 4,6,-1); //graphs for q 4 and 6
	     
	      $sql="INSERT INTO `generated_reports` ( `u_id`, `rep_name`, `rep_link`, `rep_comment`, `r_type`, `w_date`) VALUES ('$u_id', '$rep_name', '$rep_link', '$comment', '$r_type', '$date')";
         
          if($result=mysql_query($sql))
          	{        	   
               echo "<script>window.open('".$files_loc."/$rep_link')</script>";
			   echo "<script>window.location.href ='report.php'	</script>";

            }
          else echo "<br>Error in generating report";

	  }
?>
<?php
include 'footer.php';
?>