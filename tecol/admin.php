<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
if (!isset($_SESSION['username'])||!isset($_SESSION['admin']))
{
header('Location: index.php?error=2');
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
		  <b style='font-size:16px'>Report Text</b>
		  </br>
		  </br>
		  <p style='font-size:13px'>Modify the Text that is used to generate the report.</p>
			<form style='text-align:center' method='post' action='admin_report.php'>
			<input type='submit' name='Submit' value='Modify' style='width:130px' />
			</form>
		  </div>
		  </div>
		  <div style='width:230px;height:244px;float:left;padding:5px;border-width:2px; border-style: outset; border-color: gray;text-align:center'>
		  <b style='font-size:16px'>List and Modify hints</b>
		  </br>
		  </br>
		  </br>
		  </br>
		  <p style='font-size:13px'>You can see the inserted hints grouped to country type where you can modify the text. </p>
		  </br>
		  </br>
			<form style='text-align:center' method='post' action='admin_hints.php'>
			<input type='submit' name='Submit' value='Manage' style='width:130px' />
			</form>
		  </div>
		  
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