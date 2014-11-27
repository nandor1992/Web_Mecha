<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
if (!isset($_SESSION['username'])||!isset($_SESSION['admin']))
{
header('Location: index.php?error=2');
}
?>
<!-- Header -->
<?php
$title= "Administrator";
$active=4;
include 'header.php';
?>
<!-- Main Body -->
		
		<div style='width:900px;float:left'>
          <h3> Administrator page to view Worksheets </h3>
          <img src="css/images/highlight.gif" alt="" class="right" />
		  <div style='width:900px;float:left;padding:10px'>
		  
		  <fieldset >
				<legend style='font-size:15px'>Worksheet list sorted for users</legend>
				<table style="width:890px;font-size:12px">
					<tr bgcolor='#FFFFFF' style='text-decoration:underline;'>
						<th width="180px">Username</td>
						<th >Worksheet Name</td>
						<th width="120px">Worksheet Type</td>
						<th width="130px" >Operation</td>
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
					
					$q="SELECT * FROM `worksheet` WHERE 1 order by u_id";
					$result=mysql_query($q);
					if (!$result) {
						die('Invalid query: ' . mysql_error());
							}
					while($row = mysql_fetch_assoc($result))
					{
					echo "<tr bgcolor='#C0C0C0' style='text-align:center'>";
					$q2="SELECT * FROM `users` WHERE u_id='".$row['u_id']."'";
					$result2=mysql_query($q2) or die("This user search died");
					$row2 = mysql_fetch_assoc($result2);
					echo "<td>".$row2['first_name']." ".$row2['last_name']."</td>";
					echo "<td>".$row['w_name']."</td>";
					switch($row['w_type'])
					{
					case '1':
					echo "<td>Structural</td>";
					break;
					case '2':
					echo "<td>CFD1</td>";
					break;
					case '3':
					echo "<td>CFD2</td>";
					break;
					case '4':
					echo "<td>CFD3</td>";
					break;
					case '5':
					echo "<td>CFD4</td>";
					break;
					case '6':
					echo "<td>CFD5</td>";
					break;
					case '7':
					echo "<td>CFD6</td>";
					break;
					}
					echo "<td>
							<form style='text-align:center;float:left' method='post' action='admin_worksheet_dispaly.php'>
							<input type='hidden' name='w_id' value='".$row['w_id']."'/>
							<input type='hidden' name='username' value='".$row2['first_name']." ".$row2['last_name']."'/>
							<input type='hidden' name='w_name' value='".$row['w_name']."'/>
							<input type='hidden' name='w_type' value='".$row['w_type']."'/>
							<input type='submit' name='Submit' value='View Worksheet' style='width:130px' />
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