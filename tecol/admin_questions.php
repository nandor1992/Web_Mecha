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
print "alert('Please complete all fields!')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==2) 
{print "<script type=\"text/javascript\">";
print "alert('Question Successfully Added')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==3) 
{print "<script type=\"text/javascript\">";
print "alert('Variable Succesfully added')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==4) 
{print "<script type=\"text/javascript\">";
print "alert('Question Succesfully Modified')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==5) 
{print "<script type=\"text/javascript\">";
print "alert('Variable Succesfully Modified')";
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
		<div style='width:</h3></div>;float:left'>
          <div id="page-title"><h3> Question and Variable management page </h3></div>
          <img src="css/images/highlight.gif" alt="" class="right" />
		  <div style='width:</h3></div>;float:left;padding:10px'>
		  
		  <form id='question' style='text-align:center' action='admin_questions_resolve.php' method='post' accept-charset='UTF-8'>
			<fieldset >
			<legend>Question Addition </legend>
			</br>
			<p style='float:left'>&nbsp Question Text:&nbsp </p>
			<input type='text' name='question' id='question'  maxlength='1000' style='width:540px;float:left'>	 
			<p style='float:left'> &nbspQuestion Type: &nbsp</p>
			<select name='w_type' style='width:130;float:left'>
				<option value='1'>Structured</option>
				<option value='2'>CFD1</option>
				<option value='3'>CFD2</option>
				<option value='4'>CFD3</option>
				<option value='5'>CFD4</option>
				<option value='6'>CFD5</option>
				<option value='7'>CFD6</option>
		  </select>
			<input type='submit' name='Submit' value='Save Question' style='float:right' />
			</br></br>
			</fieldset>
		   </form>
		   
		   <form id='question' style='text-align:left' action='admin_questions_resolve.php' method='post' accept-charset='UTF-8'>
			<fieldset >
			<legend>Variable addition </legend>
			</br>
			<p style='float:left'>Variable Name:&nbsp </p>
			<input type='text' name='q_name' id='q_name'  maxlength='30' style='width:100px;float:left'/>	 	 
					  <p style='float:left'> &nbsp Variable Type: &nbsp </p>
			<select name='v_type' style='width:130;float:left'>
				<option value='2'>Text(2000 char)</option>
				<option value='3'>Big Integer</option>
				<option value='4'>Boolean-Req Answer</option>
				<option value='5'>Boolean-Answer nor Req</option>
				<option value='6'>Percentage</option>
				<option value='7'>Percentage under 100%</option>
		  </select>
		  <p style='float:left'>&nbsp Variable Text:&nbsp </p>
			<input type='text' name='q_text' id='q_text'  maxlength='1000' style='width:350px;float:left'/>
					  </br></br>
			<p style='float:left'>Connected Question: &nbsp</p>
			<select name='q_type' style='width:670px;float:left'>
				<?php
				include 'db_settings.php';
				$con = mysql_connect($host,$user,$password);
					if (!$con)
					{
					die('Could not connect: ' . mysql_error());
						}
					mysql_select_db($db_name,$con) or die ("Could not connect to database");
				$sql="SELECT * FROM `questions`";
				$result=mysql_query($sql) or die("cannot connect 3 ");
				while($row=mysql_fetch_assoc($result))
				{
				echo "<option value='".$row['q_id']."'>".$row['question']."</option>";
				}
				?>
		  </select>
			<input type='submit' name='Submit' value='Save Variable' style='float:right'>
			</br></br>
			</fieldset>
			<fieldset>
			<legend>List of Questions and Variables </legend>
			<!---Displayling allquestions and variables ----->
			<table style="width:950px;font-size:12px">
					<tr bgcolor='#FFFFFF' style='text-decoration:underline;'>
						<th width="100px">Question.VarID</th>
						<th width="80px">Type</th>
						<th >Question Text</th>
						<th width="140px" >Operation</th>
					</tr>
			<?php
			$q="SELECT * FROM `questions`";
					$result=mysql_query($q);
					if (!$result) {
						die('Invalid query: ' . mysql_error());
							}
					while($row = mysql_fetch_assoc($result))
					{
					echo "<tr bgcolor='#92CD00' style='text-align:center'>";
					echo "<td>".$row['q_id']."</td>";
					switch($row['w_type'])
					{
					case 0:echo "<td> Base </td> ";break;
					case 1:echo "<td> Structured </td>";break;
					case 2:echo "<td> CFD1 </td>";break;
					case 3:echo "<td> CFD2 </td>";break;
					case 4:echo "<td> CFD3 </td>";break;
					case 5:echo "<td> CFD4 </td>";break;
					case 6:echo "<td> CFD5 </td>";break;
					case 7:echo "<td> CFD6 </td>";break;
					}
					echo "<form style='text-align:center;float:left' method='post' action='admin_questions_resolve.php'>";
					echo "<td><input type='text' name='text' style='width:99%' value='".$row['question']."'/></td>";
					echo "<td>
							<input type='hidden' name='q_id' value='".$row['q_id']."'/>
							<input type='submit' name='Submit' value='Modify Question' style='width:130px' />
							</form></td>";
							//Basic form for variables
					$q2="SELECT * FROM `variable` WHERE `q_id`='".$row['q_id']."'";
					$result2=mysql_query($q2);
					if (!$result2) {
						die('Invalid query: ' . mysql_error());
							}
					while($row2 = mysql_fetch_assoc($result2))
					{		
					echo "<tr bgcolor='#C0C0C0' style='text-align:center'>";
					echo "<td>".$row['q_id'].".".$row2['var_name']."</td>";
					switch($row2['var_type'])
					{
					case 1:echo "<td> Country ID </td> ";break;
					case 2:echo "<td> Text </td>";break;
					case 3:echo "<td> BigInt </td>";break;
					case 4:echo "<td> Bool Req Ans</td>";break;
					case 5:echo "<td> Bool No Ans </td>";break;
					case 6:echo "<td> Percentage </td>";break;
					case 7:echo "<td> Percentage<100% </td>";break;
					}
					echo "<form style='text-align:center;float:left' method='post' action='admin_questions_resolve.php'>";
					echo "<td><input type='text' name='text' style='width:99%' value='".$row2['var_text']."'/></td>";
					echo "<td>
							<input type='hidden' name='var_id' value='".$row2['var_id']."'/>
							<input type='submit' name='Submit' value='Modify Variable' style='width:130px' />
							</form></td>";
					}
					}
					?>
					</table> 
					</fieldset>
			
			
		   
		   <div style='text-align:center;width:300px;float:right'>
				<table style="width:300px;font-size:10px">
					<tr >
						<td bgcolor='#C0C0C0'>&nbsp&nbsp</td>
						<td>- Variables</td>
						<td bgcolor='#92CD00'>&nbsp&nbsp</td>
						<td>- Questions</td>
					</tr>
		</table> 
		  </div>
		  </fieldset>
		  </div>
         
	<!-- Footer -->

<?php
include 'footer.php';
?>