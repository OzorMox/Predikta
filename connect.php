<?php

//connect to the database
$connection = mysql_connect("jkhemming.dns-systems.net", "jkhemming_prd", "Ffzetecs16d");
//$connection = mysql_connect("localhost", "root", "");
if (!$connection)
{
	header('Location: error.php?error=Failed+to+connect+to+database');
}

mysql_select_db("jkhemming_asaprd", $connection);
?>
