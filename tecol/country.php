<?php
//it contains all the country like a combobox

$sql="SELECT * FROM countries";

$countries=mysql_query($sql);
if (!$countries)
{
    die('Invalid query: ' . mysql_error());
}
//select list
echo "<select name='answer[]'>";

$i=1;// for indexing
while ($row = mysql_fetch_assoc($countries))
{
	echo "<option value='".$i."'>".$row['country']."</option>";
	$i++;
}
echo "</select>";

?>