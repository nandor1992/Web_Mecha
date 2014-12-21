
</article>
        </div>
			<footer>
				<div id="footer-menu">
					<ul class="fm">
						<li><a href="index.php"><strong>Home</strong></a></li>
						<li><a href="project-tecol-welcome.php"><strong>Project TECoL</strong></a></li>
                        <li><a href="project-tecol-welcome.php">Welcome</a></li>
						<li><a href="what-is-tecol.php">What is TECol?</a></li>
						<li><a href="how-does-tecol-work.php">How does TECoL work?</a></li>    
						<li><a href="why-use-tecol.php">Why use TECoL?</a></li>
						<li><a href="contact-us.php"><strong>Contact us</strong></a></li>
					</ul>
                    
					<ul class="fm">
					  <li><a href="about-us.php"><strong>About us</strong></a></li>
						<li><a href="scab.php">SCA Bulgaria</a></li>
						<li><a href="frs.php">Forseti Consult</a></li>
						<li><a href="flare.php">FLARE Network</a></li>    
						<li><a href="spf.php">Cooperative Speha Fresia</a></li>
						<li><a href="tuc.php">TUC</a></li>
						<li><a href="mecb.php">MECB</a></li>
					</ul>
                    
					<ul class="fm">
						<li><a href="economic-framework.php"><strong>Economic Framework</strong></a></li>
						<li><a href="legal-framework.php"><strong>Legal Framework</strong></a></li>
						<li><strong><a href="cfd-tool.php">CFD Tool</a></strong></li>
						<li><strong><a href="str-tool.php">STR Toll</a></strong></li>
						<li><a href="help.php"><strong>Help</strong></a></li>
					</ul>
				</div>
                
				<div id="ec-logo">
					<img src="images/ec-logo.png" alt="European Commission Logo">
				</div> 
				<div id="disclaimer">
                <?php
				include 'db_settings.php';
 $con = mysql_connect($host,$user,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_name,$con) or die ("Could not connect to database");
$sql="SELECT * FROM visitors ";
$result=mysql_query($sql) or die("cannot connect 3 ");
$res2= mysql_num_rows($result);
	echo "<p style='color: #d3d3d3;'><b> Number of Unique Visitors: ".$res2."</b></br>";?>
                
                <p>This project has been funded with support from the European Commission. This website reflects the views only of the author, and the European Commission cannot be held responsible for any use which may be made of the information contained therein.
</p>
                </div>  
			</footer>       

	</div>
	<p>&nbsp;</p>
</body>
</html>