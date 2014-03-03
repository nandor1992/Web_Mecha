<?php
session_start();
echo "
<body>
<div class='shell'>
  <div class='border'>
    <div id='header'>
      <h1 id='logo'><a href='home.php' class='notext'>TEcol</a></h1>  
    </div>
    <div id='navigation'>
      <ul>
        <li><a href='home.php'>Home</a></li>
        <li><a href='about.php'>About</a></li>";
		if(isset($_SESSION['username']))
		{
		echo "<li><a href='worksheet.php'>Worksheet</a></li>";
        if (isset($_SESSION['admin']))
		{
		echo "<li><a href='admin.php'>Administrator</a></li>";
		}
        }
     echo" </ul>	 <div style='text-align:right'>";
	 if(isset($_SESSION['username']))
	 { echo "	<p> Hello &nbsp <b> ";
	 echo $_SESSION['username'];
	echo " </b>!</p> <a href='logout.php'>Logout </a>";
	
	}
	else
	echo"
	<p> Guest User</p>
	<a href='login.php'>Login &nbsp&nbsp&nbsp&nbsp</a>
	<a href='login.php'>Create Account </a>
	</div>
      <div class='cl'>&nbsp;</div>
    </div>";
	?>