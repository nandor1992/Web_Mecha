<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include 'db_settings.php';
session_start();
if(isset($_POST['worksheet']))
{
$_SESSION['worksheet']=$_POST['worksheet'];
}
if (!isset($_SESSION['username']))
{
header('Location: index.php?error=1');
}
?>
<head>
<!--- Title goes here -->
<title> TECoL - Detailed Worksheet  </title>
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
		echo "<li><a href='worksheet.php' class='active'>Worksheet</a></li>";
        if (isset($_SESSION['admin']))
		{
		echo "<li><a href='admin.php'>Administrator</a></li>";
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
		<?php
		//php for Worksheet name user_id type an date
			$con = mysql_connect("localhost",$user,$password);
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			}
			mysql_select_db($db_name,$con) or die ("Could not connect to database");
			$q="SELECT * FROM worksheet WHERE w_id=".$_SESSION['worksheet'];
			$result=mysql_query($q);
			if (!$result) {
				die('Invalid query: ' . mysql_error());
							}
			$row = mysql_fetch_assoc($result);
			$u_id=$row['u_id'];
			$w_name=$row['w_name'];
			$w_id=$row['w_id'];
			$w_type=$row['w_type'];
		?>
          <h2 style='text-align:center;font-size:18px'>&nbsp<?php echo $row['w_name']?>&nbsp - Detailed View </h2>
		  <h2 style='text-align:center;font-size:15px'>Worksheet type: 
		  <?php 
		  switch($w_type)
		  {
		  case 1:echo "Structured";break;
		  case 2:echo "CFD";break;
		  case 3:echo "Combined";break;
		  }
		  ?>
		  </h2>
		  <h2 style='text-align:center;font-size:15px;'>Date Created: <?php echo $row['w_date']; ?></h2>
		  <div style='width:900px;text-align:center;float:left;padding:10px'>
				<div style='text-align:center;width:320px;padding-left:282px'>
			<form action='question.php' method='post' style='float:left;padding-right:5px'>
		  <input type='hidden' name='question' id='worksheet' value=1>
		  <input type='hidden' name='country' id='worksheet' value=23>
		  <input type='hidden' name='worksheet' id='worksheet' value=<?php echo $w_id ?>>
		  <input type='submit' name='Submit' value='Answer questions' />
		  </form>
		  
		  <form action='report.php' method='post' style='float:left;padding-right:5px'>
		  <input type='hidden' name='worksheet' id='worksheet' value=<?php echo $row['w_id']; ?>>
		  <input type='submit' name='Submit' value='Generate Report' />
		  </form>
		  
		  <form action='worksheet_delete.php' method='post' style='float:left' onSubmit="if(!confirm('Are you sure you want to delete the Worksheet?')){return false;}">
		  <input type='hidden' name='worksheet' id='worksheet' value=<?php echo $row['w_id']; ?>>
		  <input type='submit' name='Submit' value='Delete Worksheet' />
		  </form>
		 
			</div>
			<fieldset >
				<legend style='font-size:15px'>Questions List</legend>
				<table style="width:890px;font-size:12px">
					<tr bgcolor='#FFFFFF' style='text-decoration:underline;'>
						<th width="100px">Question Nr.</th>
						<th width="200px">Question</th>
						<th width="580px">Respone</th>
						<th>Edit</th>
						<th>Skip</th>
					</tr>
					<tr bgcolor='#E86850'>
						<td>Skipped</td>
						<td>Jackson</td>
						<td>94</td>
						<th width="80px"><form> <input type='submit' name='submit' value='Edit'/></th>
						<th width="80px"><form> <input type='submit' name='submit' value='Skip'/></th>
					</tr>
					<tr bgcolor='#C0C0C0'>
						<td>Not anwered</td>
						<td>I wonder waht happens if I add a decent question here</td>
						<td>94</td>
						<th width="80px"><form> <input type='submit' name='submit' value='Edit'/></th>
						<th width="80px"><form> <input type='submit' name='submit' value='Skip'/></th>
					</tr>
					<tr bgcolor='#92CD00'>
						<td>Answered</td>
						<td>Jackson</td>
						<td>94</td>
						<th width="80px"><form> <input type='submit' name='submit' value='Edit'/></th>
						<th width="80px"><form> <input type='submit' name='submit' value='Skip'/></th>
					</tr>
		</table> 
			</fieldset>
			<div style='text-align:center;width:300px;float:right'>
				<table style="width:300px;font-size:10px">
					<tr >
						<td bgcolor='#E86850'>&nbsp&nbsp</td>
						<td>- Skipped</td>
						<td bgcolor='#C0C0C0'>&nbsp&nbsp</td>
						<td>- Not answered</td>
						<td bgcolor='#92CD00'>&nbsp&nbsp</td>
						<td>- Answered</td>
					</tr>
		</table> 
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
    <p class='right'>Made by: Iza Birs, Zoltán Nagy, Nándor Verba</p>
    <div class='cl'></div>
  </div>
</div>
</body>
</html>