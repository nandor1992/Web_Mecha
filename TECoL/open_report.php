<?php
session_start();
if(isset($_POST['rep_link']))
	{  $rep_link=$_POST['rep_link']; 	   
               //echo "<script>window.open('http://localhost/tecol/$rep_link')</script>";
    
     $file = 'C:/xampp/htdocs/TECoL/'.$rep_link;

if(!$file){ // file does not exist
	die('file not found');
} else {
	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header("Content-Disposition: attachment; filename=$file");
	header("Content-Type: application/zip");
	header("Content-Transfer-Encoding: binary");

    // read the file from disk
	readfile($file);
}

}
else header('Location: report_history.php'); 
?>