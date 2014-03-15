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
print "alert('Hint Modified')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==2) 
{print "<script type=\"text/javascript\">";
print "alert('Please enter Text to the specific are if you want to modify it')";
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
          <h3>Hint Text Administration </h3>
          <img src="css/images/highlight.gif" alt="" class="right" />
		  <div style='width:900px;float:left;padding:10px'>
		  <form style='text-align:center' method='post' action='admin_hints.php'>
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
					
					$q="SELECT * FROM `countries`";
					$result=mysql_query($q);
					if (!$result) {
						die('Invalid query: ' . mysql_error());
							}

					?>
		  <b> Select Country:&nbsp</b>
							<select name='w_type' style='width:130px'>
								<?php
								while($row = mysql_fetch_assoc($result))
								{
								echo "<option value='".$row['q_id']."' >".$row['country']."</option>";
								}
								?>
							</select>
							<input type='submit' name='Submit' value='Display' style='width:130px' />
							</form> 
		  <fieldset >
		  <legend style='font-size:15px'>Question List</legend>
		  <?php
		  if (isset($_SESSION['hint'])){
		  $_SESSION['hint']=$_SESSION['hint'];
		  }
		   if (isset($_SESSION['hint'])){
		  echo"
				<table style='width:890px;font-size:12px'>
					<tr bgcolor='#C0C0C0' style='text-decoration:underline;'>
						<th width='180px'>Question ID</th>
						<th width='180px'>Question</th>
						<th > Hint text</th>
						<th width='140px' >Operation</th>
					</tr>";
					
					//initial db connection
					include 'db_settings.php';
					$con = mysql_connect("localhost",$user,$password);
					if (!$con)
					{
					die('Could not connect: ' . mysql_error());
					}
					mysql_select_db($db_name,$con) or die ("Could not connect to database");
					
					//selecting users
					
					$q=" SELECT * FROM `questions` ";
					$result=mysql_query($q);
					if (!$result) {
						die('Invalid query: ' . mysql_error());
							}
					while($row = mysql_fetch_assoc($result))
					{
					{echo "<tr bgcolor='#C0C0C0' style='text-align:center'>";}
					echo "<td>".$row['q_id']."</td>";
					echo "<td>".$row['question']."</td>";
					echo "<form style='text-align:center;float:left' method='post' action='admin_hint_resolv.php'>";
					$q=" SELECT * FROM `hint` WHERE `q_id`='".$row['q_id']."' AND `country_id`='".$_SESSION['hint']."'";
					$result2=mysql_query($q);
					if (!$result2) {
						die('Invalid query: ' . mysql_error());
							}
					$row2 = mysql_fetch_assoc($result2);
					echo "<td><input type='text' name='text' style='width:99%' value='".$row2['hint']."'/></td>";
					echo "<td>
							<input type='hidden' name='country' value='".$_SESSION['hint']."'/>
							<input type='hidden' name='q_id' value='".$row['q_id']."'/>
							<input type='hidden' name='h_id' value='".$row2['h_id']."'/>
							<input type='submit' name='Submit' value='Save Changes' style='width:130px' />
							</form>";
					}
					
					echo "</table> ";
					}
		?>
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