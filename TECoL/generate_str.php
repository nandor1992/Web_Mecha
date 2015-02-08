<?php
session_start();

?>
<link rel="stylesheet" href="styles/bootstrap.css" media="screen" type="text/css" />
<!-- Header -->
<?php
$title= "Structural Report";
$active=5;
include 'header.php';
include 'strWorksheet_to_pdf.php';

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
					
	echo "</br><form action='generate_str.php' method='POST' class='bootstrap-frm'>
				<h1>Complete Report
					<span>Give your report a name and if you have any comments/observations regarding any part of the report please add them.</span>
				</h1>";
		echo "<label>
        <span>Report Name :</span>
        <input  style='height:30px' id='name' type='text' name='report_name' placeholder='Insert a name for your report' />
		</label>";
		echo "<label>
        <span>Comment :</span>
        <input style='height:30px' id='name' type='text' name='comment' placeholder='Insert a comment for your report' />
		</label>";
		
		echo" <label>
        <span>&nbsp;</span>
        <input type='submit' name='report_details' class='button' value='Finish Report' />
    </label> ";
		
				
		echo "</form>";				
	if(isset($_POST['report_details']))
		{ $time=$_SERVER['REQUEST_TIME'];
	      $date=date('d-m-y H:i:s', $time);
		  $rep_name=$_POST['report_name'];
		  $rep_name = str_replace(' ', '_', $rep_name);
		  $rep_link='reports/'.$u_id.$rep_name.$time.'.pdf';
		  $comment=$_POST['comment'];
	      strWorksheetToPDF($worksheetSelected, $rep_name, $rep_link, $_SESSION['username'], $comment);
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