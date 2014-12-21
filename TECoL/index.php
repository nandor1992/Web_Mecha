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
session_start();
$title= "Main Page";
$style=1;
include 'header.php';

?>
            	<section id="sec-1">
                <p>TECOL-Tools for Enforcing Competition Low is meant to prevent and fight against one of the most dangerous criminal threats of  the contemporary society. The aim is detecting and identification of cartels. As identified in the OCTA 2011 „Key judgments: Organised crime is changing and becoming increasingly diverse in its methods, and impact on society”. It is using Noble – prize winning mathematical theory and modern ICT approach, to enable the EU citizens to detect cartels. Secret cartels are the most serious criminal infringements of the EU competition rules since they invariably result in higher prices and less competitive. They harm industry, consumers in the EU and the whole society.</p>
                </section>
                
                <section id="sec-2">
                <a href="cfd-tool.php" target="_top"><div id="cfd-button"><h1>CFD<br>
TOOL</h1></div></a>
                </section>
                
                <section id="sec-3">
                <a href="str-tool.php" target="_top"><div id="str-button"><h2>STR TOOL</h2></div></a>
                </section>
            
            <?php
include 'footer.php';
?>
