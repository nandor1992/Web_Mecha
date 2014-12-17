

<?php

//the function returns 1 if the worksheet is complete and 0 otherwise
define("irrelevantVariableId", 2);
define("compulsoryQuestionsType",0);

function worksheetReadyForReport($w_id) {
   // get worksheet type
   $sql="SELECT w_type FROM worksheet WHERE w_id='".$w_id."'";
   $result=mysql_query($sql);
   $row=mysql_fetch_assoc($result);
   $worksheet_type=$row['w_type'];
   mysql_free_result($result);

   //get the id of the questions needed for the worksheet

    $sql="SELECT q_id FROM questions WHERE (w_type='".$worksheet_type."' OR w_type='".compulsoryQuestionsType."')";
    $result=mysql_query($sql);
    $i=0;
    $arrayOfQuestions = array();
    while ($row = mysql_fetch_assoc($result))  {
          $arrayOfQuestions[$i]=$row['q_id'];
          $i++;
        }
    $noOfQuestions=$i;
    //print_r(array_values($arrayOfQuestions));
    mysql_free_result($result);

    //get the id of the variables used in the worksheet
    $index=0;
    $arrayOfVariables = array();
    for($i=0; $i<$noOfQuestions; $i++){
      $sql="SELECT var_id FROM variable WHERE q_id='".$arrayOfQuestions[$i]."'";
      $result=mysql_query($sql);
      while($row=mysql_fetch_assoc($result)){
          $arrayOfVariables[$index] = $row['var_id'];
          $index++;
      }
      mysql_free_result($result);
    }
    $noOfVariables=$index;
    //print_r(array_values($arrayOfVariables));

    //check if the worksheet is ready for report

    for($i=0; $i<$noOfVariables; $i++)
    {
      if($arrayOfVariables[$i]!=irrelevantVariableId)
      {
       $sql="SELECT answer FROM answers WHERE w_id='".$w_id."' AND var_id='".$arrayOfVariables[$i]."'";
       
       $result=mysql_query($sql);
       $row = mysql_fetch_assoc($result);

       if($row=="")
           	return 0;
      mysql_free_result($result);
	    }
	
	}

    return 1;
}

function getWorksheetName($w_id){
   $sql="SELECT w_name FROM worksheet WHERE w_id='".$w_id."'";
   $result=mysql_query($sql);
   $row=mysql_fetch_assoc($result);
   
   return $row['w_name']; 
}

?>

