<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<?php
include 'db_settings.php';
session_start();
echo "<p>Username: ".$_SESSION['username']."</p>";
echo "<p>Username ID: ".$_SESSION['id']."</p>";
echo "<p>Question_id: ".$_POST['question']."</p>";
echo "<p>Country_id: ".$_POST['country']."Country id can be empty</p>";
echo "<p>Worksheet_id: ".$_POST['worksheet']."</p>";


$question_id = $_POST['question'];

//validation procedure
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
//it requires a msql database connection for the questions and for the data 


	$con = mysql_connect("localhost",$user,$password);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	mysql_select_db($db_name,$con) or die ("Could not connect to database");

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

	if ($num_results > 0){
	
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
	echo "<form name='input' action='question.php' method='post'>";
	for($i=0;$i<$n;$i++)
	{
		switch($var_type[$i])
		{
			case 1: echo "<input type='text' name='answer'>";
					break;
			case 2: echo "<textarea name='answer' rows='4' cols='50'> Specify your answer here ... </textarea>";
					break;
			case 3: echo "<input type='text' name='answer'>";
					break;
			case 4: echo "<input type='radio' name='answer' value='yes'>yes
					<input type='radio' name='answer' value='no'>no";
					break;
			case 5: echo "<input type='radio' name='answer' value='yes'>yes
					<input type='radio' name='answer' value='no'>no";
					break;
			case 6:	echo "<input type='text' name='answer'>";
					break;
			case 7: echo "<input type='text' name='answer'>";
					break;
			default : echo "error";
		}
		echo "&nbsp;";	
	}


?>

<div style='width:900px;text-align:center;float:left;padding:10px'>
	<div style='text-align:center;width:320px;padding-left:282px'>
		  <input type='hidden' name='question' id='worksheet' value=<?php echo $question_id ?>>
		  <input type='hidden' name='country' id='worksheet' value=23>
		  <input type='hidden' name='worksheet' id='worksheet' value= <?php echo $_POST['worksheet'] ?>>

		  <input type='submit' name='Previous' value='Previous' style='float:left' />
		  <input type='submit' name='Save' value='Save'  />
		  <input type='submit' name='Skip' value='Skip' />
		  <input type='submit' name='Next' value='Next' style='float:right'/>
	</div>
</div>

</form>
<!-- the end of the file-->

<div id="footer">
    <p class='left'>Copyright &copy; 2014, UTC-N Cluj Napoca, All Rights Reserved</p>
    <p class='right'>Made by: Iza Birs, Zoltán Nagy, Nándor Verba</p>
    <div class='cl'></div>
 </div>

</body>
</html>	