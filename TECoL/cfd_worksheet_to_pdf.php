<?php

require ('fPDF/mc_table.php');

//1 graph
//w_name 0 for simple cfd
function cfd1WorksheetToPDF($worksheetSelected, $other_worksheets, $reportName, $saveName, $username , $comment, $questionThatHasGraph, $w_name){
	 //$pdf = new FPDF();
	$pdf=new PDF_MC_Table();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',12);
	$pdf->SetWidths(array(190));

     //add report name, date generated, user
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
	$no_of_selected_worksheets = count($other_worksheets);
	$first_iteration=0;

     	//select the answers for the main worksheet
	$sql="SELECT var_id, answer, q_id FROM answers WHERE w_id='".$worksheetSelected."'";
	$var_ids=mysql_query($sql);
	    //select the answers for the other worksheets
	$last_question=' ';
	$data_on_graph_index=0;
	$array_others=array();
	
	//create arrays for every other worksheet
	for($i=0; $i<$no_of_selected_worksheets; $i++){
		${"array".$i}=array();
	}
	${"array".$no_of_selected_worksheets}=array();
	$meanings=array();
	while($row=mysql_fetch_assoc($var_ids)){

	    // get question

		$sql="SELECT question FROM questions WHERE q_id='".$row['q_id']."'";
		$answer=mysql_query($sql);
		$question_text=mysql_fetch_assoc($answer);

        $first_answer=1;  //this is some boolean to show the first variable of question 5 as text and only the rest as graphs
        //this is done for questions with multiple variables
        if($question_text['question']!=$last_question){
        	$last_question=$question_text['question'];
        	$pdf->Ln(5);
        	$question_index=$question_index+1;
        	$first_answer=0;
        	unset($question_text2);
        	$question_text2 = $question_index. '. '.$question_text['question'];
        	$pdf->SetTextColor(51,51,255);
        	$pdf->Row(array($question_text2));
        	$pdf->Ln(1);
        }


        if($question_index!=$questionThatHasGraph || ($first_answer==0 && $question_index==$questionThatHasGraph))
	    {  //question 5 has the graph, not the answers
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
	    	if($w_name==1){
	    	$pdf->Row(array( $row['answer']));
	    	$pdf->Ln(1);
	    }
	    else {$pdf->Row(array( getWorksheetName($worksheetSelected).':'.$row['answer']));
	    	$pdf->Ln(1);}

		 //put the answer from the other worksheets you want to compare to

	    	for($i=0; $i < $no_of_selected_worksheets; $i++){
	    		$sql="SELECT answer FROM answers WHERE w_id='".$other_worksheets[$i]."' AND var_id='".$row['var_id']."'";
	    		$answer=mysql_query($sql);
	    		$row3=mysql_fetch_assoc($answer);
	    		$pdf->Row(array( getWorksheetName($other_worksheets[$i]).': '.$row3['answer']));
	    		$pdf->Ln(1);

	    	}
	    }

	    else 
 			if($question_index==$questionThatHasGraph && $first_answer==1)  //this is question no 5 where we need the graph
 		{
 			$sql="SELECT var_text FROM variable WHERE var_id='".$row['var_id']."'";
 			$var_text=mysql_query($sql);
 			$row2=mysql_fetch_assoc($var_text);
 			array_push(${"array".$no_of_selected_worksheets},$row['answer']); //the last array is the one with the answers of the first worksheet
 			//make an array with meanings
 			array_push($meanings, $row2['var_text']);
		    //make arrays with answers from the other worksheets
 			for($i=0; $i < $no_of_selected_worksheets; $i++){
 				
 				$sql="SELECT answer FROM answers WHERE w_id='".$other_worksheets[$i]."' AND var_id='".$row['var_id']."'";
 				$answer=mysql_query($sql);
 				$row3=mysql_fetch_assoc($answer);

 				array_push(${"array".$i},$row3['answer']);
 				
 			}
 			//if the arrays are full..there are 5 variables in the graph
 			if(sizeof(${"array".$no_of_selected_worksheets})==5){
 				
 				$data=array();
 				$name_of_first_worksheet=getWorksheetName($worksheetSelected);
 				$data[$name_of_first_worksheet]=${"array".$no_of_selected_worksheets};
 				
 				//get names of other worksheets
 				$names=array();

 				for($i=0; $i < $no_of_selected_worksheets; $i++){
 				  array_push($names, getWorksheetName($other_worksheets[$i]));
 				  $data[$names[$i]]=${"array".$i};
 			}
 			
 			$pdf->SetFont('Arial','',12);
 			$pdf->Ln(2);
 			$pdf->CheckPageBreak(100);
 			$pdf->Row(array($pdf->LineGraph(170,100,$data,'HvB')));
 			$pdf->SetFont('Arial','',12);
 			$pdf->Ln(100);
 			//meaning of variables on the abscissa
 			
 			$j=0;
 			$pdf->SetTextColor(0,0,0);
 			foreach ($meanings as $key){
 				$pdf->Row(array('['.$j.']'.' - '.$key));
 				$j++;
 			}
 			}

 		}


 	}

 	$pdf->Output($saveName);
	//$pdf->Output();
 }

//2graphs
function cfd2WorksheetToPDF($worksheetSelected, $other_worksheets, $reportName, $saveName, $username , $comment, $questionThatHasGraph1, $questionThatHasGraph2, $w_name){
	 //$pdf = new FPDF();
	$pdf=new PDF_MC_Table();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',12);
	$pdf->SetWidths(array(190));

     //add report name, date generated, user
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
	$no_of_selected_worksheets = count($other_worksheets);
	$first_iteration=0;

     	//select the answers for the main worksheet
	$sql="SELECT var_id, answer, q_id FROM answers WHERE w_id='".$worksheetSelected."'";
	$var_ids=mysql_query($sql);
	    //select the answers for the other worksheets
	$last_question=' ';
	$data_on_graph_index=0;
	$array_others=array();
	
	//create arrays for every other worksheet
	for($i=0; $i<$no_of_selected_worksheets; $i++){
		${"array".$i}=array();
	}
	${"array".$no_of_selected_worksheets}=array();
	$meanings=array();
	while($row=mysql_fetch_assoc($var_ids)){

	    // get question

		$sql="SELECT question FROM questions WHERE q_id='".$row['q_id']."'";
		$answer=mysql_query($sql);
		$question_text=mysql_fetch_assoc($answer);

        $first_answer=1;  //this is some boolean to show the first variable of question 5 as text and only the rest as graphs
        //this is done for questions with multiple variables
        if($question_text['question']!=$last_question){
        	$last_question=$question_text['question'];
        	$pdf->Ln(5);
        	$question_index=$question_index+1;
        	$first_answer=0;
        	unset($question_text2);
        	$question_text2 = $question_index. '. '.$question_text['question'];
        	$pdf->SetTextColor(51,51,255);
        	$pdf->Row(array($question_text2));
        	$pdf->Ln(1);
        }


        if( ($question_index!=$questionThatHasGraph1 && $question_index!=$questionThatHasGraph2) || ($first_answer==0 && $question_index==$questionThatHasGraph1) || ($first_answer==0 && $question_index==$questionThatHasGraph2))
	    {  //question 5 has the graph, not the answers
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
	    	if($w_name==1){
	    	$pdf->Row(array( $row['answer']));
	    	$pdf->Ln(1);
	    }
	    else {$pdf->Row(array( getWorksheetName($worksheetSelected).':'.$row['answer']));
	    	$pdf->Ln(1);}

		 //put the answer from the other worksheets you want to compare to

	    	for($i=0; $i < $no_of_selected_worksheets; $i++){
	    		$sql="SELECT answer FROM answers WHERE w_id='".$other_worksheets[$i]."' AND var_id='".$row['var_id']."'";
	    		$answer=mysql_query($sql);
	    		$row3=mysql_fetch_assoc($answer);
	    		$pdf->Row(array( getWorksheetName($other_worksheets[$i]).': '.$row3['answer']));
	    		$pdf->Ln(1);

	    	}
	    }

	    else 
 			if( ($question_index==$questionThatHasGraph1 && $first_answer==1) || ($question_index==$questionThatHasGraph2 && $first_answer==1))  //this is question no 5 where we need the graph
 		{
 			$sql="SELECT var_text FROM variable WHERE var_id='".$row['var_id']."'";
 			$var_text=mysql_query($sql);
 			$row2=mysql_fetch_assoc($var_text);
 			array_push(${"array".$no_of_selected_worksheets},$row['answer']); //the last array is the one with the answers of the first worksheet
 			//make an array with meanings
 			array_push($meanings, $row2['var_text']);
		    //make arrays with answers from the other worksheets
 			for($i=0; $i < $no_of_selected_worksheets; $i++){
 				
 				$sql="SELECT answer FROM answers WHERE w_id='".$other_worksheets[$i]."' AND var_id='".$row['var_id']."'";
 				$answer=mysql_query($sql);
 				$row3=mysql_fetch_assoc($answer);

 				array_push(${"array".$i},$row3['answer']);
 				
 			}
 			//if the arrays are full..there are 5 variables in the graph
 			if(sizeof(${"array".$no_of_selected_worksheets})==5){
 				
 				$data=array();
 				$name_of_first_worksheet=getWorksheetName($worksheetSelected);
 				$data[$name_of_first_worksheet]=${"array".$no_of_selected_worksheets};
 				
 				//get names of other worksheets
 				$names=array();

 				for($i=0; $i < $no_of_selected_worksheets; $i++){
 				  array_push($names, getWorksheetName($other_worksheets[$i]));
 				  $data[$names[$i]]=${"array".$i};
 			}
 			
 			$pdf->SetFont('Arial','',12);
 			$pdf->Ln(2);
 			$pdf->CheckPageBreak(100);
 			$pdf->Row(array($pdf->LineGraph(170,100,$data,'HvB')));
 			$pdf->SetFont('Arial','',12);
 			$pdf->Ln(100);
 			//meaning of variables on the abscissa
 			
 			$j=0;
 			$pdf->SetTextColor(0,0,0);
 			foreach ($meanings as $key){
 				$pdf->Row(array('['.$j.']'.' - '.$key));
 				$j++;
 			}
 		//print_r($data);
 			unset($data);
 			unset($meanings);
 			$meanings=array();
 			unset($names);
 			unset(${"array".$no_of_selected_worksheets});
 			${"array".$no_of_selected_worksheets}=array();
 			for($i=0; $i < $no_of_selected_worksheets; $i++){
 				unset(${"array".$i});
 				${"array".$i}=array();
 			}
 			}

 		

 	}
 }

 	$pdf->Output($saveName);
	//$pdf->Output();
 }
?>