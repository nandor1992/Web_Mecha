<?php

require ('fPDF/mc_table.php');

function strWorksheetToPDF($worksheetSelected, $reportName, $saveName, $username , $comment){
	 //$pdf = new FPDF();
	 $pdf=new PDF_MC_Table();
     $pdf->AddPage();
     $pdf->SetFont('Arial','B',12);
     $pdf->SetWidths(array(190));

     //add report name, date generate, user
     $pdf->Ln(10);
     $name = 'Report name: '.$reportName;
     $pdf->Row(array($name));
     $pdf->Ln(2);
     $generatedBy= 'User: '.$username;
	 $pdf->Row(array($generatedBy));
     $pdf->Ln(2);
     $date=$_SERVER['REQUEST_TIME'];
     $readableDate='Date: '.date('d M Y  h:i:s A e', $date);
     $pdf->Row(array($readableDate));
     $pdf->Ln(2);
     $userComment='Comment: '.$comment;
     $pdf->Row(array($userComment));
     $pdf->Ln(2);
     $pdf->SetFont('Arial','',12);
     
     
     $question_index=0;
     	//select the answers
    	$sql="SELECT var_id, answer, q_id FROM answers WHERE w_id='".$worksheetSelected."'ORDER BY q_id ASC";
	    $var_ids=mysql_query($sql);
	    $last_question=' ';
	    while($row=mysql_fetch_assoc($var_ids)){
	    // get question
	    
	    $sql="SELECT question FROM questions WHERE q_id='".$row['q_id']."'";
	    $answer=mysql_query($sql);
	    $question_text=mysql_fetch_assoc($answer);
	   
        
        //this is done for questions with multiple variables
        if($question_text['question']!=$last_question){
	    $last_question=$question_text['question'];
	    $pdf->Ln(5);
	    $question_index=$question_index+1;
	    unset($question_text2);
	    $question_text2 = $question_index. '. '.$question_text['question'];
	    $pdf->SetTextColor(51,51,255);
	    $pdf->Row(array($question_text2));
	    $pdf->Ln(1);
	    }

	    //put question text to pdf
	    
		//get variable text
		$sql="SELECT var_text FROM variable WHERE var_id='".$row['var_id']."'";
		$var_text=mysql_query($sql);
		$row2=mysql_fetch_assoc($var_text);
		
		//check if the variable is country and if yes take the name, not the id
		if($row['var_id']=='1'){
			$sql2="SELECT country FROM countries WHERE q_id='".$row['answer']."'";
			$var_country=mysql_query($sql2);
			$country_name=mysql_fetch_assoc($var_country);
			$row['answer']=$country_name['country'];
			
		}
		//add var text to pdf
		$pdf->SetTextColor(0,0,0);
		//$pdf->Cell(40,40,$row2['var_text']);
		$pdf->Row(array($row2['var_text']));
		 $pdf->Ln(1);
		//add the answer to pdf
		 $pdf->SetTextColor(153,0,0);
		//$pdf->Cell(40,40,$row['answer']);
		 $pdf->Row(array($row['answer']));
		 $pdf->Ln(1);

		//echo $row2['var_text']." ".$row['answer']."<br>";
	}

	$pdf->Output($saveName);
	//$pdf->Output();
}
?>