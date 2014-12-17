<?php
function worksheetToJson($worksheetSelected){
	$myjson=array();
	$sql="SELECT var_id, answer FROM answers WHERE w_id='".$worksheetSelected."'";
	$var_ids=mysql_query($sql);
	while($row=mysql_fetch_assoc($var_ids)){
		//echo $row['var_id'].": ".$row['answer']."<br>";
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
		//echo $row2['var_text']." ".$row['answer']."<br>";
		$json=array($row2['var_text'] => addslashes($row['answer']));
		array_push($myjson, $json);
	}
	return json_encode($myjson);
}
?>