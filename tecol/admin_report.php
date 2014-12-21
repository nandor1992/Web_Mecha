<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
if (!isset($_SESSION['username'])||!isset($_SESSION['admin']))
{
header('Location: index.php?error=2');
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==1) 
{print "<script type=\"text/javascript\">";
print "alert('Text Modified')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==2) 
{print "<script type=\"text/javascript\">";
print "alert('Please enter Text to the specific are if you want to modify it')";
print "</script>";   
}
?><!-- Header -->
<?php
$title= "Administrator";
$active=4;
include 'header.php';
?>
<!-- Main Body -->
		
		<!---- This is where it all begins -->
		<div style='width:970px;float:left'>
          <div id="page-title"><h3>Generated Reports </h3></div>
          <img src="css/images/highlight.gif" alt="" class="right" />
		  <div style='width:970px;float:left;padding:10px'>
		  <fieldset >
				<legend style='font-size:15px'>Text List</legend>
				<table style="width:950px;font-size:12px">
					<tr bgcolor='#FFFFFF' style='text-decoration:underline;'>
						<th width="100px">User</td>
						<th width="120px">Report Name</td>
						<th width="75px">Report Type</td>
						<th >Comment</td>
						<th width="150px">Date Created</td>
						<th width="140px" >Link</td>
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
					
					//selecting users
					
					$q="SELECT * FROM `generated_reports` JOIN `users` ON generated_reports.u_id=users.u_id ";
					$result=mysql_query($q);
					if (!$result) {
						die('Invalid query: ' . mysql_error());
							}
					while($row = mysql_fetch_assoc($result))
					{
					echo "<tr bgcolor='#92CD00' style='text-align:center'>";
					echo "<td>".$row['first_name']." ".$row['last_name']."</td>";
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
					echo "<td>".$row['rep_comment']."</td>";
					echo "<td>".$row['w_date']."</td>";
					echo "<td>
							<form style='text-align:center;float:left' method='post' action='".$row['rep_link'];
							echo "'><input type='submit' name='Submit' value='View' style='width:130px' />
							</form>";
					}
					
					?>
		</table> 
			</fieldset>
			
		  </div>
		  </div>
         
	<!-- Footer -->

<?php
include 'footer.php';
?>