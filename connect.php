<?php

//connect to the database
//$connection = mysqli_connect("jkhemming.dns-systems.net", "jkhemming_prd", "ffzetecs16d");
$connection = mysqli_connect("localhost", "root", "", "predikta");
if (!$connection)
{
	header('Location: error.php?error=Failed+to+connect+to+database');
}
?>
