<?php
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