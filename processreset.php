<?php

//create session
session_start();

//connect to the database
include("connect.php");

if ($_SESSION['admin'] == 1)
{
	mysql_query("DELETE FROM games");
	mysql_query("DELETE FROM results");
	mysql_query("DELETE FROM messages");
	mysql_query("UPDATE players SET brucies = 0, july = 0, august = 0, september = 0, october = 0, november = 0, december = 0, january = 0, february = 0, march = 0, april = 0, may = 0, june = 0");
	include("log.php");
	$action = "Reset game";
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
