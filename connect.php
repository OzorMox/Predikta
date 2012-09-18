<?php

//connect to the database
$connection = mysql_connect("jkhemming.dns-systems.net", "jkhemming_prd", "ffzetecs16d");
//$connection = mysql_connect("localhost", "root", "ffzetecs16d");
if (!$connection)
{
	header('Location: error.php?error=Failed+to+connect+to+database');
}

mysql_select_db("jkhemming_prd", $connection);
//mysql_select_db("predikta", $connection);
?>
