<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
if (!isset($_SESSION['username'])||!isset($_SESSION['admin']))
{
header('Location: index.php?error=2');
}
?><!-- Header -->
<?php
$title= "Administrator";
$active=4;
include 'header.php';
?>
<!-- Main Body -->
		
		<!---- This is where it all begins -->
		<div style='width:900px;float:left'>
          <h3> Main Administrator Page </h3>
          <img src="css/images/highlight.gif" alt="" class="right" />
		  <div style='width:900px;float:left;padding:10px'>
		  
		  <div style='width:650px;float:left;'>
		  <div style='width:311px;height:100px;float:left;padding:5px;border-width:2px; border-style: outset; border-color: gray;text-align:center'>
		  <b style='font-size:16px'>User Mangement</b>
		  </br>
		  </br>
		  <p style='font-size:13px'>Deleting users and appointing administrators.</p>
			<form style='text-align:center' method='post' action='admin_user.php'>
			<input type='submit' name='Submit' value='Manage' style='width:130px' />
			</form>
		  </div>
		   <div style='width:311px;height:100px;float:left;padding:5px;border-width:2px; border-style: outset; border-color: gray;text-align:center'>
		  <b style='font-size:16px'>View Worksheets</b>
		  </br>
		  </br>
		  <p style='font-size:13px'>You can view all the created worksheets.</p>
			<form style='text-align:center' method='post' action='admin_worksheets.php'>
			<input type='submit' name='Submit' value='View' style='width:130px' />
			</form>
		  </div>
		  <div style='width:195px;height:130px;float:left;padding:5px;border-width:2px; border-style: outset; border-color: gray;text-align:center'>
		  <b style='font-size:16px'>Add/Remove Country</b>
		  </br>
		  </br>
		  <p style='font-size:13px'>Add a country to the list of possible choices.</p>
			<form style='text-align:center' method='post' action='admin_country.php'>
			<input type='submit' name='Submit' value='Manage' style='width:130px' />
			</form>
		  </div>
		  <div style='width:217px;height:130px;float:left;padding:5px;border-width:2px; border-style:outset; border-color: gray;text-align:center'>
		  <b style='font-size:16px'>Add Questions and Variables</b>
		  <p style='font-size:13px'>Insert questions into the database and their adjesent Variables.</p>
			<form style='text-align:center' method='post' action='admin_questions.php'>
			<input type='submit' name='Submit' value='Add' style='width:130px' />
			</form>
		  </div>
		  <div style='width:196px;height:130px;float:left;padding:5px;border-width:2px; border-style: outset; border-color: gray;text-align:center'>
		  <b style='font-size:16px'>Generated Reports</b>
		  </br>
		  </br>
		  <p style='font-size:13px'>View the generated reports.</p>
			<form style='text-align:center' method='post' action='admin_report.php'>
			<input type='submit' name='Submit' value='View' style='width:130px' />
			</form>
		  </div>
		  </div>
		  <div style='width:230px;height:115px;float:left;padding:5px;border-width:2px; border-style: outset; border-color: gray;text-align:center'>
		  <b style='font-size:16px'>List and Modify hints</b>
			
		  <p style='font-size:13px'>You can see the inserted hints grouped to country type where you can modify the text. </p>

			<form style='text-align:center' method='post' action='admin_hints.php'>
			<input type='submit' name='Submit' value='Manage' style='width:130px' />
			</form>
		  </div>
		  <div style='width:230px;height:115px;float:left;padding:5px;border-width:2px; border-style: outset; border-color: gray;text-align:center'>
		  <b style='font-size:16px'>List Visits</b>
			
		  <p style='font-size:13px'>You can see the visits grouped by country and the list of allthe ip addresses connected </p>

			<form style='text-align:center' method='post' action='admin_visits.php'>
			<input type='submit' name='Submit' value='Manage' style='width:130px' />
			</form>
		  </div>
		  </div>
		  </div>
         
		<!-- Footer -->

<?php
include 'footer.php';
?>