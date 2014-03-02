<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>TEcol</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/jquery.jcarousel.css" type="text/css" media="all" />
<!--[if IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->
<link rel="shortcut icon" href="css/images/favicon.ico" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.jcarousel.pack.js"></script>
<script type="text/javascript" src="js/func.js"></script>
</head>
<body>
<div class="shell">
  <div class="border">
    <div id="header">
      <h1 id="logo"><a href="#" class="notext">TEcol</a></h1>
      <div class="cl">&nbsp;</div>
    </div>
    <div id="navigation">
      <ul>
        <li><a href="#" class="active">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Projects</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <div class="cl">&nbsp;</div>
    </div>
    <div id="main">
      <div id="content" class="left">
        <div class="highlight">
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
        <div class="projects">
          <h3>About the project</h3>
          <div class="item">
            <div class="image left"> <a href="#"><img src="css/images/project01.jpg" alt="" /></a> </div>
            <div class="text left">
              <h4>simply dummy title</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Lorem Ipsum is</p>
              <a href="#" class="more">Find out more</a> </div>
            <div class="cl">&nbsp;</div>
          </div>
        </div>
      </div>
      <div class="cl">&nbsp;</div>
    </div>
  </div>
  <div id="footer">
    <p class="left">Copyright &copy; 2010, Your Company Here, All Rights Reserved</p>
    <p class="right"><a href="http://www.free-css.com/">Free CSS Templates</a> by <a href="http://chocotemplates.com">Chocotemplates.com</a></p>
    <div class="cl"></div>
  </div>
</div>
</body>
</html>