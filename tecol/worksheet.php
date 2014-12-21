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
print "alert('Worksheet and all saved Responses Deleted!')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==2) 
{print "<script type=\"text/javascript\">";
print "alert('Worksheet created!')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==3) 
{print "<script type=\"text/javascript\">";
print "alert('Please enter a Worksheet name that is longer then 2 Characters!')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==4) 
{print "<script type=\"text/javascript\">";
print "alert('Invalid use of questions.php redirected')";
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
		<div id="page-title"><h3>CFD Worksheets </h3></div>
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
$id=$_SESSION['id'];
$sql="SELECT * FROM `worksheet` JOIN `users` ON worksheet.u_id = users.u_id  WHERE (username='$id' AND w_type!=1 )";
$i=0;//for array length		  
$result=mysql_query($sql) or die("cannot connect 2 ");
    while($row = mysql_fetch_array($result)) {
					echo "<tr bgcolor='#92CD00' style='text-align:center'>";
					$i++;
					echo "<td>".$i."</td>";
					echo "<td>".$row['w_name']."</td>";
					echo "<td>";
					switch($row['w_type'])
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
		  <form action='worksheet_detailed.php' method='post' style='float:left;padding-right:5px'>
		  <input type='hidden' name='worksheet' id='worksheet' value=".$row['w_id'].">
		  <input type='submit' name='Submit' value='Manage' />
		  </form>
		  <form action='worksheet_delete.php' method='post' style='float:left' onSubmit=\"if(!confirm('Are you sure you want to delete the Worksheet?')){return false;}\">
		  <input type='hidden' name='worksheet' id='worksheet' value=".$row['w_id'].">
		  <input type='submit' name='Submit' value='Delete' />
		  </form>
		</td>";
					}
					echo "</tr>";
					?>			
		</table> 
		<form id='add cfd' style='text-align:center' action='worksheet_create.php' method='post' accept-charset='UTF-8'>
			<fieldset >
			<legend>Add Worksheet </legend>
			</br>
			<p style='float:left'>&nbsp Worksheet Name:&nbsp </p>
			<input type='text' name='w_name' id='w_name'  maxlength='100' style='width:450px;float:left'>
			<p style='float:left'> &nbspWorksheet Type: &nbsp</p>
			<select name='w_type' style='float:left;width:130px'>
				<option value='2'>CFD1</option>
				<option value='3'>CFD2</option>
				<option value='4'>CFD3</option>
				<option value='5'>CFD4</option>
				<option value='6'>CFD5</option>
				<option value='7'>CFD6</option>
		  </select>
			<input type='submit' name='Submit' value='Create' style='float:right' />
			</br></br>
			</fieldset>
		   </form>
			</fieldset>
			<!-- STR PART-->
			<div id="page-title"><h3>Structural(STR) Worksheets </h3></div>
	<fieldset >
				<legend style='font-size:15px'>Structural(STR) Worksheets</legend>
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
$id=$_SESSION['id'];
$sql="SELECT * FROM `worksheet` JOIN `users` ON worksheet.u_id = users.u_id  WHERE (username='$id' AND w_type=1 )";
$i=0;//for array length		  
$result=mysql_query($sql) or die("cannot connect 2 ");
    while($row = mysql_fetch_array($result)) {
					echo "<tr bgcolor='#92CD00' style='text-align:center'>";
					$i++;
					echo "<td>".$i."</td>";
					echo "<td>".$row['w_name']."</td>";
					echo "<td>";
					switch($row['w_type'])
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
		  <form action='worksheet_detailed.php' method='post' style='float:left;padding-right:5px'>
		  <input type='hidden' name='worksheet' id='worksheet' value=".$row['w_id'].">
		  <input type='submit' name='Submit' value='Manage' />
		  </form>
		  <form action='worksheet_delete.php' method='post' style='float:left' onSubmit=\"if(!confirm('Are you sure you want to delete the Worksheet?')){return false;}\">
		  <input type='hidden' name='worksheet' id='worksheet' value=".$row['w_id'].">
		  <input type='submit' name='Submit' value='Delete' />
		  </form>
		</td>";
					}
					echo "</tr>";
					?>			
		</table> 
		<form id='add cfd' style='text-align:center' action='worksheet_create.php' method='post' accept-charset='UTF-8'>
			<fieldset >
			<legend>Add Worksheet </legend>
			</br>
			<p style='float:left'>&nbsp Worksheet Name:&nbsp </p>
			<input type='text' name='w_name' id='w_name'  maxlength='100' style='width:450px;float:left'>
			<p style='float:left'> &nbspWorksheet Type: Structural(STR) &nbsp</p>
			<input type='hidden' name='w_type' value='1'/>

			<input type='submit' name='Submit' value='Create' style='float:right' />
			</br></br>
			</fieldset>
		   </form>
			</fieldset>
		<!-- Footer -->

<?php
include 'footer.php';
?>