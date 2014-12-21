<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
if (isset($_REQUEST['error']) and $_REQUEST['error']==1) 
{print "<script type=\"text/javascript\">";
print "alert('Error,wrong username or passsword!')";
print "</script>";   
}
?><!-- Header -->
<?php
$title= "Login";
$style=2;
include 'header.php';
?>
<!-- Main Body -->
		
          <form id='login' style='text-align:center' action='login_verify.php' method='post' accept-charset='UTF-8'>
 
                        <div id="page-title"><h3><strong>Login</strong></h3></div>
						
<input type='hidden' name='submitted' id='submitted' value='1'/>
 
<label for='username' >UserName:</label>
<input type='text' name='username' id='username'  maxlength="50" />
 </br>
<label for='password' >Password:</label>
<input type='password' name='password' id='password' maxlength="50" />
 </br>
<input type='submit' name='Submit' value='Submit' />
 
</form>
		<!-- Footer -->

<?php
include 'footer.php';
?>