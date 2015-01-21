	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<?php
	session_start();
	if (!isset($_SESSION['username']))
	{
		header('Location: index.php?error=1');
	}


     if (isset($_REQUEST['error']) and $_REQUEST['error']==1) 
     {print "<script type=\"text/javascript\">";
      print "alert('Report Deleted!')";
      print "</script>";   
}
	?>
	<!-- Header -->
	<?php
	$title= "Worksheet";
	$style=2;
	include 'header.php';
	?>

	<!-- Main Body -->
	<div id="page-title"><h3>Reports </h3></div>
	<fieldset >
		<legend style='font-size:15px'>CFD Worksheets</legend>
		<table style="width:950px;font-size:12px">
			<tr bgcolor='#FFFFFF' style='text-decoration:underline;'>
				<th width="70px">Nr.</td>
					<th >Name</td>
						<th width="100px" >Type</td>
							<th width="200px" >Creation Date</td>
								<th width="150px" >Operations</td>
								</tr>
								<?php
						//initial db connection
								include 'db_settings.php';
								$con = mysql_connect($host,$user,$password);
								if (!$con)
								{
									die('Could not connect: ' . mysql_error());
								}
								mysql_select_db($db_name,$con) or die ("Could not connect to database");

								$u_id=$_SESSION['u_id'];
								$sql="SELECT * FROM `generated_reports` WHERE (u_id='$u_id')";
	$i=0;//for array length		  
	$result=mysql_query($sql) or die("cannot connect 2 ");
	while($row = mysql_fetch_array($result)) {
		unset($_SESSION['reportToDelete']);
		$_SESSION['reportToDelete']=$row['rep_link'];
		echo "<tr bgcolor='#4169E1' style='text-align:center'>";
		$i++;
		echo "<td>".$i."</td>";
		echo "<td>".$row['rep_name']."</td>";
		echo "<td>";
		switch($row['r_type'])
		{
			case 1:echo" Structural";break;
			case 2:echo" CFD1";break;
			case 3:echo" CFD2";break;
			case 4:echo" CFD3";break;
			case 5:echo" CFD4";break;
			case 6:echo" CFD5";break;
			case 7:echo" CFD1";break;
		}
		echo "</td>";
		echo "<td>".$row['w_date']."</td>";
		echo "<td>
		<form action='open_report.php' method='post' style='float:left;padding-right:5px'>
		<input type='hidden' name='rep_link' id='rep_link' value=".$row['rep_link'].">
		<input type='submit' name='Submit' value='Open' />
		</form>
		<form action='report_delete.php' method='post' style='float:left' onSubmit=\"if(!confirm('Are you sure you want to delete the Report?')){return false;}\">
	    <input type='hidden' name='rep_id' id='rep_id' value=".$row['rep_id'].">
		<input type='submit' name='Submit' value='Delete' />
		</form>
		</td>";
	}
	echo "</tr>";
	?>			
	</table> 
	<?php
	include 'footer.php';
	?>
