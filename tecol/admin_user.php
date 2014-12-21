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
print "alert('User Promoted to Admin')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==2) 
{print "<script type=\"text/javascript\">";
print "alert('User Demoted to regular user')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==3) 
{print "<script type=\"text/javascript\">";
print "alert('User Deleted')";
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
          <div id="page-title"><h3>User Control Administrator Page </h3></div>
          <img src="css/images/highlight.gif" alt="" class="right" />
		  <div style='950px;float:left;padding:10px'>
		  
		  <fieldset >
				<legend style='font-size:15px'>User List</legend>
				<table style="width:952px;font-size:12px">
					<tr bgcolor='#FFFFFF' style='text-decoration:underline;'>
						<th width="180px">Username</td>
						<th >Name</td>
						<th width="100px">User Type</td>
						<th width="270px" >Operations</td>
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
					
					$q="SELECT * FROM users WHERE username NOT IN ('".$_SESSION['id']."')";
					$result=mysql_query($q);
					if (!$result) {
						die('Invalid query: ' . mysql_error());
							}
					while($row = mysql_fetch_assoc($result))
					{
					if ($row['u_type']==2)
					{echo "<tr bgcolor='#92CD00' style='text-align:center'>"; $type='Administrator';}
					else {echo "<tr bgcolor='#C0C0C0' style='text-align:center'>"; $type='Regular User';}
					echo "<td>".$row['username']."</td>";
					echo "<td>".$row['first_name']." ".$row['last_name']."</td>";
					echo "<td>".$type."</td>";
					if ($row['u_type']==2)
					{ echo "<td>
							<form style='text-align:center;float:left' method='post' action='admin_user_resolv.php'>
							<input type='hidden' name='user_id' value='".$row['u_id']."'/>
							<input type='submit' name='Submit' value='Remove as Admin' style='width:130px' />
							</form>";
					}
					else
					{
					echo "<td>
							<form style='text-align:center;float:left' method='post' action='admin_user_resolv.php'>
							<input type='hidden' name='user_id' value='".$row['u_id']."'/>
							<input type='submit' name='Submit' value='Upgrade as Admin' style='width:130px' />
							</form>";
					} echo "
							<form style='text-align:center;float:right' method='post' action='admin_user_resolv.php'>
							<input type='hidden' name='user_id' value='".$row['u_id']."'/>
							<input type='submit' name='Submit' value='Remove User' style='width:130px' />
							</form> </td>";
					
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