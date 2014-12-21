<!DOCTYPE html>
<html lang="en-US">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='shortcut icon' href='styles/my_icon.ico' />
<title>TECoL - <?php echo $title?></title>
<?php
if(isset($active))
{
$style="2";
}
include 'db_settings.php';
 $con = mysql_connect($host,$user,$password);
switch($style)
{
case "1": echo "<link href='styles/style.css' rel='stylesheet' type='text/css'>"; break;
case "2": echo "<link href='styles/style-tecol-tool.css' rel='stylesheet' type='text/css'>";break;
}
?>
</head>

<body>
	<div id="wrapper">
    	<div id="container">
            <header id="header">
            	<div class="date-time" id="dateCell">
					<script type="text/javascript" src="javascript/date-time.js"></script>
                </div>
                
                <div class="sub-nav">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="project-tecol-welcome.php">Project TECoL</a></li>
						<?php
						
						if (isset($_SESSION['admin']))
								{
						echo "<li><a href='admin.php'>Administrator</a></li> ";
						}
						?>
                        <li><a href="about-us.php">About us</a></li>
                        <li><a href="contact-us.php">Contact us</a></li>
                    
					</br>
					</ul>
					</br>
					</br>
					<?php		
          if(isset($_SESSION['username']))
	 { echo "<p style='color: #d3d3d3;'> Hello &nbsp <b> ".$_SESSION['username']." </b>! <a href='logout.php'>Logout </a></p>";	}
	else{
	echo"
	<p style='color: #d3d3d3;padding-top:10px;'> Hello Guest User !
	<b><a href='login.php'>Login</a>&nbsp&nbsp&nbsp&nbsp
	<a href='create.php'>Create Account </a></b></p>";
	}
	?>
                </div>
                    
                <div id="logo-nav-container">
                    <div id="logo">
                      <a href="index.php">
                           <img src="images/tecol-logo-shadow.jpg" alt="TECoL-Logo">
    	    			</a>
                    </div>
                   
                  <div id="slogan">
                    	<div id="text-slogan">
                    		<h4>Tool for Enforcing <br>Competition Law</h4>
                    	</div>
                    </div>
                  <nav>
                  	<div class="main-nav">
                        <ul>
                            <li ><a href="economic-framework.php">ECONOMIC FRAMEWORK</a></li>
                            <li ><a href="legal-framework.php">LEGAL FRAMEWORK</a></li>
							<?php
							if(isset($_SESSION['username']))
									{
									echo "<li><a href='worksheet.php'";
									echo ">WORKSHEET</a></li>";
									echo "<li><a href='report.php'";
									echo ">REPORT</a></li>";
									}
									else
									{
									echo "<li><a href='cfd-tool.php'>CFD TOOL</a></li>";
									echo "<li><a href='str-tool.php'>STR TOOL</a></li>";
									}
									?> 
                            <li><a href="help.php">HELP</a></li>
                    	</ul>
                    </div>
                  </nav>
                </div>
            </header>
            
            <article>

