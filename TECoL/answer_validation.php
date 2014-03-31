<?php
//validation part- check if the input is correct or not

$validation=true;

//this part checks if it is in the right syntax- number or text
for ($i=0;$i<$_POST['n'];$i++)
{
	$answer=$_POST['answer'][$i];
	echo "I'm in the for loop answer value ";
	echo $answer;
	switch($_POST['var_type'][$i])
	{
		case 3: 
		case 6:
		case 7: if (!is_numeric($answer))
				{
					print "<script type=\"text/javascript\">";
					print "alert('Error,this is not numeric!')";
					print "</script>"; 
					$validation=false;
					break;
				} 
				break;
		case 4:
		case 5: if (empty($answer))
				{
					print "<script type=\"text/javascript\">";
					print "alert('Error, you must enter a value!')";
					print "</script>"; 
					$validation=false;
					break;
				}
				else //becuse if it is a yes than the next field has to be filled 
				{
					if ($answer=="yes")
					{
						$i++;
						$answer1=$_POST['answer'][$i];
						if (empty($answer1))
						{
							print "<script type=\"text/javascript\">";
							print "alert('Error, you must specify your answer!')";
							print "</script>"; 
							$validation=false;
							break;
						}
					}
				}
				break;
		case 1: if (empty($answer))
				{
					print "<script type=\"text/javascript\">";
					print "alert('Error, you must enter a value!')";
					print "</script>"; 
					$validation=false;
					break;
				}
				break;

		default: break;
	}
}

//the 7th case has to be treated separately
//previously it was checked if it is a numeric value, here it is checked if it is in the right order and less than 100% 
//because it has to be less than $n
$i--;
if (($_POST['var_type'][$i]==7) and ($validation==true))
{
	//checking if it is in the right order
	$answer=$_POST['answer'][0];
	for ($i=1;$i<$_POST['n'];$i++)
	{
		$aux=$_POST['answer'][$i];
		if (intval($answer)<intval($aux))
		{
			print "<script type=\"text/javascript\">";
			print "alert('Error, it has to be in decreasing order!')";
			print "</script>"; 
			$validation=false;
			break;
		}

		if (intval($answer)>100)
		{
			print "<script type=\"text/javascript\">";
			print "alert('Error,the value has to be less than 100% !')";
			print "</script>"; 
			$validation=false;
			break;
		}
		$answer=$_POST['answer'][$i];
	}
	//it also has to be checked for the last element
	if (intval($answer)>100)
	{
		print "<script type=\"text/javascript\">";
		print "alert('Error,the value has to be less than 100% !')";
		print "</script>"; 
		$validation=false;
		break;
	}
}

?>