<?php
/* to make everything more visible -- use functions!!! */

//function which returns a $status value referring to the status of the answer
//initial value = 0, skipped = 1, answered = 2, not_answered = 3;
function answerStatus($question_id, $worksheet_id)
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

function saveAnswer($question_id, $worksheet_id, $status)
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
}
function fillTextFieldWithAnswer($question_id, $worksheet_id)
{
	//it fills the text area/ text filled with the answer if it is filled

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
?>