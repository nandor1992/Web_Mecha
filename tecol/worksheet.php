<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
if (!isset($_SESSION['username']))
{
header('Location: index.php?error=1');
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==1) 
{print "<script type=\"text/javascript\">";
print "alert('Worksheet and all saved Responses Deleted!')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==2) 
{print "<script type=\"text/javascript\">";
print "alert('Worksheet created!')";
print "</script>";   
}
?>
<head>
<!--- Title goes here -->
<title> TECoL - Worksheet </title>
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
          <h3> Worksheet </h3>
          <img src="css/images/highlight.gif" alt="" class="right" />
		  <div style='width:900px;float:left;padding:10px'>
          <?php
		  // Querry for worksheet entries
		  include 'db_settings.php';
$con = mysql_connect("localhost",$user,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_name,$con) or die ("Could not connect to database");
$id=$_SESSION['id'];
$sql="SELECT * FROM `worksheet` JOIN `users` ON worksheet.u_id = users.u_id  WHERE (username='$id' )";
$i=0;//for array length		  
$result=mysql_query($sql) or die("cannot connect 2 ");
    while($row = mysql_fetch_array($result)) {
	$i++;//for array length TO-DO smarter
		  //for --while
		  echo "
		  <div style='width:280px;height:100px;float:left;padding:5px;border-width:2px;background-color:#d3d3d3; border-style: outset; border-color: gray;'>
		  <p>";
		  echo "Worksheet ".$i;
		  echo"</p>
		  <b>";
		  echo $row['w_name']."</b>";
		  switch ($row['w_type'])
		  {
		  case 1:$type=" Structural";break;
		  case 2:$type=" CFD";break;
		  case 3:$type=" Combined";break;
		  }
		  echo "<p>Worksheet type:".$type."</p>";
		  echo "
		  <form action='worksheet_detailed.php' method='post' style='float:left;padding-right:5px'>
		  <input type='hidden' name='worksheet' id='worksheet' value=".$row['w_id'].">
		  <input type='submit' name='Submit' value='Manage' />
		  </form>
		  <form action='worksheet_delete.php' method='post' style='float:left' onSubmit=\"if(!confirm('Are you sure you want to delete the Worksheet?')){return false;}\">
		  <input type='hidden' name='worksheet' id='worksheet' value=".$row['w_id'].">
		  <input type='submit' name='Submit' value='Delete' />
		  </form>
		  <p  style='text-align:right;float:right' >";
		  echo $row['w_date'];
		  echo "</p>
		  </div>";}
		  // Echoing new sheet if neccesary
		  if($i<5)
		  {echo "
		  <div style='width:280px;height:100px;float:left;padding:5px;border-width:2px; border-style: outset; border-color: gray;'>
		  <b>Create New Worksheet !</b>
		  
		  <form action='worksheet_create.php' method='post' >
		  <p> Insert Worksheet name and select type: </p>
		  <input type='text' name='w_name' id='w_name'  maxlength='30' style='width:130;float:left'>
		  <select name='w_type' style='width:130;float:left'>
				<option value='1'>Structured</option>
				<option value='2'>CFD</option>
				<option value='3'>Combined</option>
		  </select>
		  <input type='submit' name='Submit' value='Create' style='width:130px;float:right' />
		  </form>
		  </div>";
		  }
		  ?>
		  </div >
		  <div style='width:900px;paddig:10px'>
		  <h3> Info </h3>
		  <p> Basik form, to acces questions with variables:</p>
		  <form id='question' style='text-align:center' action='question.php' method='post' accept-charset='UTF-8'>
			<fieldset >
			<legend>Question Selector</legend>
			<h1> Question </h1>
			</br>
			<input type='hidden' name='submitted' id='submitted' value='1'/>
			<label for='username' >Question_id</label>
			<input type='int' name='question' id='question'  />
			</br>
			<label for='country' >Country_id</label>
			<input type='int' name='country' id='country'  />
			</br>
			<label for='last_name' >Worksheet_id:</label>
			<input type='int' name='worksheet' id='worksheet' />
			</br>
			<input type='submit' name='Submit' value='Go to Question' />
			</fieldset>
		   </form>
		</br>
		<h3> For Generate Report: </h3>
		<form style='text-align:center' action='report.php' method='post' accept-charset='UTF-8'>
		</br>
		<label for='last_name' >Worksheet_id:</label>
		<input type='int' name='worksheet' id='worksheet' />
		</br>
		<input type='submit' name='Submit' value='Generate Report' />
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
    <p class='right'>Made by: Iza Birs, Zoltán Nagy, Nándor Verba</p>
    <div class='cl'></div>
  </div>
</div>
</body>
</html>