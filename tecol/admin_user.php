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
?>
<head>
<!--- Title goes here -->
<title> TECoL - Administrator Page</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
<link rel='stylesheet' href='css/jquery.jcarousel.css' type='text/css' media='all' />
<!--[if IE 6]><link rel='stylesheet' href='css/ie6.css' type='text/css' media='all' /><![endif]-->
<link rel='shortcut icon' href='css/images/my_icon.ico' />
<script type='text/javascript' src='js/jquery-1.4.2.min.js'></script>
<script type='text/javascript' src='js/jquery.jcarousel.pack.js'></script>
<script type='text/javascript' src='js/func.js'></script>
</head>
<body>
<div class="shell">
  <div class="border">
    <div id="header">
      <h1 id="logo"><a href="#" class="notext">beSMART</a></h1>
      <div class="socials right">
        <ul>
		<div style='text-align:right'>
		<!-- Username display logout and stuff like that --->
		<?php
          if(isset($_SESSION['username']))
	 { echo "	<p> Hello &nbsp <b> ";
	 echo $_SESSION['username'];
	echo " </b>!</p> <a href='logout.php'>Logout </a>";
	
	}
	else
	echo"
	<p><b> Guest User </b></p>
	<a href='login.php'>Login</a>&nbsp&nbsp&nbsp&nbsp
	<a href='create.php'>Create Account </a>";
	?>
        </div></ul>
      </div>
      <div class="cl">&nbsp;</div>
    </div>
    <div id="navigation">
      <ul>
	  <!--- Remember to do the Active stuff --->
        <li><a href="index.php" >Home</a></li>
        <li><a href="about.php" >About</a></li>
        <!-- Menu bar for admin and user --->
		<?php
		if(isset($_SESSION['username']))
		{
		echo "<li><a href='worksheet.php'>Worksheet</a></li>";
        if (isset($_SESSION['admin']))
		{
		echo "<li><a href='admin.php' class='active'>Administrator</a></li>";
		}
        }
		?>
      </ul>
      <div class="cl">&nbsp;</div>
    </div>
    <div id="main">
		<div class="highlight">
		<!---- This is where it all begins -->
		<div style='width:900px;float:left'>
          <h3>User Control Administrator Page </h3>
          <img src="css/images/highlight.gif" alt="" class="right" />
		  <div style='width:900px;float:left;padding:10px'>
		  
		  <fieldset >
				<legend style='font-size:15px'>User List</legend>
				<table style="width:890px;font-size:12px">
					<tr bgcolor='#FFFFFF' style='text-decoration:underline;'>
						<th width="180px">Username</td>
						<th >Name</td>
						<th width="100px">User Type</td>
						<th width="270px" >Operations</td>
					</tr>
					<?php
					//initial db connection
					include 'db_settings.php';
					$con = mysql_connect("localhost",$user,$password);
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
         
		<!--- This is where it all ends --->  
		</div>

      <div class="cl">&nbsp;</div>
    </div>
    <div class="shadow-l"></div>
    <div class="shadow-r"></div>
    <div class="shadow-b"></div>
  </div>
  <div id="footer">
    <p class='left'>Copyright &copy; 2014, UTC-N Cluj Napoca, All Rights Reserved</p>
    <p class='right'>Made by: Isabela Bîrs, Zoltán Nagy, Nándor Verba</p>
    <div class='cl'></div>
  </div>
</div>
</body>
</html>