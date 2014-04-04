<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php

include 'db_settings.php'; //database name and passwd
include 'answer_functions.php'; // contains a function which returns the state of an answer
session_start();

//connecting to the database, it is here because it will be used everywhere
$con = mysql_connect("localhost",$user,$password);
if (!$con)
  {
  	die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_name,$con) or die ("Could not connect to database");

include 'question_limits.php';

//this is the most important variable, will be used all along 
$question_id = $_POST['question']; //the question_id is the primary key 
$w_id=$_POST['worksheet'];//it is the PK in worksheet db
$w_type=$_SESSION['w_type'];// this is necesssary to know which type is used

//validation procedure, Next= not save, not skip, unanswered
if (isset($_POST['Next']))
{
	$question_id=onClickNext($question_id,$w_id,$w_type);
}

//validation procedure, Previous= not save, not skip, unanswered
if (isset($_POST['Previous']))
{
	$question_id=onClickPrevious($question_id,$w_id,$w_type);
}

// setting the skip value in the database 1--skipped 0--unskipped
if (isset($_POST['Skip']))
{
	$question_id=saveAnswer($question_id,$w_id,$w_type,1);//last argument 1==skipped
}

// it doesn't need to check the validation when it clicks on the Next, Previous or Skip buttons
if (isset($_POST['n']) and !isset($_POST['Next']) and !isset($_POST['Previous']) and !isset($_POST['Skip']))
{
	include 'answer_validation.php';
}
if (isset($_POST['Save']) and ($validation==true))
{
	$question_id=saveAnswer($question_id,$w_id,$w_type,0); //last argument 0==answered
}

//the end of the php header -- it handles all the situations
?>
<head>
<!--- Title goes here -->
<title> TECoL - About us </title>
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
		<?php
          if(isset($_SESSION['username']))
		 {	echo "	<p> Hello &nbsp <b> ";
	 		echo $_SESSION['username'];
			echo " </b>!</p> <a href='logout.php'>Logout </a>";
	
		}
		else
		{
		echo"
		<p><b> Guest User </b></p>
		<a href='login.php'>Login</a>&nbsp&nbsp&nbsp&nbsp
		<a href='create.php'>Create Account </a>";
		}
		?>
        </div></ul>
      </div>
      <div class="cl">&nbsp;</div>
    </div>
    <div id="navigation">
      <ul>
	  <!-- Remember to do the Active stuff -->
        <li><a href="index.php" >Home</a></li>
        <li><a href="about.php" >About</a></li>
        <!-- Menu bar for admin and user -->
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
		<!-- This is where it all begins -->
		<?php
		// that is where the question part starts the previous part is for formatting the page
		$answerstatus=answerStatus($question_id,$w_id);
		list($n, $country_id, $var_type)=showQuestion($question_id, $answerstatus, $w_type, $w_id); // it returns the nr of variables		
		//end of the php part which refers just to the question
		?>

			<div style='width:800px;text-align:center;float:left;padding:10px'>
				<div style='text-align:center;width:320px;padding-left:300px'>
					<input type='hidden' name='question' id='worksheet' value=<?php echo $question_id ?>>
					<input type='hidden' name='worksheet' id='worksheet' value= <?php echo $_POST['worksheet'] ?>>
					<?php
					if ($country_id!=0)
						echo "<input type='hidden' name='country_id' id='country_id' value=".$country_id.">";
					?>
					<input type='hidden' name='str_upper_limit' id='str_upper_limit' value= <?php echo $str_upper_limit ?>>
					<input type='hidden' name='cfd_upper_limit' id='cfd_upper_limit' value= <?php echo $cfd_upper_limit ?>>
					<input type='hidden' name='str_down_limit' id='str_down_limit' value= <?php echo $str_down_limit ?>>
					<input type='hidden' name='cfd_down_limit' id='cfd_down_limit' value= <?php echo $cfd_down_limit ?>>

					<?php
					for ($i=0;$i<$n;$i++)
					{
						echo "<input type='hidden' name='var_type[]' id='var_type[]' value=".$var_type[$i]. ">";
					}
					?>
					<input type='hidden' name='n' id='n' value= <?php echo $n //the nr of input fields of a question?>>
					<!-- Save and Skip buttons-->
					<div>	
						<input type='submit' name='Save' style='width=40px; height:40px;' value='Save' />
					  	<input type='submit' name='Skip' style='width=40px; height:40px;' value='Skip' />
					</div>					
					<?php
					//it is necessary because if it reaches the first than it cannot go to the previous and if the last than cannot go further
					switch($w_type)
					{
						case 1:
						case 3: 	if ($question_id!=$str_down_limit)
										echo "<div><input type='submit' name='Previous' value='Previous' style='float:left' /></div>";
									break;
						case 2: 	if ($question_id!=$str_down_limit)//because it contains the first 2 question
										echo "<div><input type='submit' name='Previous' value='Previous' style='float:left' /></div>";
									break;
					}

					switch($w_type)
					{
						case 1: 	if ($question_id!=$str_upper_limit)
										echo "<input type='submit' name='Next' value='Next' style='float:right'/>";
									break;
						case 2:	
						case 3: 	if ($question_id!=$cfd_upper_limit)
										echo "<input type='submit' name='Next' value='Next' style='float:right'/>";
									break;
					}
					?>
				</div>
			</div>
		</div>
	</div>
</form> <!-- the form was started at the ShowQuestion part, where the textboxes are-->
<!-- the end of the file-->

<div id="footer">
    <p class='left'>Copyright &copy; 2014, UTC-N Cluj Napoca, All Rights Reserved</p>
    <p class='right'>Made by: Isabela Bîrs, Zoltán Nagy, Nándor Verba</p>
    <div class='cl'></div>
 </div>

</body>
</html>	