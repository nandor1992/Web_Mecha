<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
include 'db_settings.php'; //database name and passwd
include 'answer_functions.php'; // contains a function which returns the state of an answer
session_start();

//connecting to the database, it is here because it will be used everywhere
$con = mysql_connect($host,$user,$password);
if (!$con)
  {
  	die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_name,$con) or die ("Could not connect to database");

include 'question_limits.php';

//this is the most important variable, will be used all along 
if (!isset($_POST['question'])||!isset($_POST['worksheet']))
{
header('Location: worksheet.php?error=4');
}
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

<!-- Header -->
<?php
$title= "Questions";
$active=3;
include 'header.php';
?>
<!-- Main Body -->
		
		<!-- This is where it all begins -->
		<form style='text-align:center' method='post' action='worksheet_detailed.php'>
			<input type='submit' name='Submit' value='Back to Worksheet' style='width:130px' />
			</form>
		<?php
		// that is where the question part starts the previous part is for formatting the page
		$answerstatus=answerStatus($question_id,$w_id);
		list($n, $country_id, $var_type)=showQuestion($question_id, $answerstatus, $w_type, $w_id); // it returns the nr of variables		
		//end of the php part which refers just to the question
		?>

			<div style='width:800px;text-align:center;padding:10px'>
				<div style='text-align:center;width:320px;padding-left:300px'>
					<input type='hidden' name='question' id='worksheet' value=<?php echo $question_id ?>>
					<input type='hidden' name='worksheet' id='worksheet' value= <?php echo $_POST['worksheet'] ?>>
					<?php
					if ($country_id!=0)
						echo "<input type='hidden' name='country_id' id='country_id' value=".$country_id.">";
					?>
					<input type='hidden' name='upper_limit' id='upper_limit' value= <?php echo $upper_limit ?>>
					<input type='hidden' name='down_limit' id='down_limit' value= <?php echo $down_limit ?>>

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
					if($question_id!=1)
					{
						echo "<div><input type='submit' name='Previous' value='Previous' style='float:left' /></div>";
					}

					if($question_id!=$upper_limit)
					{
						echo "<input type='submit' name='Next' value='Next' style='float:right'/>";
					}
					?>
				</div>
			</div>
		<!-- Footer -->

<?php
include 'footer.php';
?>