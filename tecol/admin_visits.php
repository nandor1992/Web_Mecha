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
		<div style='width:900px;float:left'>
          <h3>Visiters to the Site </h3>
          <img src="css/images/highlight.gif" alt="" class="right" />
		  <div style='width:900px;float:left;padding:10px'>
		  <fieldset >
				<legend style='font-size:15px'>Grouping</legend>
				<table style="width:890px;font-size:12px">
					<tr bgcolor='#FFFFFF' style='text-decoration:underline;'>
						<th width="250px">Country</td>
						<th >Number of visitors</td>
						<th width="300px" >Percentage</td>
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
					$q="SELECT * FROM `visitors` ";
					$result=mysql_query($q);
					$tot=mysql_num_rows($result);
					$q="SELECT count(*),country FROM `visitors` Group by country ORDER BY COUNT(*) DESC ";
					$result=mysql_query($q);
					if (!$result) {
						die('Invalid query: ' . mysql_error());
							}
					while($row = mysql_fetch_assoc($result))
					{
					{echo "<tr bgcolor='#92CD00' style='text-align:center'>";}
					echo "<td>".$row['country']."</td>";
					echo "<td>".$row['count(*)']."</td>";
					echo "<td>".round($row['count(*)']/$tot*100,2)."%"."</td>";
					}
					?>
		</table> 
			</fieldset>
			
			<fieldset >
				<legend style='font-size:15px'>Individual</legend>
				<table style="width:890px;font-size:12px">
					<tr bgcolor='#FFFFFF' style='text-decoration:underline;'>
						<th width="100px">Nr.</td>
						<th width="400px">IP Address</td>
						<th >Country</td>
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
					$q="SELECT * FROM `visitors` ORDER BY country DESC";
					$result=mysql_query($q);
					if (!$result) {
						die('Invalid query: ' . mysql_error());
							}
					$i=0;
					while($row = mysql_fetch_assoc($result))
					{
					$i++;
					{echo "<tr bgcolor='#92CD00' style='text-align:center'>";}
					echo "<td>".$i."</td>";
					echo "<td>".$row['ip']."</td>";
					echo "<td>".$row['country']."</td>";
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