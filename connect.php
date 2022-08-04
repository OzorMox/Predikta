<?php

//connect to the database
$connection = mysqli_connect("localhost:3306", "predikta", "Uye4#063t", "predikta");

if (!$connection)
{
	header('Location: error.php?error=Failed+to+connect+to+database');
}
?>
