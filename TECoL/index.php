<?php

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
	if ($ip=="::1")
	{
	//echo $host;
	$ip="94.3.12.255";
	}
   return $ip;
}

session_start();
if (isset($_REQUEST['error']) and $_REQUEST['error']==1) 
{print "<script type=\"text/javascript\">";
print "alert('Error,Please log in to view this page')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==2) 
{print "<script type=\"text/javascript\">";
print "alert('Error,You need to be administrator to view this page')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==3) 
{print "<script type=\"text/javascript\">";
print "alert('Error,Invalid Page Acces')";
print "</script>";   
}

if (isset($_REQUEST['error']) and $_REQUEST['error']==4) 
{print "<script type=\"text/javascript\">";
print "alert('404 Error, page not found')";
print "</script>";   
}
 $ip_req=getRealIpAddr();
 include 'db_settings.php';
 $con = mysql_connect($host,$user,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_name,$con) or die ("Could not connect to database");
$sql="SELECT * FROM visitors WHERE ip='".$ip_req."' ";
$result=mysql_query($sql) or die("cannot connect 3 ");
$res2= mysql_num_rows($result);
if(!isset($_SESSION['username'])&&($res2==0))
{
$xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".getRealIpAddr());
 $country_req=$xml->geoplugin_countryName;
  if ($country_req=="") {$country_req="Unknown";}
$sql="INSERT INTO visitors (`ip`, `country`) VALUES ('".$ip_req."', '".$country_req."')" ;
$result=mysql_query($sql) or die("cannot connect 3 ");

}
?>

<!-- Header -->
<?php
$title= "Main Page";
$active=1;
include 'header.php';
?>
<!-- Main Body -->


          <h2 style='text-align:center'>Welcome to the Tecol Website</h2>
		  </br>
		  <h3>Objectives</h3>
          <img src="css/images/highlight.gif" alt="" class="right" />
          <p style='text-align:justify'>The main objective of the project is to increase the efficiency of financial investigations through the active involvement of civil society and individuals. We also aim to encourage horizontal cooperation, as well as public-private partnerships between active citizens and empowered institutions for the prevention of financial crime.

The specific objective of the project is to develop and distribute tools for the detection and identification of cartels, specifically web-enabled software using advanced algorithms for the evaluation of companies whose behaviour in a given market situation is suspect and probably the result of cartel (e.g. price fixing, etc.)</p>
		

<!-- Footer -->

<?php
include 'footer.php';
?>