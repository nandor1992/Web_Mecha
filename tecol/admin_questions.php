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
print "alert('Please Complete all the fields')";
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
          <h3> Question and Variable management page </h3>
          <img src="css/images/highlight.gif" alt="" class="right" />
		  <div style='width:900px;float:left;padding:10px'>
		  
		  <form id='question' style='text-align:center' action='admin_questions_resolve.php' method='post' accept-charset='UTF-8'>
			<fieldset >
			<legend>Question Addition </legend>
			</br>
			<p style='float:left'>&nbsp Question Text:&nbsp </p>
			<input type='text' name='question' id='question'  maxlength='1000' style='width:540px;float:left'>	 
			<p style='float:left'> &nbspQuestion Type: &nbsp</p>
			<select name='w_type' style='width:130;float:left'>
				<option value='1'>Structured</option>
				<option value='2'>CFD</option>
				<option value='3'>Combined</option>
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
				$con = mysql_connect("localhost",$user,$password);
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
		   </form>
		  
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