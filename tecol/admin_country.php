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
print "alert('Country added')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==2) 
{print "<script type=\"text/javascript\">";
print "alert('The Country and all adjacent hints deleted')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==3) 
{print "<script type=\"text/javascript\">";
print "alert('Please insert a country name')";
print "</script>"; 
}
?><!-- Header -->
<?php
$title= "Administrator";
$active=4;
include 'header.php';
?>
<!-- Main Body -->
		
		<div style='width:</h3></div>;float:left'>
          <div id="page-title"><h3>Country Administration </h3></div>
		  <div style='width:</h3></div>;float:left;padding:10px'>
		 <form style='text-align:center' method='post' action='admin_country_resolv.php'>
		  <b> Insert Country:&nbsp</b>
							<input type='text' name='country' value=''/>
							<input type='submit' name='Submit' value='Insert' style='width:130px' />
							</form> 
		  <fieldset >
				<legend style='font-size:15px'>Country List</legend>
				<table style="width:950px;font-size:12px">
					<tr bgcolor='#FFFFFF' style='text-decoration:underline;'>
						<th width="180px">Country ID</td>
						<th >Name</td>
						<th width="140px" >Operation</td>
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
					
					$q="SELECT * FROM `countries` ";
					$result=mysql_query($q);
					if (!$result) {
						die('Invalid query: ' . mysql_error());
							}
					while($row = mysql_fetch_assoc($result))
					{
					{echo "<tr bgcolor='#92CD00' style='text-align:center'>";}
					echo "<td>".$row['q_id']."</td>";
					echo "<td>".$row['country']."</td>";
					echo "<td>
							<form style='text-align:center;float:left' method='post' action='admin_country_resolv.php'>
							<input type='hidden' name='q_id' value='".$row['q_id']."'/>
							<input type='submit' name='Submit' value='Remove Country' style='width:130px' />
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