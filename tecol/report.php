
<?php
session_start();

if (isset($_REQUEST['error']) and $_REQUEST['error']==1) 
{print "<script type=\"text/javascript\">";
print "alert('You must have at least two worksheets of the same CFD type to create a Comparison Report')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==2) 
{print "<script type=\"text/javascript\">";
print "alert('The report ".$_REQUEST['name']." is not complete please review your answers')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==3) 
{print "<script type=\"text/javascript\">";
print "alert('The worksheets are not ready for report please review them')";
print "</script>";   
}
?>
 <link rel="stylesheet" href="styles/bootstrap.css" media="screen" type="text/css" />
<!-- Header -->
<?php
$title= "Report - Main Page";
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
	unset($_SESSION['otherWorksheets']);
	
	if(!isset($_REQUEST['worksheet']))
	{	echo "<br>";
		unset($_SESSION['worksheet']);
		unset($_SESSION['firstWorksheet']);
		unset($_SESSION['typeOfWorksheetForReport']);
		$sql="SELECT * FROM `worksheet` JOIN `users` ON worksheet.u_id = users.u_id  WHERE (username='$id') ORDER BY w_type DESC";
		$result=mysql_query($sql) or die("Cannot retrieve worksheets");
		$i=0;

//retine idul worksheetului selectat
?>
<!--<div id="page-title"><h3> Report Generation </h3></div></br></br></br>-->

</br>
<div style='align:left,text-align:left'>
<?php
if (mysql_num_rows($result)!=0)
{
?>
<form action="report.php" method="POST" class="bootstrap-frm">
<h1>Generate Report
        <span>Please select the Worksheet you want to generate a Report After.</span>
    </h1>
	<table style="width:450px;text-align:left'">
					<tr bgcolor='#FFFFFF' style='text-decoration:underline;'>
						<th style='text-align:left' width="30px"></td>
						<th style='text-align:left' >Name</td>
						<th style='text-align:left' width="140px" >Type</td>
					</tr>
<?php 
		while($row = mysql_fetch_array($result)) {
			echo"<tr>";
			echo "<td style='text-align:left'><input type='radio' name='worksheet' value='".$row['w_id']."'></td>";
			echo "<td style='text-align:left'> ".$row['w_name']."</td>";
			switch($row['w_type'])
		  {
		  case 1:$type=" Structural";break;
		  case 2:$type=" CFD1";break;
		  case 3:$type=" CFD2";break;
		  case 4:$type=" CFD3";break;
		  case 5:$type=" CFD4";break;
		  case 6:$type=" CFD5";break;
		  case 7:$type=" CFD1";break;
		  }
			echo "<td style='text-align:left'> ".$type."</td>";
			$i++;
			echo"</tr>";
		}
		echo "</table>";
		if($i!=0)
            		   echo "</br><label> <span>&nbsp</span> <input type='submit' name='Submit' class='button' value='Select' /> </label> ";
        else 
        	echo "You must create a worksheet before being able to generate a report";
			echo "</form>";
			}
			else
			{
			print "<script type=\"text/javascript\">";
			print "alert('To create reports please first fill out at least one Worksheet')";
			print "</script>"; 
			}
		?>
	
	</div>
	<div  class='mybutton'><a href='report_history.php' style='display: block;   height: 25px;   padding-left:340px; text-align: center;  border-radius: 20px;  color: black; font-size:16px; font-weight: bold; float:left;'>Clieck here to view report history</a><br></div></br></br>
	<?php
	
}

else
	{   if (isset($_POST['worksheet'])){
		$_SESSION['w_for_report']=$_REQUEST['worksheet'];
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
				
				 echo "</br><form action='report.php's method='POST' class='bootstrap-frm'>
				<h1>Report Type
					<span>You have selected report <b>" .$worksheet_name."</b> now select what type of report you want to create.</span>
				</h1>";
				echo" <p> The first type of report is <b> Simple</b>. This means that the report generated will only contain the information and Graphs of the single selected report</p></br>";
				echo "
				<a href='simpleCFD.php' style='display: block;  width: 220px;  height: 25px;  background: #4d90fe;  padding: 4 5px;  text-align: center;  border-radius: 6px;  color: #fff; font-size:16px; font-weight: bold; float:left; text-shadow: 0 1px rgba(0,0,0,0.4);'>Simple</a></br></br></br>";
				echo "<p> The second type of report is a <b>Comparison</b> repsort, this mean that you will have the option to select other reports you want to compare your report to and in the end you will end up with a pdf that contains all the information from all the selected worksheets. We suggest that you compare a maximum of 4 reports. Beyond this number the graphs are not so suggestive.</p></br>
				<a href='comparisonCFD.php' style='  width: 220px;  height: 25px;  background: #4d90fe;  padding: 4 5px;  text-align: center;  border-radius: 6px;  color: #fff; font-size:16px; font-weight: bold; float:left;text-shadow: 0 1px rgba(0,0,0,0.4);'>Comparison</a></br></br></br>
				";
				echo"<p> For more informationregarding worksheet the types of reports please consult the Help page where you have a detailed description of the benefits of these types of reports and how to create them in the best possible manner. To do so follow this <a style='color:black' href='help_market_compare.php'>link</a></p>";
				echo "</form>";
			}
			else {
			 echo "</br><form action='report.php's method='POST' class='bootstrap-frm'>
				<h1>Report Selection
					<span>You have selected report <b>" .$worksheet_name."</b> </span>
				</h1>";
				echo" <p> You are generating a report for the type <b> Structured.</b> This type only supports simple comparison reports.Please confirm your selection</p>";
					echo "<br>
					<a href='generate_str.php' style=' width: 220px;  height: 25px;  background: #4d90fe;  padding: 4 5px;  text-align: center;  border-radius: 6px;  color: #fff; font-size:16px; font-weight: bold; float:left;text-shadow: 0 1px rgba(0,0,0,0.4);'>Confirm</a></br></br>";
				
					
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
