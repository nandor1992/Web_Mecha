<?php

$w_type=$_SESSION['w_type'];
if (!isset($_POST['down_limit'])) //we don't need to check all of them, because if one isset than also the others
{
	list($down_limit, $upper_limit)=questionLimits($w_type);
}
else
{
	$upper_limit=$_POST['upper_limit'];
	$down_limit=$_POST['down_limit'];
}

?>