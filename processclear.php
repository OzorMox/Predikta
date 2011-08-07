<?php

//create session
session_start();

//connect to the database
include("connect.php");

if ($_SESSION['admin'] == 1)
{
	mysql_query("DELETE FROM log");
	header('Location: viewlog.php');
	exit();
}
else
{
	header('Location: error.php?error=Permission+denied');
	exit();
}

mysql_close($connection);

?>
