<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
if (isset($_REQUEST['error']) and $_REQUEST['error']==1) 
{print "<script type=\"text/javascript\">";
print "alert('Error,wrong username or passsword!')";
print "</script>";   
}
?>
 <link rel="stylesheet" href="styles/login.css" media="screen" type="text/css" />
 <!-- Header -->
<?php
$title= "Login";
$style=2;
include 'header.php';
?>
<!-- Main Body -->
		</br>
		</br>
		<div class="login-card">
    <h1>Log-in</h1><br>
  <form id='login' style='text-align:center' action='login_verify.php' method='post' accept-charset='UTF-8'>
  <input type='hidden' name='submitted' id='submitted' value='1'/>
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" name="login" class="login login-submit" value="login">
  </form>

  <div class="login-help">
    <p style='font-size:100%'> Not a Member? <a href="create.php"><b>Sign up now!<b></a> </p>
  </div>
</div>
         
		<!-- Footer -->

<?php
include 'footer.php';
?>