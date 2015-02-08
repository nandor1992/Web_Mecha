<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
if (isset($_REQUEST['error']) and $_REQUEST['error']==1) 
{print "<script type=\"text/javascript\">";
print "alert('Please complete all fields!')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==2) 
{print "<script type=\"text/javascript\">";
print "alert('Username already exists in  the database!')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==3) 
{print "<script type=\"text/javascript\">";
print "alert('The Passwords you have entered do not match')";
print "</script>";   
}
?>
 <link rel="stylesheet" href="styles/bootstrap.css" media="screen" type="text/css" />
<!-- Header -->
<?php
$title= "Create User";
$active=1;
include 'header.php';
?>
<!-- Main Body -->
		</br>
		</br>
		
		<form id='login' style='text-align:center' action='create_user.php' method='post' accept-charset='UTF-8' class="bootstrap-frm">
		<input type='hidden' name='submitted' id='submitted' value='1'/>
    <h1>Create User 
        <span>Please fill all the texts in the fields.</span>
    </h1>
    <label>
        <span>First Name :</span>
        <input id="name" type="text" name="first_name" placeholder="Your First Name" />
    </label>
	
	<label>
        <span>Last Name :</span>
        <input id="name" type="text" name="last_name" placeholder="Your Last Name" />
    </label>
   
   <label>
        <span>Username :</span>
        <input id="name" type="text" name="username" placeholder="Your Username" />
    </label>
    <label>
        <span>Your Email :</span>
        <input id="email" type="email" name="email" placeholder="Valid Email Address" />
    </label>
   
   <label>
        <span>Password :</span>
        <input id="email" type='password' name='password' placeholder="Enter a Password" />
    </label>
	
	<label>
        <span>Confirm Password :</span>
        <input id="email" type='password' name='password-confirm' placeholder="Confirm your Password" />
    </label>
       
     <label>
        <span>&nbsp;</span>
        <input type="submit" name='Submit' class="button" value="Create User" />
    </label>    
</form>
	</br>
	</br>
	<!-- Footer -->

<?php
include 'footer.php';
?>