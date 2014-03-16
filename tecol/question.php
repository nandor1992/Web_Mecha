<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<?php
include 'db_settings.php';
session_start();

//this is here just for testing, to see if there is any problem or not, will be deleted
echo "<p>Username: ".$_SESSION['username']."</p>";
echo "<p>Username ID: ".$_SESSION['id']."</p>";
echo "<p> User id: ".$_SESSION['u_id']."</p>";
echo "<p>Question_id: ".$_POST['question']."</p>";
echo "<p>Country_id: ".$_POST['country']."Country id can be empty</p>";
echo "<p>Worksheet_id: ".$_POST['worksheet']."</p>";

//connecting to the database, it is here because it will be used everywhere
$con = mysql_connect("localhost",$user,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_name,$con) or die ("Could not connect to database");

//this is the most important variable, will be used all along 
$question_id = $_POST['question'];

//validation procedure, Next= not save, not skip, unanswered
if (isset($_POST['Next']))
{
	switch($_POST['worksheet'])
	{
		case 0: 	if ($question_id<18)
						$question_id++;
					break;
		case 1:
		case 2: 	if ($question_id<51)
						$question_id++;
					break;
	}
	include 'is_skipped.php';
	while($unskipped==false)
	{
		switch($_POST['worksheet'])
		{
			case 0:
			case 2: 	if ($question_id<18)
						{
							$question_id++;
							include 'is_skipped.php';
						}
						else
						{
							header('Location: worksheet.php?error=4');
							$check=1;
						}
							
						break;
			case 1: 	if ($question_id<51)
							$question_id++;
						else
							header('Location: worksheet.php?error=4');
							$check=1;
						break;
		}
		if (check==1)
		{
			break;
		}
	}

}

if (isset($_POST['Previous']))
{
	switch($_POST['worksheet'])
	{
		case 0:
		case 2: 	if ($question_id>1)
						$question_id--;							
					break;
		case 1: 	if ($question_id>18)
						$question_id--;
					break;
	}
	include 'is_skipped.php';
	while($unskipped==false)
	{
		switch($_POST['worksheet'])
		{
			case 0:
			case 2: 	if ($question_id>1)
						{
							$question_id--;
							echo $question_id;
							include 'is_skipped.php';
						}
						else
						{
							header('Location: worksheet.php?error=4');
							$check=1;
						}
							
						break;
			case 1: 	if ($question_id>18)
							$question_id--;
						else
						{
							header('Location: worksheet.php?error=4');
							$check=1;
						}
						break;
		}
		if ($check==1)
		{
			break;
		}

	}
}

// setting the skip value 1--skipped 0--unskipped
if (isset($_POST['Skip']))
{
	//echo"ERROR it doesen't enter to the skip part";
	//it has to select the belonging variables for that question

	$sql_var="SELECT * 
			FROM variable 
			WHERE q_id LIKE '{$question_id}'
			";
	$vars=mysql_query($sql_var);

	if (!$vars) 
	{
	    die('Invalid query: ' . mysql_error());
	}

	if (mysql_num_rows($vars) > 0) 
	{
		//echo"eRROR there is a problem with the selected rows";
		while ($row = mysql_fetch_assoc($vars))
		{	
			$var_id=$row['var_id'];
			$sql="INSERT INTO answers(q_id, u_id, w_id, var_id, skip)
			VALUES ($question_id,'$_SESSION[u_id]','$_POST[worksheet]','$var_id',1)";
			mysql_query($sql); 
			 //mysql_error();
		}
	}	
}
// it doesn't need to check the validation when it clicks on the Next, Previous or Skip buttons
if (isset($_POST['n']) and !isset($_POST['Next']) and !isset($_POST['Previous']) and !isset($_POST['Skip']))
{
	include 'answer_validation.php';
}
if (isset($_POST['Save']) and ($validation==true))
{
	$sql_var="SELECT * 
			FROM variable 
			WHERE q_id LIKE '{$question_id}'
			";
	$vars=mysql_query($sql_var);

	if (!$vars) 
	{
	    die('Invalid query: ' . mysql_error());
	}

	if (mysql_num_rows($vars) > 0) 
	{
		//echo"eRROR there is a problem with the selected rows";
		$i=-1;
		while ($row = mysql_fetch_assoc($vars))
		{
			$i++;
			echo "<p> answer: ".$_POST['answer'][$i]."</p>";
			$answer=$_POST['answer'][$i];
			$var_id=$row['var_id'];
			$sql="INSERT INTO answers(q_id, u_id, w_id, var_id, skip, answer)
			VALUES ($question_id,'$_SESSION[u_id]','$_POST[worksheet]','$var_id',0,'$answer')";
			mysql_query($sql); 
			
			 //mysql_error();
		}
	}

}
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
// that is where the question part is starting the previous part is for formatting the page
//it requires a mysql database connection for the questions and for the data 
	$q="SELECT *
	                      FROM questions
	                      WHERE q_id LIKE '{$question_id}'
	                      ";
	$q1="SELECT * 
				FROM variable 
				WHERE q_id LIKE '{$question_id}'
				";
	$question=mysql_query($q);
	$variables=mysql_query($q1);
	if (!$question) {
	    die('Invalid query: ' . mysql_error());
	}
//the question is selected from the table
	$row = mysql_fetch_assoc($question);
	$num_results = mysql_num_rows($question); 

	if ($num_results > 0)
	{	
//if everything is OKAY than it will show the question, with number
	echo "<div style='background-color:#FFA500;clear:both;text-align:center;'>
		<p color:red; text-align:center; > ".$row['q_id'].": ".$row['question']."</p>
		</div>";
	//$answer_type=$row['answer_type'];
	$_SESSION['question_id']=$row['q_id'];
	//$_SESSION['answer_type']=$row['answer_type'];
	}
//the variables and types are selected from the db

	if (!$variables) {
	    die('Invalid query: ' . mysql_error());
	}

	$i=-1;
	$num_results = mysql_num_rows($variables);
	if (mysql_num_rows($variables) > 0) 
	{
		while ($row = mysql_fetch_assoc($variables))
		{

			//storing all the dta into a vector
			$i++;			
			$var_name[$i]=$row['var_name'];
			$var_text[$i]=$row['var_text'];
			$var_type[$i]=$row['var_type'];

		}
	}
	$n=$i;
	$n++;
//to print out the forms
	echo "<div style='background-color:#FFA500;clear:both;text-align:center;'>
		<p color:red; text-align:center; > ".$var_text[$i]."</p>
		</div>";
	echo "<form name='input' action='question.php' method='post' style='text-align:center'><br>";
	for($i=0;$i<$n;$i++)
	{
		switch($var_type[$i])
		{
			case 6:
			case 7:
			case 3:
			case 1: echo "<input type='text' name='answer[]' style='padding: 2px; border: solid 1px orange' >";
					break;
			case 2: echo "<textarea name='answer[]' rows='4' cols='50' style='border: solid 1px orange'> Specify your answer here ... </textarea>";
					break;
			case 4:
			case 5: echo "<input type='radio' name='answer[]' value='yes'>yes
					<input type='radio' name='answer' value='no'>no";
					break;
			default: echo "error";
		}
		echo "&nbsp";	
	}


?>

<div style='width:900px;text-align:center;float:left;padding:10px'>
	<div style='text-align:center;width:320px;padding-left:282px'>
		  <input type='hidden' name='question' id='worksheet' value=<?php echo $question_id ?>>
		  <input type='hidden' name='country' id='worksheet' value=23>
		  <input type='hidden' name='worksheet' id='worksheet' value= <?php echo $_POST['worksheet'] ?>>
		  <?php
		  for ($i=0;$i<$n;$i++)
		  {
		  	echo "<input type='hidden' name='var_type[]' id='var_type[]' value=".$var_type[$i]. ">";
		  }
		  ?>
		  
		  <input type='hidden' name='n' id='n' value= <?php echo $n ?>>

		  <?php
	//it is necessary because if it reaches the first than it cannot go to the previous
		  switch($_POST['worksheet'])
			{
				case 0:
				case 2: 	if ($question_id!=1)
								echo "<input type='submit' name='Previous' value='Previous' style='float:left' />";
							break;
				case 1: 	if ($question_id!=18)
								echo "<input type='submit' name='Previous' value='Previous' style='float:left' />";
							break;
			}

		  if (!isset($validation))
		  {
		  	if (!isset($_POST['Skip'])and !isset($_POST['Save']))
		  		echo "	<input type='submit' name='Save' value='Save' />
		  
		  				<input type='submit' name='Skip' value='Skip' />";
		  }
		  else
		  {
		  	if ((!isset($_POST['Skip'])and !isset($_POST['Save'])) or (!$validation and isset($_POST['Save'])))
		  		echo "	<input type='submit' name='Save' value='Save' />
		  				<input type='submit' name='Skip' value='Skip' />";
		  }
		  switch($_POST['worksheet'])
			{
				case 0: 	if ($question_id!=18)
								echo "<input type='submit' name='Next' value='Next' style='float:right'/>";
							break;
				case 1:
				case 2: 	if ($question_id!=51)
								echo "<input type='submit' name='Next' value='Next' style='float:right'/>";
							break;
			}

		  ?>
	</div>
</div>

</form>
<!-- the end of the file-->

<div id="footer">
    <p class='left'>Copyright &copy; 2014, UTC-N Cluj Napoca, All Rights Reserved</p>
    <p class='right'>Made by: Isabela Bîrs, Zoltán Nagy, Nándor Verba</p>
    <div class='cl'></div>
 </div>

</body>
</html>	