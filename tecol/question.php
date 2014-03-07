<?php
session_start();
echo "<p>Username: ".$_SESSION['username']."</p>";
echo "<p>Username ID: ".$_SESSION['id']."</p>";
echo "<p>Question_id: ".$_POST['question']."</p>";
echo "<p>Country_id: ".$_POST['country']."Country id can be empty</p>";
echo "<p>Worksheet_id: ".$_POST['worksheet']."</p>";



?>