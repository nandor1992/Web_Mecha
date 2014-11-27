<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
if (!isset($_SESSION['username'])||!isset($_SESSION['admin'])||!isset($_POST['w_id']))
{
header('Location: index.php?error=2');
}
?><!-- Header -->
<?php
$title= "Administrator";
$active=4;
include 'header.php';
?>
<!-- Main Body -->
		
		<!---- This is where it all begins -->
		<?php
		
		include 'db_settings.php';
		$con = mysql_connect($host,$user,$password);
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			}
			mysql_select_db($db_name,$con) or die ("Could not connect to database");
			$q="SELECT * FROM worksheet WHERE w_id=".$_POST['w_id'];
			$result=mysql_query($q);
			if (!$result) {
				die('Invalid query: ' . mysql_error());
							}
			$row = mysql_fetch_assoc($result);
			$u_id=$row['u_id'];
			$w_name=$row['w_name'];
			$w_id=$row['w_id'];
			$w_type=$row['w_type'];
		?>
			<h2  style='text-align:center;font-size:18px'><?php echo $_POST['username'];?> 
          &nbsp - &nbsp<?php echo $row['w_name']?></h2>
		  <h2 style='text-align:center;font-size:15px'>Worksheet type: 
		  <?php 
		  switch($w_type)
		  {
		  case 1:echo "Structured";break;
		  case 2:echo "CFD";break;
		  case 3:echo "Combined";break;
		  }
		  ?>
		  </h2>
		  <h2 style='text-align:center;font-size:15px;'>Date Created: <?php echo $row['w_date']; ?></h2>
		  <div style='width:900px;text-align:center;float:left;padding:10px'>
			<div style='text-align:center;width:300px;padding-left:390px'>
				<form action='admin_worksheets.php' method='post' style='float:left' >
				<input type='submit' name='Submit' value='Go Back to Worksheets' />
				</form>
				<form action='report.php' method='post' style='float:left;padding-left:5px'>
		  <input type='hidden' name='worksheet' id='worksheet' value=<?php echo $w_id; ?>>
		  </form>
			</div>
			<fieldset >
				<legend style='font-size:15px'>Questions List</legend>
				<table style="width:890px;font-size:12px">
					<tr bgcolor='#FFFFFF' style='text-decoration:underline;'>
						<th width="100px">Question Nr.</th>
						<th width="200px">Question</th>
						<th width="580px">Respone</th>
					</tr>
					<?php
					$q="SELECT w_type FROM worksheet WHERE w_id=".$_POST['w_id'];
					$result=mysql_query($q);
					$row = mysql_fetch_assoc($result);
					if ($row['w_type']==3)
					{
					$q="SELECT * FROM questions";
					}
					else
					{
					$q="SELECT * FROM questions WHERE w_type=".$row['w_type']." OR w_type=0";
					}
					$result=mysql_query($q);
					if (!$result) {	die('Invalid query: ' . mysql_error());	}
					$i=0;
					while($row = mysql_fetch_assoc($result))
					{
					$i++;
					$q="SELECT * FROM answers WHERE q_id=".$row['q_id']." AND w_id=".$_POST['w_id'];
					$result2=mysql_query($q);
					if (!$result2) {	die('Invalid query: ' . mysql_error());	}
					$row2 = mysql_fetch_assoc($result2);
					if (!isset($row2['skip']))
					{
					echo "<tr bgcolor='#C0C0C0'>";
					}
					else
					{
					if ($row2['skip']==1)
					{
					echo "<tr bgcolor='#E86850'>";
					}
					else
					{
					echo "<tr bgcolor='#92CD00'>";
					}
					}
					
					echo "<td >".$i."</td>";
					echo "<td >".$row['question']."</td>";
					echo "<td style='text-align:left'>";
					//Echo variables
					$q="SELECT * FROM answers WHERE q_id=".$row['q_id']." AND w_id=".$_POST['w_id'];
					$result2=mysql_query($q);
					if (!$result2) {	die('Invalid query: ' . mysql_error());	}
					while($row2 = mysql_fetch_assoc($result2))
					{
					if ($row['q_id']==1)
					{
					//Doing this for COuntry
					if ($row2['answer']!=""){
					$q="SELECT * FROM countries WHERE q_id=".$row2['answer'];
					$result3=mysql_query($q);
					if (!$result3) {	die('Invalid query: ' . mysql_error());	}
					$row3 = mysql_fetch_assoc($result3);
					echo "<p>".$row3['country']."</p>";
					}
					}
					else
					{
					if ($row2['answer']!=""){  
					echo "<p>".$row2['answer']."</p>";
					}
					}
					}
					echo"</td>";
					
					echo "</tr>";
					
					
					}
					?>
			
		</table> 
			</fieldset>
			<div style='text-align:center;width:300px;float:right'>
				<table style="width:300px;font-size:10px">
					<tr >
						<td bgcolor='#E86850'>&nbsp&nbsp</td>
						<td>- Skipped</td>
						<td bgcolor='#C0C0C0'>&nbsp&nbsp</td>
						<td>- Not answered</td>
						<td bgcolor='#92CD00'>&nbsp&nbsp</td>
						<td>- Answered</td>
					</tr>
		</table> 
			</div>
		  </div>
		</div>	
		<!-- Footer -->

<?php
include 'footer.php';
?>