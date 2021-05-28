<?php

//create session
session_start();

//connect to the database
include("connect.php");

if ($_SESSION['admin'] == 1)
{
	mysqli_query($connection, "DELETE FROM games");
	mysqli_query($connection, "DELETE FROM results");
	mysqli_query($connection, "DELETE FROM messages");
	mysqli_query($connection, "UPDATE players SET brucies = 0, july = 0, august = 0, september = 0, october = 0, november = 0, december = 0, january = 0, february = 0, march = 0, april = 0, may = 0, june = 0, groupstage = 0, knockout = 0");
	mysqli_query($connection, "UPDATE players SET competition = '" . $_POST["competition"] . "' WHERE name = 'Admin'");
	include("log.php");
	$action = "Reset game, competition: " . $_POST["competition"];
	writelog($action);
	header('Location: index.php');
	exit();
}
else
{
	header('Location: error.php?error=Permission+denied');
	exit();
}

mysqli_close($connection);

?>
