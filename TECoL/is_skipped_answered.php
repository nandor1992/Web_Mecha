<?php
//is skipped? is answered?

//variables
$unskipped=true;
$skipped=false;
$u_id=$_SESSION['u_id'];
$w_id=$_POST['worksheet'];
$sql_var="SELECT * FROM answers	WHERE q_id LIKE '{$question_id}'  AND w_id LIKE '{$w_id}'";
$vars=mysql_query($sql_var) or die ("I died ");

if (!$vars) 
{
    die('Invalid query: ' . mysql_error());
}
if (mysql_num_rows($vars) > 0) 
{
	while ($row = mysql_fetch_assoc($vars))
	{	
		if ($row['skip']==1)
		{
			$unskipped=false;
			$skipped=true;
			$unanswered=false;
			break;
		}
		else
		{
			$unanswered=false;
		}
	}
}
else
{
	$unanswered=true;
}

?>