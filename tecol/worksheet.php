<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
if (!isset($_SESSION['username']))
{
header('Location: index.php?error=1');
}

if (isset($_REQUEST['error']) and $_REQUEST['error']==1) 
{print "<script type=\"text/javascript\">";
print "alert('Worksheet and all saved Responses Deleted!')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==2) 
{print "<script type=\"text/javascript\">";
print "alert('Worksheet created!')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==3) 
{print "<script type=\"text/javascript\">";
print "alert('Please enter a Worksheet name that is longer then 2 Characters!')";
print "</script>";   
}
if (isset($_REQUEST['error']) and $_REQUEST['error']==4) 
{print "<script type=\"text/javascript\">";
print "alert('Invalid use of questions.php redirected')";
print "</script>";   
}
?>
<!-- Header -->
<?php
$title= "Worksheet";
$active=3;
include 'header.php';
?>
<!-- Main Body -->
		
		<div style='width:900px;float:left'>
         
		  <div style='width:900px;float:left;padding:10px'>
          <?php
		  // Querry for worksheet entries
if  (!isset($_REQUEST['type']))
{
unset($_SESSION['worksheet_type']);
echo "<div style='text-align:center; width:500px'> 
		<h2> Select your worksheet type</h2>
		</br>
		<a href='worksheet.php?type=1' style='display: block;  width: 220px;  height: 25px;  background: #DCDCDC;  padding: 10px;  text-align: center;  border-radius: 5px;  color: white; font-size:16px; font-weight: bold; float:left;'>STR Tool</a>
		<a href='worksheet.php?type=2' style='display: block;  width: 220px;  height: 25px;  background: #DCDCDC;  padding: 10px;  text-align: center;  border-radius: 5px;  color: white; font-size:16px; font-weight: bold; float:right;'>CFD Tool</a>
		</div>";
}
else
{
$_SESSION['worksheet_type']=$_REQUEST['type'];
$type_worksheet=$_REQUEST['type'];
		  include 'db_settings.php';
$con = mysql_connect($host,$user,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db_name,$con) or die ("Could not connect to database");
$id=$_SESSION['id'];
if($type_worksheet==1)
{$sql="SELECT * FROM `worksheet` JOIN `users` ON worksheet.u_id = users.u_id  WHERE (username='$id' AND w_type=1 )";}
else
{$sql="SELECT * FROM `worksheet` JOIN `users` ON worksheet.u_id = users.u_id  WHERE (username='$id' AND w_type!=1 )";}
$i=0;//for array length		  
$result=mysql_query($sql) or die("cannot connect 2 ");
    while($row = mysql_fetch_array($result)) {
	$i++;//for array length TO-DO smarter
		  //for --while
		  echo "
		  <div style='width:280px;height:100px;float:left;padding:5px;border-width:2px;background-color:#d3d3d3; border-style: outset; border-color: gray;'>
		  <p>";
		  echo "Worksheet ".$i;
		  echo"</p>
		  <b>";
		  echo $row['w_name']."</b>";
		  switch ($row['w_type'])
		  {
		  case 1:$type=" Structural";break;
		  case 2:$type=" CFD1";break;
		  case 3:$type=" CFD2";break;
		  case 4:$type=" CFD3";break;
		  case 5:$type=" CFD4";break;
		  case 6:$type=" CFD5";break;
		  case 7:$type=" CFD1";break;
		  }
		  echo "<p>Worksheet type:".$type."</p>";
		  echo "
		  <form action='worksheet_detailed.php' method='post' style='float:left;padding-right:5px'>
		  <input type='hidden' name='worksheet' id='worksheet' value=".$row['w_id'].">
		  <input type='submit' name='Submit' value='Manage' />
		  </form>
		  <form action='worksheet_delete.php' method='post' style='float:left' onSubmit=\"if(!confirm('Are you sure you want to delete the Worksheet?')){return false;}\">
		  <input type='hidden' name='worksheet' id='worksheet' value=".$row['w_id'].">
		  <input type='submit' name='Submit' value='Delete' />
		  </form>
		  <p  style='text-align:right;float:right' >";
		  echo $row['w_date'];
		  echo "</p>
		  </div>";}
		  // Echoing new sheet if neccesary
		  if($i<10)
		  {echo "
		  <div style='width:280px;height:100px;float:left;padding:5px;border-width:2px; border-style: outset; border-color: gray;'>
		  <b>Create New Worksheet !</b>
		  
		  <form action='worksheet_create.php' method='post' >
		  </br><p> Insert Worksheet name: 
		  
		  <input type='text' name='w_name' id='w_name'  maxlength='30' style='width:130;float:right'>
		  </p>";
		  if ($type_worksheet==1)
		  {
		  echo "<input type='hidden' name='w_type' value='1' style='width:130;float:left'>";
		  }
		  else
		  {
		  echo "<p> Select Type: 
				<select name='w_type' style='width:130'>
				<option value='2'>CFD1</option>
				<option value='3'>CFD2</option>
				<option value='4'>CFD3</option>
				<option value='5'>CFD4</option>
				<option value='6'>CFD5</option>
				<option value='7'>CFD6</option>
		  </select>";
		  }
		  echo  "<input type='submit' name='Submit' value='Create' style='width:130px;float:right' /> </p>
		  </form>
		 </div>";
		  }
		  echo "<a href='worksheet.php' style='clear:both; display: block;  width: 60px;  height: 18px;  background: #DCDCDC;  padding: 10px;  text-align: center;  border-radius: 5px;  color: white; font-size:12px; font-weight: bold; float:right;'>Go back</a>";
		  
		  }
		 ?>
		  </div >
		  <div style='width:900px;paddig:10px'>
		  
	</div>
</div>	
		<!-- Footer -->

<?php
include 'footer.php';
?>