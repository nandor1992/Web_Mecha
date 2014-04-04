<?php
/* to make everything more visible -- use functions!!! */

//function which returns a $status value referring to the status of the answer

function answerStatus($question_id, $worksheet_id)//initial value = 0, skipped = 1, answered = 2, not_answered = 3;
{
	//the connection to the database is already established
	$status=0;//the initial value for the answer status variable

	$sql="SELECT * FROM answers	WHERE q_id LIKE '{$question_id}'  AND w_id LIKE '{$worksheet_id}'";
	$result=mysql_query($sql) or die ("I died ");

	if (!$result) 
	{
	    die('Invalid query: ' . mysql_error());
	}

	if ($row = mysql_fetch_assoc($result)) 
	{
		if ($row['skip']==1)
		{
			$status=1;//skipped
		}
		else
		{
			$status=2;//answered
		}
	}
	else
	{
		$status=3;//not asnwered
	}
	return $status;
}

//using when you click on the Next button
function onClickNext($question_id, $worksheet_id, $w_type)
{
	include 'question_limits.php';//to know the limits of the question
	//first it goes to the next question
	switch($w_type)
	{
		case 1: 	if ($question_id<$str_upper_limit)
						$question_id++;
					break;
		case 2:		if ($question_id<$cfd_upper_limit)
					{
						if ($question_id==2)
						{
							$question_id=$cfd_down_limit;
						}
						else
						{
							$question_id++;
						}
					}
					break;
		case 3: 	if ($question_id<$cfd_upper_limit)
						$question_id++;
					break;
	}
	//it check if it was skipped
	//$status=answerStatus($question_id,$w_id);
	while(answerStatus($question_id,$worksheet_id)==1)//it goes while it gets a value which is not skipped
	{
		//include 'is_skipped_answered.php';
		echo $question_id;
		switch($w_type)
		{
			case 1:
					 	if ($question_id<$str_upper_limit)
						{
							$question_id++;
						}
						else
						{
							header('Location: worksheet_detailed.php?error=4');
							$check=1;
						}
						break;

			case 2:		if ($question_id<$cfd_upper_limit)
						{
							if ($question_id==2)
							{
								$question_id=$cfd_down_limit;
							}
							else
							{
								$question_id++;
							}
						}
						else
						{
							header('Location: worksheet_detailed.php?error=4');
							$check=1;
						}
						break;

			case 3: 	if ($question_id<$cfd_upper_limit)
							$question_id++;
						else
							header('Location: worksheet_detailed.php?error=4');
							$check=1;
						break;
		}
		if (isset($check))
		{
			break;
		}
	}
	return $question_id;
}

// using when you click on the Previous button
function onClickPrevious($question_id, $worksheet_id, $w_type)
{
	include 'question_limits.php';//to know the limits of the question
	
	switch($w_type)
	{
		case 1:
		case 3: 	if ($question_id>$str_down_limit)
						$question_id--;							
					break;

		case 2: 	if ($question_id>$str_down_limit) //because of the first 2 question str_down has used
					{
						if ($question_id==$cfd_down_limit)
						{
							$question_id=2;
						}
						else
						{
							$question_id--;
						}
					}
					break;
	}
	while(answerStatus($question_id,$worksheet_id)==1)//1-is for skipped
	{
		switch($w_type)
		{
			case 1:
			case 3: 	if ($question_id>$str_down_limit)
						{
							$question_id--;
							echo $question_id;
						}
						else
						{
							header('Location: worksheet_detailed.php?error=4');
							$check=1;
						}
							
						break;
			case 2: 	if ($question_id>$str_down_limit)//because of the first 2 question str_dow is used
						{

							if ($question_id==$cfd_down_limit)
							{
								$question_id=2;
							}
							else
							{
								$question_id--;
							}
						}
						else
						{
							header('Location: worksheet_detailed.php?error=4');
							$check=1;
						}
						break;
		}
		if (isset($check))
		{
			break;
		}

	}
	return $question_id;
}

function deleteIfNotEmpty($question_id, $worksheet_id)
{
	if (answerStatus($question_id, $worksheet_id)!=3) // if it is already answered than delete
	{
		$sql="DELETE FROM `answers` WHERE q_id='$question_id' AND w_id='$worksheet_id'";
		$result=mysql_query($sql) or die("cannot connect 2 ");
	}
}

function saveAnswer($question_id, $worksheet_id, $w_type, $status)
//$status=1 for skipped, $status=0 for answered
{
	deleteIfNotEmpty($question_id,$worksheet_id);
	
	//inserting the new values into the database
	$sql="SELECT * FROM variable WHERE q_id LIKE '{$question_id}'";
	$result=mysql_query($sql);
	if (!$result) 
	{
	    die('Invalid query: ' . mysql_error());
	}

	$i=0;//auxiliary variable just to get the answers
	while ($row = mysql_fetch_assoc($result))
	{
		$var_id=$row['var_id'];

		if ($status==1)
		{
			$sql="INSERT INTO answers(q_id, w_id, var_id, skip)
			VALUES ($question_id,'$_POST[worksheet]','$var_id',1)";
		}
		else
		{
			$answer=$_POST['answer'][$i];
			$sql="INSERT INTO answers(q_id, w_id, var_id, skip, answer)
			VALUES ($question_id,'$_POST[worksheet]','$var_id',0,'$answer')";
			$i++;		
		}
		mysql_query($sql); 
	}

	return onClickNext($question_id,$worksheet_id,$w_type);
}
function fillTextFieldWithAnswer($question_id, $worksheet_id) //the index refers to the multianswer case
{	
	//it fills the text area/ text filled with the answer if it is filled
	//$status=answerStatus($question_id, $worksheet_id); 
	//selecting the answers in this worksheet
	$sql="SELECT answer FROM answers	WHERE q_id LIKE '{$question_id}'  AND w_id LIKE '{$worksheet_id}' ORDER BY var_id";
	$result=mysql_query($sql) or die ("I died ");

	//getting the answers
	$i=0;
	while($row = mysql_fetch_assoc($result))
	{
		$answer[$i]=$row['answer'];
		$i++;
	}
	return ($answer);
}

function questionNumber($question_id, $w_type)
{
	include "question_limits.php";
	$q_nr=$question_id;

	if (($w_type==2) AND ($question_id!=2) AND ($question_id!=1))
	{
		$q_nr=$question_id-$str_upper_limit+2;
	}
	return $q_nr;
}

function progressBar($worksheet_id, $w_type)
{
	//this function shows a progress bar currently answered question/ all question at this type
	include 'question_limits.php';
	//calculating the maximum of the progress bar by using the worksheet type
	switch($w_type)
	{
		case 1: $max=$str_upper_limit; break;
		case 2: $max=$cfd_upper_limit-$str_upper_limit+2; break;
		case 3: $max=$cfd_upper_limit; break;
	}

	// getting the answers number by using the worksheet_id
	$sql="SELECT a_id FROM answers WHERE w_id='".$worksheet_id."'";
	$result=mysql_query($sql) or die ("I died ");
	
	$current_value=mysql_num_rows($result);

	echo "<meter style='width:100%;height:2em'  value=".$current_value." min='0' max=".$max."> ".$current_value." out of ".$max."</meter>";

}

function countryDropDownList($selected)
{
	//it makes a drop down list for the 1st question
	$sql="SELECT * FROM countries";
	$countries=mysql_query($sql);
	if (!$countries)
	{
	    die('Invalid query: ' . mysql_error());
	}
	
	//select list
	echo "<select name='answer[]'>";

	$i=1;// for indexing
	while ($row = mysql_fetch_assoc($countries))
	{
		echo "<option value='".$i."'";
		if ($selected==$i)
			echo"selected";	
		
		echo ">".$row['country']."</option>";
		$i++;
	}
	echo "</select>";
}

function insertHint($question_id, $worksheet_id)
{
	//getting a hint for the question if the country is set and there is a hint for that country
	$country_id=0;
	if (!isset($_POST['country_id']))
	{
		$sql="SELECT answer FROM answers WHERE q_id='1' AND w_id='".$worksheet_id."' AND var_id='1'";
		$result=mysql_query($sql) or die("cannot connect 1 ");
		//if it is not set returns false
		if ($row=mysql_fetch_assoc($result))
		{
			$country_id=$row['answer'];
		}
	}
	else
	{
		$country_id=$_POST['country_id'];
	}
	if (isset($country_id))
	{
		$sql="SELECT hint FROM hint WHERE country_id='".$country_id."' AND q_id='".$question_id."'";

		$result=mysql_query($sql) or die("cannot connect 2 ");

		//if there is no hint for that question = no hint
		while ($row = mysql_fetch_assoc($result))
		{
			echo"<div style='border: solid 1px white';>
			 <br><p> Hint : ".$row['hint']. "</p><br></div>";
		}
	}

	return $country_id;
}

function showQuestion($question_id, $answerstatus, $w_type, $w_id)
{
	$question_sql="SELECT * FROM questions WHERE q_id LIKE '{$question_id}'";
	$question=mysql_query($question_sql);
	
	if (!$question) 
	{
	    die('Invalid query: ' . mysql_error());
	}
//the question is selected from the table
	$row = mysql_fetch_assoc($question);
	$num_results = mysql_num_rows($question); 
	$question_aux=$row['question']; //if I put just $row['question'] doesent work in the last line

	if ($num_results > 0)
	{
//if everything is OKAY than it will show the question, with number
		echo "<div style='";
		//the color of the question, using this answerStatus function
		switch($answerstatus) 
		{
			case 1: echo "background-color:#E86850;"; break; //skipped
			case 2: echo "background-color:#92CD00;"; break; //answered
			case 3: echo "background-color:#C0C0C0;"; break; //not answered
		}

		echo "clear:both;text-align:center;'>";

		progressBar($w_id,$w_type);
		echo "<div style='border: solid 1px white;font-size:18px';>
			<p text-align:center; > ".questionNumber($question_id,$w_type).": ".$question_aux."</p></div>";
	}
	// to get the variables for this question: type, text, name
	$variables=getVariables($question_id);
	$i=0;// an auxiliary variable to get all the solution
	while ($row = mysql_fetch_assoc($variables))
	{
		//storing all the data in a vector			
		$var_name[$i]=$row['var_name'];
		$var_text[$i]=$row['var_text'];
		$var_type[$i]=$row['var_type'];
		$i++;
	}
			
	$n=$i;
	echo "<form name='input' action='question.php' method='post' style='text-align:center'>";
	if ($answerstatus==2)//which means it was answered
	{
		$text=fillTextFieldWithAnswer($question_id, $w_id); //it returns a vector with previously answered question
	}
	else
	{
		$text=null;//otherwise null
	}
	showTextBoxes($var_text, $var_type, $n, $text); //showing the right textboxes
	echo "<br><br>";// for some spaces between textboxes and hints
	$country_id=insertHint($question_id, $w_id);
	echo "</div>"; 	

	return array ($n,$country_id,$var_type); //returns the number of elements nad the variable types
}

function getVariables($question_id)
{
	$variable_sql="SELECT * FROM variable WHERE q_id LIKE '{$question_id}'";
	$variables=mysql_query($variable_sql);

	if (!$variables) 
	{
	    die('Invalid query: ' . mysql_error());
	}
	return $variables;
}

function yesnoRadioBox($text)
{
	if ($text=='yes')
	{
		echo "<input type='radio' name='answer[]' value='yes' checked >yes
			  <input type='radio' name='answer[]' value='no'>no";
	}
	else
	{
		if ($text=='no')
		{
			echo "<input type='radio' name='answer[]' value='yes'>yes
				  <input type='radio' name='answer[]' value='no' checked >no";			
		}
		else
		{
			echo "<input type='radio' name='answer[]' value='yes'>yes
				  <input type='radio' name='answer[]' value='no'>no";	
		}
	}
}

function showTextBoxes($var_text, $var_type, $n, $text)
{
	for($i=0;$i<$n;$i++)
	{
		echo "<br><p text-align:center; > ".$var_text[$i]."</p>";//this is an auxiliary text for the question for better understanding
		switch($var_type[$i])
		{
			case 1: countryDropDownList($text[0]);
					break;
			case 6:
			case 7:
			case 3: echo "<input type='text' name='answer[]' value='".$text[$i]."' style='padding: 2px; border: solid 1px orange'>";
					break;
			case 2: echo "<textarea name='answer[]' rows='4' cols='50' style='border: solid 1px orange'>".$text[$i]."</textarea>";
					break;
			case 4:
			case 5: yesnoRadioBox($text[$i]);
					break;
			default: echo "error";//this is not necessary, because it cannot happen
		}
		echo "&nbsp";	
	}
}

function questionLimits()
{
	$sql="SELECT w_type FROM questions";
	$result=mysql_query($sql) or die ("I died here");
	
	$str_upper_limit=0;
	$cfd_upper_limit=0;

	$str_down_limit=1;
	$cfd_down_limit=19;

	while($row=mysql_fetch_assoc($result))
	{
		if ($row['w_type']==1)
		{
			$str_upper_limit++;
		}
		if ($row['w_type']==2)
		{
			$cfd_upper_limit++;
		}
	}
	$str_upper_limit+=2;
	$cfd_upper_limit=$cfd_upper_limit+$str_upper_limit;
	$cfd_down_limit=$str_upper_limit+1;

	//echo $cfd_upper_limit;
	
	return array ($str_upper_limit, $cfd_upper_limit, $str_down_limit, $cfd_down_limit);
}
?>