<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
if (!isset($_SESSION['username'])||!isset($_SESSION['admin']))
{
header('Location: index.php?error=2');
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==1) 
{print "<script type=\"text/javascript\">";
print "alert('Hint Modified')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==2) 
{print "<script type=\"text/javascript\">";
print "alert('Please enter Text to the specific are if you want to modify it')";
print "</script>";   
}
?>
<!-- Header -->
<?php
$title= "Administrator";
$active=4;
include 'header.php';
?>
<!-- Main Body -->
		
		<!---- This is where it all begins -->
		<div style='width:</h3></div>;float:left'>
          <div id="page-title"><h3>Hint Text Administration </h3></div>
          <img src="css/images/highlight.gif" alt="" class="right" />
		  <div style='width:</h3></div>;float:left;padding:10px'>
		  <form style='text-align:center' method='post' action='admin_hint_resolv.php'>
		  <?php
					//initial db connection
					include 'db_settings.php';
					$con = mysql_connect($host,$user,$password);
					if (!$con)
					{
					die('Could not connect: ' . mysql_error());
					}
					mysql_select_db($db_name,$con) or die ("Could not connect to database");
					
					
		  echo"
				<table style='width:950px;font-size:12px'>
					<tr bgcolor='#C0C0C0' style='text-decoration:underline;'>
						<th width='80x'>Question ID</th>
						<th width='180px'>Question</th>
						<th > Hint text</th>
						<th width='130px'> Hint link </th>
						<th width='140px' >Operation</th>
					</tr>";
					
					//initial db connection
					include 'db_settings.php';
					$con = mysql_connect($host,$user,$password);
					if (!$con)
					{
					die('Could not connect: ' . mysql_error());
					}
					mysql_select_db($db_name,$con) or die ("Could not connect to database");
					
					//selecting users
					
					$q=" SELECT * FROM `questions` ";
					$result=mysql_query($q);
					if (!$result) {
						die('Invalid query: ' . mysql_error());
							}
					while($row = mysql_fetch_assoc($result))
					{
					{echo "<tr bgcolor='#C0C0C0' style='text-align:center'>";}
					echo "<td>".$row['q_id']."</td>";
					echo "<td>".$row['question']."</td>";
					echo "<form style='text-align:center;float:left' method='post' action='admin_hint_resolv.php'>";
					$q=" SELECT * FROM `hint` WHERE `q_id`='".$row['q_id']."'";
					$result2=mysql_query($q);
					if (!$result2) {
						die('Invalid query: ' . mysql_error());
							}
					$row2 = mysql_fetch_assoc($result2);
					echo "<td><input type='text' name='text' style='width:98%' value='".$row2['hint']."'/></td>";
					echo "<td><input type='text' name='link' style='width:98%' value='".$row2['hint_link']."'/></td>";
					echo "<td>
							<input type='hidden' name='q_id' value='".$row['q_id']."'/>
							<input type='hidden' name='h_id' value='".$row2['h_id']."'/>
							<input type='submit' name='Submit' value='Save Changes' style='width:130px' />
							</form>";
					}
					
					echo "</table> ";
					
		?>
			</fieldset>
		  
		  </div>
		  </div>
         
	<!-- Footer -->

<?php
include 'footer.php';
?>