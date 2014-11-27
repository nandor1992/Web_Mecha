<?php
//to select the right hint
//selecting the country_id from the answers 
$sql="SELECT answer FROM answers WHERE q_id='1' AND w_id='".$w_id."' AND var_id='1'";
$result=mysql_query($sql) or die("cannot connect 1 ");
//if it is not set returns false
if ($row=mysql_fetch_assoc($result))
{
	$c_id=$row['answer'];
}
if (isset($c_id))
{
	$sql="SELECT hint FROM hint WHERE country_id='".$c_id."' AND q_id='".$question_id."'";

	$result=mysql_query($sql) or die("cannot connect 2 ");

	//if there is no hint for that question = no hint
	while ($row = mysql_fetch_assoc($result))
	{
		echo"<div style='border: solid 1px white';>
		 <br><p> Hint : ".$row['hint']. "</p><br></div>";
	}
}
?>