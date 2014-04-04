<?php

if (!isset($_POST['str_down_limit'])) //we don't need to check all of them, because if one isset than also the others
{
	list($str_upper_limit, $cfd_upper_limit, $str_down_limit, $cfd_down_limit)=questionLimits();
}
else
{
	$str_upper_limit=$_POST['str_upper_limit'];
	$cfd_upper_limit=$_POST['cfd_upper_limit'];
	$str_down_limit=$_POST['str_down_limit'];
	$cfd_down_limit=$_POST['cfd_down_limit'];
}

?>