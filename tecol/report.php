<?php
session_start();
echo "<p>Username: ".$_SESSION['username']."</p>";
echo "<p>Username ID: ".$_SESSION['id']."</p>";
echo "<p>Worksheet_id: ".$_POST['worksheet']."</p>";



?>