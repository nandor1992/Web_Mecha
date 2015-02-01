<?php
session_start();

?>
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