<?php

//connect to the database
$connection = mysqli_connect("localhost:3306", "predikta", "k5zoM0@8", "predikta");

if (!$connection)
{
	header('Location: error.php?error=Failed+to+connect+to+database');
}
?>
