
<?php 
include 'begin.php'
?>
<?php

echo "
    <div id='main'>
      <div id='content' class='left'>
        <div class='highlight'>
			<h3>Login</h3>
			          <div id='sidebar'>
			            <ul>
			              <li id='login'>
			                <form id='loginform' action='login.php' method='post'>
			                Username: <input type='text' name = 'username' align = 'left'>
			                <br />
			                Password: <input type='password' name = 'password' align ='left' >
			                <br/>
			                <input type='submit' value = 'Login' >
			                </form>
			                <form id='loginform' action='register.php' method='get'>
			                <input type = 'submit' value = 'Register' name = 'register'>
			                </form>
			              </li>
			            </ul>
			          <!-- end #sidebar -->
		</div>
	  </div>
	</div>


"
?>

<?php
include 'end.php'
?>