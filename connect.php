<?php
date_default_timezone_set('Europe/London');

//connect to the database
$connection = mysqli_connect("localhost", "predikta", "password", "predikta");

if (!$connection)
{
	header('Location: error.php?error=Failed+to+connect+to+database');
}
?>
