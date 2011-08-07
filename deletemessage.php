<?php

//create session
session_start();

//connect to the database
include("connect.php");

if ($_SESSION['admin'] == 1)
{
	mysql_query("DELETE FROM messages WHERE message_id = " . $_GET["message"]);
	include("log.php");
	$action = "Deleted message: " . $_GET["message"];
	writelog($action);
	header('Location: index.php');
	exit();
}
else
{
	header('Location: error.php?error=Permission+denied');
	exit();
}

mysql_close($connection);

?>
